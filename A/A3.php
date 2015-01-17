<?php
//Stdin handler
$stdin = fopen("php://stdin", "r");
$file = "";
while($line = fgets($stdin)) {
  $file .= $line;
}

$file = str_replace("\n", "", $file);
$output = "";

$output .= strlen($file)."\n";

//For some weird reason when I used regex to check the number of capital letters it would return 15 every fourth time I loaded the script
$capitalLetterArray = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "W", "V", "X", "Y", "Z"];
$capitalCount = 0;
$charArray = [];
for($i = 0; $i < strlen($file); $i++) {
    $char = $file[$i];
		if(in_array($char, $capitalLetterArray))
			$capitalCount++;
		if(!in_array($char, $charArray))
			$charArray[] = $char;
}

$output .= $capitalCount."\n";
$output .= count($charArray)."\n";
$output .= strrev($file)."\n";

echo $output;