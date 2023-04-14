<?php namespace Znci\Lithium\Logging;

use Znci\Lithium\Config;

class Logger {
    private $logFile;
    private $timeFormat = 'Y-m-d H:i:s';
    
    public function __construct() {
        $this->logFile = fopen(Config::get('path', 'LOG_PATH') . '/app.log', 'a');
    }
    
    public function log($message) {
        $date = date($this->timeFormat);
        $formattedMessage = "[LOG, $date]: $message\n";
        fwrite($this->logFile, $formattedMessage);
    }

    public function error($message) {
        $date = date($this->timeFormat);
        $formattedMessage = "[ERROR, $date]: $message\n";
        fwrite($this->logFile, $formattedMessage);
    }

    public function warn($message) {
        $date = date($this->timeFormat);
        $formattedMessage = "[WARN, $date]: $message\n";
        fwrite($this->logFile, $formattedMessage);
    }

    public function critical($message) {
        $date = date($this->timeFormat);
        $formattedMessage = "[CRITICAL, $date]: $message\n";
        fwrite($this->logFile, $formattedMessage);
    }
    
    public function __destruct() {
        fclose($this->logFile);
    }
}
