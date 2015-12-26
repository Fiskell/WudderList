<?php namespace WudderList;

use GuzzleHttp\Client;

class WunderList
{
    public $BASE_URL = "https://a.wunderlist.com";

    /** @var Client $client */
    public $client;

    public function __construct() {
        $this->client = new Client(['base_uri' => $this->BASE_URL]);
    }

    public function getDefaultHeaders() {
        return ['Content-Type'   => 'application/json',
                'X-Access-Token' => getenv('ACCESS_TOKEN'),
                'X-Client-ID'    => getenv('CLIENT_ID')];
    }

    public function getLists() {
        try {
            $lists = $this->client->request('GET', '/api/v1/lists', [
                'headers' => $this->getDefaultHeaders()
            ]);
            $lists = json_decode($lists->getBody()->getContents(), true);
            $listsNames = [];
            foreach($lists as $list) {
                $listsNames[$list['id']] = $list['title'];
            }
            print_r($listsNames);
        } catch (\Exception $ex) {
            print_r($ex->getMessage());
        }
    }
}