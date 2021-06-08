<?php namespace Minesweeper\Game;

class Tile{
    private $x;
    private $y;

    private $is_covered;
    private $is_flagged = false;
    private $value;

    public function __construct($x, $y){
        $this->x = $x;
        $this->y = $y;
        $this->is_covered = true;
        $this->value = 0;
    }

    public function isCovered() : bool{
        return $this->is_covered;
    }

    public function isMine() : bool{
        return $this->value == 9;
    }

    public function uncover(){
        $this->is_covered = false;
    }

    public function isBlank() : bool{
        return $this->value == 0;
    }

    public function getX() : int{
        return $this->x;
    }
    
    public function getY() : int{
        return $this->y;
    }

    public function setValue(int $value){
        $this->value = $value;
    }

    public function getValue() : int{
        return $this->value;
    }

    public function toArray() : array{
        $object = array();
        
        $object["x"] = $this->x;
        $object["y"] = $this->y;
        $object["is_flagged"] = $this->is_flagged;
        $object["is_covered"] = $this->is_covered;
        $object["value"] = $this->value;

        return $object;
    }

    public function loadFromArray(Object $array){
        $this->x = $array->x;
        $this->y = $array->y;
        $this->is_covered = $array->is_covered;
        $this->is_flagged = $array->is_flagged;
        $this->value = $array->value;
    }

    public function flag(){
        if($this->isCovered()){
            $this->is_flagged = true;
            if(isset($_SESSION["flags"]))
                $_SESSION["flags"]++;
            else
                $_SESSION["flags"] = 1;
        }
    }

    public function unflag(){
        if($this->is_flagged){
            $this->is_flagged = false;
            $_SESSION["flags"]--;
        }
    }
    
    public function isFlagged() : bool{
        return $this->is_flagged;
    }

    public function switchFlag(){
        if($this->isFlagged())
            $this->unflag();
        else
            $this->flag();
    }
}