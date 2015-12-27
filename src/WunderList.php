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
        $taskPositionResponse = $this->getTaskPositions($listId);

        $tasks = $this->getTasks($listId);

        foreach($taskPositionResponse[0]['values'] as $taskId) {
            $tmpTask = $tasks[$taskId];
            if($tmpTask && !$tmpTask['completed']) {
                return $tmpTask['title'];
            }
        }

        return 'No task found, go take a break';
    }

    public function getTasks($listId) {
        try {
            $lists = $this->client->request('GET', '/api/v1/tasks', [
                'query' => ['list_id' => $listId],
                'headers' => $this->getDefaultHeaders()
            ]);
            $tasksResponse = json_decode($lists->getBody()->getContents(), true);
            $tasks = [];
            foreach($tasksResponse as $task) {
                $tasks[$task['id']] = $task;
            }
            return $tasks;
        } catch (\Exception $ex) {
            print_r($ex->getMessage());

            return [];
        }
    }

    public function getTask($taskId) {
        try {
            $lists = $this->client->request('GET', '/api/v1/tasks/' . $taskId, [
                'query' => ['completed' => false],
                'headers' => $this->getDefaultHeaders()
            ]);
            $task  = json_decode($lists->getBody()->getContents(), true);
//            print_r($task);
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
                    'completed' => false,
                ],
                'headers' => $this->getDefaultHeaders()
            ]);
            $tasks = json_decode($lists->getBody()->getContents(), true);
//            print_r($tasks);

            return $tasks;
        } catch (\Exception $ex) {
            print_r($ex->getMessage());

            return [];
        }
    }

}