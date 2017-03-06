<?php

class Model {
    
    private $data = array();
    private $file = array();
    
    function getData(){
        return $this->data;
    }
    
    function setData($name, $value){
        $this->data[$name] = $value;
    }
    
    function getFile() {
        return $this->file;
    }
    
}