<?php namespace App\CI\Api;

class Delicious
{
    protected $client;

    public function __construct(){
        $this->client = new \GuzzleHttp\Client();


    }

    public function getPopular($tags){

        $tagsQuery = implode('+', $tags);

        $url = 'http://feeds.delicious.com/v2/json/tag/'.$tagsQuery.'?count=100';

        $res = $this->client->get($url);

        $results = $res->json();

        foreach($results as $post){
            var_dump($this->getUrlInfo($post['u']));
        }

        /*
        $this->client->send($req)->then(function ($response) {
            echo 'I completed! ' . $response;
        });
        */
    }

    public function getUrlInfo($u){

        $url = 'http://feeds.delicious.com/v2/json/url/'.md5($u);

        $res = $this->client->get($url);

        $results = $res->json();

        return $results;
    }
}