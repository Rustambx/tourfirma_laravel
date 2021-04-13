<?php

namespace App\Modules\Tour\Services;

use App\Lib\File\CImage;
use App\Lib\File\ImageUploader;
use App\Modules\Tour\Models\Tour;

class TourService
{
    public function all()
    {
        $tours = Tour::all();
        foreach ($tours as $tour) {
            $tour->resized_image = CImage::resize($tour->img, 300, 364);
        }

        return $tours;
    }

    public function query()
    {
        return Tour::query();
    }

    public function find($id)
    {
        return Tour::find($id);
    }

    public function toursIndex()
    {
        $tours = Tour::where('hot', 'Y')->take(3)->get();

        foreach ($tours as $tour){
            if ($tour->img) {
                $tour->resized_image = CImage::resize($tour->img, 300, 364);
            }
        }

        return $tours;
    }

    public function create($request)
    {
        $data = $request->except('_token', 'hotel_id');
        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageHelper = new ImageUploader($image);
            if ($imageHelper->checkMimeType()) {
                $imagePath = $imageHelper->save('/storage/images/tours');
                $data['img'] = $imagePath;
            } else {
                return ['error' => 'Доступны только jpg и png форматы изображений'];
            }
        } else {
            if (env('APP_ENV') != 'testing') {
                return ['error' => 'Картинка не загружена!'];
            }
        }


        $tour = new Tour();
        if ($tour->fill($data)->save()) {
            if ($request->get('hotel_id')) {
                $tour->hotels()->attach($request->get('hotel_id'));
            }
            return ['status' => 'Тур добавлен'];

        }
    }

    public function update($request, $id)
    {
        $tour = Tour::find($id);
        $data = $request->except('_token', '_method', 'hotel_id');

        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        if (!isset($data['hot']) || $data['hot'] != 'Y') {
            $data['hot'] = 'N';
        } else {
            $data['hot'] = 'Y';
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageHelper = new ImageUploader($image);
            if ($imageHelper->checkMimeType()) {
                $imagePath = $imageHelper->save('/storage/images/tours');
                $data['img'] = $imagePath;
                $oldImageFile = $tour->img;
                if (!empty($oldImageFile) && file_exists($_SERVER['DOCUMENT_ROOT']. $oldImageFile)) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . $oldImageFile);
                }
            } else {
                return ['error' => 'Доступны только jpg и png форматы изображений'];
            }
        }

        $tour->fill($data);

        if ($tour->update()) {
            if ($request->get('hotel_id') > 0) {
                $tour->hotels()->sync($request->get('hotel_id'));
            }
            return ['status' => 'Тур обновлен'];
        }
    }

    public function destroy($id)
    {
        $tour = Tour::find($id);
        $tour->hotels()->detach();

        if ($tour->delete()) {
            return ['status' => 'Тур удален'];
        }
    }
}
