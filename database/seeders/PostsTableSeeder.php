<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Faker\Provider\Lorem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name' => 'Jake Smith',
            'email' => 'jsmith@smith.com',
            'password' => Hash::make('password'),
            'role' => 'writer'
        ]);
        $user2 = User::create([
            'name' => 'Jane Nowak',
            'email' => 'jnowak@nowak.com',
            'password' => Hash::make('password'),
            'role' => 'writer'
        ]);

        Category::create([
            'name' => 'JavaScript'
        ]);
        Category::create([
            'name' => 'Laravel'
        ]);
        $user1->posts()->create(
            [
                'title' => 'Lorem ipsum',
                'description' => 'Dolor sit amet consectetur',
                'content' => 'Adipisicing elit. Nihil ex est beatae autem saepe nesciunt quis sit nam voluptatem enim repellendus, facilis officia fugiat repellat veritatis voluptas temporibus necessitatibus veniam?',
                'category_id' => 1,
                'image' => 'postimgs/hIQRwXBsbgUB010GH4f5gOPeHmnxnUbxr4vC5DjM.jpeg',
            ]
        );
        $user2->posts()->create(
            [
                'title' => 'Lorem ipsum',
                'description' => 'Dolor sit amet consectetur',
                'content' => 'Adipisicing elit. Nihil ex est beatae autem saepe nesciunt quis sit nam voluptatem enim repellendus, facilis officia fugiat repellat veritatis voluptas temporibus necessitatibus veniam?',
                'category_id' => 1,
                'image' => 'postimgs/hIQRwXBsbgUB010GH4f5gOPeHmnxnUbxr4vC5DjM.jpeg',
            ]
        );
        $user1->posts()->create(
            [
                'title' => 'Lorem ipsum',
                'description' => 'Dolor sit amet consectetur',
                'content' => 'Adipisicing elit. Nihil ex est beatae autem saepe nesciunt quis sit nam voluptatem enim repellendus, facilis officia fugiat repellat veritatis voluptas temporibus necessitatibus veniam?',
                'category_id' => 1,
                'image' => 'postimgs/hIQRwXBsbgUB010GH4f5gOPeHmnxnUbxr4vC5DjM.jpeg',
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
