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

    public function setNewBoard(Board $board){
        $_SESSION["board"] = $board->toJSON();
    }

    private function getSavedBoard() : Board{
        $board = new Board();
        $board->loadJSON($_SESSION["board"]);
        return $board; 
    }

    public function checkForWinOrLost(){
        if($this->isLost()){
            $_SESSION["lost"] = true;
        }
        else if($this->isWon()){
            $_SESSION["win"] = true;
        }

        if(!isset($_SESSION["win"]) && ($_SESSION["flags"] == $this->board->getNumberOfMines())){
            $_SESSION["lost"] = true;
        }
        
        if(isset($_SESSION["lost"])){
            $this->board->uncoverLoss();
        }
    }

    public function isLost(){
        return $this->isAnyBombExposed();
    }

    private function isAnyBombExposed(){
        foreach($this->board->everyTile() as $tile){
           if($tile->isMine() && !$tile->isCovered())
                return true;
        }
        return false;
    }

    public function isWon(){
        $goodAnswers = 0;
        foreach($this->board->everyTile() as $tile){
            if($tile->isFlagged() && $tile->isMine()) $goodAnswers++;
        }

        if($goodAnswers == $this->board->getNumberOfMines()) return true;
        else return false;
    }
}