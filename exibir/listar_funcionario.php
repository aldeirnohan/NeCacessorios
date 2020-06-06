<!DOCTYPE html>
<html lang="en">
<head>
  <title>Table V02</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor-2/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor-2/animate/animate.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor-2/select2/select2.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor-2/perfect-scrollbar/perfect-scrollbar.css">
  <!--===============================================================================================-->
  <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/util-2.css">
  <link rel="stylesheet" type="text/css" href="css/main-2.css">
  <link rel="stylesheet" type="text/css" href="css/main-3.css">
  <link rel="stylesheet" type="text/css" href="css/tabela_mobile_listarFuncionario.css">

  <!--===============================================================================================-->
</head>
<body>

  <!-- ################################## TRATA SUCESSO DA ALTERAÇÃO ############################## -->
  <?php
  if (!empty($_GET)) {
    if (isset($_GET['alterado'])) {
      if ($_GET['alterado']) {
        ?>

        <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Sucesso!</strong> As alterações foram realizadas!
        </div>

        <script>
          window.setTimeout(function () {
            $(".alert").fadeTo(500, 0).slideUp(500, function () {
              $(this).remove();
            });
          }, 4000);
          window.history.pushState('Object', 'Categoria JavaScript', 'indexSistema.php? page=exibir/listar_funcionario');
        </script>

        <?php
      } else {
        ?>
        <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Ops!</strong> Houve um erro nas alterações!
        </div>

        <script>
          window.setTimeout(function () {
            $(".alert").fadeTo(500, 0).slideUp(500, function () {
              $(this).remove();
            });
          }, 4000);
          window.history.pushState('Object', 'Categoria JavaScript', 'indexSistema.php? page=exibir/listar_funcionario');
        </script>
        <?php
      }
    }
  }
  ?>

  <div class='listar-h1'>

    <h1 class="h1">Lista de funcionários cadastrados</h1>

  </div>

  <div class="s003">
    <form name="busca">
      <div class="inner-form">
        <div class="input-field first-wrap">
          <div class="input-select">
            <select data-trigger="" name="choices-single-defaul">
              <option placeholder="">Escolha um</option>
              <option>Nome</option>
              <option>Login</option>
            </select>
          </div>
        </div>
        <div class="input-field second-wrap">
          <input id="search" name="codigo" type="text" placeholder="Pesquisar" />
        </div>
        <div class="input-field third-wrap">
          <button class="btn-search" type="submit" name="page" value="exibir/listar_funcionario">
            <img class="img-seatch" src="img/search.png"/>
            <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
          </svg>
        </button>
      </div>
    </div>
  </form>
</div>

<!-- #################################### PHP PARTS #############################################-->

