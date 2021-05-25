<?php namespace Minesweeper\Game;

use Minesweeper\Game\BoardSet;

class BoardGenerator{
    public static function generateBoard($numOfMines){
        $boardSet = new BoardSet();
        BoardGenerator::placeMines($numOfMines, $boardSet); 
        Boardgenerator::calculateNumbers($boardSet); 
        return $boardSet;
    }

    private static function placeMines($numOfMines, $boardSet){
        while($numOfMines != 0){
            $x = rand(0, 19);
            $y = rand(0, 19);

            if(!$boardSet->getTile($x,$y)->isMine()){
                $boardSet->getTile($x,$y)->setValue(9);
                $numOfMines--;
            }
        }
    }

    private static function calculateNumbers($boardSet){
        for($x = 0; $x < $boardSet->width;$x++)
            for($y = 0; $y < $boardSet->height;$y++){
                if(!$boardSet->getTile($x,$y)->isMine()){
                    $numOfMines = 0;
                    
                    foreach($boardSet->tilesNearTile($x, $y) as $tile)
                        if($tile->isMine())
                            $numOfMines++;

                    $boardSet->getTile($x,$y)->setValue($numOfMines);
                }
            }
    }
}