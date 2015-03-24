<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LastfmPopularTracks extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lastfm_popular_tracks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('country');
			$table->string('track_mbid');
			$table->string('track_name');
			$table->string('artist_name');
			$table->string('artist_mbid');
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
		Schema::dropIfExists('lastfm_popular_tracks');
	}

}
