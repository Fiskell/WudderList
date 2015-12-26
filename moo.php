<?php
use WudderList\Command\BaseCommand;

require __DIR__.'/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$count = 0;
while(true) {
    (new BaseCommand())->cowsay('a' . $count);
    sleep(2);
    $count++;
}
