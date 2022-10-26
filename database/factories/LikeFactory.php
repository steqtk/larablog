<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Like;
use App\Post;
use App\User;

$factory->define(Like::class, function () {

    $post_count = Post::all()->count();
    $user_count = User::all()->count();
    
    $branch_products = [];
    for ($i = 1; $i <= $post_count; $i++) {
        for ($j = 1; $j <= $user_count; $j++) {
            array_push($branch_products, $i . "-" . $j);
        }
    }
    
    $post_and_users = $this->faker->unique->randomElement($branch_products);
    
    $post_and_users = explode('-', $post_and_users);
    $post_id = $post_and_users[0];
    $user_id = $post_and_users[1];
    
    return [
        "post_id" =>  $post_id,
        "user_id" => $user_id
    ];
});
