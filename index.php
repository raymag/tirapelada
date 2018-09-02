<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title> Tira Times - O site que sorteia times</title>

	<?php include_once "includes/metatags.html";?>

	<link href='css/estilo-index.css' type="text/css" rel="stylesheet" />
	<link rel="icon" type="imagem/png" href="imagens/icone.png" />
 
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<?php include "includes/components/menu.php" ?>
<!-- Fim do Menu  -->
<!-- Centro -->
<div id="fundo">	
	<div class="row container">
		<div class="col m12" id="centro">
			<h2 class="header center white-text"> O <b>melhor site</b> para tirar times</h2>
			<h5 class="center white-text"> Sorteie os times para sua pelada com o melhor site! Com opções de escolha de goleiros e avaliação dos jogadores. </h5> 
			<a class="waves-effect waves-light btn-large green" href="addplayers.php" id="botao"> Tirar Time </a>
		</div>		
	</div>
</div>
</body>
</html>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.min.js" ></script>
<script type="text/javascript"> <?php include_once "includes/components/sidenav.js"; ?></script>