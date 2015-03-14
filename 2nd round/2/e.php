<?php
//Stdin handler
$alphabet = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","W","V","X","Y","Z"];

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

$stdin = fopen("php://stdin", "r");
$string = "";
while($line = fgets($stdin)) {
  $line = str_replace("\n", "", $line);
  $string = $line;
}

function solver($text, $cost = 0) {
  global $alphabet;

  //check for palindromen longer than 3 and


  // look for almost palidromes and make them a palidrom


  //

}

function getPalindromes($string, $minlength = 2) {
  if($minlength > strlen($string))
    return [];

  $palindromes = [];
  for($i = $minlength; $i < strlen($string); $i++) {
    for($o = 0; $o < (strlen($string)-$i+1); $o++) {
      $smallstring = getChars($string, $o, $o+$i);
      if($smallstring == invert($smallstring)) {
        $palindromes[] = [$o, $i];
      }
    }
  }

  usort($palindromes, function($a, $b) {
    if($a[1] == $b[1])
      return false;

    return $a[1] > $b[1] ? -1 : 1;
  });

  return $palindromes;
}

print_r()
