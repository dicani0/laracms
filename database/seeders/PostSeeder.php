<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'JavaScript'
        ]);
        Category::create([
            'name' => 'Laravel'
        ]);
        Post::create(
            [
                'title' => 'Lorem ipsum',
                'description' => 'Dolor sit amet consectetur',
                'content' => 'Adipisicing elit. Nihil ex est beatae autem saepe nesciunt quis sit nam voluptatem enim repellendus, facilis officia fugiat repellat veritatis voluptas temporibus necessitatibus veniam?',
                'category_id' => 1,
            ]
        );
        Post::create(
            [
                'title' => 'Lorem ipsum',
                'description' => 'Dolor sit amet consectetur',
                'content' => 'Adipisicing elit. Nihil ex est beatae autem saepe nesciunt quis sit nam voluptatem enim repellendus, facilis officia fugiat repellat veritatis voluptas temporibus necessitatibus veniam?',
                'category_id' => 1,
            ]
        );
        Post::create(
            [
                'title' => 'Lorem ipsum',
                'description' => 'Dolor sit amet consectetur',
                'content' => 'Adipisicing elit. Nihil ex est beatae autem saepe nesciunt quis sit nam voluptatem enim repellendus, facilis officia fugiat repellat veritatis voluptas temporibus necessitatibus veniam?',
                'category_id' => 1,
            ]
        )
            ->tags()
            ->attach(
                [
                    Tag::create([
                        'name' => 'SQL'
                    ])->id
                ]
            );
    }
}
