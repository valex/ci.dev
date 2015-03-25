<?php namespace App\Http\Controllers;

use App\CI\Api\Lastfm;
use App\LastfmArtist;
use App\LastfmTrack;
use App\Repositories\LastfmArtistRepository;
use App\Repositories\LastfmTrackRepository;
use App\Repositories\LastfmUserRepository;

class LastfmController extends Controller {

    protected $artistRepository;
    protected $trackRepository;
    protected $userRepository;

    public function __construct(LastfmArtistRepository $artistRepository,
                        LastfmTrackRepository $trackRepository,
                        LastfmUserRepository $userRepository
    ){
        parent::__construct();

        $this->artistRepository = $artistRepository;
        $this->trackRepository = $trackRepository;
        $this->userRepository = $userRepository;
    }

    public function updateDbWithFans(){

        set_time_limit ( 300 );

        $new_users = 0;

        $lastfmApi = new Lastfm();

        $tracks = $this->trackRepository->all();

        foreach($tracks as $track){

            if( $track->fans()->count() > 0)
                continue;

            $fans = $lastfmApi->getFans($track->mbid);

            foreach($fans as $fan){

                if( ! isset($fan['name']) || $fan['name'] == ''){
                    continue;
                }

                $userModel = $this->userRepository->findByName($fan['name']);

                if( ! $userModel){
                    $userModel = $this->userRepository->create($fan);

                    $new_users++;
                }

                $userModel->favtracks()->attach($track);
            }
        }

        return view('lastfm.updateDbWithFans', compact('new_users'));
    }

    public function updateDbWithPopular(){

        $country = 'ukraine';

        $new_artists = 0;
        $new_tracks = 0;

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

                $new_artists++;
            }

            if( ! isset($popular['mbid']) || ! $popular['mbid'])
            {
                continue;
            }

            $trackModel = $this->trackRepository->findByMbid($popular['mbid']);

            if( ! $trackModel){
                $trackModel = $this->trackRepository->create([
                    'lastfm_artist_id' => $artistModel->id,
                    'name' => $popular['name'],
                    'mbid' => $popular['mbid'],
                    'url' => $popular['url']
                ]);

                $new_tracks++;
            }
        }

        return view('lastfm.updateDbWithPopular', compact('new_artists', 'new_tracks'));
    }
}