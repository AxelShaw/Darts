<?php
    class Loader {
        public static function scan($dir, $ignore = array(), $only = array()) {
            if(!isset($ignore['folders'])) {
                $ignore['folders'] = array();
            }

            if(!isset($ignore['files'])) {
                $ignore['files'] = array();
            }

            if(!isset($only['folders'])) {
                $only['folders'] = array();
            }

            if(!isset($only['files'])) {
                $only['files'] = array();
            }

            foreach(scandir($dir) as $file) {
                if(!in_array($file, array('.', '..'))) {
                    if(is_dir($dir.'/'.$file)) {
                        if(!in_array($file, $ignore['folders']) && (count($only['folders']) == 0 || in_array($file, $only['folders']))) {
                            Loader::scan($dir.'/'.$file, $ignore, $only);
                        }
                    }
                    else if(!in_array($file, $ignore['files']) && (count($only['files']) == 0 || in_array($file, $only['files']))) {
                        require_once $dir.'/'.$file;
                    }
                }
            }
        }

        public static function load($dir) {
            // Load core files first
            Loader::scan($dir, array('files' => array('loader.php')), array('folders' => array('core')));
            
            // Then load other includes (excluding libs and core)
            Loader::scan($dir, array('files' => array('loader.php'), 'folders' => array('libs', 'core')));
        }
    }

    // Load all dependencies
    Loader::load(__DIR__);
?>

