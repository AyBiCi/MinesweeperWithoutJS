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

            if($boardSet->tiles[$x][$y] != 9){
                $boardSet->tiles[$x][$y] = 9;
                $numOfMines--;
            }
        }
    }

    private static function calculateNumbers($boardSet){
        for($x = 0; $x < $boardSet->width;$x++)
            for($y = 0; $y < $boardSet->height;$y++){
                if(!$boardSet->isMine($x,$y)){
                    $numOfMines = 0;
                    if($y != 0 && $x != 0 && $boardSet->isMine($x-1, $y-1)) $numOfMines++;
                    if($y != 0 && $boardSet->isMine($x, $y-1)) $numOfMines++;
                    if($x != 19 && $y != 0 && $boardSet->isMine($x+1, $y-1)) $numOfMines++;
                    
                    if($x != 0 && $boardSet->isMine($x-1, $y)) $numOfMines++;
                    if($boardSet->isMine($x, $y)) $numOfMines++;
                    if($x != 19 && $boardSet->isMine($x+1, $y)) $numOfMines++;
                    
                    if($y != 19 && $x != 0 && $boardSet->isMine($x-1, $y+1)) $numOfMines++;
                    if($y != 19 && $boardSet->isMine($x, $y+1)) $numOfMines++;
                    if($x != 19 && $y != 19 && $boardSet->isMine($x+1, $y+1)) $numOfMines++;

                    $boardSet->tiles[$x][$y] = $numOfMines;
                }
            }
    }
}