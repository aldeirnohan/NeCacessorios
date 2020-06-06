<?php
/* esse bloco de código em php verifica se existe a sessão, pois o usuário pode
simplesmente não fazer o login e digitar na barra de endereço do seu navegador
o caminho para a página principal do site (sistema), burlando assim a obrigação
de fazer um login, com isso se ele não estiver feito o login não será
criado a session, então ao verificar que a session não existe a página
redireciona o mesmo para a indexSistemaSistema.php.
sdsdsdssd
 */

session_start();

if((!isset ($_SESSION['login'])) or (!isset ($_SESSION['senha'])))
{
  unset($_SESSION['login']);
  unset($_SESSION['senha']);
  ?>
  <script>
    alert('usuário ou senha incorreta');
    location.href="../login.php";
  </script>
  <?php
  header('location:login.php');
}

$logado = $_SESSION['login'];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>NeC Acessórios</title>

    <!-- Bootstrap -->

    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

     <!-- iCheck -->
   <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <?php
    require_once 'conexao/conexao.php';

    $codigo = pg_query($conex,"select cdfuncionario from funcionario where login = '$logado'");
    $cdfuncionario = pg_fetch_result($codigo,0,0);

  ?>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="indexSistema.php" class="site_title"><span>NeC - Acessórios</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/user.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bem Vindo,</span>
                <h2><span class="fa fa-circle" style="color: #00ff00;"></span> <?php echo $logado ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Geral</h3>
                <ul class="nav side-menu">
                  <li>
                    <a href="indexSistema.php"><i class="fa fa-home"></i> Home</a>
                  </li>
                  <li><a><i class="fa fa-edit"></i>Cadastrar ou alterar<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="indexSistema.php? page=forms/form_funcionario">Funcionários</a></li>
                      <li><a href="indexSistema.php? page=forms/form_cliente">Clientes</a></li>
                      <li><a href="indexSistema.php? page=forms/form_fornecedor">Fornecedor</a></li>
                      <li><a href="indexSistema.php? page=forms/form_produto">Produtos</a></li>
                      <li><a href="indexSistema.php? page=forms/form_pagamento">Forma Pagamento</a></li>
                      <li><a href="indexSistema.php? page=forms/form_categoriaprod">Categoria Produto</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> Exibir <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="indexSistema.php? page=exibir/listar_funcionario&codigo=">Funcionários</a></li>
                      <li><a href="indexSistema.php? page=exibir/listar_clientes&codigo=">Clientes</a></li>
                      <li><a href="indexSistema.php? page=exibir/listar_fornecedores&codigo=">Fornecedor</a></li>
                      <li><a href="indexSistema.php? page=exibir/listar_produtos&codigo=">Produtos</a></li>
                      <li><a href="indexSistema.php? page=exibir/listar_pagamento&codigo=">Forma Pagamento</a></li>
                      <li><a href="indexSistema.php? page=exibir/listar_categoriaprod&codigo=">Categoria Produto</a></li>
                      <li><a href="indexSistema.php? page=exibir/listar_compra&codigo=">Compra</a></li>
                      <li><a href="indexSistema.php? page=exibir/listar_venda&codigo=">Venda</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-shopping-cart"></i> Realizar <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="indexSistema.php? page=forms/form_compra">Compra</a></li>
                      <li><a href="indexSistema.php? page=forms/form_venda">Venda</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-money"></i>Pagamento<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="indexSistema.php? page=forms/paga_parcelascompra">Compra</a></li>
                      <li><a href="indexSistema.php? page=forms/paga_parcelasvenda">Venda</a></li>
                    </ul>
                  </li>
                </ul>

              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Facebook">
                <span class="fa fa-facebook-square" aria-hidden="true"></span>
              </a>

              <a data-toggle="tooltip" data-placement="top" title="Twitter">
                <span class="fa fa-twitter-square"></span>
              </a>

              <a data-toggle="tooltip" data-placement="top" title="Instagram">
                <span class="fa fa-instagram" aria-hidden="true"></span>
              </a>

              <a data-toggle="tooltip" data-placement="top" title="Sair" href="logout.php?sair=logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a> 

            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/user.png" alt=""><span class="fa fa-circle" style="color: #00b300;"></span><?php echo " Bem vindo(a) ".$logado ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="logout.php?sair=logout"><i class="fa fa-sign-out pull-right"></i> Sair</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <?php
                $page='';
                if( empty($_REQUEST['page'])){
                  ?>
                  <div class="jumbotron">
                    <h2><?php echo "Bem vindo(a) ".$logado ?> - NeC ACESSÓRIOS!</h2>
                    <p>Aqui você cadastra os seus produtos e pode realizar buscas a qualquer momento e em qualquer lugar!</p>
                  </div>

                <?php }else{
                  $pagina = $_REQUEST['page'];
                  include ($pagina.'.php');
                }
              ?>

            </div>
          </div>
          
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <h6>Sistema de controle de estoque da NeC acessórios</h6>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->

      </div><!-- / main_container --->
    </div><!-- / container body --->

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

    <!-- Google Analytics -->
    <script type="976dc805b227badb889b7f9f-text/javascript">
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-23581568-13', 'auto');
    ga('send', 'pageview');

    </script>
	
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/a2bd7673/cloudflare-static/rocket-loader.min.js" data-cf-settings="976dc805b227badb889b7f9f-|49" defer=""></script>
  </body>
</html>
