<?php

class Buffering {
    public static function start() {
        ob_start();
    }

    public static function clean() {
        ob_clean();
    }

    public static function stop() {
        ob_end_clean();
    }

    public static function length() {
        return ob_get_length();
    }

    public static function flush() {
        @ob_flush();
        flush();
    }

    public static function encode($data) {
        $json = json_encode($data);

        if(json_last_error() != JSON_ERROR_NONE) {
            $json = json_encode(array('error' => 'invalid_json'));
        }

        return $json;
    }

    public static function output($data) {
        $content = Buffering::encode($data);

        header('Content-Type: application/json');
        header('Content-Length: '.strlen($content));

        Buffering::write($content);
    }

    public static function write($content) {
        Buffering::check();

        echo $content;

        Buffering::flush();
    }

    public static function none() {
        header('Content-Type: application/json');
        header('Content-Length: 2');

        Buffering::write("{}");
    }

    public static function close() {
        exit();
    }

    public static function die($error) {
        Buffering::error($error);
        Buffering::close();
    }

    public static function error($error) {
        Buffering::output(array('error' => $error));
    }

    public static function enableOutput() {
        global $outputEnabled;
        $outputEnabled = true;
    }

    public static function disableOutput() {
        global $outputEnabled;
        $outputEnabled = false;
    }

    public static function canOutput() {
        global $outputEnabled;
        return (isset($outputEnabled) && $outputEnabled);
    }

    public static function check() {
        if(!Buffering::canOutput()) {
            header('HTTP/1.1 403 Forbidden');
            Buffering::close();
        }
    }
}

?>

