<?php namespace Minesweeper\Game;

use Minesweeper\Input\BoardInput;
use Minesweeper\Game\BoardRenderer;

class Game{
    private $save;

    public function __construct(Save $save){
        $this->save = $save;
    }

    public function loop(){
        $gameInput = new BoardInput($this->save->getBoard());
        if(!isset($_SESSION["lost"]) && !isset($_SESSION["win"]))
            $gameInput->updateInput();

        $this->save->checkForWinOrLost();
        $this->save->saveBoard();
    }

    public function isLost(){
        return isset($_SESSION["lost"]);
    }

    public function isWon(){
        return isset($_SESSION["win"]);
    }
}