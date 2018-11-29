<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenuesTable extends Migration
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
              $table->binary('pic');
              $table->unsignedInteger('address_id')->nullable();;
              $table->foreign('address_id')
                  ->references('id')
                  ->on('address')
                  ->onDelete('set null');
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
