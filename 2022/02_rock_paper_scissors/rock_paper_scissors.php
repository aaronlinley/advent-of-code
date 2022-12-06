<?php

class RockPaperScissors
{
    const WIN = 6;
    const DRAW = 3;
    const LOSS = 0;

    const ROCK = 1;
    const PAPER = 2;
    const SCISSORS = 3;

    private array $enemyInput = [
        'A' => self::ROCK,
        'B' => self::PAPER,
        'C' => self::SCISSORS,
    ];

    private array $myInput = [
        'X' => self::ROCK,
        'Y' => self::PAPER,
        'Z' => self::SCISSORS,
    ];

    private array $rounds = [];

    public function __construct()
    {
        $input = file(__DIR__ . '/input.txt');

        foreach ($input as $round) {
            $this->rounds[] = explode(' ', trim($round));
        }
    }

    public function getMyFinalScore(): void
    {
        $myScores = [];
        foreach ($this->rounds as $round) {
            $myInput = strtoupper($round[1]);
            $shapePoints = $this->myInput[$myInput];
            $roundResultPoints = $this->getResultPointsForRound($round);

            $myScores[] = $shapePoints + $roundResultPoints;
        }

        echo sprintf("My final score for the game is %d\n", array_sum($myScores));
    }

    private function getResultPointsForRound(array $round): int
    {
        $enemyScore = $this->enemyInput[$round[0]];
        $myScore = $this->myInput[$round[1]];

        if ($myScore === self::ROCK) {
            switch ($enemyScore) {
                case self::ROCK:
                    return self::DRAW;
                case self::PAPER:
                    return self::LOSS;
                case self::SCISSORS:
                    return self::WIN;
            }
        } elseif ($myScore === self::PAPER) {
            switch ($enemyScore) {
                case self::ROCK:
                    return self::WIN;
                case self::PAPER:
                    return self::DRAW;
                case self::SCISSORS:
                    return self::LOSS;
            }
        } else {
            switch ($enemyScore) {
                case self::ROCK:
                    return self::LOSS;
                case self::PAPER:
                    return self::WIN;
                case self::SCISSORS:
                    return self::DRAW;
            }
        }
    }
}

$rps = new RockPaperScissors();
$rps->getMyFinalScore();