<?php

namespace App\Modules\Tour\Controllers;

use App\Http\Controllers\Controller;
use App\Lib\File\CImage;
use App\Modules\Tour\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Tour;
use Country;
use City;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $countries = Country::all();
        $types = Type::all();

        $countryId = $request->query("country");
        $cityId = $request->query("city");

        $query = Tour::query();

        if ($countryId > 0 && $cityId <= 0) {
            $arCities = City::all()->where("country_id", $countryId);
            $cities = $arCities->pluck('id');
            $query->whereHas('hotels', function ($hotelQuery) use ($cities) {
                return $hotelQuery->whereIn('city_id', $cities);
            });
        } else if ($cityId > 0) {
            $query->whereHas('hotels', function ($hotelQuery) use ($cityId) {
                return $hotelQuery->where('city_id', $cityId);
            });
        }

        if ($request->query('hot') == "Y") {
            $query->where('hot', 'Y');
        }
        if ($request->query('price') >= 100) {
            $query->where('price', '<', intval($request->query('price')));
        }
        if ($request->query('type_tour_id')){
            $query->where('type_tour_id', $request->query('type_tour_id'));
        }

        $tours = $query->get();
        foreach ($tours as $tour){
            if ($tour->img) {
                $tour->resized_image = CImage::resize($tour->img, 300, 364);
            }
        }

        $this->view('tour::index');

        return $this->render(compact('tours', 'countries', 'types'));
    }

    public function show($id)
    {
        $tour = Tour::find($id);

        $arResult = [
            "countries" => [],
            "cities" => [],
            "hotels" => [],
        ];

        if ($tour->arHotels instanceof Collection) {
            foreach ($tour->arHotels as $hotel) {
                $arResult['countries'][$hotel->city->country->id] = $hotel->city->country;
                $arResult['hotels'][$hotel->id] = $hotel;
                $arResult['cities'][$hotel->city->id] = $hotel->city;
            }
        }

        $galleries = $tour->galleries;
        foreach ($galleries as $gallery) {
            $gallery->resized_image = CImage::resize($gallery->img, 250, 150);
        }

        $this->view('tour::show');

        return $this->render(compact('tour', 'arResult', 'galleries'));
    }
}
