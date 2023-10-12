<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
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
         User::factory(5)->create()->each(function($user)
         {
          $user->posts()->save(Post::factory()->make());

         });


        
        
        
        
        

        // هي الطريقة استعملا بالفيديو بس مو زابطة لانو  غير تنسخة لارفل
        //factory(User::class,2)->create();

    }
}
