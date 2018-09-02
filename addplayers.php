<?php session_start() ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title> Tira Times - Sorteando Times</title>

	<?php include_once "includes/metatags.html";?>

	<link href='css/estilo-sorteia.css' type="text/css" rel="stylesheet" />
	<link rel="icon" type="imagem/png" href="imagens/icone.png" />
 
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<!-- Menu -->
<?php include "includes/components/menu.php" ?>
<!-- Fim do Menu  -->
<!-- Centro -->
<div id="fundo">	
	<div class="row container">
		<div class="row" id="backblack">
	            <h5 class="col m5 white-text">Progresso: 1/4</h5>
	            <h5 class="col m7 white-text right-align"><i><b>Cadastre os Jogadores</b></i></h5>
			<div class="progress white">
			    <div class="determinate green" style="width: 25%;"></div>
			</div>
		</div>
		<div class="col m12" id="backblack2">
			<div class="col m12" id="form">
				<form method="post" action="">
					<div class="input-field col m12 s12 white-text">
			          <input id="jogador" name="jogador" type="text" class="validate white-text">
			          <label for="jogador">Insira o nome do jogador:</label>
			        </div>
					<button type="submit" class="waves-effect col m4 waves-light right btn-large green" id="botao"> Adicionar jogador </button>					
				</form>		
			</div>	
		</div>		
		<div class="col m12" id="backblack2">
		<?php
		if(isset($_POST["jogador"][0])){
			$nomeJogador = $_POST["jogador"];
			if(!isset($_SESSION["players"])){
				$_SESSION["players"] = array();
				$_SESSION["numPlayers"] = 0;
				$_SESSION["numGoalkeeper"] = 0;
				$_SESSION["numTeams"] = 0;
				$_SESSION["undefined"] = 0;
				$_SESSION["bronze"] = 0;
				$_SESSION["silver"] = 0;
				$_SESSION["gold"] = 0;
			}
			$jogador["playerName"] = $nomeJogador;
			$jogador["playerPosition"] = "campo";
			$jogador["playerCategory"] = "indefinido";
			$_SESSION["players"][] = $jogador;
			$_SESSION["numPlayers"] = count($_SESSION["players"]);
			$_SESSION["numTeams"] = floor($_SESSION["numPlayers"]/5);

		}
		if(isset($_SESSION["players"])){
			$players = $_SESSION["players"];
			foreach($players as $player){
				$pn = $player["playerName"];
				echo "<div class='col m3 s12 push-m1 white rounded center-align'>";
				echo "<span>".$player["playerName"]."</span>";
				echo "<a href='delplayer.php?pn=$pn'><i class='material-icons right green-text'>close</i></a>";
				echo "</div>";
			}
		}
		?>
			<!-- <div class="col m3 s12 push-m1 white rounded center-align"> 
				<span> João Gabriel </span> 
				<a href="#"> <i class="material-icons right green-text">close</i> </a> -->
				<!-- ATRIBUIR FUNÇÃO AO CLICAR NO 'X' -->
			<!-- </div>

			<div class="col m3 s12 push-m1 white rounded center-align"> 
				<span> Jarbas </span> 
				<a href="#"> <i class="material-icons right green-text">close</i> </a>
			</div>

			<div class="col m3 s12 push-m1 white rounded center-align"> 
				<span> Magno </span> 
				<a href="#"> <i class="material-icons right green-text">close</i> </a>		
			</div>

			<div class="col m3 s12 push-m1 white rounded center-align"> 
				<span> Carlito </span> 
				<a href="#"> <i class="material-icons right green-text">close</i> </a>
			</div> -->
			<button type="submit" onclick="window.location.href = 'setgoalkeepers.php'" class="waves-effect col m12 waves-light btn-large <?php if($_SESSION["numTeams"]<2){echo " disabled ";} ?>" id="botao"> Próxima Etapa <i class="material-icons right"> arrow_forward_ios </i> </button>
		</div>	
	</div>
</div>
</body>
</html>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.min.js" ></script>