<?php
require_once"conexao/conexao.php";
$inicial= $_REQUEST['codigo'];
$busca = pg_query($conex,"select * from funcionario where nome like '$inicial%' or login like '%$inicial%' order by nome") or die( "impossivel fazer a busca");
if (pg_num_rows($busca)==0) {
  ?>
  <script>
    alert('Nenhum Registro Encontrado');
  </script>

  <?php
}else{
 ?>
 <table class="table table-sm table-striped table-hover" align='center' style="width:800px;">
   <div class="limiter">
     <div class="container-table100">
       <div class="wrap-table100">
         <div class="table100">
           <table>
             <thead>
               <tr class="table100-head">
                 <th class="column2">Nome</th>
                 <th class="column3">Email</th>
                 <th class="column1">Código</th>
                 <th class="column6"><p class="label-text">Ações</p></th>
               </tr>
             </thead>
             <tbody>

              <?php
              while ($dados = pg_fetch_assoc($busca)) {
               ?>
  
                    <!-- Modal -->
                    <div class="modal fade" id="modalExcluir<?php echo $dados['cdfuncionario']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Você realmente deseja excluir esse funcionário?</h4>
                          </div>
                          <div class="modal-body">
                            Nome do funcionário: <strong><?php echo $dados['nome']; ?></strong><br>
                            Login: <strong><?php echo $dados['login']; ?></strong>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <a href="dao/del_funcionario.php?codigo=<?php echo $dados['cdfuncionario']; ?>" type="button" class="btn btn-danger">Excluir esse funcionário</a>
                          </div>
                        </div>
                      </div>
                    </div>


               <tr>
                 <td class="column2"><?php echo $dados['nome']; ?></td>
                 <td class="column3"><?php echo $dados['email']; ?></td>
                 <td class="column1"><?php echo $dados['cdfuncionario']; ?></td>
                 <form name="verificarcpf" action="indexSistema.php" method="GET">
                   <td class="column6">
                     <div class="btn-group btn-group-sm" role="group" aria-label="Ações para os Funcionário!">

                      <button type="button" class="btn btn-default btn-info acoes" aria-label="Exibir Funcionário" data-toggle="modal" data-target="#visualizarModal<?php echo $dados['cdfuncionario']; ?>">
                       <span class="glyphicon glyphicon-search"></span>
                     </button>

                     <button type="submit" class="btn btn-default btn-primary acoes"  aria-label="Editar Funcionário">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </button>

                     <input type="hidden" name="page" value="forms/form_funcionario">
                     <input type="hidden" name="login" id="login" value="<?php echo $dados['login']; ?>">       
                     <input type="hidden" name="listar" id="login" value="sim">

                     <input type="hidden" name="senha" id="senha" value="<?php echo $dados['senha']; ?>">       
                     <input type="hidden" name="listar" id="senha" value="sim">

                    <button type="button" class="btn btn-default btn-danger acoes" aria-label="Excluir Funcionários" data-toggle="modal" data-target="#modalExcluir<?php echo $dados['cdfuncionario']; ?>">
                     <span class="glyphicon glyphicon-trash"></span>
                   </button>

                 </div>
               </td>
             </form>
           </tr>
           

         <!--################################## MODAL VISUALIZAR #####################################!>
           <!-- Modal Visualizar-->
           <div class="modal fade" id="visualizarModal<?php echo $dados['cdfuncionario']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
               <div class="modal-content bg-modal">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                   <h3 class="modal-title" id="exampleModalLabel"><?php echo $dados['nome']; ?></h3>
                 </div>
                 <div class="modal-body">
                   <label><h4><strong>Sexo: </strong>
                    <?php if($dados['sexo'] == 'M'){ echo 'MASCULINO';}else{echo 'FEMININO';}; ?> </label></h4>
                    <br>
                   <label><h4><strong>Email: </strong><?php echo $dados['email']; ?> </label></h4><br>
                   <label><h4><strong>Celular: </strong><?php echo $dados['celular']; ?> </label></h4><br>
                   <label><h4><strong>Bairro: </strong><?php echo $dados['bairro']; ?> </label></h4><br>
                   <label><h4><strong>Rua: </strong><?php echo $dados['rua']; ?> </label></h4><br>
                   <label><h4><strong>Numero: </strong><?php echo $dados['numcasa']; ?> </label></h4><br>

                   <label><h4><strong>Login: </strong><?php echo $dados['login']; ?> </label></h4><br>
                   <label><h4><strong>Senha: </strong><?php echo $dados['senha']; ?> </label></h4><br>

                  </div>
                  <div class="modal-footer">
                   <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                 </div>
               </div>
             </div>
           </div>

           <?php
         }
         ?>

       </table>
       <?php
     }
     ?>

   </tbody>
 </table>
</div>
</div>
</div>
</div>



<!--===============================================================================================-->
<script src="vendor-2/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor-2/bootstrap/js/popper.js"></script>
<script src="vendor-2/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor-2/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="js/main-2.js"></script>
<script src="js/extention/choices.js"></script>
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/jquery.mask.min.js"></script>
<script>
  const choices = new Choices('[data-trigger]',
  {
    searchEnabled: false,
    itemSelectText: '',
  });

</script>

<?php
if (isset($_GET['delete'])){

  if ($_GET['delete'] == 'false') {

    ?>

    <!-- Modal -->
    <div class="modal fade in" id="modalAlertaErro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Erro ao excluir funcionário!</h3>
          </div>
          <div class="modal-body">
            O cadastro de <strong><?php echo $_GET['funcionario']; ?></strong> não foi excluido.<br>
            Motivo: <strong><?php echo $_GET['motivo']; ?></strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>

    <?php
  } else {

    ?>

    <!-- Modal -->
    <div class="modal fade in" id="modalAlertaErro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Funcionário excluido com sucesso!</h3>
          </div>
          <div class="modal-body">
            O cadastro de <strong><?php echo $_GET['funcionario']; ?></strong> foi excluido.<br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>

    <?php
  }
}
?>

<script type="text/javascript">
  $(window).load(function() {
    $('#modalAlertaErro').modal('show');
  });
</script>

</body>
</html>
