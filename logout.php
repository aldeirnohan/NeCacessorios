<?php
if($_GET['sair']=='logout'){
	session_start();
	unset($_seesion['login']);
	unset($_seesion['senha']);
	session_destroy();
	header('location: index.php');
}
?>
