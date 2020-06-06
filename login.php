<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Entrar no sistema NeC</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>

<?php
require_once 'conexao/conexao.php';
?>

<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="imagens/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" form method="POST" action="dao/verificalogin.php">
					<span class="login100-form-title">
						ENTRAR NO SISTEMA
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Informe o login!">
						<input class="input100" type="text" name="login" placeholder="Usuário">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Informe a senha!">
						<input class="input100" type="password" id="senha" name="senha" placeholder="Senha">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" id="cad" aria-hidden="true"></i>
						</span>
					</div>
					
					
					<div class="custom-control custom-switch">
						<input class="custom-control-input" type="checkbox" id="exibirSenha" name="exibirSenha">
						<label class="custom-control-label" for="exibirSenha">Exibir Senha</label>
					</div>
					
					<div class="container-login100-form-btn">
						<button type="submit" value="Entrar" name="entrar" class="login100-form-btn">
							Entrar
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
						</span>
						<a class="txt2" href="#">
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							<!--<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>-->
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>




	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
	$('.js-tilt').tilt({
		scale: 1.1
	})
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){ 
		    $('#exibirSenha').click(function () {  
		      if($('#exibirSenha').is(':checked') ){
		          $('#senha').attr('type','text');
		          $('#cad').attr('class','fa fa-unlock-alt');

		      } else {
		          $('#senha').attr('type','password');
		          $('#cad').attr('class','fa fa-lock');
		      }
		  
		   }); 
		});
	</script>
</body>
</html>
