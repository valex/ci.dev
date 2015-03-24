<?php namespace App\Http\Controllers;

use App\CI\Api\Lastfm;
use App\LastfmArtist;
use App\Repositories\LastfmArtistRepository;

class LastfmController extends Controller {

    protected $artistRepository;

    public function __construct(LastfmArtistRepository $artistRepository){
        parent::__construct();

        $this->artistRepository = $artistRepository;
    }

    public function updateDbWithPopular(){

        $country = 'ukraine';

        $lastfmApi = new Lastfm();

        $populars = $lastfmApi->getPopular($country);

        foreach($populars as $popular){
            $artist = $popular['artist'];

            if( ! isset($artist['mbid']) || ! $artist['mbid'])
            {
                continue;
            }

            $artistModel = $this->artistRepository->findByMbid($artist['mbid']);

            if( ! $artistModel){
                $artistModel = $this->artistRepository->create($artist);
            }
        }
    }
}