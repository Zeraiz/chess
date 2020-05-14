<?php

namespace Chess\Model;

use Chess\ColorEnum;
use Chess\Game;

/**
 * Created by PhpStorm.
 * User: mpak
 * Date: 08.02.20
 * Time: 19:12
 */
class Pawn extends Figure
{

    private $firstMove = true;

    protected $symbolVariant = [
        ColorEnum::WHITE => '♙',
        ColorEnum::BLACK => '♟',
    ];

    /**
     * @param array $start
     * @param array $end
     * @return bool
     */
    public function checkMove(array $start, array $end): bool
    {
        $result = $this->checkMoveByColor($start['line'], $end['line']) && $this->checkPossibleMove($start, $end);
        if($this->firstMove && $result){
            $this->firstMove = false;
        }
        return $result;
    }

    /**
     * Проверяет, что движение назад запрещено
     * @param int $startLine
     * @param int $endLine
     * @return bool
     */
    private function checkMoveByColor(int $startLine, int $endLine){
        return ($this->color === ColorEnum::WHITE && $startLine - $endLine < 0)
            || ($this->color === ColorEnum::BLACK && $startLine - $endLine > 0);
    }

    /**
     * Проверяет возможно ли движение на клетку
     * @param array $start
     * @param array $end
     * @return bool
     */
    private function checkPossibleMove(array $start, array $end){
        $move = 1;
        if($this->color === ColorEnum::BLACK){
            $move = -1;
        }
        $nextLine = $start['line'] + $move;
        $endCellFigure = Game::$board->getCell($end['letter'], $end['line']);
        $nextCellFigure = Game::$board->getCell($start['letter'], $nextLine);
        $possible = [];
        if($endCellFigure === null && $nextCellFigure === null){
            if($this->firstMove){
                $possible[] = $start['letter'] . ($nextLine + $move);
            }
            $possible[] = $start['letter'] . $nextLine;
        }elseif(($endCellFigure instanceof Figure) && $endCellFigure->color !== $this->color){
            $ordLetter = ord($start['letter']);
            $possible[] = chr($ordLetter + 1) . $nextLine;
            $possible[] = chr($ordLetter - 1) . $nextLine;
        }
        return in_array(($end['letter'] . $end['line']), $possible, true);
    }
}
