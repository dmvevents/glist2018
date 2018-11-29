<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::create(
          'users',
          function (Blueprint $table) {
              $table->engine = 'InnoDB';
              $table->increments('id')->unique();
              $table->string('username')->unique(); // used for slug.
              $table->string('first');
              $table->string('last');
              $table->string('email')->unique();
              $table->unsignedInteger('address_id')->nullable();
              $table->foreign('address_id')
                  ->references('id')->on('address')
                  ->onDelete('set null');
              $table->string('password', 60);
              $table->string('confirmation_code');
              $table->boolean('confirmed')->default(false);
              $table->date('dob')->nullable();
              $table->enum('gender', array('male', 'female'))->nullable();
              $table->string('instagram')->nullable();
              $table->string('twitter')->nullable();
              $table->string('facebook')->nullable();
              $table->string('country')->nullable();
              $table->binary('pic')->nullable();
              $table->boolean('admin')->default(false);
              $table->rememberToken();
              $table->timestamps();
              $table->softDeletes();

          }
      );
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::drop('users');
  }
}
