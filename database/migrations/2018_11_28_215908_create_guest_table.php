<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    // blog guest
    Schema::create('guest', function(Blueprint $table)
    {
      $table->engine = 'InnoDB';
      $table->increments('id')->unique();
      $table->string('first');
      $table->string('last');
      $table->string('email');
      $table->unsignedInteger('address_id')->nullable();

      $table->unsignedInteger('number_id')->nullable();

      $table->date('dob')->nullable();
      $table->enum('gender', array('male', 'female'))->nullable();
      $table->string('instagram')->nullable();
      $table->string('twitter')->nullable();
      $table->string('facebook')->nullable();
      $table->string('country')->nullable();
      $table->binary('pic')->nullable();
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
    // drop blog guest

    Schema::dropIfExists('guest', function(Blueprint $table)
    {
      $table->dropForeign(['address_id']);
      $table->dropForeign(['number_id']);
    });
  }
}
