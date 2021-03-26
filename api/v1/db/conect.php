<?php 
    error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
    $serv = 'br140.hostgator.com.br';
    $name = 'catal842_mortorf';
    $password = 'mortorf123';
    $banco = 'catal842_MotorFort';
    $conn = mysql_connect($serv,$name,$password) or die(mysql_error());
    mysql_select_db($banco,$conn) or die(mysql_error());
?>