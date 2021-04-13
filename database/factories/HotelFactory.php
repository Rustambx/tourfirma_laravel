<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Modules\City\Models\City;
use App\Modules\Hotel\Models\Hotel;
use Faker\Generator as Faker;

$factory->define(Hotel::class, function (Faker $faker) {
    $city = factory(City::class)->create();
    return [
        'title' => $faker->name,
        'price' => random_int(1000, 5000),
        'img' => '/storage/images/countries/5dd7fd31d8094.jpg',
        'detail_text' => $faker->text,
        'city_id' => $city->id,
    ];
});
