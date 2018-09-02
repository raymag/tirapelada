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
<?php include "includes/components/menu.php" ?>
<!-- Fim do Menu  -->
<!-- Centro -->
<div id="fundo">	
	<div class="row container">
		<div class="row" id="backblack">
	            <h5 class="col m5 white-text">Progresso: 2/4</h5>
	            <h5 class="col m7 white-text right-align"><i><b>Selecione os Goleiros</b></i></h5>
			<div class="progress white">
			    <div class="determinate green" style="width: 50%;"></div>
			</div>
		</div>
		<div class="col m12" id="backblack2">
			<div class="col m12" id="form">
				<form method="post" onsubmit="return false" id="formd">	
					<input type="hidden" name="gatilho" value="" id="gatilho"/>	
					<script>
					function ativar(){
						document.getElementById("gatilho").value = 'ativo';
						document.getElementById("formd").submit();
					}
					</script>	
				<?php
					if(isset($_POST["gatilho"])){
						$players = $_SESSION["players"];
						for($i=0;$i<count($players);$i++){
							if(isset($_POST[$i."n"])){
								$players[$i]["playerPosition"] = "goleiro";
								$_SESSION["numGoalkeeper"]++;
							}else{
								if($players[$i]["playerPosition"]=="goleiro"){
									$_SESSION["numGoalkeeper"]--;
								}
								$players[$i]["playerPosition"] = "campo";
							}
						}
						$_SESSION["players"] = $players;
						header("Location:rateplayers.php");
					}
				?>
					<?php
					$players = $_SESSION["players"];
					$i = 0;
					foreach($players as $player){
						$pn = $player["playerName"];
						$checked = "";
						if($player["playerPosition"] == "goleiro"){
							$checked = "checked";
						}
						echo "<div class='col m3 s12 push-m1 white rounded center-align'>";
						echo "<label>";
						echo "<input type='checkbox' value='goleiro' $checked name='".$i++."n'>";
						echo "<span class='black-text'> $pn </span>";
						echo "</label>";
						echo "</div>";
					}
					?>	  				   
				    <!-- <div class="col m3 s12 push-m1 white rounded center-align"> 
				    	<label>
					    	<input type="checkbox" />
					    	<span class="black-text"> João Gabriel </span> 
					    </label>
				    </div>
				    <div class="col m3 s12 push-m1 white rounded center-align"> 
				    	<label>
					    	<input type="checkbox" />
					    	<span class="black-text"> Jarbas </span> 
					    </label>
				    </div>
				    <div class="col m3 s12 push-m1 white rounded center-align"> 
				    	<label>
					    	<input type="checkbox" />
					    	<span class="black-text"> Magno </span> 
					    </label>
				    </div>
				    <div class="col m3 s12 push-m1 white rounded center-align"> 
				    	<label>
					    	<input type="checkbox" />
					    	<span class="black-text"> Carlito </span> 
					    </label>
				    </div>				   -->
						<button type="submit" onclick="ativar()" class="waves-effect col m12 s12 waves-light btn-large green" id="botao"> Próxima Etapa 
						<i class="material-icons right"> arrow_forward_ios </i> </button>	
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