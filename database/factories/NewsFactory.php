<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Modules\News\Models\News;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'img' => '/storage/images/news/5dd8030c382fb.jpg',
        'preview_text' => $faker->text,
        'detail_text' => $faker->text,
    ];
});
