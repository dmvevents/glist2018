<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
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
      $table->string('address2')->nullable();
      $table->string('city');
      $table->string('state',2);
      $table->string('postalcode',16);
      $table->string('country',2)->nullable();
      $table->double('lng', 11, 8)->nullable();
      $table->double('lat', 10, 8)->nullable();

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
