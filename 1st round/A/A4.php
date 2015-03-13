<?php
//Stdin handler
$stdin = fopen("php://stdin", "r");
$file = "";
while($line = fgets($stdin)) {
  $file .= $line;
}

$file = str_replace("\r", "", $file);
$file = explode("\n", $file);

function twoInARow($content, $type) {
	if($type == 0) {
		return ($content == "0010" || $content == "0011" || $content == "1001" || $content == "1100" || $content == "0100") ? 1 : 0;
	} else {
		return ($content == "1101" || $content == "1100" || $content == "0110" || $content == "0011" || $content == "1011") ? 1 : 0;
	}
}

function threeInARow($content, $type) {
	if($type == 0) {
		return ($content == "1000" || $content == "0001") ? 1 : 0;
	} else {
		return ($content == "1110" || $content == "0111") ? 1 : 0;
	}
}

function fourInARow($content, $type) {
	if($type == 0) {
		return ($content == "0000") ? 1 : 0;
	} else {
		return ($content == "1111") ? 1 : 0;
	}
}

$rows = [];

foreach($file as $line) {
	$rows[] = $line;
}

for($i = 0; $i < 4; $i++) {
	$rows[] = $file[0][$i] . $file[1][$i] . $file[2][$i] . $file[3][$i];
}

$inARows = [2 => [0, 0], 3 => [0, 0], 4 => [0, 0]];
foreach($rows as $row) {
	$inARows[2][0] += twoInARow($row, 0);
	$inARows[3][0] += threeInARow($row, 0);
	$inARows[4][0] += fourInARow($row, 0);
	
	$inARows[2][1] += twoInARow($row, 1);
	$inARows[3][1] += threeInARow($row, 1);
	$inARows[4][1] += fourInARow($row, 1);
}

foreach($inARows as $inARow) {
	echo $inARow[0] . " " . $inARow[1] . "\n";
}
