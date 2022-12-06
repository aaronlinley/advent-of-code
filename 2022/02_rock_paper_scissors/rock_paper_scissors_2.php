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

    private array $result = [
        'X' => self::LOSS,
        'Y' => self::DRAW,
        'Z' => self::WIN,
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
            $expectedResult = $this->result[$myInput];
            $roundResultPoints = $this->getShapePointsForResult($expectedResult, $round[0]);

            $myScores[] = $expectedResult + $roundResultPoints;
        }

        echo sprintf("My final score for the game is %d\n", array_sum($myScores));
    }

    private function getShapePointsForResult(int $result, string $enemyInput): int
    {
        $enemyScore = $this->enemyInput[$enemyInput];

        if ($result === self::WIN) {
            switch ($enemyScore) {
                case self::ROCK:
                    return self::PAPER;
                case self::PAPER:
                    return self::SCISSORS;
                case self::SCISSORS:
                    return self::ROCK;
            }
        } elseif ($result === self::LOSS) {
            switch ($enemyScore) {
                case self::ROCK:
                    return self::SCISSORS;
                case self::PAPER:
                    return self::ROCK;
                case self::SCISSORS:
                    return self::PAPER;
            }
        }

        return $enemyScore;
    }
}

$rps = new RockPaperScissors();
$rps->getMyFinalScore();