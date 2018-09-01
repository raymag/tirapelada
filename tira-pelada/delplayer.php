<?php
session_start();
if(isset($_SESSION["players"])){
    if(isset($_GET["pn"]) && isset($_GET["pc"])){
        $player["playerName"] = $_GET["pn"];
        $player["playerCategory"] = $_GET["pc"];

        unset($_SESSION["players"][array_search($player, $_SESSION["players"])] );
        $_SESSION["numPlayers"] -= 1;
        $_SESSION["numTeams"] = floor($_SESSION["numPlayers"]/5);
        switch($player["playerCategory"]){
            case "bronze":
                $_SESSION["bronze"]--;
                break;
            case "prata":
                $_SESSION["prata"]--;
                break;
            case "ouro":
                $_SESSION["ouro"]--;
                break;
            default:
                $_SESSION["undefined"]--;
                break;
        }
        if($player["playerPosition"] == "goleiro"){
            $_SESSION["numGolkeeper"]--; 
        }
    }
}
header("location:homepage.php");
?>