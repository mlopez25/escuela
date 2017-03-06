<?php

class ViewProfesor extends View {
    
    function render() {
        return json_encode( $this->getModel()->getData() );
    }
    
}