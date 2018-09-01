<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TiraPelada</title>
    <link rel="stylesheet" href="css/padrao.css">
</head>
<body>
<div id="container">
<div id="section">
<?php 
session_start();
$players = $_SESSION["players"];
$numPlayers = $_SESSION["numPlayers"];
$numGolkeeper = $_SESSION["numGolkeeper"];
$numTeams = $_SESSION["numTeams"];
$undefined = $_SESSION["indefinido"]; 
$bronze = $_SESSION["bronze"];
$silver = $_SESSION["prata"];
$gold = $_SESSION["ouro"];
$teams = array();
// $teamScores = array();
for($i=0;$i < $numTeams;$i++){
    $teams[$i] = array();
    $teams[$i][0] = 0; //pontos
}
if($numTeams<2){
    echo "<script>alert('São necessários pelo menos 10 jogadores')</script>";
    // header("location:homepage.php");
}else{
while(--$numGolkeeper>=0){
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
        if($player["playerCategory"] == "ouro" && count($teams[0])<6 ){
            $teams[0][] = $player;
            $teams[0][0] += 3;
            unset($players[array_search($player, $players)]);
        }
    }
}
while(--$silver >=0){
    foreach($players as $player){
        sort($teams);
        if($player["playerCategory"] == "prata" && count($teams[0])<6 ){
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
// print_r($players);
echo count($teams)." Times<br>";
foreach($teams as $team){
    // echo "<br>";
    echo "<hr>";
    echo "<br>";
    echo "Pontos: ".$team[0];
    echo "<br/>";
    for($i=1;$i<count($team);$i++){
        echo "<div class='player-block'>";
        echo "Nome: ".$team[$i]["playerName"];
        echo "<br>";
        echo "Categoria: ".$team[$i]["playerCategory"];
        echo "<br>";
        echo "Posição: ".$team[$i]["playerPosition"];
        echo "<br>";
        echo "<a href='delplayer.php?pn=".$team[$i]["playerName"]."&pc=".$team[$i]["playerCategory"]."'>X</a>";
        echo "</div>";
        // echo $team[$i]["playerCategory"]." - ".$team[$i]["playerName"];
        // echo "<br/>";
    }
    echo "<br>";
}
echo "<hr>";
echo "<p>Jogadores de Reserva</p>";
foreach($players as $player){
    echo "<div class='player-block'>";
    echo "Nome: ".$player["playerName"];
    echo "<br>";
    echo "Categoria: ".$player["playerCategory"];
    echo "<br>";
    echo "Posição: ".$player["playerPosition"];
    echo "<br>";
    echo "</div>";
}
echo "<hr>";
// foreach($players as $player){
//     if()
// }
// var_dump($players);
}
?>
<a href="homepage.php">Voltar</a>
</div> 
</body>
</html>