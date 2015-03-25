<?php namespace App\Repositories;

use App\LastfmUser;

class LastfmUserRepository {

    public function all(){
        return LastfmUser::all();
    }

    public function findByName($name){

        return LastfmUser::where('name', $name)->first();
    }

    public function create($attributes = []){
        return LastfmUser::create($attributes);
    }
}