<?php

namespace Test;

require __DIR__ . '/../vendor/autoload.php';

use Kata\Game;
use PHPUnit\Framework\TestCase;

class BowlingGameTest extends TestCase
{
    private $game;

    public function setUp(): void
    {
        $this->game = new Game();
    }

    public function test_gutterGame(): void
    {
        $this->rollMany(20,0);
        $this->assertEquals(0, $this->game->score());
    }

    public function test_allOnes(): void
    {
        $this->rollMany(20,1);
        $this->assertEquals(20, $this->game->score());
    }

    public function test_oneSpare(): void
    {
        $this->rollSpare();
        $this->game->roll(3);
        $this->rollMany(17,0);
        $this->assertEquals(16, $this->game->score());
    }

    public function test_oneStrike(): void
    {
        $this->roleStrike();
        $this->game->roll(3);
        $this->game->roll(4);
        $this->rollMany(16,0);
        $this->assertEquals(24, $this->game->score());

    }

    public function test_perfectGame(): void
    {
        $this->rollMany(12,10);
        $this->assertEquals(300, $this->game->score());
    }

    private function rollMany(int $n, int $pins): void
    {
        for($i =0 ; $i< $n ;$i++){
            $this->game->roll($pins);
        }
    }

    private function rollSpare(): void
    {
        $this->game->roll(5);
        $this->game->roll(5);
    }

    private function roleStrike(): void
    {
        $this->game->roll(10);
    }
}
