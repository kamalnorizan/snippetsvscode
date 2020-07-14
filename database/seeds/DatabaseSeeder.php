<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\User::class,50)->create();
        // factory(App\Post::class,200)->create();
        factory(App\Comment::class,10)->create();
    }
}
