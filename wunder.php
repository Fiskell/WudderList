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
            echo $wunderlist->getPrimaryTaskTitle($command);
        } else {
            echo "You must supply a list id";
        }
}


