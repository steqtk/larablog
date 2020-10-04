<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $imgs = scandir(public_path().'/img');
    unset($imgs[0], $imgs[1]);
    shuffle($imgs);
    $images = array_slice($imgs, 2, rand(1, 25));
    foreach ($images as &$image) {
        $image = 'img/'.$image;
    }
    return [
        'title' => $faker->sentence(5),
        'text' => $faker->text(200),
        'image' => serialize($images)
    ];
});
