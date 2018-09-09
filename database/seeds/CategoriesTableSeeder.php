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
            ['name' => 'Электроника'],
            ['name' => 'Бытовая техника'],
            ['name' => 'Транспорт'],
            ['name' => 'Недвижимость'],
            ['name' => 'Работа'],
            ['name' => 'Обмен'],
            ['name' => 'Бизнес и услуги'],
            ['name' => 'Отдам даром'],
            ['name' => 'Детский мир'],
            ['name' => 'Дом и сад'],
            ['name' => 'Хобби, отдых, спорт'],
            ['name' => 'Прочее']
        ];

        foreach ($categories as $category)
        {
            $newCategory = new Category($category);
            $newCategory->save();
        }
    }
}
