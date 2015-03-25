<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class LastfmFan extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lastfm_fans';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastfm_track_id',
        'lastfm_user_id',
    ];

}
