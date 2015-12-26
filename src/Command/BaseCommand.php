<?php namespace WudderList\Command;

class BaseCommand
{
    public function clear() {
        $this->run('clear');
    }

    public function cowsay($text) {
        $this->clear();
        $this->run('cowsay ' . $text);
    }

    public function run($command) {
        passthru($command);
    }

}