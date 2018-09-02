<?php
session_start();
if(isset($_SESSION["players"])){
    if(isset($_GET["pn"])){
        $player["playerName"] = $_GET["pn"];

        unset($_SESSION["players"][array_search($player, $_SESSION["players"])]);
        $_SESSION["numPlayers"]--;
        $_SESSION["numTeams"] = floor($_SESSION["numPlayers"]/5);
    }
}
header("location:addplayers.php");
?>