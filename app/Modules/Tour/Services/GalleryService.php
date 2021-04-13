<?php

namespace App\Modules\Tour\Services;

use App\Lib\File\ImageUploader;
use App\Modules\Tour\Models\Gallery;

class GalleryService
{
    public function all()
    {
        $galleries = Gallery::all();

        return $galleries;
    }

    public function find($id)
    {
        $galley = Gallery::find($id);

        return $galley;
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
                $imagePath = $imageHelper->save('/storage/images/galleries');
                $data['img'] = $imagePath;
            } else {
                return ['error' => 'Доступны только jpg и png форматы изображений'];
            }
        } else {
            if (env('APP_ENV') != 'testing') {
                return ['error' => 'Картинка не загружена!'];
            }
        }

        if (Gallery::create($data)) {
            return ['status' => 'Галерея добавлена'];
        }
    }

    public function update($request, $id)
    {
        $gallery = Gallery::find($id);
        $data = $request->except('_token', '_method');

        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageHelper = new ImageUploader($image);
            if ($imageHelper->checkMimeType()) {
                $imagePath = $imageHelper->save('/storage/images/galleries');
                $data['img'] = $imagePath;
                $oldImageFile = $gallery->img;
                if (!empty($oldImageFile) && file_exists($_SERVER['DOCUMENT_ROOT']. $oldImageFile)) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . $oldImageFile);
                }
            } else {
                return ['error' => 'Доступны только jpg и png форматы изображений'];
            }
        }

        $gallery->fill($data);

        if ($gallery->update()) {
            return ['status' => 'Галерея обновлена'];
        }
    }

    public function destroy($id)
    {
        $gallery = Gallery::find($id);

        if ($gallery->delete()) {
            return ['status' => 'Галерея удалена'];
        }
    }
}
