<?php

namespace App\Modules\News\Services;

use App\Lib\File\CImage;
use App\Lib\File\ImageUploader;
use App\Modules\News\Models\News;

class NewsService
{
    public function all()
    {
        $news = News::all();

        foreach ($news as $item)
        {
            $item->resized_image = CImage::resize($item->img, 300, 364);
        }

        return $news;
    }

    public function find($id)
    {
        return News::find($id);
    }

    public function newsIndex()
    {
        $news = News::orderBy('created_at', 'desc')->take(3)->get();

        return $news;
    }

    public function create($request)
    {
        $data = $request->except('_token');

        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageHelper = new ImageUploader($image);
            if ($imageHelper->checkMimeType()) {
                $imagePath = $imageHelper->save('/storage/images/news');
                $data['img'] = $imagePath;
            } else {
                return ['error' => 'Доступны только jpg и png форматы изображений'];
            }
        } else {
            if (env('APP_ENV') != 'testing') {
                return ['error' => 'Картинка не загружена!'];
            }
        }

        if (News::create($data)) {
            return ['status' => 'Новость добавлена'];
        }
    }

    public function update($request, $id)
    {
        $news = News::find($id);
        $data = $request->except('_token', '_method');

        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageHelper = new ImageUploader($image);
            if ($imageHelper->checkMimeType()) {
                $imagePath = $imageHelper->save('/storage/images/news');
                $data['img'] = $imagePath;
                $oldImageFile = $news->img;
                if (!empty($oldImageFile) && file_exists($_SERVER['DOCUMENT_ROOT']. $oldImageFile)) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . $oldImageFile);
                }
            } else {
                return ['error' => 'Доступны только jpg и png форматы изображений'];
            }
        }

        $news->fill($data);


        if ($news->update()) {
            return ['status' => 'Новость обновлена'];
        }
    }

    public function destroy($id)
    {
        $news = News::find($id);
        if ($news->delete()){
            return ['status' => 'Новость удалена'];
        }
    }
}
