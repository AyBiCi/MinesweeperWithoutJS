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
        foreach($boardSet -> everyTile() as $tile){
            if(!$tile->isMine()){
                $numOfMines = 0;
                
                foreach($boardSet->tilesNearTile($tile) as $tile2)
                    if($tile2->isMine())
                        $numOfMines++;

                $tile->setValue($numOfMines);
            }
        }
    }
}