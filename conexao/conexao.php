<?php
$server = "localhost";
$user="postgres";
$password="postgres";
$dbname="NeC";
$port="5432";

$conex= pg_connect("host=$server dbname=$dbname user=$user "."password=$password port=$port sslmode=disable");
if(!$conex){
	echo "impossivel realizar a conexão";
}

?>
