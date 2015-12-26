<?php
use WudderList\Command\BaseCommand;

require __DIR__.'/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

//(new \WudderList\WunderList())->getLists();
$baseCommand = new BaseCommand();
while(true) {
//    $wunderlist = (new \WudderList\WunderList());
//    $taskId = $wunderlist->getFirstPosition(210225917);
//    $task = $wunderlist->getTask($taskId);
//    $baseCommand->cowsay($task['title']);
    $baseCommand->cowsay('yessss');
    sleep(10);
}
