<?php 
    error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
    $serv = '****';
    $name = '****';
    $password = '*****';
    $banco = '********';
    $conn = mysql_connect($serv,$name,$password) or die(mysql_error());
    mysql_select_db($banco,$conn) or die(mysql_error());
?>