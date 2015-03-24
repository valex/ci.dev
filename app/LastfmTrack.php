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
        'name',
        'mbid',
    ];

    public function artist()
    {
        return $this->belongsTo('App\LastfmArtist');
    }
}
