<?php

namespace Kata;

class Game
{
    private $currentRole = 0;
    private $rolls = array();

    public function roll(int $pins): void
    {
      $this->rolls[$this->currentRole++] = $pins;
    }

    public function score(): int
    {
        $score = 0;
        $frameIndex = 0;
        for ($frame = 0; $frame < 10; $frame++){
            if($this->isStrike($frameIndex)){
                $score += 10 + $this->strikeBonus($frameIndex);
                $frameIndex++;
            }else if($this->isSpare($frameIndex)){
                $score += 10 + $this->spareBonus($frameIndex);
                $frameIndex +=2;
            }else {
                $score += $this->sumOfBallInFrame($frameIndex);
                $frameIndex += 2;
            }
        }
        return $score;
    }

    private function isStrike(int $frameIndex): bool
    {
        return $this->rolls[$frameIndex] === 10;
    }

    private function isSpare(int $frameIndex): bool
    {
        return $this->rolls[$frameIndex] +  $this->rolls[$frameIndex+1] === 10;
    }

    private function spareBonus(int $frameIndex): int
    {
        return $this->rolls[$frameIndex+2];
    }

    private function strikeBonus(int $frameIndex): int
    {
        return $this->rolls[$frameIndex + 1] +
            $this->rolls[$frameIndex + 2];
    }

    private function sumOfBallInFrame(int $frameIndex): int
    {
        return $this->rolls[$frameIndex] + $this->rolls[$frameIndex + 1];
    }
}
