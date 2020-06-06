
<div class="row form-decoration">
  <h1 class="text-ti">Produtos</h1>
  <h1 class="text-informa">Cadastro e alteração</h1>

  <?php 
  $nome = '0';
  $fornecedor ='0';
  

  if (isset($_GET['nome']) ) {

    $nome = $_GET['nome'];
  
    require_once 'conexao/conexao.php';
    $sql = "SELECT * FROM produto WHERE nome = '$nome'";

    $query= pg_query($conex,$sql);

    $dados = pg_fetch_assoc($query);
    
    if ($dados['nome'] != '' ){

    }
    ?>

    <!--                              DEPOIS DE VERIFICAR CPF ENTRADA                           -->


    <?php

    if ($dados['nome'] != '') {
        
            $cdCat = $dados['cdcategoriaprod'];
            $categoria = pg_query($conex,"select nome from categoriaprod where cdcategoriaprod = $cdCat ") or die( "impossivel fazer a busca");
            $nome = pg_fetch_result($categoria,0,0);

            $cdCat2 = $dados['cdfornecedor'];
            $fornecedor = pg_query($conex,"select nome from fornecedor where cdfornecedor = $cdCat2 ") or die( "impossivel fazer a busca");
            $fornecedor = pg_fetch_result($fornecedor,0,0);
        
                         
      ?>

      <form class="form-horizontal" name="edit_produto" action="dao/edit_produto.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="cdproduto" value="<?php echo $dados['cdproduto']; ?>" autofocus required disable>

        <?php
      } else {
        ?>

        <form class="form-horizontal" name="cad_produto" action="dao/cad_produto.php" method="post" enctype="multipart/form-data">

          <?php
        }
       

        ?>


        <div class="forms">

          <div class="row form-group">
           <div class="col-md-12">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" 
            value="<?php if ($dados['nome'] != '') echo $dados['nome']; else echo $nome; ?>" autofocus required>
          </div>
        </div>
        <div class="row form-grou">
          <div class="col-md-12">
            <label for="categoria">Categoria</label>
                      <select class="form-control" id="categoria" name="cdcategoriaprod" autofocus required >  

                      <option value="" autofocus required></option>
                        <?php
                          $cat = pg_query($conex,"select * from categoriaprod order by nome");
                            while($dadosCat = pg_fetch_assoc($cat)){ ?>
                              <option value="<?php echo $dadosCat['cdcategoriaprod']; ?>"
                                <?php if($dadosCat['nome'] == $nome){echo "selected";}?>>
                                <?php echo $dadosCat['nome']; ?>
                              </option>
                              <?php
                            }?>
                 </select>
          </div>

          <div class="col-md-12">
            <label for="fornecedor">Fornecedor</label>
                      <select class="form-control" id="fornecedor" name="cdfornecedor" autofocus required >  

                      <option value="" autofocus required></option>
                        <?php
                          $cat2 = pg_query($conex,"select * from fornecedor order by nomerazaosocial");
                            while($dadosforn = pg_fetch_assoc($cat2)){ ?>
                              <option value="<?php echo $dadosforn['cdfornecedor']; ?>"
                                <?php if($dadosforn['nomerazaosocial'] == $fornecedor){echo "selected";}?>>
                                <?php echo $dadosforn['nomerazaosocial']; ?>
                              </option>
                              <?php
                            }?>
                 </select>
          </div>



          <div class="col-md-12">
            <label for="descricao">Descrição</label>
                <textarea rows="4" cols="100" class="form-control" id="descricao" name="descricao" maxlength="450"  required  placeholder="Pequena descrição de no máximo 450 caracteres incluido o de espaço."><?php echo $dados['descricao']; ?></textarea>
          </div>

        </div>
        <br>
          <label for="exampleFormControlFile1">Imagem</label>
            <input   type="file" data-max-size="52428800" name="file"  class="input6" accept=".png, .jpg, .jpeg, .PNG, .JPG, .JPEG"><br>
                      
        <div class="row justify-content-between">

          <?php

          if ($dados['nome'] != '' ) {
            ?>

            <div class="col-md-8">
              <button type="submit" class="btn btn-info btn-form">Salvar alterações do Produto</button>
            </div>

            <?php
          } else {
            ?>

            <div class="col-md-8">
              <button type="submit" class="btn btn-primary btn-form">Cadastrar Produto</button>
            </div>

            <?php
          }

          ?>

          <?php
          if (isset($_GET['listar']) and $_GET['listar'] == 'sim'){
            ?>

            <div class="col-md-2">
              <a href="indexSistema.php? page=exibir/listar_produtos&codigo=" act class="btn btn-danger btn-form">Cancelar</a>           
            </div>

            <?php
          } else {
            ?>

            <div class="col-md-2">
              <a href="indexSistema.php?page=forms%2Fform_produto" act class="btn btn-danger btn-form">Cancelar</a>           
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
      <label>Digite o Nome do Produto no campo abaixo</label>
      <input type="hidden" name="page" value="forms/form_produto">
      <br>
      <label for="login">Nome</label>
      <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" autofocus required>
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
            O cadastro de <strong><?php echo $_GET['produto']; ?></strong> foi alterado.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <a href="indexSistema.php? page=exibir/listar_produtos&codigo=<?php echo $_GET['cod']; ?>" class="btn btn-primary">Ver na lista de Produtos</a>
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
            Os dados de <strong><?php echo $_GET['produto']; ?></strong> foram cadastrados.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <a href="indexSistema.php? page=exibir/listar_produtos&codigo=<?php echo $_GET['cod']; ?>" class="btn btn-primary">Ver na lista de Produtos</a>
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
