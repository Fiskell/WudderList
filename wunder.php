<?php
use WudderList\WunderList;

require __DIR__.'/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$command = null;
if(count($argv) > 1) {
    $command = $argv[1];
}

$wunderlist = new WunderList();
//print_r($wunderlist->getLists());
//print_r($wunderlist->getTaskPositions(229627536));
//print_r($wunderlist->getTask($command));
//exit();
switch($command) {
    case 'list':
        $lists = $wunderlist->getLists();
        $string = "";
        foreach($lists as $name => $id) {
            $string .= "{$id} : {$name}\n";
        }
        echo $string;
        break;
    default:
        if(is_numeric($command)) {
            echo $command;
            echo $wunderlist->getPrimaryTaskTitle($command);
        } else {
            echo "You must supply a list id";
        }
}


