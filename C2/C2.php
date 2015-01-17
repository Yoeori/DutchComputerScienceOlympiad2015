<?php

class Position {

  private $x;
  private $y;

  private $alphabet = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j"];
  private $size = [10, 9];

  public function __construct($x, $y = 1, $boardsize = []) {

    if(strlen($x) == 2) {
      if((is_array($y) && count($y) == 2) || $y instanceof Board)
        $boardsize = $y;
      $y = intval($x[1]);
      $x = $x[0];
    }

    if($boardsize instanceof Board) {
      $boardsize = $boardsize->getBoardSize();
    }
    
     $this->size = $boardsize;
     $this->alphabet = array_slice($this->alphabet, 0, $this->size[0]);

    if(!in_array($x, $this->alphabet))
      $x = "a";

    if(!is_int($y) || $y > $this->size[1] || $y < 1)
      $y = 1;

    $this->x = $x;
    $this->y = $y;
  }

  public function isValidMove($deltax, $deltay) {
    $newx = array_search($this->x, $this->alphabet) + $deltax;
    $newy = $this->y + $deltay;
    return isset($this->alphabet[$newx]) && is_int($newy) && $newy <= $this->size[1] && $newy >= 1;
  }

  public function move($deltax, $deltay) {
    if(!$this->isValidMove($deltax, $deltay))
      return false;

    $this->x = $this->alphabet[array_search($this->x, $this->alphabet) + $deltax];
    $this->y = $this->y + $deltay;
    return true;
  }

  public function __toString() {
    return $this->x.$this->y;
  }
}

class Horse {

  private $position;
  private $board;
  private $moveability = [];
  private $positionHistory = [];
  private $positionBlackList = [];

  public function __construct($position, $moveability = [], $board = "") {

    if($board instanceof Board)
      $this->board = $board;
    else
      $this->board = Board::getInstance();

    if(is_array($moveability) && count($moveability) == 2 && is_int($moveability[0]) && is_int($moveability[1]))
      $this->moveability = $moveability;
    else
      $this->moveability = [1, 1];

    $this->setPosition($position);

    $this->moveability = $moveability;
    $this->board = $board;
  }

  public function getPosition() {
    return $this->position;
  }

  public function getPositionHistory() {
    return $this->positionHistory;
  }

  public function getMoveability() {
    return $this->moveability;
  }

  public function getPossibleMoves() {
    $position = $this->getPosition();
    $moveablility = $this->getMoveability();
    $possibleMoves =  [];
    $possibleMovesAsString = [];

    for($i = 0; $i < 8; $i++) {
      $newPosition = clone $position;
      if($newPosition->move(
        ($i == 2 || $i == 3 || $i == 5 || $i == 7 ? -1 : 1) * $moveablility[$i >= 4 ? 1 : 0],
        ($i == 1 || $i == 3 || $i == 6 || $i == 7 ? -1 : 1) * $moveablility[$i >= 4 ? 0 : 1])
      ) {
        if(!in_array((string) $newPosition, $possibleMovesAsString) && !in_array((string) $newPosition, $this->positionBlackList)) {
          $possibleMoves[] = $newPosition;
          $possibleMovesAsString[] = (string) $newPosition;
        }
      }
    }
    return $possibleMoves;
  }

  public function setPosition($newposition) {
    if($newposition instanceof Position)
      $newposition = $newposition;
    elseif(is_array($newposition) && count($newposition) == 2 && is_int($newposition[0]) && is_int($newposition[1]))
      $newposition = new Position($newposition[0], $newposition[1], $this->board->getBoardSize());
    else
      $newposition = new Position("a1", $this->board->getBoardSize());
    $this->position = $newposition;
    $this->positionBlackList[] = (string) $newposition;
    $this->positionHistory[] = $newposition;
  }

}

class Board {

  private static $instance;
  private $boardsize =  [10, 2];

  private function __construct($args /* $size */) {

    $boardsize = isset($args[0]) ? $args[0] : [10, 2];

    if(count($boardsize) == 2 && is_int($boardsize[0]) && is_int($boardsize[1]))
      $this->boardsize = $boardsize;
  }

  public function getBoardSize() {
    return $this->boardsize;
  }

  public static function getInstance() {
    if(!isset(self::$instance))
      self::$instance = new self(func_get_args());
    return self::$instance;
  }

}

class AI {

  private $boardsize = [];
  private $moveability = [];
  private $biggestAnswer = -1;
  private $answerHorse;

  public function __construct($boardsize, $moveability) {
  
    $this->boardsize = $boardsize;
    $this->moveability = $moveability;
    Board::getInstance($this->boardsize);
  }

  public function solve() {
    $startHorse = new Horse(new Position("a", $this->boardsize[1], Board::getInstance()), $this->moveability);
    $this->horseSolver($startHorse);
  }

  private function horseSolver($horse) {
    $possibilities = $horse->getPossibleMoves();

    // This horse is done, check if best possibliltie
    if(count($possibilities) == 0) {
      $historyCount = count($horse->getPositionHistory());
      if($historyCount > $this->biggestAnswer || $this->biggestAnswer == -1) {
        $this->biggestAnswer = $historyCount;
        $this->answerHorse = $horse;
      }
      return;
    }

    foreach($possibilities as $possiblilitie) {
      $clonedHorse = clone $horse;
      $clonedHorse->setPosition($possiblilitie);
      $this->horseSolver($clonedHorse);
    }
  }

  public function getAnswer() {
    return $this->biggestAnswer;
  }

  /* Returns array with all moves as an instance of Position */
  public function getMoves() {
    return $this->answerHorse->getPositionHistory();
  }

}

$stdin = fopen("php://stdin", "r");
$file = "";
while($line = fgets($stdin)) {
  $file .= $line;
}

$file = str_replace("\r", "", $file);
$file = explode("\n", $file);
$file = array_map(function($line) {
  return array_map(function($value) {
    return intval($value);
  }, explode(" ", $line));
}, $file);

$c2ai = new AI([$file[0][0], $file[0][1]], [$file[1][0], $file[1][1]]);
$c2ai->solve();

echo $c2ai->getAnswer()."\n";
foreach($c2ai->getMoves() as $move) {
  echo $move."\n";
}
