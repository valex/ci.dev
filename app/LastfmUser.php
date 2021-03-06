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
        'url',
    ];

    public function favtracks()
    {
        return $this->belongsToMany('App\LastfmTrack', 'lastfm_fans', 'user_id', 'track_id');
    }
}
