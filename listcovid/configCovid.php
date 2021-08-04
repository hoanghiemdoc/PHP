<?php

define('DB_SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_Name','listcovid');

$link = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_Name);

if ($link === false) {
    die("error: could not connect" .mysqli_connect_error());
}


?>
