<?php

use Illuminate\Database\Seeder;
use App\Like;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 5)->create()->each(function($user) {
            $user->posts()->saveMany(factory(App\Post::class, rand(5,10))->make());
        });
        factory(App\Like::class, 50)->create();
    }
}
