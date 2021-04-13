<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Modules\City\Models\City;
use Faker\Generator as Faker;
use App\Modules\Country\Models\Country;

$factory->define(City::class, function (Faker $faker) {
    $country = factory(Country::class)->create();

    return [
        'title' => $faker->name,
        'img' => '/storage/images/cities/5dd801afac376.jpg',
        'preview_text' => $faker->text,
        'detail_text' => $faker->text,
        'country_id' => $country->id
    ];
});
