<?php

class Util{
    
    static function renderFile($file, array $data = array()) {
        if (!file_exists($file)) {
            echo 'Error: ' . $file . '<br>';
            return '';
        }
        $contenido = file_get_contents($file);
        return self::renderText($contenido, $data);
    }

    static function renderText($text, array $data = array()) {
        foreach ($data as $indice => $dato) {
            $text = str_replace('{' . $indice . '}', $dato, $text);
        }
        return $text;
    }
    
}