<?php namespace Minesweeper\Game;

class Tile{
    private $x;
    private $y;

    private $is_covered;
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

    public function isMine(){
        return $this->value == 9;
    }

    public function uncover(){
        $this->is_covered = false;
    }

    public function isBlank() : bool{
        return $this->value == 0;
    }

    public function getX(){
        return $this->x;
    }
    
    public function getY(){
        return $this->y;
    }

    public function setValue($value){
        $this->value = $value;
    }

    public function getValue(){
        return $this->value;
    }

    public function toArray(){
        $object = array();
        
        $object["x"] = $this->x;
        $object["y"] = $this->y;
        $object["is_covered"] = $this->is_covered;
        $object["value"] = $this->value;

        return $object;
    }

    public function loadFromArray($array){
        $this->x = $array->x;
        $this->y = $array->y;
        $this->is_covered = $array->is_covered;
        $this->value = $array->value;
    }
     
}