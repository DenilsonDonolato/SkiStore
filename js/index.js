const valorProdutos = [100,50,75,80,150,120];
let prod = document.getElementsByName('prod');

for (let i = 1; i <= prod.length; i++) {
    document.getElementById('valorProd'+i).innerHTML = numberToReal(valorProdutos[i-1]);
    document.getElementById('prod'+i).setAttribute("Value",valorProdutos[i-1])
}

function numberToReal(num) {
    var numero = num.toFixed(2).split('.');
    numero[0] = "R$ " + numero[0].split(/(?=(?:...)*$)/).join('.');
    return numero.join(',');
}

//document.getElementById('prod1').innerHTML = vendedor;