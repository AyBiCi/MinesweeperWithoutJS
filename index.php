<?php session_start() ?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE> Minesweeper </TITLE>
        <STYLE>
            body{
                padding: 0px;
                margin: 0px;
            }
            #up{
                width: 100%;
                height: 10%;
                background: gray;
                color: white;
                font-size: 40px;
                line-height: 100px;
                text-align: center;
                float: left;
            }
            #options{
                width: 300px;
                height: 700px;
                float: left;
                background: darkgray;
            }
            .tile{
                width: 32px;
                height: 32px;
                float: left;
            }
            #board{
                float: left;
            }
        </STYLE>
    </HEAD>
    <BODY>
        <div id="up">
           Minesweeper
        </div>
        <div id="options">
            <form action="#" method="get">
                Mines number: 
                <input type="number" name="numofmines">
                <input type="submit" value="Generate new board">
            </form>
        </div>

        <?php
            require_once("Game/BoardSet.php");
            require_once("Game/BoardRenderer.php");
            require_once("Game/BoardGenerator.php");

            use Minesweeper\Game\BoardRenderer;
            use Minesweeper\Game\BoardSet;
            use Minesweeper\Game\BoardGenerator;

            $cookieName = "marec";
            
            $boardSet = new BoardSet();
            $boardSet->loadJSON($_SESSION["boardSet"]);
            $numofmines = 30;
            $new = false;

            if(isset($_GET["numofmines"]) && $_GET["numofmines"] != 0) {
                $numofmines = $_GET["numofmines"];
                $boardSet = BoardGenerator::generateBoard($numofmines);
                $new = true;
            }

            if(isset($_GET["clickx"])){
                $boardSet->reveal($_GET["clickx"], $_GET["clicky"]);
            }

            $boardRenderer = new BoardRenderer($boardSet);
            $_SESSION["boardSet"] = $boardSet->toJSON();
            $boardRenderer->show();
            

        ?>
    </BODY>
</HTML>