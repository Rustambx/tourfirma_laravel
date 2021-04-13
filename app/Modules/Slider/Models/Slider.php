<?php

namespace App\Modules\Slider\Models;

use App\Modules\Country\Models\Country;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['title', 'price', 'img', 'country_id'];

    public function country ()
    {
        return $this->belongsTo(Country::class);
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
