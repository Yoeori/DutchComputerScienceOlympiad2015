<?php
$numbers = [];
$stdin = fopen("php://stdin", "r");
while($line = fgets($stdin)) {
  $line = str_replace("\n", "", $line);
  if($line != "" && !in_array($line, $numbers))
    $numbers[] = $line;
}
$break = $numbers[0] / 2;
$wrong = 0;
$wrongs = [];
for($i = 0; $i < count($numbers) -1; $i++) {
  $n1 = $numbers[$i];
  $n2 = $numbers[$i+1];
  if((
    ($n1 <= $break && $n2 <= $break) ||
    ($n1 >= $break+1 && $n2 >= $break+1)
  )) {
    $wrong++;
    $wrongs[] = [$n1, $n2];
  }
}
echo $wrong;
//print_r($wrongs);
