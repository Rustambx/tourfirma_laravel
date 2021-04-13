<?php

namespace App\Modules\News\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'img', 'preview_text', 'detail_text'];
}
