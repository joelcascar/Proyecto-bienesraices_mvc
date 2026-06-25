<?php

//Importamos las funciones
require __DIR__ . "/funciones.php";
//importamos la conexion a la base de datos
require __DIR__ . "/config/database.php";
// importamos el autoload que generamos con composer
require __DIR__ . "/../vendor/autoload.php";

// Importamos la clase Propiedad
use Model\ActiveRecord;
// Variable que contendra la instancia de la conexión
$db = conectarDB();
// Llamamos la funcion estatica
ActiveRecord::setDB($db);
