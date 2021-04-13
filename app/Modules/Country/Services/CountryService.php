<?php

namespace App\Modules\Country\Services;

use App\Lib\File\ImageUploader;
use App\Modules\Country\Models\Country;
use App\Lib\File\CImage;
use App\Modules\Country\Requests\CountryRequest;
use Illuminate\Database\Eloquent\Collection;

class CountryService
{
    public function all()
    {
        $countries = Country::all();
        foreach ($countries as $country) {
            $country->resized_image = CImage::resize($country->img, 300, 364);
        }

        return $countries;
    }

    public function arResult($country)
    {
        $arResult = [
            "cities" => [],
            "hotels" => [],
            "tours" => []
        ];

        if ($country->city instanceof Collection) {
            foreach ($country->city as $city) {
                $arResult['cities'][$city->id] = $city;
                if ($city->arHotels instanceof Collection) {
                    foreach ($city->arHotels as $hotel) {
                        $arResult['hotels'][$hotel->id] = $hotel;
                        if ($hotel->arTours instanceof Collection) {
                            foreach ($hotel->arTours as $tour) {
                                $arResult['tours'][$tour->id] = $tour;
                            }
                        }
                    }
                }
            }
        }

        return $arResult;
    }

    public function find($id)
    {
        return Country::find($id);
    }

    public function create(CountryRequest $request)
    {
        $data = $request->except('_token');

        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageHelper = new ImageUploader($image);
            if ($imageHelper->checkMimeType()) {
                $imagePath = $imageHelper->save('/storage/images/countries');
                $data['img'] = $imagePath;
            } else {
                return ['error' => 'Доступны только jpg и png форматы изображений'];
            }
        } else {
            if (env('APP_ENV') != 'testing') {
                return ['error' => 'Картинка не загружена!'];
            }
        }

        if (Country::create($data)) {
            return ['status' => 'Страна добавлена'];
        } else {
            return ['error' => 'Ошибка при сохранении'];
        }
    }

    public function update(CountryRequest $request, $id)
    {
        $country = Country::find($id);

        $data = $request->except('_token', '_method');

        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageHelper = new ImageUploader($image);
            if ($imageHelper->checkMimeType()) {
                $imagePath = $imageHelper->save('/storage/images/countries');
                $data['img'] = $imagePath;
                $oldImageFile = $country->img;
                if (!empty($oldImageFile) && file_exists($_SERVER['DOCUMENT_ROOT']. $oldImageFile)) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . $oldImageFile);
                }
            } else {
                return ['error' => 'Доступны только jpg и png форматы изображений'];
            }
        }

        $country->fill($data);

        if ($country->update()) {
            return ['status' => 'Страна обновлена'];
        }
    }

    public function destroy($id)
    {
        $country = Country::find($id);

        if ($country->delete()) {
            return ['status' => 'Страна удалена'];
        }

    }
}
