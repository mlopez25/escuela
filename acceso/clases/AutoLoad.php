<?php

class AutoLoad {
    static function load($class) {
        $folders = array(
            '.',
            'controller',
            'database',
            'manage',
            'model',
            'mvc',
            'table',
            'util',
            'view',
            'web'
        );
        foreach($folders as $folder) {
            $file = __DIR__ . '/' . $folder . '/' . $class . '.php';
            if(file_exists($file)){
                require_once ($file);
                return;
            }
        }
    }
}

spl_autoload_register('AutoLoad::load');