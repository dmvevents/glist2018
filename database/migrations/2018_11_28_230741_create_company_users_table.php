<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyUsersTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    // company_user table
    Schema::create('company_user', function(Blueprint $table)
    {
      $table->increments('id')->unique();
      $table->unsignedInteger('company_id');
      $table->foreign('company_id')
      ->references('id')
      ->on('company')
      ->onDelete('cascade');
      $table->unsignedInteger('user_id');
      $table->foreign('user_id')
      ->references('id')
      ->on('users')
      ->onDelete('cascade');
      $table->boolean('is_owner')->default(false);
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
    // drop company_user table
    Schema::drop('company_user');
  }

}
