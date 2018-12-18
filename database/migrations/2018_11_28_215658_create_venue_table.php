<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenueTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      // blog guest
      Schema::create('venue', function(Blueprint $table)
          {
              $table->increments('id')->unique();
              $table->string('name');
              $table->binary('pic')->nullable();
              $table->unsignedInteger('address_id')->nullable();;
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
      // drop blog venue
      Schema::drop('venue');
  }

}
