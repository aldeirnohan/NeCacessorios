<?php
$server = "ec2-3-222-150-253.compute-1.amazonaws.com";
$user="rqadityykhgrfy";
$password="237c29531a67746652d8ac528701e737788d2cd038e479d97d3ac09b2c6348da";
$dbname="d1gl4jgemb52hg";
$port="5432";

$conex= pg_connect("host=$server dbname=$dbname user=$user "."password=$password port=$port sslmode=disable");
if(!$conex){
	echo "impossivel realizar a conexão";
}

?>
