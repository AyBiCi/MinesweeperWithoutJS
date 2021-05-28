<?php namespace Minesweeper\Game;

use Minesweeper\Game\Tile;

class BoardRenderer{

    private $board;

    public function __construct($board){
        $this->board = $board;
    }

    public function show(){
        echo '<div id="board">';
        for($y=0;$y<$this->board->height;$y++) {
            for($x=0;$x<$this->board->width; $x++){
                echo $this->getTileDiv($this->board->getTile($x,$y));
            }
            echo '<div style="clear:both"></div>';
        }
        echo '</div>';
    }

    private static function getTileDiv($tile){
        $image;

        if($tile->isFlagged()) $image = "flagged.png";
        else if($tile->isCovered()) $image = "tile.png";
        else if($tile->isBlank()) $image = "blank.png";
        else if($tile->isMine()) $image = "mine.png";
        else $image = $tile->getValue().".png";
        
        return '<a href="index.php?clickx='.$tile->getX().'&clicky='.$tile->getY().'"><div class="tile" style=\'background-image: url("Assets/'.$image.'")\'></div></a>';
    }
}