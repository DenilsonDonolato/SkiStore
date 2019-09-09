<?php
	define("ERROR", 'error.html');

	if(isset($_GET['nome'])){
		$nome = trim($_GET['nome']);
		if (trim($nome)==='') {
			redirect(ERROR);
		}
	} else {
		redirect(ERROR);
	}
	$string = $nome;


	function redirect($url) {
		ob_start();
		header('Location: '.$url);
		ob_end_flush();
		die();
	}
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