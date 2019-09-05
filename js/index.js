const valorProdutos = [15,20,30,45,50];
let prod = document.getElementsByName('prod');

for (let i = 1; i <= prod.length; i++) {
	document.getElementById('valorProd'+i).innerHTML = valorProdutos[i-1];
}

//document.getElementById('prod1').innerHTML = vendedor;