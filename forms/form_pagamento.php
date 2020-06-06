<div class="row">
  <h3 class="text-center">Forma de Pagamento</h3>
  <form class="form-horizontal" name="pagamento" action="dao/cad_pagamento.php" method="post" >
    <div class="form-group">
      <label>Tipo</label>
      <select name="tipo" class="form-control">
      <option value="À VISTA">À VISTA</option>
      <option value="PARCELA UNICA">PARCELA UNICA</option>
      <option value="PARCELADO">PARCELADO</option>
      </select>
    </div>
    <div class="form-group">
      <label>Forma</label>
      <select name="forma" class="form-control">
      <option value="DINHEIRO">DINHEIRO</option>
      <option value="CHEQUE">CHEQUE</option>
      <option value="BOLETO">BOLETO</option>
      </select>
    </div>
                     
       <button type="submit" class="btn btn-primary">Cadastrar</button>
       <button type="reset" class="btn btn-primary">Limpar</button>

  </form>
</div>