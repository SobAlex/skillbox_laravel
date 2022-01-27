<?php

namespace Database\Seeders;

use App\PostTag;
use App\Post;
use App\Tag;

use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $postCount =  Post::get()->random()->id;
        $tagCount = Tag::get()->random()->id;
        $resultCount = $postCount * $tagCount;

        PostTag::factory()->count($resultCount)->create();
    }
}
