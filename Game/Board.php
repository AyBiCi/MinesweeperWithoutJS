<?php namespace Minesweeper\Game;

class Board{
    private $width = 20;
    private $height = 20;

    private $tile_cover;
    private $tiles;

    public function __construct(){
        $this->tile_cover = array(array());
        for($x=0;$x<$width;$x++) {
            for($y=0;$y<$height;$y++) {
                $this->tile_cover[$x][$y] = true;
            }
        }
    }

    public function show(){
        echo '<div id="board">';
        for($j=0;$j<$this->height;$j++) {
            for($i=0;$i<$this->width; $i++){
                echo '<div class="closed"></div>';
            }
            echo '<div style="clear:both"></div>';
        }
        echo '</div>';
    }
}