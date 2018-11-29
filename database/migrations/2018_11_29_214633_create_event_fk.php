<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventFk extends Migration
{
  /**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('event', function(Blueprint $table) {
      $table->foreign('venue_id')
      ->references('id')
      ->on('venue')
      ->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('event', function(Blueprint $table) {
      $table->dropForeign('event_venue_id_foreign');
		});
	}
}
