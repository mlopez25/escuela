<?php

require_once('clases/AutoLoad.php');

$ruta = Request::read("ruta");
$accion = Request::read("accion");

if($ruta === null && $accion === null) {
    $htaccess = Request::read('htaccess');
    $parametros = explode('/', $htaccess);
    $ruta = $parametros[0];
    $accion = $parametros[1];
}else{
    $parametros[0] = $ruta;
    $parametros[1] = $accion;
}


$frontController = new FrontController($ruta);
$frontController->doAction($accion, array_slice($parametros, 2));

echo $frontController->getOutput();