<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class LastfmTrack extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lastfm_tracks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastfm_artist_id',
        'name',
        'mbid',
        'url'
    ];

    public function artist()
    {
        return $this->belongsTo('App\LastfmArtist');
    }

    public function fans()
    {
        return $this->belongsToMany('App\LastfmUser', 'lastfm_fans', 'track_id', 'user_id');
    }
}
