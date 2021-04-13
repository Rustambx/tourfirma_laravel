<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Modules\Tour\Models\Gallery;
use App\Modules\Tour\Models\Tour;
use Faker\Generator as Faker;

$factory->define(Gallery::class, function (Faker $faker) {
    $tour = factory(Tour::class)->create();
    return [
        'name' => $faker->name,
        'img' => '/storage/images/countries/5dd7fd31d8094.jpg',
        'tour_id' => $tour->id
    ];
});
