<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Modules\Country\Models\Country;
use App\Modules\Slider\Models\Slider;
use Faker\Generator as Faker;

$factory->define(Slider::class, function (Faker $faker) {
    $country = factory(Country::class)->create();
    return [
        'title' => $faker->name,
        'img' => '/storage/images/countries/5dd7fd31d8094.jpg',
        'price' => random_int(1000, 5000),
        'country_id' => $country->id
    ];
});
