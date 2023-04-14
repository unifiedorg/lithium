<?php namespace Znci\Lithium\Error;

use Znci\Lithium\Logging\Logger;

class Handler {
    public static function errorHandler() {
        set_exception_handler(function($exception) {
            $title = 'Whoops, something went wrong!';
            $message = $exception->getMessage();
            $file = $exception->getFile();
            $line = $exception->getLine();
            $trace = nl2br(htmlspecialchars($exception->getTraceAsString()));
            $log = new Logger();
            $log->error('Error : ' . $exception->getMessage() .
            ' occured in ' . $exception->getFile() . 'at line ' . $exception->getLine());
          
            echo <<<HTML
            <div style="font-family: Arial, sans-serif;
                        padding: 20px; background-color: #f8f8f8; border: 1px solid #ccc;">
                <p style="font-size: 12px;">Znci/Lithium</p>
                <h1 style="font-size: 24px; margin-top: 0;">{$title}</h1>
                <p style="font-size: 16px;">{$message}</p>
                <p style="font-size: 14px; color: #666;">{$file} (line {$line})</p>
                <pre style="font-size: 14px; background-color: #fff;
                            border: 1px solid #ccc; padding: 10px;">{$trace}</pre>
            </div>
            HTML;
        });
    }
}
