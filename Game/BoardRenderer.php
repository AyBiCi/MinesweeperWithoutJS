<?php namespace Minesweeper\Game;

class BoardRenderer{

    private $boardSet;

    public function __construct($boardSet){
        $this->boardSet = $boardSet;
    }

    public function show(){
        echo '<div id="board">';
        for($y=0;$y<$this->boardSet->height;$y++) {
            for($x=0;$x<$this->boardSet->width; $x++){
                echo $this->getTileDiv($this->boardSet->tile_cover[$x][$y], $this->boardSet->tiles[$x][$y], $x, $y);
            }
            echo '<div style="clear:both"></div>';
        }
        echo '</div>';
    }

    private static function getTileDiv($is_covered, $block, $x, $y){
        $image = "tile.png";
        if(!$is_covered){
            if($block == 0) $image = "blank.png";
            else if($block >= 1 && $block <=8) $image = $block.".png";
            else $image = "mine.png";
        }
        return '<a href="index.php?clickx='.$x.'&clicky='.$y.'"><div class="tile" style=\'background-image: url("Assets/'.$image.'")\'></div></a>';
    }
}