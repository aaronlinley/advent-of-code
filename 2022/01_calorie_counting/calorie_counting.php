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

        $mostCalories = max($totals);
        $elfWithMostCalories = array_search($mostCalories, $totals);
        echo sprintf(
            "The elf with the most calories is %d. They have %d calories available.\n",
            $elfWithMostCalories + 1,
            $totals[$elfWithMostCalories]
        );
    }
}

$calorieCounter = new CalorieCounter();
$calorieCounter->findElfWithMostCalories();