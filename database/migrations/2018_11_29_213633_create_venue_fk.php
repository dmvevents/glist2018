<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenueFk extends Migration
{
  /**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('venue', function(Blueprint $table) {
      $table->foreign('address_id')
          ->references('id')
          ->on('address')
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
		Schema::table('venue', function(Blueprint $table) {
      $table->dropForeign('venue_address_id_foreign');
		});
	}
}
