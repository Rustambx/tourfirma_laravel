<?php

namespace App\Modules\Hotel\Models;

use App\Modules\Tour\Models\Tour;
use Illuminate\Database\Eloquent\Model;
use App\Modules\City\Models\City;

class Hotel extends Model
{
    protected $fillable = ['title', 'detail_text', 'img', 'price', 'city_id'];

    public function tours ()
    {
        return $this->belongsToMany(Tour::class, 'tour_hotel');
    }

    public function getArToursAttribute ()
    {
        $hotels = $this->tours()->getResults();
        return $hotels;
    }

    public function city ()
    {
        return $this->belongsTo(City::class);
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
