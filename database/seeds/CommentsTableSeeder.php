<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment = new App\Comment;
        $comment->content = "10/10. Would read again.";
        $comment->user_id = 2;
        $comment->post_id = 1;
        $comment->save();

        factory(App\Comment::class, 10)->create();
    }
}
