<?php

use Illuminate\Database\Seeder;
use App\Components\User\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userModel = new User;
        $users = [
            [
                'api_token' => $userModel->createToken(),
                'first_name' => 'Alexey',
                'last_name' => 'Vronsky',
                'email' => 'avronsky@provectus.com',
                'is_admin' => true,
                'expired_at' => date('Y-m-d')
            ],
            [
                'api_token' => $userModel->createToken(),
                'first_name' => 'Андрей',
                'last_name' => 'Скляниченко',
                'email' => 'sklyack@gmail.com',
                'telegram' => 'sklyack',
                'is_admin' => true,
                'expired_at' => date('Y-m-d')
            ],
            [
                'api_token' => $userModel->createToken(),
                'first_name' =>'Максим' ,
                'last_name' => 'Токарь',
                'telegram' => 'max',
                'email' => 'tokarmaxe@gmail.com',
                'is_admin' => true,
                'expired_at' => date('Y-m-d')
            ],
            [
                'api_token' => $userModel->createToken(),
                'first_name' => 'Alex',
                'last_name' => 'Shchurovsky',
                'email' => 'ashchurovskyi@provectus.com',
                'telegram' => 'alex',
                'is_admin' => true,
                'expired_at' => date('Y-m-d')
            ],
            [
                'api_token' => $userModel->createToken(),
                'first_name' => 'Ivan',
                'last_name' => 'Litinsky',
                'email' => 'ilitinskiy@provectus.com',
                'telegram' => 'ilitinskiy',
                'is_admin' => true,
                'expired_at' => date('Y-m-d')
            ],
            [
                'api_token' => $userModel->createToken(),
                'first_name' => 'Roman',
                'last_name' => 'Kovalevich',
                'email' => 'rkovalevych@determine.com',
                'telegram' => 'rkovalevych',
                'is_admin' => true,
                'expired_at' => date('Y-m-d')
            ],
            [
                'api_token' => $userModel->createToken(),
                'first_name' => 'Aleksandr',
                'last_name' => 'Osadchiy',
                'telegram' => 'aosadchiy',
                'email' => 'aosadchiy@provectus.com',
                'is_admin' => true,
                'expired_at' => date('Y-m-d')
            ],
            [
                'api_token' => $userModel->createToken(),
                'first_name' => 'Aleksandr',
                'last_name' => 'Melnyk',
                'email' => 'almelnik@provectus.com',
                'is_admin' => true,
                'expired_at' => date('Y-m-d')
            ],
            [
                'api_token' => $userModel->createToken(),
                'first_name' => 'Анастасия',
                'last_name' => 'Куталова',
                'email' => 'kutalova.a@gmail.com',
                'telegram' => 'kto_et0',
                'is_admin' => true,
                'expired_at' => date('Y-m-d')
            ],
            [
                'api_token' => $userModel->createToken(),
                'first_name' => 'Денис',
                'last_name' => 'Любченко',
                'email' => 'rexar1988@gmail.com',
                'is_admin' => true,
                'expired_at' => date('Y-m-d')
            ],
            [
                'api_token' => $userModel->createToken(),
                'first_name' => 'Сергей',
                'last_name' => 'Пономаренко',
                'email' => 'sergey.ponomarenko.od@gmail.com',
                'telegram' => 'Sanktium',
                'is_admin' => true,
                'expired_at' => date('Y-m-d')
            ],
            [
                'api_token' => $userModel->createToken(),
                'first_name' => 'Аня',
                'last_name' => 'Журавель',
                'email' => 'ann.zhuravel7@gmail.com',
                'telegram' => 'ann.zhuravel7',
                'is_admin' => true,
                'expired_at' => date('Y-m-d')
            ]

        ];


        foreach ($users as $data) {
            $userModel->create($data);
        }

        $this->call(CategoriesTableSeeder::class);
        $this->call(PostsTableSeeder::class);
    }
}
