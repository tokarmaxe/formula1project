<?php

use Illuminate\Database\Seeder;
use App\Components\BlackMarketPost\Models\BlackMarketPost;

class BlackMarketPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Components\BlackMarketPost\Models\BlackMarketPost::class, 20)->create();
    }
}
