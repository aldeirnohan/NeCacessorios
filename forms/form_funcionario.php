
<div class="row form-decoration">
  <h1 class="text-ti">Funcionários</h1>
  <h1 class="text-informa">Cadastro e alteração</h1>

  <?php 
  $login = '0';
  $senha = '0';

  if (isset($_GET['login']) and isset($_GET['senha'])) {

    $senha = $_GET['senha'];
    $login = $_GET['login'];
    require_once 'conexao/conexao.php';
    $sql = "SELECT * FROM funcionario WHERE login = '$login' or senha = '$senha'";

    $query= pg_query($conex,$sql);

    $dados = pg_fetch_assoc($query);

    if ($dados['senha'] != '' and $dados['login'] != ''){

    }
    ?>

    <!--                              DEPOIS DE VERIFICAR CPF ENTRADA                           -->


    <?php

    if ($dados['senha'] != '' and $dados['login'] != '') {
      ?>

      <form class="form-horizontal" name="edit_funcionario" action="dao/edit_funcionario.php" method="post">
        <input type="hidden" name="cdfuncionario" value="<?php echo $dados['cdfuncionario']; ?>" autofocus required disable>

        <?php
      } else {
        ?>

        <form class="form-horizontal" name="cad_funcionario" action="dao/cad_funcionario.php" method="post">

          <?php
        }

        ?>


        <div class="forms">

          <div class="row form-group">
           <div class="col-md-12">
            <label for="login">Login</label>
            <input type="text" class="form-control" id="login" name="login" placeholder="Login" 
            value="<?php if ($dados['login'] != '') echo $dados['login']; else echo $login; ?>" autofocus required>
          </div>
        </div>

        <div class="row form-group">
          <div class="col-md-12">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" 
            value="<?php if ($dados['senha'] != '') echo $dados['senha']; else echo $senha; ?>" autofocus required >
          </div>
        </div>

        <div class="row form-grou">

          <div class="col-md-12">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?php echo $dados['nome']; ?>" autofocus required>
          </div>

          <div class="col-md-12">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $dados['email']; ?>" autofocus required>
          </div>

        </div>
        <br>
        <label>Sexo</label>
        <div class="row form-group">
          <div class="col-md-6">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="sexo" value="M" required <?php if ($dados['sexo'] == 'M') echo "checked"; ?> > Masculino
            </label>
          </div>

          <div class="col-md-6">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="sexo" value="F" <?php if ($dados['sexo'] == 'F') echo "checked"; ?> > Feminino
            </label>
          </div>
        </div>
        <br>

        <div class="row form-group">
          
          <div class="col-md-12">
            <label for="rua">Endereço</label>
            <input type="text" class="form-control" id="rua" name="rua" placeholder="Rua" value="<?php echo $dados['rua']; ?>" autofocus required>
          </div>

          <div class="col-md-12">
            <label for="bairro">Bairro</label>
            <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="<?php echo $dados['bairro']; ?>" autofocus required>
          </div> 

          <div class="col-md-4">
            <label>Número</label>
            <input type="number" class="form-control" name="numcasa" value="<?php if($dados['numcasa'] != '') echo $dados['numcasa']; else echo 0; ?>" placeholder="Numero" min="0">
          </div>  


          <div class="col-md-8">
            <label for="celular">Celular</label>
            <input type="text" class="form-control" id="celular" name="celular" placeholder="(00) 00000-0000" value="<?php echo $dados['celular']; ?>" autofocus required>
          </div>

        </div>

        </div>               
        <div class="row justify-content-between">

          <?php

          if ($dados['senha'] != '' and $dados['login'] != '') {
            ?>

            <div class="col-md-8">
              <button type="submit" class="btn btn-info btn-form">Salvar alterações do funcionário</button>
            </div>

            <?php
          } else {
            ?>

            <div class="col-md-8">
              <button type="submit" class="btn btn-primary btn-form">Cadastrar funcionário</button>
            </div>

            <?php
          }

          ?>

          <?php
          if (isset($_GET['listar']) and $_GET['listar'] == 'sim'){
            ?>

            <div class="col-md-2">
              <a href="indexSistema.php? page=exibir/listar_funcionario&codigo=" act class="btn btn-danger btn-form">Cancelar</a>           
            </div>

            <?php
          } else {
            ?>

            <div class="col-md-2">
              <a href="indexSistema.php?page=forms%2Fform_funcionario" act class="btn btn-danger btn-form">Cancelar</a>           
            </div>

            <?php
          }
          ?>


        </div>   

      </div>

    </form>
  </div>


  <?php

} else {

  ?>

  <!--                              PRIMEIRA ENTRADA                           -->

  <div class="form-group">
    <form class="form-horizontal" name="verificarcpf" action="indexSistema.php" method="GET">
      <label>Digite a Senha e Login do funcionário nos campos abaixo</label>
      <input type="hidden" name="page" value="forms/form_funcionario">

      <label for="login">Login</label>
      <input type="text" class="form-control" id="login" name="login" placeholder="Login" autofocus required>

      <label for="senha">Senha</label>
      <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" autofocus required >

      <div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" id="exibirSenha" name="exibirSenha">
            <label class="custom-control-label" for="exibirSenha">Exibir Senha</label>
      </div>

      <button type="submit" class="btn btn-primary verificar-cpf">Verificar Cadastro</button>
    </form>
  </div>

  <?php

}

?>



<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/jquery.mask.min.js"></script>

<script type="text/javascript">
  $("#telefone, #celular").mask("(00) 00000-0000");
  $("#cpf").mask("000.000.000-00");
  $("#cpfv").mask("000.000.000-00");
</script> 


<?php
if (isset($_GET['cad'])){

  if ($_GET['cad'] == 0) {

    ?>

    <!-- Modal -->
    <div class="modal fade in" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Alterado com sucesso!</h3>
          </div>
          <div class="modal-body">
            O cadastro de <strong><?php echo $_GET['funcionario']; ?></strong> foi alterado.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <a href="indexSistema.php? page=exibir/listar_funcionario&codigo=<?php echo $_GET['cod']; ?>" class="btn btn-primary">Ver na lista de funcionarios</a>
          </div>
        </div>
      </div>
    </div>

    <?php
  } else {

    ?>

    <!-- Modal -->
    <div class="modal fade in" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Cadastrado com sucesso!</h3>
          </div>
          <div class="modal-body">
            Os dados de <strong><?php echo $_GET['funcionario']; ?></strong> foram cadastrados.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <a href="indexSistema.php? page=exibir/listar_funcionario&codigo=<?php echo $_GET['cod']; ?>" class="btn btn-primary">Ver na lista de funcionários</a>
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
    $('#exampleModal').modal('show');
  });


  $(document).ready(function(){ 
    $('#exibirSenha').click(function () {  
      if($('#exibirSenha').is(':checked') ){
          $('#senha').attr('type','text');
      } else {
          $('#senha').attr('type','password');
      }
  
   }); 
  });
</script>
