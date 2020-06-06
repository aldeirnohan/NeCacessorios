<?php  
	require_once('../conexao/conexao.php');
	session_start();
	$cdcompra=$_SESSION['cdcompra'];
	$sql1 = "DELETE FROM itemcompra WHERE cdcompra =$cdcompra;";
	$sql = "DELETE FROM compra WHERE cdcompra =$cdcompra;";
	$query1= pg_query($conex,$sql1);
	
	
	if (isset($query1)) {
		$query = pg_query($conex,$sql);
?>
		<script>
			
			location.href="../indexSistema.php?page=forms/form_compra&cod=1";
		</script>"
	<?php
		}else{
			echo "Não foi possivel editar o registro - entre em contato com Bigode GRC <br><br>".infotech.pg_result_error(result);
		}
	?>