<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create(
      'user',
      function (Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->increments('id')->unique();
        $table->string('username')->unique(); // used for slug.
        $table->string('first');
        $table->string('last');
        $table->string('email')->unique();
        $table->unsignedInteger('address_id')->nullable();
        $table->string('password', 255);
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
    Schema::drop('user');
  }
}
