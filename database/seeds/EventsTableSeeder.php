<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \App\Event::create([
            'name'=>'Asia Fridays',
            'description'=>'Asia Fridays is DC\'s #1 Friday event for the young and hip crowd. Join us each and every Friday for a experience like non other. ',
            'start_date'=>'2015-07-10',
            'end_date'=>'2015-07-11',
            'start_time'=>'21:00:00',
            'end_time'=>'03:00:00',
            'venue_id'=>'1',
            'day_of_week'=>'Friday',
            'female_free_time'=>'24:00:00',
            'male_free_time'=>'24:00:00',
            'female_age'=>'18',
            'male_age'=>'21',
            'repeating'=>'1',
            'repeat_type'=>'Weekly',
        ]);


    }
}
