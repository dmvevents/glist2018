<?php

use Illuminate\Database\Seeder;

class VenueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \App\Venue::create([
                'name'=>'Asia',
                'address_id'=>'1',
        ]);
    }
}
