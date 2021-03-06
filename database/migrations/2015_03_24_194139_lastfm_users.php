<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LastfmUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lastfm_users', function(Blueprint $table)
		{
			$table->engine = "MyISAM";
			$table->increments('id');
			$table->string('name');
			$table->string('url');
			$table->timestamps();

			$table->unique('name');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('lastfm_users');
	}

}
