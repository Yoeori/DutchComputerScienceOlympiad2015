<?php
function getSum($numbers) {
  $sum = 0;

  for($i = 1; $i < $numbers[0]; $i++) {
    $best = 0;
    $one = abs(array_search($i, $numbers) - array_search($i+1, $numbers));
    $two = abs(array_search($i, $numbers) + ($numbers[0]-array_search($i+1, $numbers)));
    $three = array_search($i+1, $numbers) + ($numbers[0]-array_search($i, $numbers));
    if($one < $two && $one < $three) {
      $best = $one;
    } elseif($two < $three) {
      $best = $two;
    } else {
      $best = $three;
    }
    $sum += $best*$best;
  }
  return $sum;
}
function printN($numbers) {
  $n = [(int)$numbers[0], (int)$numbers[1]];
  //print_r($n);
  //return true;
  if((int)$n[0] > (int)$n[1]) {
    echo $n[1] . " " . $n[0];
  } else {
    echo $n[0] . " " . $n[1];
  }
}

$numbers = [];
$stdin = fopen("php://stdin", "r");
while($line = fgets($stdin)) {
  $line = str_replace("\n", "", $line);
  if($line != "" && !in_array($line, $numbers))
    $numbers[] = $line;
}

$changeStack = [];
$bestResult = getSum($numbers);
for(;;) {

  $oldBestResult = $bestResult;
  $bestResultPair = [];
  for($i = 1; $i < $numbers[0]; $i++) {
    for($o = $i+1; $o < $numbers[0]; $o++) {
      if($o > $i) {
        $n1 = $numbers[$i];
        $n2 = $numbers[$o];
        $newnumbers = $numbers;
        $newnumbers[$i] = $numbers[$o];
        $newnumbers[$o] = $numbers[$i];
        $sum = getSum($newnumbers);
        if($sum > $bestResult) {
          $bestResult = $sum;
          $bestResultPair = [[$n2,$n1], [$o, $i]];
        }
      }
    }
  }


  //print_r($numbers);
  if($bestResult == $oldBestResult)
    break;
  else {
    $changeStack[] = $bestResultPair[0];

    $numbers[$bestResultPair[1][0]] = $bestResultPair[0][1];
    $numbers[$bestResultPair[1][1]] = $bestResultPair[0][0];
  }
}
for($i = 0; $i < count($changeStack); $i++) {
  printN($changeStack[$i]);
  echo "\n";
}
echo $bestResult;
