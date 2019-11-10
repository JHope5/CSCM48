<?php

use Illuminate\Database\Seeder;

class AdditionalContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $contact1 = new App\AdditionalContact;
        $contact1->user_id = 1;
        $contact1->phone_number = '07876543210';
        $contact1->save();

        $contact2 = new App\AdditionalContact;
        $contact2->user_id = 6;
        $contact2->address = '3 Main Street';
        $contact2->postcode = 'SA12 3DE';
        $contact2->save();
    }
}
