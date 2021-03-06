<?php namespace Minesweeper\Game;

use Minesweeper\Game\Board;

class BoardGenerator{
    public static function generateBoard(int $numOfMines) : Board{
        $board = new Board();
        $board->setNumberOfMines($numOfMines);
        BoardGenerator::placeMines($numOfMines, $board); 
        Boardgenerator::calculateNumbers($board); 
        return $board;
    }

    private static function placeMines(int $numOfMines, Board $board){
        while($numOfMines != 0){
            $x = rand(0, 19);
            $y = rand(0, 19);

            if(!$board->getTile($x,$y)->isMine()){
                $board->getTile($x,$y)->setValue(9);
                $numOfMines--;
            }
        }
    }

    private static function calculateNumbers(Board $board){
        foreach($board -> everyTile() as $tile){
            if(!$tile->isMine()){
                $numOfMines = 0;
                
                foreach($board->tilesNearTile($tile) as $tile2)
                    if($tile2->isMine())
                        $numOfMines++;

                $tile->setValue($numOfMines);
            }
        }
    }
}