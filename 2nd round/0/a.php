<?php
//Stdin handler
$stdin = fopen("php://stdin", "r");
$numbers = [];
while($line = fgets($stdin)) {
  $line = str_replace("\n", "", $line);
  if($line != "" && !in_array($line, $numbers))
    $numbers[] = $line;
}

$numbers = array_values(array_filter($numbers));
echo max($numbers) . "\n" . min($numbers) . "\n";
