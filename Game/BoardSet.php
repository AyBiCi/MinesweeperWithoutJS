<?php namespace Minesweeper\Game;

class BoardSet{
    public $width = 20;
    public $height = 20;

    public $tile_cover;
    public $tiles; 

    public function __construct(){
        $this->tile_cover = array(array());
        $this->tiles = array(array());
        for($x=0;$x<$this->width;$x++) {
            for($y=0;$y<$this->height;$y++) {
                $this->tile_cover[$x][$y] = false;
                $this->tiles[$x][$y] = 0;
            }
        }
    }

    public function isMine($x, $y) : bool{
        return $this->tiles[$x][$y] == 9;
    }
}