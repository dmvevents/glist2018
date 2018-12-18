<?php

use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
            \App\Address::create([
                'address1'=>'1720 I St NW',
                'city'=>'Washington',
                'state'=>'DC',
                'postalcode'=>'20006',
            ]);
    }
}
