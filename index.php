<?php
    require_once("Game/Board.php");
    require_once("Game/BoardRenderer.php");
    require_once("Game/BoardGenerator.php");
    require_once("Game/Tile.php");
    require_once("Game/Save.php");
    require_once("Input/BoardInput.php");
    require_once("Game/Game.php");
    require_once("Input/NewBoardRequestChecker.php");

    use Minesweeper\Input\NewBoardRequestChecker;
    use Minesweeper\Game\Game;
    use Minesweeper\Game\BoardRenderer;
    use Minesweeper\Game\Board;
    use Minesweeper\Game\BoardGenerator;
    use Minesweeper\Game\Save;
    use Minesweeper\Input\GameInput;

    $save = new Save();
    $newBoardInput = new NewBoardRequestChecker($save);
    $newBoardInput->resolveRequestIfExists();

    if($save->hasSave()){
        $save->loadSave();
        $game = new Game($save);
        $game->loop();
    }
?>
<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE> Minesweeper </TITLE>
        <LINK rel="stylesheet" href="style.css?5">
    </HEAD>
    <BODY>
        <div id="left-panel">
            <div id="logo" class="leftblock">
                Minesweeper
            </div>
            <div id="newboard" class="leftblock">
                <form action="#" method="get">
                    Mines number<br> 
                    <input type="number" class="button" id="minesnuminput" name="numofmines">
                    <input type="submit" class="button" value="Create new board">
                </form>
            </div>

            <div id="stats" class="leftblock">
                Flags: <?= ( isset($_SESSION["flags"]) ? $_SESSION["flags"] : 0) ?><br>
                Mines: <?=$save->getBoard()->getNumberOfMines()?> <br>
            </div>

            <div id="mode">
                <form action="?depressor" method="get">
                    <input type="submit" id="depressor" class="tool" name="tool" value="depressor">
                    <input type="submit" id="flag" class="tool" name="tool" value="flag">
                </form>
            </div>
        </div>
        <?php
            if($save->hasSave()){
                $boardRenderer = new BoardRenderer($save->getBoard());
                $boardRenderer->show();
            }
            else{
                echo "You don't have saved game! Create new board";
            }
        ?>
    </BODY>
</HTML>