<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nickname' => 'Sklyack',
            'email' => 'sklyack@gmail.com',
            'access_token' => '00000000000000000',
            'avatar' => 'localhost',
            'name' => 'Andrii Sklianichenko',
            'expired_at' => Carbon::parse('2020-01-01'),
            'is_admin' => '1'
        ]);
    }
}
