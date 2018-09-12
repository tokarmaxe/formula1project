<?php

use Illuminate\Database\Seeder;
use App\Components\Category\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Электроника',
                'image' => '/public/assets/images/electronics.svg'
            ],
            [
                'name' => 'Бытовая техника',
                'image' => '/public/assets/images/appliances.svg'
            ],
            [
                'name' => 'Транспорт',
                'image' => '/public/assets/images/transport.svg'
            ],
            [
                'name' => 'Недвижимость',
                'image' => '/public/assets/images/property.svg'
            ],
            [
                'name' => 'Работа',
                'image' => '/public/assets/images/work.svg'
            ],
            [
                'name' => 'Обмен',
                'image' => '/public/assets/images/exchange.svg'
            ],
            [
                'name' => 'Бизнес и услуги',
                'image' => '/public/assets/images/business.svg'
            ],
            [
                'name' => 'Отдам даром',
                'image' => '/public/assets/images/free.svg'
            ],
            [
                'name' => 'Детский мир',
                'image' => '/public/assets/images/baby.svg'
            ],
            [
                'name' => 'Дом и сад',
                'image' => '/public/assets/images/house.svg'
            ],
            [
                'name' => 'Хобби, отдых, спорт',
                'image' => '/public/assets/images/hobby.svg'
            ],
            [
                'name' => 'Прочее',
                'image' => '/public/assets/images/other.svg'
            ]
        ];

        foreach ($categories as $category) {
            $newCategory = new Category($category);
            $newCategory->save();
        }
    }
}
