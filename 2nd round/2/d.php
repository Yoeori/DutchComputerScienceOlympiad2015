<?php
//Stdin handler
$alphabet = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","W","V","X","Y","Z"];

$stdin = fopen("php://stdin", "r");
$string = "";
while($line = fgets($stdin)) {
  $line = str_replace("\n", "", $line);
  $string = $line;
}
function invert($string) {
  $inversed = "";
  for($i = strlen($string)-1; $i >= 0; $i--) {
    $inversed .= $string[$i];
  }
  return $inversed;
}
function getChars($string, $start, $end) {
  $return = "";
  for($i = $start; $i < $end; $i++) {
    $return .= $string[$i];
  }
  return $return;
}

$palindromen = [];

$score = 0;
$left = getChars($string, 0, strlen($string)/2);
$right = invert(getChars($string, strlen($string)/2, strlen($string)));

//8
for($i = 0; $i < strlen($left); $i++) {
  $char1 = $left[$i];
  $char2 = $right[$i];
  if($char1 != $char2) {
    $score += abs(array_search($char1, $alphabet) - array_search($char2, $alphabet));
  }
}

echo (8 + $score);
