<?php namespace WudderList\Command;

class BaseCommand
{
    public $has_cowsay = false;
    public $has_lolcat = false;

    public function __construct() {
        $this->has_cowsay = $this->command_exist('cowsay');
        $this->has_lolcat = $this->command_exist('lolcat');
    }

    function command_exist($cmd) {
        $returnVal = shell_exec("which $cmd");
        return (empty($returnVal) ? false : true);
    }

    public function clear() {
        $this->run('clear');
    }

    public function cowsay($text) {
        $command = 'cowsay ' . $text;
        $this->clear();
        $response = $this->run($command);
        if($this->has_lolcat) {
            $this->lolcat($response);
        }
    }

    public function lolcat($text) {
        $path = __DIR__ . '/../../tmp/moo.log';
        file_put_contents($path, $text);
        $command = 'lolcat ' . $path;
        print_r($command);
        $this->pass($command);
    }

    public function run($command) {
        return shell_exec($command);
    }

    public function pass($command) {
        passthru($command);
    }

}