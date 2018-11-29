<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestFk extends Migration
{
  /**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('guest', function(Blueprint $table) {

      $table->foreign('address_id')
      ->references('id')
      ->on('address')
      ->onDelete('set null');

      $table->foreign('number_id')
      ->references('id')
      ->on('number')
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
		Schema::table('guest', function(Blueprint $table) {
      $table->dropForeign('guest_address_id_foreign');

      $table->dropForeign('guest_number_id_foreign');

		});
	}
}
