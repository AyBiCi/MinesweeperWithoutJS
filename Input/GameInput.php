<?php namespace Minesweeper\Game\Input;

class GameInput{
    private $tool = "depressor";

    public function updateInput(){
        $this->checkForToolChange();

    }

    public function saveInput(){
        $_SESSION["tool"] = $tool;
    }

    private function loadTool(){
        $tool = $_SESSION["tool"];
    }

    private function checkForToolChange(){
        if(isset($_GET["tool"])){
            $tool = $_GET["tool"];
        }
    }
    
    private function checkForClicks(){
        
    }
}