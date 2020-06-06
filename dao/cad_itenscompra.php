<?php
require_once '../conexao/conexao.php';
 
$cdcompra=$_POST['cdcompra'];
$fornecedor = $_POST['nome_fornecedor'];
$qtd = $_POST['quant_item'];
$venda = ($_POST['valorvenda']);
$compra = ($_POST['valorcompra']);
$cdproduto = (int)$_POST['nomes_prod'];


if($venda == 0 or $compra == 0){

	$consulta = pg_query($conex,"SELECT valorvenda, valorcompra FROM produto WHERE cdproduto = $cdproduto");
	$prod = pg_fetch_array($consulta);
	
	$venda = $prod['valorvenda'];
	$compra = $prod['valorcompra'];
}

$sql = "INSERT INTO itemcompra(quantidade,valorunitcompra,cdcompra,cdproduto,valorunitvenda)
 VALUES('$qtd','$compra','$cdcompra','$cdproduto', '$venda')";
$query= pg_query($conex,$sql);

if (isset($query)) {
    ?>
    <script>
    	location.href="../indexSistema.php?page=forms/form_compra&cad=1&cdcompra=<?php echo $cdcompra;?>&fornecedor=<?php echo $fornecedor; ?>";
    </script>

    <?php

}else{
    echo "Não foi possivel inserir o registro - entre em contato com Bigode GRC <br><br>".infotech.pg_result_error(result);
}


?>
