<?php

namespace App\Modules\Tour\Models;

use App\Modules\City\Models\City;
use App\Modules\Hotel\Models\Hotel;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = ['title', 'img', 'detail_text', 'price', 'city_id', 'hotel_id', 'type_tour_id', 'hot'];

    public function hotels ()
    {
        return $this->belongsToMany(Hotel::class, 'tour_hotel');
    }

    public function getArHotelsAttribute ()
    {
        $hotels = $this->hotels()->getResults();
        return $hotels;
    }

    public function getArTypeAttribute ()
    {
        $type = Type::all()->where('id',  $this->type_tour_id);
        return $type;
    }

    public function city ()
    {
        return $this->belongsTo(City::class);
    }

    public function type ()
    {
        return $this->belongsTo(Type::class, 'type_tour_id');
    }

    public function galleries ()
    {
        return $this->hasMany(Gallery::class);
    }

    public function getArCitiesAttribute()
    {
        $arTempCities = [];
        $arHotels = $this->ar_hotels;
        foreach ($arHotels as $hotel) {
            $city = $hotel->city;
            $arTempCities[$city->id] = $city->title;
        }
        return $arTempCities;
    }


    protected static function boot()
    {
        parent::boot();
        /**
         * Удаление картинок и ресайзов
         */
        static::deleted (function ($model) {
            $realPath = public_path() . $model->img;
            if (file_exists($realPath)) {
                if (preg_match('/(.*?)(\w+)\.(\w+)$/', $model->img, $matches)) {
                    $files = glob(public_path() . $matches[1] . $matches[2] . '_resize_*');
                    if (is_array($files)) {
                        foreach ($files as $file) {
                            unlink($file);
                        }
                    }
                }
                unlink($realPath);
            }
        });
    }
}
