<?php
$numbers = [];
$stdin = fopen("php://stdin", "r");
while($line = fgets($stdin)) {
  $line = str_replace("\n", "", $line);
  if($line != "" && !in_array($line, $numbers))
    $numbers[] = $line;
}
$wrong = 0;
for($i = 0; $i < count($numbers); $i++) {
  $n1 = $numbers[$i];
  $n2 = $numbers[$i+1];
  if(!(
    ($n1 % 2 == 0 && $n2 % 2 == 1) ||
    ($n1 % 2 == 1 && $n2 % 2 == 0)
  )) {
    $wrong++;
  }
}
echo $wrong;
