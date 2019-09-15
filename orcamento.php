<?php
	define("ERROR", 'error.html');
	date_default_timezone_set('America/Sao_Paulo');

	$dia = date("d");
	$mes = retornaMes(date("M"));
	$ano = date("Y");
	$validadeOrcamento = date('d-m-Y', strtotime('+1 week'));
	$dataOrcamento = date('d-m-Y');
	$horaOrcamento = date('H-i');

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
	if (isset($_POST['prod6'])){
		$produto6=$_POST['prod6'];
	}else {
		$produto6=0;
	}

	if (isset($_POST['sexo'])){
		$sexo=$_POST['sexo'];
	}else {
		$sexo="Masculino";
	}

	$totalPedido = 0;
	$totalPedido = $produto1+$produto2+$produto3+$produto4+$produto5+$produto6;
	$tipoPagamento = "";
	if (isset($_POST['formaPgto'])) {
		$desconto = $_POST['formaPgto'];
		switch ($desconto) {
			case '1':
				$tipoPagamento = "A vista com desconto de 10%";
				$descontoPerc = 0.1;
				$totalPedido *= (1-$descontoPerc);
				break;

			case '2':
				$descontoPerc = 0;
				$totalPedido *= (1-$descontoPerc);
				$tipoPagamento = "Em 2x parcelas sem juros.</p>
								<p>Valor da parcela: R$ ".(number_format($totalPedido/2,2,",",".")).".";
				break;

			case '6':
				$descontoPerc = -0.13;//Juros
				$totalPedido *= (1-$descontoPerc);
				$tipoPagamento = "Em 6x parcelas</p>
								<p>Valor da parcela: R$ ".(number_format($totalPedido/6,2,",",".")).".";
				break;
			
			default:
				redirect(ERROR);
				break;
		}
	}

	function redirect($url) {
		ob_start();
		header('Location: '.$url);
		ob_end_flush();
		die();
	}

	$escolha ="";

	if ($produto1>0) {
		$escolha.="Você selecionou Bota Rossignol Alltrack 90, no valor de R$ ".number_format($produto1,2,",",".").".</br>";
	}
	if ($produto2>0) {
		$escolha.="Você selecionou Bastão Leki Micro Vario Carbon, no valor de R$ ".number_format($produto2,2,",",".").".</br>";
	}
	if ($produto3>0) {
		$escolha.="Você selecionou Esqui Head Power Instinct, no valor de R$ ".number_format($produto3,2,",",".").".</br>";
	}
	if ($produto4>0) {
		$escolha.="Você selecionou Snowboard Burton After School, no valor de R$".number_format($produto4,2,",",".").".</br>";
	}
	if ($produto5>0) {
		$escolha.="Você selecionou Trenó Tsl Outdoor Weez 2 Places, no valor de R$ ".number_format($produto5,2,",",".").".</br>";
	}
	if ($produto6>0) {
		$escolha.="Capacete Head Stivot, no valor de R$ ".number_format($produto6,2,",",".").".";
	}

	$fp = fopen("orcamento-".$nome."-".$dataOrcamento."-".$horaOrcamento.".txt", "w");
	$arquivo = "";
	$arquivo.="Nome: ".$nome."\n";
	if ($produto1>0) {
		$arquivo.="Bota Rossignol Alltrack 90: R$ ".number_format($produto1,2,",",".")."\n";
	}
	if ($produto2>0) {
		$arquivo.="Bastão Leki Micro Vario Carbon: R$".number_format($produto2,2,",",".")."\n";
	}
	if ($produto3>0) {
		$arquivo.="Esqui Head Power Instinct: ".number_format($produto3,2,",",".")."\n";
	}
	if ($produto4>0) {
		$arquivo.="Você selecionou Snowboard Burton After School: ".number_format($produto4,2,",",".")."\n";
	}
	if ($produto5>0) {
		$arquivo.="Você selecionou Trenó Tsl Outdoor Weez 2 Places: ".number_format($produto5,2,",",".")."\n";
	}
	if ($produto6>0) {
		$arquivo.="Capacete Head Stivot: ".number_format($produto6,2,",",".")."\n";
	}
	$arquivo.="Valor Total: R$ ".number_format($totalPedido,2,",",".")."\n";
	switch ($desconto) {
		case '2':
			$arquivo.="Valor da parcela: R$ ".number_format($totalPedido/2,2,",",".")."\n";
			break;
		
		case '6':
			$arquivo.="Valor da parcela: R$ ".number_format($totalPedido/6,2,",",".")."\n";
			break;
	}
	switch ($desconto) {
		case '1':
			$arquivo.="Forma de pagamento: A vista com desconto de 10%\n";
			break;
		
		case '2':
			$arquivo.="Forma de pagamento: Em 2x parcelas sem juros\n";
			break;
		
		case '6':
			$arquivo.="Forma de pagamento: Em 6x parcelas\n";
			break;
	}

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


<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Ski Store Orçamento</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="./css/main.css" type="text/css" />

</head>
<body>

<div class="card text-center mx-auto" style="background-color: rgba(255, 255, 255, 0.63); width: 70%">
		
	<div class="card-body">
		<div class="card-board"><h1>Orçamento</h1>
			<p>Olá, <?php echo $nome;?>!</p>
			<p><?php echo $escolha;?></p>
			<p>Forma de pagamento selecionada: <?php echo $tipoPagamento;?></p>
			<p>Seu orçamento ficou no valor de R$ <?php echo number_format($totalPedido,2,",","."); ?>.</p>
			<p>Orçamento válido até <?php  echo $validadeOrcamento;?>.</p>
			<p>Jundiaí, <?php  echo $dia." de ".$mes." de ".$ano."."; ?></p>
		</div>
	</div> 
	
</div> 
	
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
		crossorigin="anonymous"></script>

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
		crossorigin="anonymous"></script>
</body>
</html>