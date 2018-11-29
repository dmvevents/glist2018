<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('address', function(Blueprint $table)
    {
      $table->engine = 'InnoDB';
      $table->increments('id')->unique();
      $table->string('address1');
      $table->string('address2');
      $table->string('city');
      $table->string('state',2);
      $table->string('postalcode',16);
      $table->string('country',2);
      $table->double('lng', 11, 8);
      $table->double('lat', 10, 8);

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
    // drop address table
    Schema::drop('address');
  }
}
