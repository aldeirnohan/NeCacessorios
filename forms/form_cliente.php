<script src="bootstrap/js/validacao.js"></script>
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/jquery.maskedinput.js"></script>

<div class="modal fade in" id="cpfinvalido" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">CPF Inválido</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $("#verificar-cpf").click(function(){
      if(!validarCPF($("#cpfv").val())){
        $("#respostaCpf").html("<b>CPF Inválido</b><br>");
        $("#cpfv").focus();
      }else{
        $("#verificacpf").submit();
      }
    });
  });
</script>

<div class="row form-decoration panel panel-default">
  <div class="panel-heading">
    <h2 class="text-ti">Clientes</h1>
    <h2 class="text-informa">Cadastro e alteração</h1>
  </div>
  <div class="panel-body">
  <?php 
  $cpf = '0';
  if (isset($_GET['cpf'])) {

    $cpf = $_GET['cpf'];
    require_once 'conexao/conexao.php';
    $sql = "SELECT * FROM cliente WHERE cpf = '$cpf'";

    $query= pg_query($conex,$sql);

    $dados = pg_fetch_assoc($query);

    if ($dados['cpf'] != ''){

    }
    ?>

    <!--                              DEPOIS DE VERIFICAR CPF ENTRADA                           -->


  <?php

    if ($dados['cpf'] != '') {
  ?>

    <form class="form-horizontal" name="agenda" id="altCliente" action="dao/edit_cliente.php" method="post">
      <input type="hidden" name="cdcliente" value="<?php echo $dados['cdcliente']; ?>" autofocus required>

    <?php
      } else {
    ?>

      <form class="form-horizontal" name="agenda" id="altCliente" action="dao/cad_cliente.php" method="post">

    <?php
      }
    ?>
      <div class="forms">
      <fieldset>
        <legend class="text-info">Dados Pessoais e de Contato</legend>
        <div class="row form-group">
          <div class="col-md-12">
            <label>CPF</label>
    <?php
        if ($dados['cpf'] != '') {
    ?>
          <input type="text" class="form-control cpf" name="cpf" id="cpf" placeholder="Ex: 000.000.000-00" value="<?php echo $dados['cpf'] ; ?>" autofocus required/>
            <span id="respostaCpf" style="color: red;"></span>
              <script type="text/javascript">
                $(document).ready(function(){
                  $("#alterarCliente").click(function(){
                    if(!validarCPF($("#cpf").val())){
                      $("#respostaCpf").html("<b>CPF Inválido</b><br>");
                      $("#cpf").focus();
                    }else{
                      $("#altCliente").submit();
                    }
                  });
                });
                $("#cpf").mask("999.999.999-99");
              </script>
<?php
            }else{
?>
              <input type="text" class="form-control" name="cpf" id="cpf" placeholder="Ex: 000.000.000-00" value="<?php echo $cpf; ?>" disable readonly="true" autofocus required/>
                <span id="respostaCpf" style="color: red;"></span>
<?php
            }
?>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-md-12">
            <label>Nome</label>
            <input type="text" class="form-control" name="nome" placeholder="Nome" value="<?php echo $dados['nome']; ?>" autofocus required>
          </div>
        </div>

        <div class="row form-group">
          <div class="col-md-6">
            <label>Celular</label>
            <input type="tel" class="form-control" name="celular" id="celular" placeholder="(00) 00000-0000" value="<?php echo $dados['celular']; ?>"  required>
          </div>

          <div class="col-md-6">
            <label>Data Nascimento</label>
            <input type="date" class="form-control" name="idade" value="<?php echo $dados['idade']; ?>" placeholder="idade" required>
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

      </fieldset>
      
      <fieldset>
        <legend class="text-info">Endereço Residencial</legend>
        <div class="row form-group">
          <div class="col-md-12">
            <label>Rua</label>
            <input type="text" class="form-control" name="rua" value="<?php echo $dados['rua']; ?>" placeholder="Rua" autofocus>
          </div>
        </div>

        <div class="row form-group">
          <div class="col-md-8">
            <label>Bairro</label>
            <input type="text" class="form-control" name="bairro" value="<?php echo $dados['bairro']; ?>" placeholder="Bairro" autofocus>
          </div>
          <div class="col-md-4">
            <label>Número</label>
            <input type="number" class="form-control" name="numero" value="<?php if($dados['numcasa'] != '') echo $dados['numcasa']; else echo 0; ?>" placeholder="Numero" min="0">
          </div>       
        </div>
      </fieldset>
      </div>     
    </div>

      <div class="panel-footer">
        <div class="row justify-content-between">
        <?php
          if ($dados['cpf'] != '') {
        ?>
          <div class="col-md-8">
            <button type="button" id="alterarCliente" class="btn btn-info btn-form">Salvar alterações do cliente</button>
          </div>
        <?php
          }else{
        ?>
          <div class="col-md-8">
            <button type="submit" class="btn btn-primary btn-form">Cadastrar cliente</button>
          </div>
        <?php
          }
            if (isset($_GET['listar']) and $_GET['listar'] == 'sim'){
        ?>
              <div class="col-md-2">
                <a href="indexSistema.php? page=exibir/listar_clientes&codigo=" act class="btn btn-danger btn-form">Cancelar</a>           
              </div>
        <?php
          }else{
        ?>
            <div class="col-md-2">
              <a href="indexSistema.php?page=forms%2Fform_cliente" act class="btn btn-danger btn-form">Cancelar</a>           
            </div>
        <?php
          }
        ?>
        </div>
      </form>
    </form>   
  </div>
</div>








<?php

  } else {

?>

<div class="form-group">
  <form class="form-horizontal" name="verificarcpf" id="verificacpf" action="indexSistema.php" method="GET">
    <label>Digite o CPF do cliente no campo abaixo</label>
    <input type="hidden" name="page" value="forms/form_cliente">
    <input type="text" class="form-control" name="cpf" id="cpfv" placeholder="Ex: 000.000.000-00" autofocus required>
    <span id="respostaCpf" style="color: red;"></span><br>
    <button type="button" id="verificar-cpf" class="btn btn-primary verificar-cpf">Verificar CPF</button>

  </form>
</div>

<?php

}

