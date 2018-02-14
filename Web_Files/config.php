<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "students_db";
$conn = mysqli_connect($host,$user,$pass,$dbname);
if(!$conn)
{
	die('could not connect'.mysql_error());
}
?>