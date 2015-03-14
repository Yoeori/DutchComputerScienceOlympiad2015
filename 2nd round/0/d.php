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

function check($num) {
  global $current;
  if(is_int($num / 2015)) {
    echo $current . "\n";
    exit();
  }
}
$current = 0;
$total = 0;
for($i = 0; $i < $aanloop_length; $i++) {
  $current++;
  $total += $nums[$i];
  $array[] = $total;
  check($total);
}

for($i = 0; $i < 100000000; $i++) {
  $current++;
  $total += $loop_numbers[$i % $loop_length];
  check($total);
}

echo 0 . "\n";

exit();
