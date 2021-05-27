<?php namespace Minesweeper\Game;

use Minesweeper\Game\Tile;

class Board{
    public $width = 20;
    public $height = 20;

    private $tiles;

    public function __construct( ){
        $this->clearBoard(); 
    }

    public function reveal($x, $y){
        $tile = $this->getTile($x, $y);
        $tile->uncover();
        if($tile->isBlank())
            $this->revealBlanks($x,$y);
    }

    public function revealBlanks($x, $y){
        foreach($this->tilesNearTile($this->getTile($x, $y)) as $tile){
            if($tile->isCovered()){
                $tile->uncover();
                if($tile->isBlank())
                    $this->revealBlanks($tile->getX(), $tile->getY());
            }
        }
    }
    
    public function clearBoard(){
        $this->realTiles = array(array());

        for($x=0;$x<$this->width;$x++)
            for($y=0;$y<$this->height;$y++){
                $this->tiles[$x][$y] = new Tile($x, $y);
            }
    }

    public function getTile($x, $y) : Tile{
        return $this->tiles[$x][$y];
    }

    public function tilesNearTile($tile){
        $tilesNear = new \ArrayObject();
        $x = $tile->getX();
        $y = $tile->getY();

        for($ex = ($x != 0 ? $x-1 : $x); $ex <= ($x != 19 ? $x+1 : $x);$ex++)
            for($ey = ($y != 0 ? $y-1 : $y); $ey <= ($y != 19 ? $y+1 : $y);$ey++)
                $tilesNear->append($this->getTile($ex,$ey));
        return $tilesNear;
    }

    public function everyTile(){
        $everyTile = new \ArrayObject();
        for($y=0;$y<$this->height;$y++) 
            for($x=0;$x<$this->width; $x++)
                $everyTile->append($this->getTile($x, $y));
        return $everyTile;
    }

    public function toJSON(){
        $object = array();
        
        $object["width"] = $this->width;
        $object["height"] = $this->height;

        for($x = 0; $x < $this->width; $x++)
        for($y = 0; $y < $this->height; $y++){
            $object["tiles"][$x][$y] = $this->tiles[$x][$y]->toArray();
        }   

        return json_encode($object);
    }

    public function loadJSON($json){
        $object = json_decode($json);

        $this->width = $object->width;
        $this->height = $object->height;

        for($x = 0; $x < $this->width; $x++)
        for($y = 0; $y < $this->height; $y++){
            $tile = new Tile($x, $y);
            $tile->loadFromArray($object->tiles[$x][$y]); 
            $this->tiles[$x][$y] = $tile;
        }   
    }
}