<?php

namespace App\Modules\City\Models;

use App\Modules\Country\Models\Country;
use App\Modules\Hotel\Models\Hotel;
use App\Modules\Tour\Models\Tour;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'id', 'title', 'img', 'preview_text', 'detail_text', 'country_id', 'tour_id'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function hotels ()
    {
        return $this->hasMany(Hotel::class);
    }

    public function getArHotelsAttribute ()
    {
        $hotels = $this->hotels()->getResults();
        return $hotels;
    }

    public function tour()
    {
        return $this->belongsToMany(Tour::class);
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
