<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
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
        $postCount = Post::get()->random()->id;
        $tagCount = Tag::get()->random()->id;
        $resultCount = $postCount * $tagCount;

        PostTag::factory()->count($resultCount)->create();
    }
}
