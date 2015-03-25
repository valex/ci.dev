<?php namespace App\CI\Api;

// http://www.last.fm/api
class Lastfm
{
    protected $api_key = 'eaf84f834c7037dcf064919065a8fd0b';
    protected $client;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }


    public function initializeUserDict(){

        $userDict = [];

        $fmusers = \App\LastfmUser::with('favtracks')->take(500)->get();
        $fmtracks = \App\LastfmTrack::all();

        $allTracksDict = [];
        foreach($fmtracks as $fmtrack){
            $allTracksDict[$fmtrack->mbid] = 0.0;
        }

        foreach($fmusers as $fmuser){

            $favtracks = $fmuser->favtracks;

            $userDict[$fmuser->name] = $allTracksDict;

            foreach($favtracks as $favtrack){
                $userDict[$fmuser->name][$favtrack->mbid] = 1.0;
            }

        }

        return $userDict;
    }

    public function getPopular($country){

        // http://www.last.fm/api/show/geo.getTopTracks

        $country = strtolower($country);

        $url = 'http://ws.audioscrobbler.com/2.0/?method=geo.gettoptracks&country='.$country.'&api_key='.$this->api_key.'&format=json&limit=999';

        $res = $this->client->get($url);

        $results = $res->json();

        if( ! isset($results['toptracks']) || ! isset($results['toptracks']['track']))
            return [];


        return $results['toptracks']['track'];
    }

    public function getFans($mbid){

        $url = 'http://ws.audioscrobbler.com/2.0/?method=track.gettopfans&mbid='.$mbid.'&api_key='.$this->api_key.'&format=json&limit=1000';

        $res = $this->client->get($url);

        $results = $res->json();

        if( ! isset($results['topfans']) || ! isset($results['topfans']['user']))
            return [];

        return $results['topfans']['user'];
    }
}