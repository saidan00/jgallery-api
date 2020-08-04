<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Album;
use Faker\Generator as Faker;

$factory->define(Album::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'description' => $faker->text(200),
        'coverImgLink' => 'https://loremflickr.com/320/240'
    ];
});
