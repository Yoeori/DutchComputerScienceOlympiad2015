<?php
$numbers = [];
$stdin = fopen("php://stdin", "r");
while($line = fgets($stdin)) {
  $line = str_replace("\n", "", $line);
  if($line != "" && !in_array($line, $numbers))
    $numbers[] = $line;
}

$wrong = 0;
$lowest = -1;

for($i = 0; $i < count($numbers) -1; $i++) {
  $n1 = $numbers[$i];
  $n2 = $numbers[$i+1];
  $dif = abs($n1 - $n2);

  if($lowest == -1 || $dif < $lowest) {
    $lowest = $dif;
  }
}
echo $lowest;
