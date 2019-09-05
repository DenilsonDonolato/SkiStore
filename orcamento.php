<?php
	if(isset($_GET['nome'])){
		$nome = $_GET['nome'];
	} else {
		echo "nao tem";
	}
	$string = $nome;
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Ski Store Orçamento</title>
</head>
<body>
	<h1>Orçamento</h1>
	<p><?php echo $string;?></p>
</body>
</html>