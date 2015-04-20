<?php

$testMode = true;

if(!$testMode) {
    $i = $testCount = 0;
    $input = '';
    while ($f = fgets(STDIN)) {
        $input .= $f;
        if ($i == 0)
            $testCount = (int)$f;
        $i++;
        if ($i == $testCount * 4)
            break;
    }
} else
    $input = "13
X.O
OO.
XXX

O.X
XX.
OOO

O.X
XXX
OOO

ooo
ooo
ooo

XXX
XXX
XXX

...
...
...

o..
...
...

ooo
xx.
xx.

ox.
...
...

xox
oxo
xox

oxo
xxx
oxo

xxx
oox
oox

xxx
xxx
ooo";

$inputLines = array_map(function($item) {
    return trim($item);
}, explode("\n", $input));
$testCount = (int)$inputLines[0];


for($i = 0; $i < $testCount; $i++) {
    $isPossible = false;

    $counters = ['x' => 0, 'o' => 0, '.' => 0];
    $field = [];
    for($j = 0; $j < 3; $j++) {
        $field[$j] = array_map('strtolower', str_split($inputLines[1 + $i * 4 + $j]));
        for($k = 0; $k < 3; $k++)
            $counters[$field[$j][$k]]++;
    }
    $isPossible = ($counters['x'] >= $counters['o'] && $counters['x'] - $counters['o'] < 2);
    if($isPossible) {
        $wins = ['x' => 0, 'o' => 0, '.' => 0];
        for($j = 0; $j < 3; $j++) {
            if($field[$j][0] == $field[$j][1] && $field[$j][0] == $field[$j][2])
                $wins[$field[$j][0]]++;
            if($field[0][$j] == $field[1][$j] && $field[0][$j] == $field[2][$j])
                $wins[$field[0][$j]]++;
        }
        if($field[0][0] == $field[1][1] && $field[0][0] == $field[2][2])
            $wins[$field[0][0]]++;
        if($field[0][2] == $field[1][1] && $field[0][2] == $field[2][0])
            $wins[$field[0][2]]++;
        $isPossible = (
            $wins['x'] <= 2 && $wins['o'] < 2
            && ($wins['x'] != $wins['o'] || $wins['o'] == 0)
        );
        if($isPossible && $wins['o'] && $counters['x'] > $counters['o'])
            $isPossible = false;
    }

    echo $isPossible ? "yes" : "no";
    if($i < $testCount - 1)
        echo "\n";
}