<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class LastfmUser extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lastfm_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'mbid',
    ];

}
