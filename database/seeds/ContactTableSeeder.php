<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->insert([
            'name' => 'Khien Pham',
            'phone' => '0979903200',
            'email' => 'phamkhien@hotmail.com',
        ]);

        factory(App\Models\Contact::class, 20)->create();
    }
}
