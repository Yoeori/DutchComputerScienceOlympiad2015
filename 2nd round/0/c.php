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
$aanloop_length = 0;
$loop_length = 0;
$loop_numbers = [];

foreach($numbers as $number) {
  if(in_array($number, $nums)) {
    $aanloop_length = array_search($number, $numbers);
    $loop_length = (count($nums) - $aanloop_length);
    for($i = 0; $i < $loop_length; $i++) {
      $loop_numbers[] = $nums[$aanloop_length+$i];
    }
    break;
  }
  $nums[] = $number;
}

echo $loop_numbers[(2015 - $aanloop_length) % $loop_length - 1] . "\n";
