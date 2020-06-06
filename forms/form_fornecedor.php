<script src="bootstrap/js/validacao.js"></script>
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/jquery.maskedinput.js"></script>


<div class="modal fade in" id="cnpjinvalido" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">CNPJ Inválido</h3>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>

<script type="text/javascript">
        $(document).ready(function(){
            $("#verificar-cnpj").click(function(){
                if(!validarCNPJ($("#cnpj").val())){
                    $("#respostaCnpj").html("<b>CNPJ Inválido</b><br>");
                    $("#cnpj").focus();
                }else{
                    $("#verificacnpj").submit();
                }
            });
        });
    </script>
<div class="row form-decoration panel panel-default">
  <div class="panel-heading">
    <h2 class="text-ti">Fornecedores</h2>
    <h2 class="text-informa">Cadastro e alteração</h2>
  </div>
  <div class="panel-body">
  <?php 
  $cnpj = '0';
  if (isset($_GET['cnpj'])) {

    $cnpj = $_GET['cnpj'];
    require_once 'conexao/conexao.php';
    $sql = "SELECT * FROM fornecedor WHERE cnpj = '$cnpj'";

    $query= pg_query($conex,$sql);

    $dados = pg_fetch_assoc($query);

    if ($dados['cnpj'] != ''){

    }
    ?>

    <!--                              DEPOIS DE VERIFICAR CNPJ ENTRADA                           -->


    <?php

    if ($dados['cnpj'] != '') {
      ?>

      <form class="form-horizontal" name="agenda" id="altCnpj" action="dao/edit_fornecedor.php" method="post">
        <input type="hidden" name="cdfornecedor" value="<?php echo $dados['cdfornecedor']; ?>" autofocus required disable>

        <?php
      } else {
        ?>

        <form class="form-horizontal" name="agenda" id="CadCnpj" action="dao/cad_fornecedor.php" method="post">

          <?php
        }

        ?>


        <div class="forms">
          <fieldset>
            <legend>Dados da Empresa</legend>
          <div class="row form-group">
           <div class="col-md-12">
            <label>CNPJ</label>
            <input type="text" class="form-control" name="cnpj" id="cnpj" placeholder="Ex: 00.000.000/0000-00" value="<?php if ($dados['cnpj'] != '') echo $dados['cnpj']; else echo $cnpj; ?>" autofocus required>
            <span id="respostaCnpj" style="color: red;"></span>
          </div>
        </div>

        <script type="text/javascript">
          $(document).ready(function(){
              $("#alterarCnpj").click(function(){
                  if(!validarCNPJ($("#cnpj").val())){
                      $("#respostaCnpj").html("<b>CNPJ Inválido</b><br>");
                      $("#cnpj").focus();
                  }else{
                      $("#altCnpj").submit();
                  }
              });

              $("#cadastrarCnpj").click(function(){
                  if(!validarCNPJ($("#cnpj").val())){
                      $("#respostaCnpj").html("<b>CNPJ Inválido</b><br>");
                      $("#cnpj").focus();
                  }else{
                      $("#CadCnpj").submit();
                  }
              });
          });
     $("#cnpj").mask("99.999.999/9999-99");
  </script>

        <div class="row form-group">
          <div class="col-md-12">
            <label>Nome</label>
            <input type="text" class="form-control" name="nomerazaosocial" placeholder="Razão Social" value="<?php echo $dados['nomerazaosocial']; ?>" autofocus required>
          </div>
        </div>

        <div class="row form-grou">
          <div class="col-md-6">
            <label>Telefone</label>
            <input type="tel" class="form-control" name="telefone" id="telefone" placeholder="(00) 00000-0000" value="<?php echo $dados['telefone']; ?>"  required>
          </div>
          </div>
          <br>
          <div class="row form-grou">
          <div class="col-md-12">
            <label>Email</label>
            <input type="text" class="form-control" name="email" value="<?php echo $dados['email']; ?>" placeholder="exemplo@email.com" required>
          </div>
        </div>
     
        <br>
        </fieldset>
        <fieldset>
        <legend class="text-info">Endereço Residencial</legend>
        <div class="row form-group">
          <div class="col-md-12">
            <label>Endereço</label>
            <input type="text" class="form-control" name="rua" value="<?php echo $dados['rua']; ?>" placeholder="Endereço" autofocus>
          </div>
        </div>
        <div class="row form-group">
        <div class="col-md-12">
            <label>Cidade</label>
            <input type="text" class="form-control" name="cidade" value="<?php echo $dados['cidade']; ?>" placeholder="Cidade" autofocus>
          </div>
        </div>
         <div class="row form-group">
          <div class="col-md-3">
            <label>Estado</label>
            <input type="text" class="form-control" name="estado" value="<?php echo $dados['estado']; ?>" placeholder="DP" autofocus>
          </div>
        </div>
        <div class="row form-group">
          <div class="col-md-8">
            <label>Bairro</label>
            <input type="text" class="form-control" name="bairro" value="<?php echo $dados['bairro']; ?>" placeholder="Bairro" autofocus>
          </div>
          <div class="col-md-4">
            <label>Número</label>
            <input type="number" class="form-control" name="numero" value="<?php if($dados['numero'] != '') echo $dados['numero']; else echo 0; ?>" placeholder="Numero" min="0">
          </div>       
        </div>      
        </fieldset>
        </div>
       
        <div class="panel-footer">

        <div class="row justify-content-between">

          <?php

          if ($dados['cnpj'] != '') {
            ?>

            <div class="col-md-8">
              <button type="button" id="alterarCnpj" class="btn btn-info btn-form">Salvar alterações do Fornecedor</button>
            </div>

            <?php
          } else {
            ?>

            <div class="col-md-8">
              <button type="button" id="cadastrarCnpj" class="btn btn-primary btn-form">Cadastrar Forncedor</button>
            </div>

            <?php
          }

          ?>

          <?php
          if (isset($_GET['listar']) and $_GET['listar'] == 'sim'){
            ?>

            <div class="col-md-2">
              <a href="indexSistema.php? page=exibir/listar_fornecedores&codigo=" act class="btn btn-danger btn-form">Cancelar</a>           
            </div>

            <?php
          } else {
            ?>

            <div class="col-md-2">
              <a href="indexSistema.php?page=forms%2Fform_fornecedor" act class="btn btn-danger btn-form">Cancelar</a>           
            </div>

            <?php
          }
          ?>

          </div>
        </div>
        
        </div>   

      </div>

    </form>
  </div>


  <?php

} else {

  ?>

  <!--                              PRIMEIRA ENTRADA                           -->

  <div class="form-group">
    <form class="form-horizontal" name="verificarcnpj" id="verificacnpj" action="indexSistema.php" method="GET">
      <label>Digite o CNPJ do Fornecedor no campo abaixo</label>
      <input type="hidden" name="page" value="forms/form_fornecedor">
      <input type="text" class="form-control" name="cnpj" id="cnpj" placeholder="Ex: 00.000.000/0000-00" autofocus required>
      <span id="respostaCnpj" style="color: red;"></span>
      <button type="button" id="verificar-cnpj" class="btn btn-primary verificar-cpf">Verificar CNPJ</button>
    </form>
  </div>

  <script type="text/javascript">
     $("#cnpj").mask("99.999.999/9999-99");
  </script>

  <?php

}

?>

<script type="text/javascript">
    $("#telefone").mask("(99) 99999-9999");
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
            O cadastro de <strong><?php echo $_GET['fornecedor']; ?></strong> foi alterado.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <a href="indexSistema.php? page=exibir/listar_fornecedores&codigo=<?php echo $_GET['cod']; ?>" class="btn btn-primary">Ver na lista de Fornecedor</a>
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
            Os dados de <strong><?php echo $_GET['fornecedor']; ?></strong> foram cadastrados.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <a href="indexSistema.php? page=exibir/listar_fornecedores&codigo=<?php echo $_GET['cod']; ?>" class="btn btn-primary">Ver na lista de Fornecedores</a>
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