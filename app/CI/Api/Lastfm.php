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


    public function initializeUserDict($country){
        $userDict = [];

        $populars  = $this->getPopular($country);

        foreach($populars as $popular){
var_dump($popular);exit;
            $fans = $this->getFans($popular['mbid']);

            foreach($fans as $fan){
                $userDict[$fan['name']] = [];
            }
        }

        return $userDict;
    }

    public function getPopular($country){

        // http://www.last.fm/api/show/geo.getTopTracks

        $country = strtolower($country);

        $url = 'http://ws.audioscrobbler.com/2.0/?method=geo.gettoptracks&country='.$country.'&api_key='.$this->api_key.'&format=json&limit=10';

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