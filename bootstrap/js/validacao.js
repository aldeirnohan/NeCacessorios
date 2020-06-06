function validarCPF(a){
	if(a=a.replace(/[^\d]+/g,""),""==a)
		return false;
	if(11!=a.length)
		return false;
	if ("00000000000"==a ||
		"11111111111"==a ||
		"22222222222"==a ||
		"33333333333"==a ||
		"44444444444"==a ||
		"55555555555"==a ||
		"66666666666"==a ||
		"77777777777"==a ||
		"88888888888"==a ||
		"99999999999"==a
	)
		return false;
	for(add=0,i=0;i<9;i++)
		add+=parseInt(a.charAt(i))*(10-i);
	if(rev=11-add%11,(10==rev||11==rev)&&(rev=0),rev!=parseInt(a.charAt(9)))
		return!1;
	for(add=0,i=0;i<10;i++)
		add+=parseInt(a.charAt(i))*(11-i);
	return rev=11-add%11,(10==rev||11==rev)&&(rev=0),rev!=parseInt(a.charAt(10))?!1:!0
}

function validarCNPJ(cnpj) {
    cnpj = cnpj.replace(/[^\d]+/g,'');
    if(cnpj == '')
    	return false;
    if (cnpj.length != 14)
        return false;
 	// Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
        cnpj == "11111111111111" || 
        cnpj == "22222222222222" || 
        cnpj == "33333333333333" || 
        cnpj == "44444444444444" || 
        cnpj == "55555555555555" || 
        cnpj == "66666666666666" || 
        cnpj == "77777777777777" || 
        cnpj == "88888888888888" || 
        cnpj == "99999999999999")
        return false;
         
    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;
         
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false;
           
    return true;
    
}