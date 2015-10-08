<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('actions', function (Blueprint $table) {
			$table->increments('id');
			$table->string('action');
			$table->integer('country_id_from');
			$table->integer('country_id_to');
			$table->boolean('executed');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('actions');
	}
}
