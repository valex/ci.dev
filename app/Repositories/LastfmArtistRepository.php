<?php namespace App\Repositories;

use App\LastfmArtist;

class LastfmArtistRepository {

    public function findByMbid($mbid){

        return LastfmArtist::where('mbid', $mbid)->first();
    }

    public function create($attributes = []){
        return LastfmArtist::create($attributes);
    }
}