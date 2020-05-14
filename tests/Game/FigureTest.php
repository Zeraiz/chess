<?php

namespace test\Game;

use Chess\Game;
use Chess\Model\Figure;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: mpak
 * Date: 08.02.20
 * Time: 23:00
 */
class FigureTest extends TestCase
{
    public function testPawn()
    {
        $figure = Figure::create('a', 2);
        $this->assertEquals('♙', $figure->symbol);
        $figure = Figure::create('b', 2);
        $this->assertEquals('♙', $figure->symbol);
        $figure = Figure::create('c', 2);
        $this->assertEquals('♙', $figure->symbol);
        $figure = Figure::create('h', 2);
        $this->assertEquals('♙', $figure->symbol);
        $figure = Figure::create('a', 7);
        $this->assertEquals('♟', $figure->symbol);
        $figure = Figure::create('f', 7);
        $this->assertEquals('♟', $figure->symbol);
        $figure = Figure::create('g', 7);
        $this->assertEquals('♟', $figure->symbol);
        $figure = Figure::create('h', 7);
        $this->assertEquals('♟', $figure->symbol);
    }

    public function testRook()
    {
        $figure = Figure::create('a', 1);
        $this->assertEquals('♖', $figure->symbol);
        $figure = Figure::create('h', 1);
        $this->assertEquals('♖', $figure->symbol);
        $figure = Figure::create('a', 8);
        $this->assertEquals('♜', $figure->symbol);
        $figure = Figure::create('h', 8);
        $this->assertEquals('♜', $figure->symbol);
    }

    public function testKnight()
    {
        $figure = Figure::create('b', 1);
        $this->assertEquals('♘', $figure->symbol);
        $figure = Figure::create('g', 1);
        $this->assertEquals('♘', $figure->symbol);
        $figure = Figure::create('b', 8);
        $this->assertEquals('♞', $figure->symbol);
        $figure = Figure::create('g', 8);
        $this->assertEquals('♞', $figure->symbol);
    }

    public function testBishop()
    {
        $figure = Figure::create('c', 1);
        $this->assertEquals('♗', $figure->symbol);
        $figure = Figure::create('f', 1);
        $this->assertEquals('♗', $figure->symbol);
        $figure = Figure::create('c', 8);
        $this->assertEquals('♝', $figure->symbol);
        $figure = Figure::create('f', 8);
        $this->assertEquals('♝', $figure->symbol);
    }

    public function testQueen()
    {
        $figure = Figure::create('d', 1);
        $this->assertEquals('♕', $figure->symbol);
        $figure = Figure::create('d', 8);
        $this->assertEquals('♛', $figure->symbol);
    }

    public function testKing()
    {
        $figure = Figure::create('e', 1);
        $this->assertEquals('♔', $figure->symbol);
        $figure = Figure::create('e', 8);
        $this->assertEquals('♚', $figure->symbol);
    }

    public function testMovePawn()
    {
        $game = new Game();
        $figure = $game::$board->getCell('e', 2);
        $game::$board->setMove(
            ['letter' => 'e', 'line' => 7],
            ['letter' => 'e', 'line' => 3]
        );
        $start = [
            'letter' => 'e',
            'line'   => 2,
        ];
        $end = [
            'letter' => 'e',
            'line'   => 4,
        ];
        $this->assertFalse($figure->checkMove($start, $end));
        $start = [
            'letter' => 'e',
            'line'   => 2,
        ];
        $end = [
            'letter' => 'e',
            'line'   => 3,
        ];
        $this->assertFalse($figure->checkMove($start, $end));
        $start = [
            'letter' => 'e',
            'line'   => 2,
        ];
        $end = [
            'letter' => 'd',
            'line'   => 3,
        ];
        $this->assertFalse($figure->checkMove($start, $end));
        $start = [
            'letter' => 'e',
            'line'   => 2,
        ];
        $end = [
            'letter' => 'e',
            'line'   => 2,
        ];
        $this->assertFalse($figure->checkMove($start, $end));
    }
}
