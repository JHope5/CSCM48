<?php

use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $announcement = new App\Topic;
        $announcement->name = 'Announcement';
        $announcement->save();

        $general = new App\Topic;
        $general->name = 'General Nonsense';
        $general->save();

        factory(App\Topic::class, 5)->create();
    }
}
