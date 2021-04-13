<?php

namespace App\Modules\Navigation\Models;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    protected $fillable = ['title', 'path', 'routeName'];

    protected $table = 'navigations';
}
