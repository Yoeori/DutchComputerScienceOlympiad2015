<?php
$numbers = [];
$stdin = fopen("php://stdin", "r");
while($line = fgets($stdin)) {
  $line = str_replace("\n", "", $line);
  if($line != "" && !in_array($line, $numbers))
    $numbers[] = $line;
}

$wrong = 0;
$sum = 0;

for($i = 1; $i < $numbers[0]; $i++) {
  $best = 0;
  $one = abs(array_search($i, $numbers) - array_search($i+1, $numbers));
  $two = abs(array_search($i, $numbers) + ($numbers[0]-array_search($i+1, $numbers)));
  $three = array_search($i+1, $numbers) + ($numbers[0]-array_search($i, $numbers));
  if($one < $two && $one < $three) {
    $best = $one;
  } elseif($two < $three) {
    $best = $two;
  } else {
    $best = $three;
  }
  $sum += $best*$best;
}
echo $sum;
