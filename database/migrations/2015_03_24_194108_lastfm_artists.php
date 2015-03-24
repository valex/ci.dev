<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LastfmArtists extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lastfm_artists', function(Blueprint $table)
		{
			$table->engine = "MyISAM";
			$table->increments('id');
			$table->string('mbid');
			$table->string('name');
			$table->string('url');
			$table->timestamps();

			$table->unique('mbid');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('lastfm_artists');
	}

}
