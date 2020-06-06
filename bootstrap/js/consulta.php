<?php
require_once"conexao/conexao.php";
$nome = $_GET['q'];
$sql = "SELECT * FROM cliente WHERE nome = '$nome'";

    $query= pg_query($conex,$sql);

    while ($dados = pg_fetch_assoc($query)) {
     $nomes_cliente = $nomes_cliente . "\"" . $dados['nome'] . "\"," ;
  }
  echo json_encode($nomes_cliente);
?>