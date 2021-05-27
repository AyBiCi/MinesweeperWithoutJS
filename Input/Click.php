<?php namespace Minesweeper\Game\Input;

class Click{
    private $x;
    private $y;
    private $tool;

    public function __construct($x, $y, $tool){
        $this->x = $x;
        $this->y = $y;
        $this->tool = $tool;
    }

    public function executeOnBoard($board){

    }
}