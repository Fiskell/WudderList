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
            $lists      = $this->client->request('GET', '/api/v1/lists', [
                'headers' => $this->getDefaultHeaders()
            ]);
            $lists      = json_decode($lists->getBody()->getContents(), true);
            $listsNames = [];
            foreach ($lists as $list) {
                $listsNames[strtolower($list['title'])] = $list['id'];
            }
            ksort($listsNames);
            return $listsNames;
        } catch (\Exception $ex) {
            return [];
        }
    }

    public function getPrimaryTaskTitle($listId) {
        $taskId = $this->getFirstPosition($listId);
        $task   = $this->getTask($taskId);

        return $task['title'];
    }

    public function getTask($taskId) {
        try {
            $lists = $this->client->request('GET', '/api/v1/tasks/' . $taskId, [
                'headers' => $this->getDefaultHeaders()
            ]);
            $task  = json_decode($lists->getBody()->getContents(), true);

            return $task;
        } catch (\Exception $ex) {
            print_r($ex->getMessage());

            return [];
        }
    }

    public function getTaskPositions($listId) {
        try {
            $lists = $this->client->request('GET', '/api/v1/task_positions', [
                'query'   => [
                    'list_id' => $listId,
                ],
                'headers' => $this->getDefaultHeaders()
            ]);
            $tasks = json_decode($lists->getBody()->getContents(), true);

            return $tasks;
        } catch (\Exception $ex) {
            print_r($ex->getMessage());

            return [];
        }
    }

    public function getFirstPosition($listId) {
        $taskPositionResponse = $this->getTaskPositions($listId);

        // todo more error handling
        return $taskPositionResponse[0]['values'][0];
    }
}