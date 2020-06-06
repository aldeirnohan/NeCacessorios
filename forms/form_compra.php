  <link rel="stylesheet" type="text/css" href="css/main-2.css">
  <link rel="stylesheet" type="text/css" href="css/main-3.css">
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<?php
  require_once"conexao/conexao.php";
  $nomes_fornecedor = '';
  $busca_fornecedor = pg_query($conex,"select cdfornecedor, nomerazaosocial, cnpj from fornecedor") or die( "impossivel fazer a busca");

  if (pg_num_rows($busca_fornecedor)==0) {
?>
    <script>
      alert('Nenhum fornecedor ou produto cadastrado');
    </script>
<?php
  }else{
?>
    <div class="row form-decoration panel panel-default">

    <div class="panel-heading">
      <h4 class="text-ti">Compra</h4>
      <h4 class="text-informa">Formulário de Compra</h4>
    </div>

    <div class="panel-body">
<?php  
  if (!isset($_REQUEST['cdcompra'])) {
          # code...
?>
      <form class="" name="form_venda" id="form_venda" action="dao/cad_compra.php" method="post">
        <div class="forms">

          <div class="row form-group"> 

            <div class="col-md-5">
              <label for="nome_fornecedor">ID  -  Razão Social -  CNPJ </label>
              <input list="nome_fornecedor" class="form-control" name="nome_fornecedor">     
              <datalist id="nome_fornecedor" name="nome_fornecedor" placeholder="Cliente" autofocus required>
                <option></option>
<?php      
      while ($forn = pg_fetch_array($busca_fornecedor)) {
        echo '<option value="'.$forn['cdfornecedor'].' - ' .$forn['nomerazaosocial'].' - ' .$forn['cnpj'].'"></option>';
          
      }

?>
              </datalist>
            </div>

            <div class="col-md-1">
              <input type="hidden" class="form-control" id="cdfuncionario" value="<?php echo $cdfuncionario?>" name="cdfuncionario" autofocus required>
            </div>

            <div class="col-md-1">
              <label>Selecionar</label>
              <button class="fa fa-check-square btn btn-success btn-form"></button>
            </div>

          </div>

        </div>
      </form>
    </div>
    <!-- fim panel-body caso 1 -->
    <div class="panel-footer">
    </div>
    <!-- fim panel-footer caso 1 -->

  </div>
  <!-- fim panel-default caso 1 -->
<?php  
  }else{
    
    $nomefornecedor=$_REQUEST['fornecedor'];
    $cdfornec = (int)$_REQUEST['fornecedor'];
    $d=$_REQUEST['cdcompra'];
    $valort = 0;
    $valorb = 0;
    $desct = 0;
    $_SESSION['fornecedor'] = $nomefornecedor;
    $_SESSION['cdcompra'] = $d;
 
  
    


    
?> 
      <form class="" name="form_itenscompra" id="form_itenscompra" action="dao/cad_itenscompra.php" method="post">

        <div class="row form-group"> 
          <div class="col-md-5">
            <label for="nome_cliente">ID  -  Nome Forncedor  -  CMPJ </label>
            <input type="text" class="form-control" id="nome_fornecedor" name="nome_fornecedor" value="<?php echo $nomefornecedor?>" autofocus required readonly>
          </div>

          

        </div>

        <div class="row form-group">                                                      
          
          <div class="col-md-4">
            <label for="nomes_prod">ID - Produto</label>
            <input list="nomes_prod" class="form-control" name="nomes_prod">     
            <datalist id="nomes_prod" name="nomes_prod" placeholder="Produto" autofocus required>
              <option></option>
<?php 
    	$busca_produto = pg_query($conex," select * from produto where cdfornecedor = '$cdfornec' order by cdproduto ;") or die( "impossivel fazer a busca");

    		/*select pr.cdproduto, pr.nome from fornecedor as f,produto as pr, itemcompra as ic, compra as co where pr.cdproduto = ic.cdproduto and ic.cdcompra = co.cdcompra and co.cdfornecedor = f.cdfornecedor and f.cdfornecedor*/

      while ($prod = pg_fetch_array($busca_produto)) {
          echo '<option value="'.$prod['cdproduto'].' - ' .$prod['nome'].'"></option>';

      }
?>

            </datalist>
          </div>

          

          <div class="col-md-1">
            <label for="quant_item">Quant</label>
            <br>
            <input type="number" id="quant_item" min="1" value="1" class="form-control" name="quant_item" >
          </div>

          <div class="col-md-1">
            <label for="desconto%">v.Compra </label>
            <input type="text" id="valorcompra" value="0" min="0" max="99" class="form-control" name="valorcompra">
          </div>

          <div class="col-md-1">
            <label for="desconto%">v.Venda </label>

            <input type="text" id="valorvenda" value="0" min="0" max="99" class="form-control" name="valorvenda">
          </div>

          <div class="col-md-2">
            <label for="cdvenda">Código da Compra</label>
            <br>
            <input type="text" id="cdvenda" class="form-control" name="cdcompra" value="<?php echo $d ?>" autofocus required readonly>
          </div>

          <div class="col-md-1">
            <label>Adicionar</label>
            <button type="submit" class="add_campo btn btn-success btn-form"><span class="glyphicon glyphicon-plus"></span></button>
          </div>
        </div>
      </form>
    </div>
    <!-- fim class panel-body --->
    <form class="" name="form_venda" id="form_venda" action="dao/cad_compra.php" method="post">
        <div class="forms">
<?php  
          
  $busca_itemvenda = pg_query($conex,"select *from itemcompra where cdcompra='$d'") or die( "impossivel fazer a busca");
          
?>


    </form>

<?php        
  if (pg_num_rows($busca_itemvenda)==0) {


  }else{
  ?>
    <table class="table table-striped table-hover" align='center' style="width:800px;">
      <div class="limiter">
        <div class="container-table100">
          <div class="wrap-table100">
            <div class="table100">
              <table>
                <thead>
                  <tr class="table100-head">
                    <th class="column1">Produto</th>
                    <th class="column2">Quantidade</th>
                    <th class="column2">Valor total da  Compra</th>
                    <th class="column2">Valor de Compra</th>
                    <th class="column2">Valor de Venda</th>
                    <th class="column1"><p class="label-text">Ações</p></th>
                  </tr>
                </thead>
                <tbody>

<?php
    while ($dados = pg_fetch_assoc($busca_itemvenda)) {
      $cdprod = $dados['cdproduto'];
      $produto = pg_query($conex,"select nome from produto where cdproduto = $cdprod ") or die( "impossivel fazer a busca");
      $nome = pg_fetch_result($produto,0,0);
?>
               
                    
                    <div class="modal fade" id="modalExcluir<?php echo $dados['cditemcompra']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Você realmente deseja excluir esse item?</h4>
                          </div>
                          <div class="modal-body">
                            Nome do produto: <strong><?php echo "$nome"; ?></strong><br>
                            Código: <strong><?php echo $dados['cditemcompra']; ?></strong>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <a href="dao/del_itemcompra.php?codigo=<?php echo $dados['cditemcompra']; ?>" type="button" class="btn btn-danger">Excluir esse produto</a>
                          </div>
                        </div>
                      </div>
                    </div>

                    


                  <tr>
                    <td class="column5"><?php echo $nome ?></td>
                     <td class="column1"><?php echo $dados['quantidade']?></td>
                    <td class="column1"><?php echo $dados['valortotalcompra']?></td>
                    <td class="column1"><?php echo $dados['valorunitcompra']?></td>            
                    <td class="column1"><?php echo $dados['valorunitvenda']?></td>
                    <td class="column2">
                      <form name="verificarcpf" action="indexSistema.php" method="GET">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Ações para os Clientes!">

                          <button type="button" class="btn btn-default btn-info acoes" aria-label="Exibir Clientes" data-toggle="modal" data-target="#editarModal<?php echo $dados['cditemcompra']; ?>"><span class="glyphicon glyphicon-pencil"></span>
                          </button>
                         
                         <button type="button" class="btn btn-default btn-danger acoes" aria-label="Excluir Clientes" data-toggle="modal" data-target="#modalExcluir<?php echo $dados['cditemcompra']; ?>">
                           <span class="glyphicon glyphicon-trash"></span>
                          </button>

                        </div>
                      </form>
                    </td>
                      
                  </tr>
                  <?php 
                    
                    $valort = $valort + $dados['valortotalcompra'];
                    
                    
                    
                   ?>
                  <!-- Modal editar-->
                   <div class="modal fade" id="editarModal<?php echo $dados['cditemcompra']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content bg-modal">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            <h3 class="modal-title" id="exampleModalLabel"><?php echo "$nome"; ?></h3>
                          </div>
                          <form name="agenda" action="dao/edit_itemcompra.php" method="post" >
                            <div class="modal-body">
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-md-3">
                                    <label>Quantidade</label>
                                    <input type="number" class="form-control" min="1" name="quant_item" placeholder="codigo" value="<?php echo $dados['quantidade']; ?>" autofocus required disable>
                                  </div>
                                </div>
                                <br>
                                <div class="row">
                                  <div class="col-md-3">
                                    <label>Valor de Compra</label>
                                    <input type="text" class="form-control" name="valorunitcompra" placeholder="codigo" value="<?php echo $dados['valorunitcompra']; ?>" autofocus required disable>
                                  </div>
                                </div>
                                <br>
                                <div class="row">
                                  <div class="col-md-3">
                                    <label>Valor de Venda</label>
                                    <input type="text" class="form-control" name="valorunitvenda" placeholder="codigo" value="<?php echo $dados['valorunitvenda']; ?>" autofocus required disable>
                                  </div>
                                </div>

                                </div>
                                   <input type="hidden" class="form-control" name="cditemcompra" placeholder="codigo" value="<?php echo $dados['cditemcompra']; ?>" autofocus required disable>
                              </div>
                            
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Salvar alterações</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <?php
                  }
                ?>

                </tbody>
              <?php
                 }
                 
                 ?>

              </table>
            </div>
          </div>
        </div>
      </div>  
    </table>
    <form class="" name="form_venda" id="form_venda" action="dao/finalizar_compra.php" method="post">
        <div class="forms">

          <div class="col-md-2">
            <label for="valort">Valor total</label>
            <input type="number" id="valort" class="form-control" name="valort" value="<?php echo $valort ?>" autofocus required readonly>
          </div>
          
          <div class="col-md-2">
            <label for="cdvenda">Parcelas</label>
            <input type="number" id="parcelas" class="form-control" name="parcelas" min="1" value="1" autofocus required >
          </div>


          <div class="col-md-3">
            <label for="nomes_prod">Forma pagamento</label>
            <input list="formapagamento" class="form-control" name="formapagamento" type="text-transform:uppercase"> 
            <datalist id="formapagamento" name="formapagamento" value="2 - PARCELA UNICA - DINHEIRO" autofocus required>
              <option></option>
<?php
  $busca_formapag = pg_query($conex,"select  * from formapagamento") or die( "impossivel fazer a busca");

  if (pg_num_rows($busca_formapag)==0) {
?>
      <script>
        alert('Nenhum formapagamento cadastrada');
      </script>
<?php
  }else{
   
      while ($forma = pg_fetch_array($busca_formapag)) {
        echo '<option value="'.$forma['cdformapagamento'].' - ' .$forma['tipopagamento'].' - ' .$forma['formapagamento'].'"></option>';
      }
  }
?>
              
            </datalist>
          </div>
           
            <input type="hidden" id="cdvenda" class="form-control" name="cdvenda" value="<?php echo $d ?>" autofocus required readonly>
          

      
      </div>
    
    <br>
    <br>
    <br>
    <br>

    <div class="panel-footer">
      </form>
      <div class="row justify-content-between">
        <div class="col-md-11">
          <button type="submit" class="btn btn-primary btn-form">Finalizar Compra</button>
        </div>
        <div class="col-md-1">
            <a href="dao/del_compra.php" class="btn btn-danger btn-form">Cancelar</a>
        </div>
      </div>

    </div>
    <!-- fim class panel-footer --->
  </div>
  <!-- fim class panel-default --->
<?php 
  }

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
                <h3 class="modal-title" id="exampleModalLabel">Item da Compra Alterado com Sucesso!</h3>
              </div>
              <div class="modal-body">
                O Produto da Compra  <strong><?php echo "$nome"; ?></strong> foi alterado.
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                
              </div>
            </div>
          </div>
        </div>

<?php
      }
    } else {

?>

      <!-- Modal -->
      
      <?php 
    }
  }


        if (isset($_GET['cod'])) {
          # code...
            if ($_GET['cod'] == 1) {
                ?>
                <div class="modal fade in" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Venda cancelada o que deseja fazer?</h3>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Iniciar outra Compra</button>
                    <a href="indexSistema.php" class="btn btn-primary">Voltar para a pagina principal</a>
              
            </div>
          </div>
        </div>
      </div>
<?php
            }
        }
        if (isset($_GET['fin'])) {
          # code...
            if ($_GET['fin'] == 1) {
                ?>
                <div class="modal fade in" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Venda Realizada com Sucesso!</h3>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Realizar outra Compra</button>
                    <a href="indexSistema.php" class="btn btn-primary">Voltar para a pagina principal</a>
              
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
<?php
    
  }
  
?>

