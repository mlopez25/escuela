<?php

class Model {
    
    private $data = array();
    
    function getData(){
        return $this->data;
    }
    
    function setData($name, $value){
        $this->data[$name] = $value;
    }
    
}