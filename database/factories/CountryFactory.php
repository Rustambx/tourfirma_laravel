<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Modules\Country\Models\Country;
use Faker\Generator as Faker;

$factory->define(Country::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'img' => '/storage/images/countries/5dd7fd31d8094.jpg',
        'preview_text' => $faker->text,
        'detail_text' => $faker->text,
    ];
});
