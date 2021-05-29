<?php namespace Minesweeper\Input;

use Minesweeper\Game\Board;

class GameInput{
    private $tool = "depressor";
    private $board;

    public function __construct(Board $board){
        $this->board = $board;        
    }

    public function updateInput(){
        $this->loadTool();
        $this->checkForToolChange();
        $this->checkForClicks();
        $this->saveInput();
    }

    public function saveInput(){
        $_SESSION["tool"] = $this->tool;
    }

    private function loadTool(){
        if(isset($_SESSION["tool"]))
        $this->tool = $_SESSION["tool"];
    }

    private function checkForToolChange(){
        if(isset($_GET["tool"])){
            $this->tool = $_GET["tool"];
        }
    }
    
    private function checkForClicks(){
        if(isset($_GET["clickx"])  &&  isset($_GET["clicky"])){
            $this->resultClick($_GET["clickx"], $_GET["clicky"]);
        }
    }

    private function resultClick($x, $y){
        if($this->tool == "depressor")
            $this->board->reveal($x, $y);
        else
            $this->board->getTile($x, $y)->switchFlag();
    }
}