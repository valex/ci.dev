<?php namespace App\Repositories;

use App\LastfmTrack;

class LastfmTrackRepository {

    public function all(){
        return LastfmTrack::all();
    }

    public function findByMbid($mbid){

        return LastfmTrack::where('mbid', $mbid)->first();
    }

    public function create($attributes = []){
        return LastfmTrack::create($attributes);
    }
}