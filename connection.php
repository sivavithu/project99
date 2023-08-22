<?php
$hostname="db4free.net";
$username="webtechpro1";
$password="king1234";
$dbname="webtechpro1";
$con=mysqli_connect($hostname,$username,$password,$dbname);
if(!$con)
{
    die("connection failed:".mysqli_connect_error($con));

}


?>