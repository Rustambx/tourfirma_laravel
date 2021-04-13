<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Modules\Navigation\Models\Navigation;
use Faker\Generator as Faker;

$factory->define(Navigation::class, function (Faker $faker) {
    return [
        'title' => 'Тест',
        'path' => '/test',
        'routeName' => 'test'
    ];
});
