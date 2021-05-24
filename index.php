<!DOCTYPE HTML>
<HTML>
    <HEAD>
        <TITLE> Minesweeper </TITLE>
        <STYLE>
            .closed{
                width: 32px;
                height: 32px;
                background-image: url("Assets/tile.png");
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
            require_once("Game/Board.php");
            use Minesweeper\Game\Board;

            $board = new Board();
            $board->show();
        ?>
    </BODY>
</HTML>