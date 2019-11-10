<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creating an admin
        $admin = new App\User;
        $admin->username = "Administrator";
        $admin->email = "admin@example.com";
        $admin->email_verified_at = now();
        $admin->password = bcrypt('Passw0rd');
        $admin->remember_token = Str::random(10);
        $admin->save();


        factory(App\User::class, 10)->create();
    }
}
