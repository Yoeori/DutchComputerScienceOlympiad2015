import java.util.ArrayList;

public class Ai {

	private int[] moveAbility = new int[2];
	private int[] boardSize = new int[2];
	private int	biggestAnswer = -1;
	private ArrayList<Horse> horseToSolve = new ArrayList<Horse>();
	private Horse answerHorse;
	private long startTime;
	
	public Ai(int boardSizeX, int boardSizeY, int moveAbilityX, int moveAbilityY) {
		this.moveAbility[0] = moveAbilityX;
		this.moveAbility[1] = moveAbilityY;
		this.boardSize[0] = boardSizeX;
		this.boardSize[1] = boardSizeY;
		this.startTime = System.currentTimeMillis();
		new Board(boardSize[0], boardSize[1]);
	}

	public void solve() {
		Horse startHorse = new Horse(new Position("a" + this.boardSize[1]), this.moveAbility);
		this.horseToSolve.add(startHorse);
		while(!this.horseToSolve.isEmpty() && (System.currentTimeMillis()-startTime) < 1500) {
			this.solver();
		}
	}
	
	private void solver() {
		Horse horse = this.horseToSolve.get(this.horseToSolve.size()-1);
		this.horseToSolve.remove(this.horseToSolve.size()-1);
		
		ArrayList<Position> possibilities = horse.getPossibleMoves();
		
		if(possibilities.isEmpty()) {
			int historyCount = horse.getPositionHistory().size();
			if(historyCount > this.biggestAnswer || this.biggestAnswer == -1) {
				this.biggestAnswer = historyCount;
				this.answerHorse = horse;
				if(historyCount == this.boardSize[0] * this.boardSize[1]) {
					this.horseToSolve.clear();
				}
			}
		} else {
			for(Position possibiltie : possibilities) {
				Horse clone = horse.clone();
				clone.setPosition(possibiltie);
				this.horseToSolve.add(clone);
			}
		}
	}
	
	public int getAnswer() {
		return this.biggestAnswer;
	}
	
	public ArrayList<Position> getMoves() {
		return this.answerHorse.getPositionHistory();
	}

}
