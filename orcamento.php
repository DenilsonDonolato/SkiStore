<?php
	define("ERROR", 'error.html');
	date_default_timezone_set('America/Sao_Paulo');

	$dia = date("d");
	$mes = retornaMes(date("M"));
	$ano = date("Y");
	$validadeOrcamento = date('d-m-Y', strtotime('+1 week'));
	$dataOrcamento = date('d-m-Y');

	if(isset($_POST['nome'])){
		$nome = trim($_POST['nome']);
		if (trim($nome)==='') {
			redirect(ERROR);
		}
	} else {
		redirect(ERROR);
	}
	$string = $nome;

	if (isset($_POST['prod1'])){
		$produto1=$_POST['prod1'];
	}else {
		$produto1=0;
	}
	if (isset($_POST['prod2'])){
		$produto2=$_POST['prod2'];
	}else {
		$produto2=0;
	}
	if (isset($_POST['prod3'])){
		$produto3=$_POST['prod3'];
	}else {
		$produto3=0;
	}
	if (isset($_POST['prod4'])){
		$produto4=$_POST['prod4'];
	}else {
		$produto4=0;
	}
	if (isset($_POST['prod5'])){
		$produto5=$_POST['prod5'];
	}else {
		$produto5=0;
	}

	if (isset($_POST['sexo'])){
		$sexo=$_POST['sexo'];
	}else {
		$sexo="Masculino";
	}
	
	$totalPedido = 0;
	$valorProd1 = 15;
	$totalPedido = $produto1+$produto2+$produto3+$produto4+$produto5;

	function redirect($url) {
		ob_start();
		header('Location: '.$url);
		ob_end_flush();
		die();
	}

	$escolha ="";

	if ($produto1>0) {
		$escolha.="Você selecionou Produto 1, no valor de ".number_format($produto1,2,",",".").".</br>";
	}
	if ($produto2>0) {
		$escolha.="Você selecionou Produto 2, no valor de ".number_format($produto2,2,",",".").".</br>";
	}
	if ($produto3>0) {
		$escolha.="Você selecionou Produto 3, no valor de ".number_format($produto3,2,",",".").".</br>";
	}
	if ($produto4>0) {
		$escolha.="Você selecionou Produto 4, no valor de ".number_format($produto4,2,",",".").".</br>";
	}
	if ($produto5>0) {
		$escolha.="Você selecionou Produto 5, no valor de ".number_format($produto5,2,",",".").".";
	}

	$fp = fopen("orcamento-".$nome."-".$dataOrcamento.".txt", "w");
	$arquivo = "";
	$arquivo.="Nome: ".$nome."\n";
	if ($produto1>0) {
		$arquivo.="Produto 1: R$ ".number_format($produto1,2,",",".").".\n";
	}
	if ($produto2>0) {
		$arquivo.="Produto 2: R$".number_format($produto2,2,",",".").".\n";
	}
	if ($produto3>0) {
		$arquivo.="Produto 3: ".number_format($produto3,2,",",".").".\n";
	}
	if ($produto4>0) {
		$arquivo.="Produto 4: ".number_format($produto4,2,",",".").".\n";
	}
	if ($produto5>0) {
		$arquivo.="Produto 5: ".number_format($produto5,2,",",".").".\n";
	}
	$arquivo.="Valor Total: R$ ".number_format($totalPedido,2,",",".")."\n";
	$arquivo.="Válido até ".$validadeOrcamento;
	fwrite($fp, $arquivo);
	fclose($fp);


	function retornaMes($mes){
		switch ($mes) {
			case "Jan": $result = "Janeiro"; break;
			case "Fev": $result = "Fevereiro"; break;
			case "Mar": $result = "Março"; break;
			case "Apr": $result = "Abril"; break;
			case "May": $result = "Maio"; break;
			case "Jun": $result = "Junho"; break;
			case "Jul": $result = "Julho"; break;
			case "Aug": $result = "Agosto"; break;
			case "Sep": $result = "Setembro"; break;
			case "Oct": $result = "Outubro"; break;
			case "Nov": $result = "Novembro"; break;
			case "Dec": $result = "Dezembro"; break;
			default: $result = "Número do mês inválido"; break;
		}
		return $result;
	}

?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Ski Store Orçamento</title>
	<link rel="stylesheet" href="./css/main.css" type="text/css" />

</head>
<body>
	<div class="card text-center mx-auto" style="background-color: rgba(255, 255, 255, 0.63); width: 50%">
		<div class="card-board"><h1>Orçamento</h1>
		<p>Olá, <?php echo $nome;?>!</p>
		<p><?php echo $escolha;?></p>
		<p>Seu orçamento ficou no valor de R$ <?php echo number_format($totalPedido,2,",","."); ?>.</p>
		<p>Orçamento válido até <?php  echo $validadeOrcamento;?>.</p>
		<p>Jundiaí, <?php  echo $dia." de ".$mes." de ".$ano."."; ?></p>
		</div>
	</div>
</body>
</html>