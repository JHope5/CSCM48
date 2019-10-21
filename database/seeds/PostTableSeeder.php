<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $post = new App\Post;
        $post->title = "First Post!";
        $post->content = "This is the first post on the blog";
        $post->user_id = 1;
        $post->save();
    }
}
