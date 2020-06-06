<?php
require_once '../conexao/conexao.php';
 
$cdvenda=$_POST['cdvenda'];
$cliente = $_POST['nome_cliente'];
$qtd = $_POST['quant_item'];
$desc = ($_POST['%desconto'] / 100);
$cdproduto = (int)$_POST['nomes_prod'];

$busca = "select quantidade from produto where cdproduto = '$cdproduto'";
$query1 = pg_query($conex,$busca);
$dados= pg_fetch_result($query1, 0, 0);

$busca1 = "select nome from produto where cdproduto = '$cdproduto'";
$query2 = pg_query($conex,$busca1);
$dados1= pg_fetch_result($query2, 0, 0);


	if ($qtd > $dados) {
		?>
			<script>
    			location.href="../indexSistema.php?page=forms/form_venda&tp=1&cdvenda=<?php echo $cdvenda;?>&cliente=<?php echo $cliente; ?>&qtd=<?php echo $dados; ?>&nome=<?php echo $dados1; ?>";
    		</script>
    	<?php  
	}else{
	
		$sql = "INSERT INTO itemvenda(quantidade,percentualdesconunit,cdproduto,cdvenda)
 		VALUES('$qtd','$desc','$cdproduto','$cdvenda')";
		$query= pg_query($conex,$sql);

		if (isset($query)) {
    		?>
    		<script>
    			location.href="../indexSistema.php?page=forms/form_venda&cad=1&cdvenda=<?php echo $cdvenda;?>&cliente=<?php echo $cliente; ?>";
    		</script>
    	<?php

		}else{
    		echo "Não foi possivel inserir o registro - entre em contato com Bigode GRC <br><br>".infotech.pg_result_error(result);
		}
	}
	

?>
