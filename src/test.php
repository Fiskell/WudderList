<?php
$count = 0;
while(true) {
    $cmd = 'clear; cowsay a' . $count;
    passthru($cmd);
    sleep(2);
    $count++;
}
