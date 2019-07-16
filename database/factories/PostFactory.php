<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $imgs = scandir(public_path().'/img');
    unset($imgs[0]);unset($imgs[1]);
    shuffle($imgs);
    $photos = array_slice($imgs, 2, rand(1, 50));

    return [
        'title' => $faker->sentence(5),
        'content' => $faker->text(300),
        'photo' => serialize($photos)
    ];
});