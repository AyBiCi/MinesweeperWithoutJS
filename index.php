<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE> Minesweeper </TITLE>
        <LINK rel="stylesheet" href="style.css?1">
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
            require_once("Game/Tile.php");
            require_once("Session/Session.php");

            use Minesweeper\Game\BoardRenderer;
            use Minesweeper\Game\BoardSet;
            use Minesweeper\Game\BoardGenerator;
            use Minesweeper\Session\Session;
            
            $session = new Session();
            $session->loadSession();

            $numofmines = 30;
            $new = false;

            if(isset($_GET["numofmines"])) {
                $numofmines = $_GET["numofmines"];
                $session->setNewBoard(BoardGenerator::generateBoard($numofmines));
                $new = true;
            }

            if(isset($_GET["clickx"])){
                $session->getBoardSet()->reveal($_GET["clickx"], $_GET["clicky"]);
            }

            $boardRenderer = new BoardRenderer($session->getBoardSet());
            $session->saveBoard();
            $boardRenderer->show();
        ?>
    </BODY>
</HTML>