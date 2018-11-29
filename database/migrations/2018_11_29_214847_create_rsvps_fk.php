<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRsvpsFk extends Migration
{
  /**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('rsvp', function(Blueprint $table) {

      $table->foreign('event_id')
      ->references('id')
      ->on('event')
      ->onDelete('cascade');

      $table->foreign('guest_id')
      ->references('id')
      ->on('guest')
      ->onDelete('cascade');

      $table->foreign('user_id')
      ->references('id')
      ->on('user')
      ->onDelete('cascade');

    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('rsvp', function(Blueprint $table) {
      $table->dropForeign('rsvp_event_id_foreign');

      $table->dropForeign('rsvp_guest_id_foreign');

      $table->dropForeign('rsvp_user_id_foreign');


		});
	}
}
