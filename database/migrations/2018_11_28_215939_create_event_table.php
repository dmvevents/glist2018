<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    // blog table
    Schema::create('event', function(Blueprint $table)
    {
      $table->engine = 'InnoDB';
      $table->increments('id')->unique();
      $table->string('name');
      $table->text('description');
      $table->date('start_date');
      $table->date('end_date');
      $table->time('start_time');
      $table->time('end_time');
      $table->unsignedInteger('venue_id')->nullable();

      $table->enum('day_of_week', array(
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
        'Sunday'));
      $table->time('female_free_time');
      $table->time('male_free_time');
      $table->integer('female_age');
      $table->integer('male_age');
      $table->string('dress_code');
      $table->binary('pic');
      $table->boolean('repeating')->default(false);
      $table->enum('repeat_type', array(
        'Daily',
        'Weekly',
        'Bi-Weekly',
        'Monthly',
        'Yearly'));
      $table->timestamps();
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('event');
  }
}
