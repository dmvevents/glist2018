<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {    // blog company
    Schema::create('company', function(Blueprint $table)
    {
      $table->increments('id')->unique();
      $table->string('name');
      $table->string('email')->unique();
      $table->unsignedInteger('address_id')->nullable();;
      $table->foreign('address_id')
      ->references('id')
      ->on('address')
      ->onDelete('set null');
      $table->string('ein');

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
    Schema::dropIfExists('groups');
  }
}
