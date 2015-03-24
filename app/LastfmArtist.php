<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class LastfmArtist extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lastfm_artists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'mbid',
        'url'
    ];

}
