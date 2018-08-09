<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User([
            'token'=>'....',
            'nickname'=>'DragDealer',
            'name'=>'Alexey Vronsky',
            'email'=>'avronsky@provectus.com',
            'avatar'=>'somePath',
            'is_admin'=>true
        ]);
        $user->save();

        $user = new \App\User([
            'token'=>'....',
            'nickname'=>'DragDealer',
            'name'=>'Скляниченко Адрей',
            'email'=>'sklyack@gmail.com ',
            'avatar'=>'somePath',
            'is_admin'=>true
        ]);
        $user->save();

        $user = new \App\User([
            'token'=>'ya29.GlvzBctlH0-jYX0D4bqyDh6J0NUI2VJzUjDz6lNSddtnbW_XHTaWiK4bTLJboif-7300mDdL2JlbVSWqBrOcXThKBToX4P5pxEELlc3IZCNuuHK9u2-2zmbmHoQt',
            'nickname'=>'DragDealer',
            'name'=>'Токарь Максим',
            'email'=>'tokarmaxe@gmail.com',
            'avatar'=>'somePath',
            'is_admin'=>true
        ]);
        $user->save();
    }
}
