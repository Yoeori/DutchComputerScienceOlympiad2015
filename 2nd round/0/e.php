<?php
function check($num) {
  global $current;
  if(is_int($num / 2015)) {
    return true;
  }
  return false;
}

function isdevisibleby2015($numbers) {

	$numbers = array_values(array_filter($numbers));

	$nums = [];
	$aanloop_length = 0;
	$loop_length = 0;
	$loop_numbers = [];

	foreach($numbers as $number) {
	  if(in_array($number, $nums)) {
	    $aanloop_length = array_search($number, $numbers);
	    $loop_length = (count($nums) - $aanloop_length);
	    for($i = 0; $i < $loop_length; $i++) {
	      $loop_numbers[] = $nums[$aanloop_length+$i];
	    }
	    break;
	  }
	  $nums[] = $number;
	}


	$array = [];
	$current = 0;
	$total = 0;
	for($i = 0; $i < $aanloop_length; $i++) {
	  $current++;
	  $total += $nums[$i];
	  $array[] = $total;
	  if(check($total)) return true;
	}

	for($i = 0; $i < 100000; $i++) {
	  $current++;
	  $total += $loop_numbers[$i % $loop_length];
	  $array[] = $total;
	  if(check($total)) return true;
	}

	return false;
}

for($i = 1; $i < 300; $i++) {
	for($o = 1; $o < 100; $o++) {
    for($j = 0; $j < 100; $j++) {
      if($i != $o && $i != $j && $o != $j && !isdevisibleby2015([$i, $o, $i])) {
        print_r([$i, $o, $j, $i]);
        exit();
      }
    }
	}
}
