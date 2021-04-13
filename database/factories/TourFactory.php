<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Modules\Tour\Models\Tour;
use App\Modules\Tour\Models\Type;
use Faker\Generator as Faker;

$factory->define(Tour::class, function (Faker $faker) {
    $typeTour = factory(Type::class)->create();
    return [
        'title' => $faker->name,
        'price' => random_int(1000, 5000),
        'img' => '/storage/images/countries/5dd7fd31d8094.jpg',
        'hot' => 'Y',
        'detail_text' => $faker->text,
        'type_tour_id' => $typeTour->id,
    ];
});
