<?php namespace Minesweeper\Input;

use Minesweeper\Game\Save;
use Minesweeper\Game\BoardGenerator;

class NewBoardRequestChecker{
    private $save;
    
    public function __construct(Save $save){
        $this->save = $save;
    }

    public function resolveRequestIfExists(){
        if(isset($_GET["numofmines"])) {
            $numofmines = $_GET["numofmines"];
            $this->save->setNewBoard(BoardGenerator::generateBoard($numofmines));
            unset($_SESSION["lost"]);
            unset($_SESSION["win"]);
            $_SESSION["flags"] = 0;
        }
    }
}