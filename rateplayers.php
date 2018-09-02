
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
<!-- Corpo -->
<div id="fundo">	
	<div class="row container">
		<div class="row" id="backblack"> <!-- Parte do pregresso com fundo preto transparente -->
	            <h5 class="col m5 white-text">Progresso: 3/4</h5>
	            <h5 class="col m7 white-text right-align"><i><b>Avalie os Jogadores</b></i></h5>
			<div class="progress white">
			    <div class="determinate green" style="width: 75%;"></div>
			</div>
		</div>
		<div class="col m12" id="backblack2"> <!-- Parte preta e transparente embaixo da barra de progresso (onde engloba todos os jogadores) -->
			<div class="col m12" id="form">
				<?php
				if(isset($_POST["gatilho"])){
					$players = $_SESSION["players"];
					for($i=0;$i<count($players);$i++){
						switch($_POST[$i."c"]){
							case "1":
								$players[$i]["playerCategory"] = "bronze";
								$_SESSION["bronze"]++;
								break;
							case "2":
								$players[$i]["playerCategory"] = "silver";
								$_SESSION["silver"]++;
								break;
							case "3":
								$players[$i]["playerCategory"] = "gold";
								$_SESSION["gold"]++;
								break;
							default:
								$_SESSION["undefined"]++;
								break;
						}
					}
					$_SESSION["players"] = $players;
					header("location: chooseteams.php");
				}
				?>
				<form method="post" onsubmit="return false" id="formd">		
					<input type="hidden" name="gatilho" id="gatilho" value="">
					<script>
					function ativar(){
						document.getElementById("gatilho").value = "ativo";
						document.getElementById("formd").submit();
					}
					</script>
					<?php
					$players = $_SESSION["players"];
					$i = 0;
					foreach($players as $player){
						$pn = $player["playerName"];
						$pc = $player["playerCategory"];
						echo "<div class='col m4 s12 push-m2 white rounded center-align'>";
						echo "<span> $pn </span>";
						switch($pc){
							case "bronze":
								echo "<input type='range' min='0' max='3' value='1' name='".$i."c' step='1'>";
								break;
							case "silver":
								echo "<input type='range' min='0' max='3' value='2' name='".$i."c' step='1'>";
								break;
							case "gold":
								echo "<input type='range' min='0' max='3' value='3' name='".$i."c' step='1'>";
								break;	
							default:
								echo "<input type='range' min='0' max='3' value='0' name='".$i."c' step='1'>";
								break;
						}
						$i++;
						echo "</div>";
					}
					?>
				    <!-- <div class="col m4 s12 push-m2 white rounded center-align"> 
			    		<span> Carlito </span> 
				    	<i class="material-icons right green-text">star_border</i>
				    	<i class="material-icons right green-text">star_border</i>
				    	<i class="material-icons right green-text">star_border</i>
				    </div>			   -->
						<button type="submit" onclick="ativar()" class="waves-effect col m12 s12 waves-light btn-large green" id="botao"> Próxima Etapa <i class="material-icons right"> arrow_forward_ios </i> </button>
				</form>		
			</div>	
		</div>		
	</div>
</div>
</body>
</html>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.min.js" ></script>
<script type="text/javascript"> <?php include_once "includes/components/sidenav.js"; ?></script>