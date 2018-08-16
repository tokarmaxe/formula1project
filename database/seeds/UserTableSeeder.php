<?php

use Illuminate\Foundation\Auth\User;
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
        $user = new User([
            'api_token' => '....',
            'first_name' => 'Alexey',
            'last_name' => 'Vronsky',
            'email' => 'avronsky@provectus.com',
            'avatar' => 'somePath',
            'is_admin' => true,
            'expired_at' => date('Y-m-d')
        ]);
        $user->save();

        $user = new User([
            'api_token' => '....',
            'first_name' => 'Андрей',
            'last_name' => 'Скляниченко',
            'email' => 'sklyack@gmail.com ',
            'avatar' => 'somePath',
            'is_admin' => true,
            'expired_at' => date('Y-m-d')
        ]);
        $user->save();

        $user = new User([
            'api_token' => '...',
            'first_name' => 'Максим',
            'last_name' => 'Токарь',
            'email' => 'tokarmaxe@gmail.com',
            'avatar' => 'somePath',
            'is_admin' => true,
            'expired_at' => date('Y-m-d')
        ]);
        $user->save();

        $user = new User([
            'api_token' => '...',
            'first_name' => 'Alex',
            'last_name' => 'Shchurovsky',
            'email' => 'ashchurovskyi@provectus.com',
            'avatar' => 'somePath',
            'is_admin' => true,
            'expired_at' => date('Y-m-d')
        ]);
        $user->save();

        $user = new User([
            'api_token' => '...',
            'first_name' => 'DragDealer',
            'last_name' => 'Ivan Litinsky',
            'email' => 'ilitinskiy@provectus.com',
            'avatar' => 'somePath',
            'is_admin' => true,
            'expired_at' => date('Y-m-d')
        ]);
        $user->save();

        $user = new User([
            'api_token' => '...',
            'first_name' => 'Roman',
            'last_name' => 'Kovalevich',
            'email' => 'rkovalevych@determine.com',
            'avatar' => 'somePath',
            'is_admin' => true,
            'expired_at' => date('Y-m-d')
        ]);
        $user->save();

        $user = new User([
            'api_token' => '...',
            'first_name' => 'Aleksandr',
            'last_name' => 'Osadchiy',
            'email' => 'aosadchiy@provectus.com',
            'avatar' => 'somePath',
            'is_admin' => true,
            'expired_at' => date('Y-m-d')
        ]);
        $user->save();

        $user = new User([
            'api_token' => '...',
            'first_name' => 'Aleksandr',
            'last_name' => 'Melnyk',
            'email' => 'almelnik@provectus.com',
            'avatar' => 'somePath',
            'is_admin' => true,
            'expired_at' => date('Y-m-d')
        ]);
        $user->save();

        $user = new User([
            'api_token' => '...',
            'first_name' => 'Анастасия',
            'last_name' => 'Куталова',
            'email' => 'kutalova.a@gmail.com',
            'avatar' => 'somePath',
            'is_admin' => true,
            'expired_at' => date('Y-m-d')
        ]);
        $user->save();

        $user = new User([
            'api_token' => '...',
            'first_name' => 'Денис',
            'last_name' => 'Любченко',
            'email' => 'rexar1988@gmail.com',
            'avatar' => 'somePath',
            'is_admin' => true,
            'expired_at' => date('Y-m-d')
        ]);
        $user->save();

        $user = new User([
            'api_token' => '...',
            'first_name' => 'Сергей',
            'last_name' => 'Пономаренко',
            'email' => 'sergey.ponomarenko.od@gmail.com',
            'avatar' => 'somePath',
            'is_admin' => true,
            'expired_at' => date('Y-m-d')
        ]);
        $user->save();

        $user = new User([
            'api_token' => '...',
            'first_name' => 'Ольга',
            'last_name' => 'Беляева',
            'email' => 'olga.bilyayeva@gmail.com ',
            'avatar' => 'somePath',
            'is_admin' => true,
            'expired_at' => date('Y-m-d')
        ]);
        $user->save();

        $user = new User([
            'api_token' => '...',
            'first_name' => 'Аня',
            'last_name' => 'Журавель',
            'email' => 'ann.zhuravel7@gmail.com',
            'avatar' => 'somePath',
            'is_admin' => true,
            'expired_at' => date('Y-m-d')
        ]);
        $user->save();
    }
}
