<?php namespace Minesweeper\Session;

use Minesweeper\Game\BoardSet;

session_start();

class Session{
    private $boardSet;

    public function loadSession(){
        if($this->hasSavedBoardSet()) $this->boardSet = $this->getSavedBoardSet();
    }

    public function hasSavedBoardSet() : bool{
        return isset($_SESSION["board"]);
    }

    public function getBoardSet() : BoardSet{
        return $this->boardSet;
    }

    public function saveBoard(){
        $_SESSION["board"] = $this->boardSet->toJSON();
    }

    public function setNewBoard($boardSet){
        $this->boardSet = $boardSet;
    }

    private function getSavedBoardSet() : BoardSet{
        $boardSet = new BoardSet();
        $boardSet->loadJSON($_SESSION["board"]);
        return $boardSet; 
    }
}