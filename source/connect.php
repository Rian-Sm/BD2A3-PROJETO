<?php 
define('HOST'   , 'localhost');
define('USUARIO', "snow");
define('SENHA'  , "snow");
define('DB'     , 'php_connection');

$link = mysqli_connect(HOST, USUARIO, SENHA, DB);


if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
?>