<?php
function conectarDB(): mysqli
{
    $db = new mysqli("localhost", "root", "root", "bienesraices_mvc");
    if (!$db) {
        echo "hubo un error de conexion";
        exit;
    }
    return $db;
}
