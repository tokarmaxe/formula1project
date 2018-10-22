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
        $posts = [
            [
                'title' => 'Title Name',
                'description' => 'Some Description',
                'price' => 123,
                'category_id' => 1,
                'user_id' => 1,
                'currency' => 'UAH',
            ],
            [
                'title' => 'Title Name',
                'description' => 'Some Description',
                'price' => 123,
                'category_id' => 1,
                'user_id' => 1,
                'currency' => 'UAH',
            ],
            [
                'title' => 'Title Name',
                'description' => 'Some Description',
                'price' => 123,
                'category_id' => 1,
                'user_id' => 1,
                'currency' => 'UAH',
            ],
            [
                'title' => 'Title Name',
                'description' => 'Some Description',
                'price' => 123,
                'category_id' => 1,
                'user_id' => 1,
                'currency' => 'UAH',
            ],
            [
                'title' => 'Title Name',
                'description' => 'Some Description',
                'price' => 123,
                'category_id' => 1,
                'user_id' => 1,
                'currency' => 'UAH',
            ],
            [
                'title' => 'Title Name',
                'description' => 'Some Description',
                'price' => 123,
                'category_id' => 1,
                'user_id' => 1,
                'currency' => 'UAH',
            ],
            [
                'title' => 'Title Name',
                'description' => 'Some Description',
                'price' => 123,
                'category_id' => 1,
                'user_id' => 1,
                'currency' => 'UAH',
            ],
            [
                'title' => 'Title Name',
                'description' => 'Some Description',
                'price' => 123,
                'category_id' => 1,
                'user_id' => 1,
                'currency' => 'UAH',
            ],
            [
                'title' => 'Title Name',
                'description' => 'Some Description',
                'price' => 123,
                'category_id' => 1,
                'user_id' => 1,
                'currency' => 'UAH',
            ],
            [
                'title' => 'Title Name',
                'description' => 'Some Description',
                'price' => 123,
                'category_id' => 1,
                'user_id' => 1,
                'currency' => 'UAH',
            ],
            [
                'title' => 'Title Name',
                'description' => 'Some Description',
                'price' => 123,
                'category_id' => 1,
                'user_id' => 1,
                'currency' => 'UAH',
            ],
            [
                'title' => 'Title Name',
                'description' => 'Some Description',
                'price' => 123,
                'category_id' => 1,
                'user_id' => 1,
                'currency' => 'UAH',
            ],
            [
                'title' => 'Title Name',
                'description' => 'Some Description',
                'price' => 123,
                'category_id' => 1,
                'user_id' => 1,
                'currency' => 'UAH',
            ],
            [
                'title' => 'Title Name',
                'description' => 'Some Description',
                'price' => 123,
                'category_id' => 1,
                'user_id' => 1,
                'currency' => 'UAH',
            ],
            [
                'title' => 'Title Name',
                'description' => 'Some Description',
                'price' => 123,
                'category_id' => 1,
                'user_id' => 1,
                'currency' => 'UAH',
            ],
            [
                'title' => 'Title Name',
                'description' => 'Some Description',
                'price' => 123,
                'category_id' => 1,
                'user_id' => 1,
                'currency' => 'UAH',
            ],
            [
                'title' => 'Title Name',
                'description' => 'Some Description',
                'price' => 123,
                'category_id' => 1,
                'user_id' => 1,
                'currency' => 'UAH',
            ], [
                'title' => 'Title Name',
                'description' => 'Some Description',
                'price' => 123,
                'category_id' => 1,
                'user_id' => 1,
                'currency' => 'UAH',
            ],
            [
                'title' => 'Title Name',
                'description' => 'Some Description',
                'price' => 123,
                'category_id' => 1,
                'user_id' => 1,
                'currency' => 'UAH',
            ],
            [
                'title' => 'Title Name',
                'description' => 'Some Description',
                'price' => 123,
                'category_id' => 1,
                'user_id' => 1,
                'currency' => 'UAH',
            ]
        ];
        foreach ($posts as $post) {
            $newPost = new Post($post);
            $newPost->save();
        }
    }
}
