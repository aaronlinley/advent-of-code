<?php

class CalorieCounter
{
    private array $elves = [];

    public function __construct()
    {
        $this->setElvesFromFile(file(__DIR__ . '/elves.txt'));
    }

    private function setElvesFromFile(array $rawData) {
        $i = 0;
        foreach($rawData as $elf)
        {
            $elf = trim($elf);

            if (!empty($elf)) {
                $this->elves[$i][] = intval($elf);
            } else {
                $i++;
            }
        }
    }

    public function findElfWithMostCalories(): void
    {
        $totals = [];
        foreach ($this->elves as $elf) {
            $totals[] = array_sum($elf);
        }

        arsort($totals);
        $elfCounter = array_keys($totals);

        echo sprintf(
            "The elf with the most calories is %d. They have %d calories available.\n",
            $elfCounter[0] + 1,
            $totals[$elfCounter[0]]
        );

        $topThreeElves = [$elfCounter[0] + 1, $elfCounter[1] + 1, $elfCounter[2] + 1];
        $topThreeCalories = [$totals[$elfCounter[0]], $totals[$elfCounter[1]], $totals[$elfCounter[2]]];
        echo sprintf(
            "The top 3 elves are %s. They have %d calories in total.\n",
            implode(', ', $topThreeElves),
            array_sum($topThreeCalories)
        );
    }
}

$calorieCounter = new CalorieCounter();
$calorieCounter->findElfWithMostCalories();