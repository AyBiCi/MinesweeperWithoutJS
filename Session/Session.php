<?php namespace Minesweeper\Session;

use Minesweeper\Game\Board;

session_start();

class Session{
    private $board;

    public function loadSession(){
        if($this->hasSavedBoardSet()) $this->board = $this->getSavedBoardSet();
    }

    public function hasSavedBoardSet() : bool{
        return isset($_SESSION["board"]);
    }

    public function getBoardSet() : Board{
        return $this->board;
    }

    public function saveBoard(){
        $_SESSION["board"] = $this->board->toJSON();
    }

    public function setNewBoard($board){
        $this->board = $board;
    }

    private function getSavedBoardSet() : Board{
        $board = new Board();
        $board->loadJSON($_SESSION["board"]);
        return $board; 
    }
}