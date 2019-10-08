<?php

// use App\Category;
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
    	// parent::run();
        // $this->call(UsersTableSeeder::class);
        factory(\App\Post::class, 10)->create();
        factory(\App\Category::class, 10)->create();
        factory(\App\User::class, 10)->create();
    }
}
