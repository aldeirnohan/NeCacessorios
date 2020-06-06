  <link rel="stylesheet" type="text/css" href="css/main-2.css">
  <link rel="stylesheet" type="text/css" href="css/main-3.css">
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

  <div class="row form-decoration panel panel-default">

    <div class="panel-heading">
      <h4 class="text-ti">Exibir</h4>
      <h4 class="text-informa">Venda</h4>
    </div>

    <div class="panel-body">

<?php  

  require_once"conexao/conexao.php";
  $cdcliente = '';

  $busca_cliente = pg_query($conex,"select cdcliente, nome, cpf from cliente") or die( "impossivel fazer a busca");   

  if (pg_num_rows($busca_cliente)==0) {
?>
    <script>
      alert('Nenhum cliente cadastrado');
    </script>

<?php

  }else{

?>
     <!--- form usado apenas para passar o nome do cliente selecionado do datalist abaixo --->
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
    $busca_venda = pg_query($conex,"select * from venda where cdcliente = '$cdcliente'") or die( "impossivel fazer a busca");

    if (pg_num_rows($busca_venda)==0) {
?>
      <script>
        $(document).ready(function(){
          alert('Nenhuma venda sem pagamento econtrada para este cliente');

        });
      </script>
<?php
    }else{ 
?>    
      
      <div class="row form-group">
        <div class="col-md-12">
          <label>Cliente:</label>
          <input type="text" class="form-control" name="nome" placeholder="Nome" value="<?php echo $_POST['nomes_cliente']; ?>" readonly>
        </div>
      </div>

      <table class="table table-striped table-hover" align='center' style="width:800px;">
      <div class="limiter">
        <div class="container-table100">
          <div class="wrap-table100">
            <div class="table100">
              <table>
                <thead>
                  <tr class="table100-head">
                    <th class="column2">Data</th>
                    <th class="column1">Venda</th>
                    <th class="column1">Pagamento</th>
                    <th class="column2">Prazo em dias</th>
                    <th class="column1">Parcelas</th>
                    <th class="column1">Parcelas pag</th>
                    <th class="column1">Valor bruto</th>
                    <th class="column1">Multa</th>
                    <th class="column1">Valor liquído</th>
                    <th class="column1"><p class="label-text">Ações</p></th>
                  </tr>
                </thead>
                <tbody>

<?php
      while ($dados = pg_fetch_assoc($busca_venda)) {
        $cdvenda = $dados['cdvenda'];
?>
               
                    
                    <div class="modal fade" id="modalExcluir<?php echo $dados['cdvenda']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Você Deseja visualizar essa venda?</h4>
                          </div>
                          <div class="modal-body">
                            Data: <strong><?php echo $dados['datavenda']; ?></strong><br>
                            Código: <strong><?php echo $dados['cdvenda']; ?></strong>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <a href="dao/del_itemvenda.php?codigo=<?php echo $dados['cdvenda']; ?>" type="button" class="btn btn-success">Visualizar venda</a>
                          </div>
                        </div>
                      </div>
                    </div>

                    


                  <tr>
                    <td class="column2"><?php echo  $dados['datavenda']?></td>
                    <td class="column1"><?php echo  $dados['situacaovenda']?></d>
                    <td class="column1"><?php echo  $dados['situacaopag']?></td>
                    <td class="column2"><?php echo  $dados['prazoemdias']?></td>
                    <td class="column1"><?php echo  $dados['quantparcelas']?></td>
                    <td class="column1"><?php echo  $dados['quantparcelaspag']?></td>
                    <td class="column1"><?php echo  $dados['valorbruto']?></td>
                    <td class="column1"><?php echo  $dados['valormulta']?></td>
                    <td class="column1"><?php echo  $dados['valorliquido']?></td>
                    <td class="a-center column2">
                      <form name="verificarcpf" action="indexSistema.php" method="GET">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Ações para os Clientes!">
                         
                         <button type="button" class="btn btn-default btn-success acoes" aria-label="Excluir Clientes" data-toggle="modal" data-target="#modalExcluir<?php echo $dados['cdvenda']; ?>">
                           <span class="glyphicon glyphicon-search"></span>
                          </button>

                        </div>
                      </form>
                    </td>
                      
                  </tr>


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

  }
?>        


<script type="text/javascript">
  $(window).load(function() {
    $('#exampleModal').modal('show');
  });
</script>
<

<?php
                
}
                 
?>
