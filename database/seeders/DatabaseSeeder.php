<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\TestimonialsSeeder;
use Database\Seeders\NewsSeeder;
use Database\Seeders\MusicSeeder;
use Database\Seeders\CommentSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([LaratrustSeeder::class,UserTableSeederr::class]); 
        // $this->call([TestimonialsSeeder::class,NewsSeeder::class]); 
        // $this->call([MusicSeeder::class]); 
        // $this->call([CommentSeeder::class]); 
    }
}
