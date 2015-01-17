<?php
//Stdin handler
$stdin = fopen("php://stdin", "r");
$file = "";
while($line = fgets($stdin)) {
  $file .= $line;
}

$file = intval($file);
$output = "";

$width = $file*2-1;
for($c = 0; $c < $file; $c++) {
	$numberOfDashes = ($width-1)/2-$c;
	
	for($i = 0; $i < $numberOfDashes; $i++) {
		$output .= "-";
	}
	
	for($i = 0; $i < $width-($numberOfDashes*2); $i++) {
		$output .= "*";
	}
	
	for($i = 0; $i < $numberOfDashes; $i++) {
		$output .= "-";
	}
	$output .= "\n";
}

for($i = 0; $i<$width; $i++) {
	$output .=	($i == ($width-1)/2 ? "*" : "-");
}
$output .= "\n";

echo $output;
exit;