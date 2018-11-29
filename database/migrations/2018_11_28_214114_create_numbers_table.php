<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNumbersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      // blog number
      Schema::create('number', function(Blueprint $table)
          {
              $table->increments('id')->unique();
              $table->string('number');
              $table->enum('type', array('Home', 'Business','Work','Cell','Fax'));
              $table->string('carrier');
              $table->string('state');
              $table->string('area');
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
      // drop number table
      Schema::drop('number');
  }
}