?>

<script type="text/javascript">
  $("#telefone, #celular").mask("(99) 99999-9999");
  $("#cpfv").mask("999.999.999-99");
</script> 


<?php
  if (isset($_GET['cad'])){

    if ($_GET['cad'] == 0) {

      if (isset($_GET['erro'])){

?>

        <!-- Modal -->
        <div class="modal fade in" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Erro na alteração do cadastro!</h3>
              </div>
              <div class="modal-body">
                O cadastro de <strong><?php echo $_GET['cliente']; ?></strong> não foi alterado.<br>
                Motivo: <strong><?php echo $_GET['erro']; ?></strong>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <a href="indexSistema.php? page=exibir/listar_clientes&codigo=<?php echo $_GET['cod']; ?>" class="btn btn-primary">Ver na lista de clientes</a>
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
                <h3 class="modal-title" id="exampleModalLabel">Alterado com sucesso!</h3>
              </div>
              <div class="modal-body">
                O cadastro de <strong><?php echo $_GET['cliente']; ?></strong> foi alterado.
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <a href="indexSistema.php? page=exibir/listar_clientes&codigo=<?php echo $_GET['cod']; ?>" class="btn btn-primary">Ver na lista de clientes</a>
              </div>
            </div>
          </div>
        </div>

<?php
      }
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
              Os dados de <strong><?php echo $_GET['cliente']; ?></strong> foram cadastrados.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
              <a href="indexSistema.php? page=exibir/listar_clientes&codigo=<?php echo $_GET['cod']; ?>" class="btn btn-primary">Ver na lista de clientes</a>
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
</script>
