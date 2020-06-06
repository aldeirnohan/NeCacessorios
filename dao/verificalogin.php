<?php

require_once '../conexao/conexao.php';
session_start();
if (isset($_POST['entrar'])) {
	$login= pg_escape_string($conex, $_POST['login']);
	$senha= pg_escape_string($conex, $_POST['senha']);
	$verifica = pg_query($conex,"SELECT * FROM funcionario WHERE login = '$login' and senha = '$senha' ") or die("erro ao selecionar");

	if (pg_num_rows($verifica)>0) {
		# code...
		$_SESSION['login'] = $login;
		$_SESSION['senha'] = $senha;
		header('location: ../indexSistema.php');
	}else{
		?>
		<script>
		alert('Login ou Senha inválido(a), tente novamente.');
		location.href="../login.php";
		</script>";

		<?php
		unset($_COOKIE["login"]);
		unset($_COOKIE["senha"]);
	}
}
?>
