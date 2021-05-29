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
        $gameInput->updateInput();
        $this->save->saveBoard();
    }
}