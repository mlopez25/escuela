<?php
$uploads_dir = '../imagenesProfesores';
$name = $_FILES['archivo']['name'];

$loc = $uploads_dir . '/' . $name;

move_uploaded_file($_FILES["archivo"]["tmp_name"], $loc);
$nombre = parse_str($name);
var_dump($nombre);