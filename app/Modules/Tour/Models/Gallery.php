<?php

namespace App\Modules\Tour\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['id', 'name', 'img', 'tour_id'];

    public function tour ()
    {
        return $this->belongsTo(Tour::class);
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
