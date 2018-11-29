<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRsvpsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::create('rsvp', function(Blueprint $table)
          {
              $table->increments('id')->unique();
              $table->unsignedInteger('event_id')->nullable();
              $table->foreign('event_id')
                  ->references('id')
                  ->on('event')
                  ->onDelete('set null');
              $table->unsignedInteger('guest_id')->nullable();
              $table->foreign('guest_id')
                  ->references('id')
                  ->on('guest');
              $table->unsignedInteger('user_id')->nullable();
              $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
              $table->date('rsvp_date');
              $table->integer('num_of_guest')->default(0);
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
        Schema::dropIfExists('rsvps');
    }
}
