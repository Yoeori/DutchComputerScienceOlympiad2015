<?php
//Stdin handler
$stdin = fopen("php://stdin", "r");
$file = "";
while($line = fgets($stdin)) {
  $file .= $line;
}

$file = str_replace("\r", "", $file);
$numberOfCandidates = null;
$votes = [];
$lostCandidates = [];

$line = 1;
foreach(explode("\n", $file) as $inputRow) {
	if($line == 1) {
		$numberOfCandidates = $inputRow;
	} elseif($inputRow != "" && $line != 2) {
		$votes[] = $inputRow;
	}
	
	$line++;
}

$votes = array_map(function($votes) {
	return array_map(function($vote) {
		return intval($vote);
	}, explode(" ", $votes));
}, $votes);

function isThereAWinner($scores) {

	$numberOfVotes = 0;
	foreach($scores as $score) {
		$numberOfVotes += $score;
	}
	
	foreach($scores as $scorer => $score) {
		if($score > $numberOfVotes/2)
			return $scorer;
	}
	
	return 0;
}

function getLoser($scores) {
	$lowestValue = -1;
	$lowestKey = 0;
	foreach($scores as $candidate=>$votes) {
		if(($votes <= $lowestValue || $lowestValue == -1) && $candidate > $lowestKey) {
			$lowestKey = $candidate;
			$lowestValue = $votes;
		}
	}
	return $lowestKey;
}

while(true) {
	
	$scores = [];
	
	for($i = 1; $i <= $numberOfCandidates; $i++) {
		if(!in_array($i, $lostCandidates))
			$scores[$i] = 0;
	}
	
	foreach($votes as $voterVotes) {
		if(!isset($scores[$voterVotes[0]]))
			$scores[$voterVotes[0]] = 0;
		$scores[$voterVotes[0]]++;
	}
	
	if($winner = isThereAWinner($scores)) {
		echo $winner;
		exit;
	}
	
	$loser = getLoser($scores);
	$lostCandidates[] = $loser;
	
	$votes = array_map(function($voterVotes){
		return array_values(array_filter($voterVotes, function($vote) {
			global $loser;
			return $loser!=$vote;
		}));
	}, $votes);
}

?>