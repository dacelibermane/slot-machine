<?php

$board = [
    ['', '', '', '', ''],
    ['', '', '', '', ''],
    ['', '', '', '', '']
];

$combinations = [
    //Horizontal
    [[0, 0], [0, 1], [0, 2], [0, 3], [0, 4]],
    [[1, 0], [1, 1], [1, 2], [1, 3], [1, 4]],
    [[2, 0], [2, 1], [2, 2], [2, 3], [2, 4]],
    //Vertical
    [[0, 0], [1, 0], [2, 0]],
    [[0, 1], [1, 1], [2, 1]],
    [[0, 2], [1, 2], [2, 2]],
    [[0, 3], [1, 3], [2, 3]],
    [[0, 4], [1, 4], [2, 4]],
    //Combo
    [[0, 0], [1, 1], [2, 2], [1, 3], [0, 4]],
    [[0, 0], [1, 1], [2, 2], [2, 3]],
    [[0, 0], [1, 1], [2, 0]],
    [[0, 3], [1, 2], [2, 3]]
];


$symbols = ["@" => 1, 'A' => 2, 'Q' => 1, "#" => 4, "*" => 5];
$linesPayout = [3 => 1, 4 => 2, 5 => 3];
$userCoins = 0;
$creditsPerSpin = 5;


echo "\nWelcome! Cost per spin is 5 coins. \n";
$userCoins = (int)readline("Please insert money to begin the game <<<\n");

while ($userCoins < $creditsPerSpin) {
    echo "You inserted " . $userCoins . ".\n";
    $addCoins = (int)readline("\nPlease insert more coins: ");
    $userCoins += $addCoins;

    if ($userCoins === $creditsPerSpin) {
        break;
    }
}

while (true) {

    if ($userCoins <= 0) {
        exit("You gambled all your money :(");
    }
    echo "Your balance: $userCoins.\n";

    $userInput = (int)readline("\nEnter 1 to start game or 2 to quit!! ");

    if ($userInput === 2) {
        exit ("See you next time!");
    }
    if ($userInput > 2) {
        echo "Invalid input!\n";
        continue;
    }

    $userCoins -= $creditsPerSpin;

    foreach ($board as &$row) {
        foreach ($row as &$value) {
            $value = array_rand($symbols);
        }
        echo " $row[0] | $row[1] | $row[2] | $row[3] | $row[4]\n";
        echo "====================\n";
    }

    $moneyWon = 0;

    foreach ($combinations as $combination) {
        $counter = 0;
        $symbol = '';
        foreach ($combination as $position) {
            [$x, $y] = $position;
            if (!$symbol) {
                $symbol = $board[$x][$y];
            }

            if ($symbol != $board[$x][$y]) {
                break;
            }
            $counter++;
        }
        if ($counter >= 3) {
            $moneyWon += $symbols[$symbol] * ($linesPayout[$counter] + $creditsPerSpin);
            var_dump($symbols[$symbol]);
            var_dump($linesPayout[$counter] );
        }
    }

    $userCoins += $moneyWon;
    if ($moneyWon > 0) {
        echo "You won: $moneyWon\n";
    }

}



