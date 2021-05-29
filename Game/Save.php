<?php namespace Minesweeper\Game;

use Minesweeper\Game\Board;

session_start();

class Save{
    private $board;

    public function loadSave(){
        if($this->hasSave()) $this->board = $this->getSavedBoard();
    }

    public function hasSave() : bool{
        return isset($_SESSION["board"]);
    }

    public function getBoard() : Board{
        return $this->board;
    }

    public function saveBoard(){
        $_SESSION["board"] = $this->board->toJSON();
    }

    public function setNewBoard($board){
        $_SESSION["board"] = $board->toJSON();
    }

    private function getSavedBoard() : Board{
        $board = new Board();
        $board->loadJSON($_SESSION["board"]);
        return $board; 
    }
}