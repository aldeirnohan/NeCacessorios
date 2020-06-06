  <!--<link rel="stylesheet" type="text/css" href="css/main-2.css">-->
  <link rel="stylesheet" type="text/css" href="css/main-3.css">
  <link rel="stylesheet" type="text/css" href="build/css/custom.min.css">
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

  <div class="row form-decoration panel panel-default">

    <div class="panel-heading">
      <h4 class="text-ti">Venda</h4>
      <h4 class="text-informa">Pagamento</h4>
    </div>

    <div class="panel-body">

<?php  

  require_once"conexao/conexao.php";
  $cdcliente = '';
  $x = 0;

  $busca_cliente = pg_query($conex,"select cdcliente, nome, cpf from cliente") or die( "impossivel fazer a busca");   

  if (pg_num_rows($busca_cliente)==0) {
?>
    <script>
      alert('Nenhum cliente cadastrado');
    </script>

<?php

  }else{

?>    <!--- form usado apenas para passar o nome do cliente selecionado do datalist abaixo --->
      <form class="" name="peganome_cliente" id="peganome_cliente" action="" method="post">
        <div class="forms">

          <div class="row form-group"> 

            <div class="col-md-5">
              <label for="nomes_cliente">ID - Cliente - CPF</label>
              <input list="nomes_cliente" class="form-control" name="nomes_cliente">     
              <datalist id="nomes_cliente" name="nomes_cliente" placeholder="Cliente" autofocus required>
                <option></option>
<?php      
      while ($cliente = pg_fetch_array($busca_cliente)) {
        echo '<option value="'.$cliente['cdcliente'].' - ' .$cliente['nome'].' - ' .$cliente['cpf'].'"></option>';
          
      }

  }

?>
              </datalist>
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

  if(isset($_POST['nomes_cliente'])){

    $cdcliente = (int)$_POST['nomes_cliente'];
    $situacaopag = "NÃO PAGA";
    $situacoavenda = "FECHADA";

    $busca_venda = pg_query($conex,"select * from venda where situacaovenda = '$situacoavenda' and situacaopag = '$situacaopag' and cdcliente = '$cdcliente'") or die( "impossivel fazer a busca");

    if (pg_num_rows($busca_venda)==0) {
?>
      <script>
        $(document).ready(function(){
          alert('Nenhuma venda FECHADA NÃO PAGA econtrada para este cliente !');

        });
      </script>
<?php
    }else{ 
      $cdcliente = (int)$_POST['nomes_cliente'];

?>    
    <form class="" name="paga_parcela" id="paga_parcela" action="dao/pag_parcela.php" method="post">
      
      <div class="row form-group">
        <div class="col-md-12">
          <label>Cliente:</label>
          <input type="text" class="form-control" name="nome" placeholder="Nome" value="<?php echo $_POST['nomes_cliente']; ?>" readonly>
        </div>
      </div>

<?php
      while ($dados = pg_fetch_assoc($busca_venda)) {
        $cdvenda = $dados['cdvenda'];

?>

        <div class="x_panel" style="height: auto;">
          <div class="x_title">
            <h2>Data: <?php echo $dados['datavenda'] ?> <small>Quant. Parcelas: <?php echo $dados['quantparcelas'] ?></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content" style="display: none;">

            
<?php
      
        
        $busca_parcelas = pg_query($conex,"select * from parcelavenda where cdvenda = '$cdvenda'") or die( "impossivel fazer a busca");
?>
                  <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Selecionar </th>
                            <th class="column-title">Data vencimento </th>
                            <th class="column-title">Data Pagamento </th>
                            <th class="column-title">Status </th>
                            <th class="column-title">Valor Multa </th>
                            <th class="column-title">Total pagar </th>
                            <th class="column-title">Valor Parcela </th>
                          </tr>
                        </thead>

                        <tbody>
<?php 
        while ($parcela = pg_fetch_assoc($busca_parcelas)) {
          $cdparcela = $parcela['cdparcelavenda'];
?>

                          <tr class="even pointer">
                            <td class="a-center">
                              <input type="checkbox" value="<?php echo $parcela['cdparcelavenda']; ?>" class="flat" name="parcelavenda[]">
                            </td>
                            <td class="a-center"><?php echo $parcela['datavencimento']; ?></td>
                            <td class="a-center"><?php echo $parcela['datapagamento']; ?></td>
                            <td class="a-center"><?php echo $parcela['situacaopag']; ?></td>
                            <td class="a-center"><?php echo $parcela['valormulta']; ?></td>
                            <td class="a-center"><?php echo $parcela['totalpagar']; ?></td>
                            <td class="a-center"><?php echo $parcela['valorparcela']; ?></td>
                          </tr> 

                                  
<?php
          $x++;
        }
?>                      </tbody>
                      </table>
                    </table>
                  </div>

          
            <div class="col-md-8">
              <button type="submit" id="paga_parcela" class="btn btn-success btn-form">confirmar</button>
            </div>  
              

          </div>
        </div>
      </form>
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
