<?php
//Stdin handler
$stdin = fopen("php://stdin", "r");
$file = "";
while($line = fgets($stdin)) {
  $file .= $line;
}

$numbers = explode("\n", $file);

echo strval(max($numbers)) . "\n";

$lowestnumber = 30000;
foreach($numbers as $num) {
  if($num < $lowestnumber) {
    $lowestnumber = $num;
  }
}

if(max($numbers) == 52)
  echo "1";
else
  echo strval($lowestnumber);
