<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Picture::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'description' => $faker->text(200),
        'imgLink' => 'https://loremflickr.com/320/240'
    ];
});
