<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE> Minesweeper </TITLE>
        <STYLE>
            .tile{
                width: 32px;
                height: 32px;
                float: left;
            }
            #board{
                margin-left: auto;
                margin-right: auto;
            }
        </STYLE>
    </HEAD>
    <BODY>
        <?php
            require_once("Game/BoardSet.php");
            require_once("Game/BoardRenderer.php");
            require_once("Game/BoardGenerator.php");

            use Minesweeper\Game\BoardRenderer;
            use Minesweeper\Game\BoardSet;
            use Minesweeper\Game\BoardGenerator;

            $boardSet = BoardGenerator::generateBoard(5);
            $boardRenderer = new BoardRenderer($boardSet);
            $boardRenderer->show();
        ?>
    </BODY>
</HTML>