<?php
$HOSTNAME='localhost';
$USERNAME='root';
$PASSWORD='';
$DATABASE='online_food';

$con = mysqli_connect($HOSTNAME,$USERNAME,$PASSWORD,$DATABASE);
if(!$con) //if connection is not true (false,unsuccessful).
{
    die(mysqli_error($con)); //printing the error.
}
