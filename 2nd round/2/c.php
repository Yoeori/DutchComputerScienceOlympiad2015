<?php
//Stdin handler
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
for($i = 2; $i < strlen($string); $i++) {
  for($o = 0; $o < (strlen($string)-$i+1); $o++) {
    $smallstring = getChars($string, $o, $o+$i);
    if($smallstring == invert($smallstring)) {
      if(!in_array($smallstring, $palindromen)) {
        $palindromen[] = $smallstring;
      }
    }
  }
}

echo count($palindromen);
