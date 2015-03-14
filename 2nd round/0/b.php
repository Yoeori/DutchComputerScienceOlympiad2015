<?php
//Stdin handler
$stdin = fopen("php://stdin", "r");
$numbers = [];
while($line = fgets($stdin)) {
  $line = str_replace("\n", "", $line);
  if($line != "")
    $numbers[] = $line;
}

$numbers = array_values(array_filter($numbers));

$nums = [];
foreach($numbers as $number) {
  if(in_array($number, $nums)) {
    $key = array_search($number, $numbers);
    echo $key . "\n" . (count($nums) - $key) . "\n";
    break;
  }
  $nums[] = $number;
}
