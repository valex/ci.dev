<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class LastfmPopularTrack extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lastfm_popular_tracks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['country'];

}
