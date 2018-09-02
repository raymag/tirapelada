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
	            <h5 class="col m5 white-text">Progresso: 4/4</h5>
	            <h5 class="col m7 white-text right-align"><i><b>Times Sorteados</b></i></h5>
			<div class="progress white">
			    <div class="determinate green" style="width: 100%;"></div>
			</div>
		</div>
		<div class="col m12" id="backblack2"> <!-- Parte preta e transparente embaixo da barra de progresso (onde engloba todos os jogadores) -->
		<?php
		$players = $_SESSION["players"];
		$numPlayers = $_SESSION["numPlayers"];
		$numGoalkeeper = $_SESSION["numGoalkeeper"];
		$numTeams = $_SESSION["numTeams"];
		$undefined = $_SESSION["undefined"]; 
		$bronze = $_SESSION["bronze"];
		$silver = $_SESSION["silver"];
		$gold = $_SESSION["gold"];
		$teams = array();
		for($i=0;$i < $numTeams;$i++){
			$teams[$i] = array();
			$teams[$i][0] = 0; //pontos
		}
		if($numTeams<2){
			echo "<script>alert('São necessários pelo menos 10 jogadores')</script>";
			header("location:addplayers.php");
		}else{
		while(--$numGoalkeeper>=0){
				foreach($players as $player){
					sort($teams);
					if($player["playerPosition"] == "goleiro" && count($teams[0])<2){
						$teams[0][] = $player;
						switch($player["playerCategory"]){
							case "bronze":
								$teams[0][0]+=1;
								break;
							case "prata":
								$teams[0][0]+=2;
								break;
							case "ouro":
								$teams[0][0]+=3;
								break;
						}
						unset($players[array_search($player, $players)]);
					}
				}
		}
		while(--$gold >=0){
			foreach($players as $player){ 
				sort($teams);
				if($player["playerCategory"] == "gold" && count($teams[0])<6 ){
					$teams[0][] = $player;
					$teams[0][0] += 3;
					unset($players[array_search($player, $players)]);
				}
			}
		}
		while(--$silver >=0){
			foreach($players as $player){
				sort($teams);
				if($player["playerCategory"] == "silver" && count($teams[0])<6 ){
					$teams[0][] = $player;
					$teams[0][0] += 2;
					unset($players[array_search($player, $players)]);
				}
			}
		}
		while(--$bronze >=0){
			foreach($players as $player){
				sort($teams);
				if($player["playerCategory"] == "bronze" && count($teams[0])<6 ){
					$teams[0][] = $player;
					$teams[0][0] += 1;
					unset($players[array_search($player, $players)]);
				}
			}
		}
		while(--$undefined >=0){
			foreach($players as $player){
				sort($teams);
				if($player["playerCategory"] == "indefinido" && count($teams[0])<6){
					$min = count($teams[0]);
					$minTeam = $teams[0];
					foreach($teams as $team){
						if(count($teams[0])<$min){
							$min = $team[0];
							$minTeam = $team;
						}
					}
					$teams[array_search($teams, $minTeam)][] = $player;
					unset($players[array_search($player, $players)]);
				}
			}
		}
		$i = 1;
		foreach($teams as $team){
			echo "<div class='col m6' id='form'>";
			echo "<h3 class='header white-text'> Time ".$i++."(".$team[0].")</h3>";
			for($j=1;$j<count($team);$j++){
				echo "<div class='col m5 s12 white rounded center-align'>";
				echo "<span>".$team[$j]["playerName"]."</span>";
				if($team[$j]["playerPosition"] == "goleiro"){
					echo "<span class='badge white-text rounded-badge green'>GOL</span>";
				}
				echo "</div>";
			}
			echo "</div>";
		}
		// echo "<script>console.log(".count($teams).")</script>";
	}
		?>
			<!-- <div class="col m6" id="form">
				<h3 class="header white-text"> Time 1 </h3>
				<div class="col m5 s12 white rounded center-align"> 
		    		<span> Carlito </span>
		    		<span class="badge white-text rounded-badge green">GOL</span>
			    </div>
			    <div class="col m5 s12 white rounded center-align"> 
		    		<span> Luan </span>		    		
			    </div>
			    <div class="col m5 s12 white rounded center-align"> 
		    		<span> Jorge </span>
			    </div>
			    <div class="col m5 s12 white rounded center-align"> 
		    		<span> Anderson </span>
			    </div>
			    <div class="col m5 s12 white rounded center-align"> 
		    		<span> Sidney </span>
			    </div>
			</div>
			<div class="col m6" id="form">
				<h3 class="header white-text"> Time 2 </h3>
				<div class="col m5 s12 white rounded center-align"> 
		    		<span> João Afonso </span> 
		    		<span class="badge white-text green rounded-badge">GOL</span>
			    </div>
			    <div class="col m5 s12 white rounded center-align"> 
		    		<span> Jarbas </span>
			    </div>
			    <div class="col m5 s12 white rounded center-align"> 
		    		<span> João Gabriel </span>
			    </div>
			    <div class="col m5 s12 white rounded center-align"> 
		    		<span> Magno </span>
			    </div>
			    <div class="col m5 s12 white rounded center-align"> 
		    		<span> Neves </span>
			    </div>
			</div>		 -->
		<!-- </div>		 -->
		<?php 
		if(count($players)>0){
			echo '<div class="col m6" id="form">';
			echo '<h3 class="header white-text"> Reservas </h3>';
			foreach($players as $player){
				echo '<div class="col m5 s12 white rounded center-align"> ';
				echo '	<span> '.$player["playerName"].' </span> ';
				echo '</div>';
			}
			echo '</div';
		}
	?>
	</div>
</div>
</body>
</html>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.min.js" ></script>
<script type="text/javascript"> <?php include_once "includes/components/sidenav.js"; ?></script>