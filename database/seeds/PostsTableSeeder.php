<?php

use Illuminate\Database\Seeder;
use App\Components\Post\Models\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Components\Post\Models\Post::class, 20)->create();
    }


}
