<?php
$numbers = [];
$stdin = fopen("php://stdin", "r");
while($line = fgets($stdin)) {
  $line = str_replace("\n", "", $line);
  if($line != "" && !in_array($line, $numbers))
    $numbers[] = (int)$line;
}

$incorrectNumbers = [];

for($i = 1; $i < count($numbers)-1; $i++) {
  $n = $numbers[$i];
  $nplus = $numbers[$i+1];
  $nmin = $numbers[$i-1];
  if(!(($n > $nplus && $n > $nmin) || ($n < $nplus && $n < $nmin))) {
    echo $n . "\n";
  }
}
