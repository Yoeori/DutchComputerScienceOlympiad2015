<?php
//Stdin handler
$stdin = fopen("php://stdin", "r");
$string = "";
while($line = fgets($stdin)) {
  $line = str_replace("\n", "", $line);
  $string = $line;
}
$stringarray = [];
for($i = 0; $i < strlen($string); $i++) {
  $char = $string[$i];
  if(!in_array($char, $stringarray)) {
    $stringarray[] = $char;
  }
}
echo count($stringarray);
