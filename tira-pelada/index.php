<?php
session_start();
?>
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
<fieldset>

<ol>
<?php 
if(isset($_POST["playerName"][0])){
    $playerName = $_POST["playerName"];
    $playerCategory = $_POST["playerCategory"];
    $playerPosition = $_POST["playerPosition"];

    $players = $_SESSION["players"];
    $player = array();
    $player["playerName"] = $playerName;
    $player["playerCategory"] = $playerCategory;
    $player["playerPosition"] = $playerPosition;
    $players[] = $player;
    $numPlayers = count($players);
    $numGolkeeper = 0;
    $numTeams = floor($numPlayers/5);
    $undefined = 0; 
    $bronze = 0;
    $silver = 0;
    $gold = 0;
    foreach($players as $player){
        switch ($player["playerCategory"]){
            case "bronze":
                $bronze++;
                break;
            case "prata":
                $silver++;
                break;
            case "ouro":
                $gold++;
                break;    
            default:
                $undefined++;
                break;
        }
        if($player["playerPosition"] == "goleiro"){
            $numGolkeeper++;
        }
    }
    $_SESSION["numPlayers"] = $numPlayers;
    $_SESSION["numGolkeeper"] = $numGolkeeper;
    $_SESSION["numTeams"] = $numTeams;
    $_SESSION["indefinido"] = $undefined; 
    $_SESSION["bronze"] = $bronze;
    $_SESSION["prata"] = $silver;
    $_SESSION["ouro"] = $gold;
    // echo "Num P -> ".$numPlayers;

    $_SESSION["players"] = $players;

    foreach($players as $player){
        echo "<div class='player-block'>";
        echo "Nome: ".$player["playerName"];
        echo "<br>";
        echo "Categoria: ".$player["playerCategory"];
        echo "<br>";
        echo "Posição: ".$player["playerPosition"];
        echo "<br>";
        echo "<a href='delplayer.php?pn=".$player["playerName"]."&pc=".$player["playerCategory"]."'>X</a>";
        echo "</div>";
    }
    
    echo "<br><br><br>";
    echo "<br>";
    echo "Jogadores: $numPlayers";
    echo "<br>";
    echo "Times: $numTeams";
    echo "<br>";
    echo "Ouro: $gold";
    echo "<br>";
    echo "Prata: $silver";
    echo "<br>";
    echo "Bronze: $bronze";
    echo "<br>";
    echo "Indefinido: $undefined";
    echo "<br>";

}
// echo "Jogadores: $numPlayers";

// unset($_SESSION["players"]);
?>
</ol>

<form method="post">
<fieldset>
<legend>Adicionar Jogador</legend>
<label>Nome: <input type="text" required name="playerName"> </label>
<label>Posição: 
<select name="playerPosition">
    <option value="campo">Campo</option>
    <option value="goleiro">Goleiro</option>
</select> </label><br>
<fieldset>
<legend>Categoria</legend>
<label>Desconhecido: <input type="radio" checked name="playerCategory" value="indefinido"></label><br>
<label>Bronze: <input type="radio" name="playerCategory" value="bronze"></label><br>
<label>Prata: <input type="radio" name="playerCategory" value="prata"></label><br>
<label>Ouro: <input type="radio" name="playerCategory" value="ouro"></label><br>
</fieldset>
<br>
<input type="submit" value="Adicionar"><br>
<a href="tiratime.php">Tirar Time</a><br>
<a href="limpartime.php">Limpar Time</a>
</fieldset>
</form>
</fieldset>
</div>
<?php 
if(isset($_SESSION["players"]) && !isset($_POST["playerName"])){
    // $teams = $_SESSION["teams"];
    $players = $_SESSION["players"];
    $numPlayers = $_SESSION["numPlayers"];
    $numGolkeeper = $_SESSION["numGolkeeper"];
    $numTeams = $_SESSION["numTeams"];
    $undefined = $_SESSION["indefinido"]; 
    $bronze = $_SESSION["bronze"];
    $silver = $_SESSION["prata"];
    $gold = $_SESSION["ouro"];

    echo "<br>";
    echo "Jogadores: $numPlayers";
    echo "<br>";
    echo "Times: $numTeams";
    echo "<br>";
    echo "Ouro: $gold";
    echo "<br>";
    echo "Prata: $silver";
    echo "<br>";
    echo "Bronze: $bronze";
    echo "<br>";
    echo "Indefinido: $undefined";
    echo "<br>";
    echo "<hr>";

    echo "<div class='container'>";
    foreach($players as $player){
        // echo "==========";
        echo "<div class='player-block'>";
        echo "Nome: ".$player["playerName"];
        echo "<br>";
        echo "Categoria: ".$player["playerCategory"];
        echo "<br>";
        echo "Posição: ".$player["playerPosition"];
        echo "<br>";
        echo "<a href='delplayer.php?pn=".$player["playerName"]."&pc=".$player["playerCategory"]."'>X</a>";
        echo "</div>";
    }
    echo "</div>";
}else{
    $teams = array();
    $players = array();
    $undefined = 0; 
    $bronze = 0;
    $silver = 0;
    $gold = 0;
    $numGolkeeper = 0;
    if(!isset($_SESSION["players"])){
        $_SESSION["players"] = array();
        $_SESSION["numPlayers"] = 0;
        $_SESSION["numGolkeeper"] = $numGolkeeper;
        $_SESSION["numTeams"] = 0;
        $_SESSION["indefinido"] = $undefined;
        $_SESSION["bronze"] = $bronze;
        $_SESSION["prata"] = $silver;
        $_SESSION["ouro"] = $gold;
        
    }
}
?>

</div> 
</body>
</html>