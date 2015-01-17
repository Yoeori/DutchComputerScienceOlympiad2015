<?php
//Stdin handler
$stdin = fopen("php://stdin", "r");
$file = "";
while($line = fgets($stdin)) {
  $file .= $line;
}

$output = 0;
$line = strtok($file, "\r\n");
while ($line !== false) {
    $number = floatval($line);
		if($number == 0) {
			break;
		}
		
		if($number & 1 && intval($number) == $number) {
			$output += $number*$number;
		}
    $line = strtok("\r\n");
}
echo $output."\n";