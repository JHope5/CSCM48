<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new App\Post;
        $post->title = "First Post!";
        $post->content = "This is the first post on the blog";
        $post->user_id = 1;
        $post->save();
        $post->topics()->attach(1);
        $post->topics()->attach(2);

        factory(App\Post::class, 15)->create()->each(function($p) {
            $p->topics()->sync(App\Topic::all()->random(2)); }); 
        // from https://laracasts.com/discuss/channels/laravel/modelfactory-manytomany?page=1#reply=120747
    }
}
