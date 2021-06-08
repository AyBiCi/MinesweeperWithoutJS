<?php namespace Minesweeper\Game;

use Minesweeper\Game\Tile;

class Board{
    public $width = 20;
    public $height = 20;

    private $numberOfMines;
    private $tiles;

    public function __construct( ){
        $this->clearBoard(); 
    }

    public function reveal(int $x, int $y){
        $tile = $this->getTile($x, $y);
        $tile->uncover();
        if($tile->isBlank())
            $this->revealBlanks($x,$y);
    }

    public function revealBlanks(int $x, int $y){
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
        
        $numberOfFlags = $numberOfMines = 0;
    }

    public function getTile(int $x, int $y) : Tile{
        return $this->tiles[$x][$y];
    }

    public function tilesNearTile(Tile $tile) : \ArrayObject{
        $tilesNear = new \ArrayObject();
        $x = $tile->getX();
        $y = $tile->getY();

        for($ex = ($x != 0 ? $x-1 : $x); $ex <= ($x != 19 ? $x+1 : $x);$ex++)
            for($ey = ($y != 0 ? $y-1 : $y); $ey <= ($y != 19 ? $y+1 : $y);$ey++)
                $tilesNear->append($this->getTile($ex,$ey));
        return $tilesNear;
    }

    public function everyTile() : \ArrayObject{
        $everyTile = new \ArrayObject();
        for($y=0;$y<$this->height;$y++) 
            for($x=0;$x<$this->width; $x++)
                $everyTile->append($this->getTile($x, $y));
        return $everyTile;
    }

    public function toJSON() : string{
        $object = array();
        
        $object["width"] = $this->width;
        $object["height"] = $this->height;
        $object["mines"] = $this->numberOfMines;

        for($x = 0; $x < $this->width; $x++)
        for($y = 0; $y < $this->height; $y++){
            $object["tiles"][$x][$y] = $this->tiles[$x][$y]->toArray();
        }   

        return json_encode($object);
    }

    public function loadJSON(string $json){
        $object = json_decode($json);

        $this->width = $object->width;
        $this->height = $object->height;
        $this->numberOfMines = $object->mines;

        for($x = 0; $x < $this->width; $x++)
        for($y = 0; $y < $this->height; $y++){
            $tile = new Tile($x, $y);
            $tile->loadFromArray($object->tiles[$x][$y]); 
            $this->tiles[$x][$y] = $tile;
        }   
    }
    public function setNumberOfMines(int $number){
        $this->numberOfMines = $number;
    }
    public function getNumberOfMines() : int{
        return $this->numberOfMines;
    }
}