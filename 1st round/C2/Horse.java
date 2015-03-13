import java.util.ArrayList;

public class Horse {
	
	private Position position;
	private Board board;
	private int[] moveabalitiy;
	private ArrayList<String> positionBlacklist = new ArrayList<String>();
	private ArrayList<Position> positionHistory = new ArrayList<Position>();

	public Horse(Position position, int[] moveAbility, Board board) {
		
		this.moveabalitiy = moveAbility;
		this.board = board;
		
		this.setPosition(position);
	}
	
	public Horse(Position position, Board board, int[] moveability, ArrayList<String> positionBlacklist, ArrayList<Position> positionHistory) {
		this.position = position;
		this.board = board;
		this.moveabalitiy = moveability;
		this.positionBlacklist = positionBlacklist;
		this.positionHistory = positionHistory;
	}
	
	public Horse(Position position, int[] moveAbility) {
		this(position, moveAbility, Board.getInstance());
	}
	
	public Position getPosition() {
		return this.position;
	}

	public ArrayList<Position> getPositionHistory() {
		return this.positionHistory;
	}
	
	public int[] getMoveAbility() {
		return this.moveabalitiy;
	}

	public ArrayList<Position> getPossibleMoves() {
		int[] moveability = this.getMoveAbility();
		ArrayList<Position> possibleMoves = new ArrayList<Position>();
		ArrayList<String> possibleMovesAsString = new ArrayList<String>();
		
		for(int i = 0; i < 8; i++) {
			Position newPosition = this.getPosition().clone();
			if(newPosition.move(
				(i == 2 || i == 3 || i == 5 || i == 7 ? -1 : 1) * moveability[i >= 4 ? 1 : 0],
				(i == 1 || i == 3 || i == 6 || i == 7 ? -1 : 1) * moveability[i >= 4 ? 0 : 1])) 
			{
				if(!possibleMovesAsString.contains(newPosition.toString()) && !this.positionBlacklist.contains(newPosition.toString())) {
					possibleMoves.add(newPosition);
					possibleMovesAsString.add(newPosition.toString());
				}
			}
		}
		
		return possibleMoves;
	}

	public void setPosition(Position position) {
		if(!this.positionBlacklist.contains(position.toString())) {
			this.position = position;
			this.positionHistory.add(position);
			this.positionBlacklist.add(position.toString());
		}
	}
	
	public void setPosition(String position) {
		this.setPosition(new Position(position, this.board));
	}
	
	public void setPosition(int[] position) {
		this.setPosition(new Position(position[0], position[1], this.board.getBoardSize()));
	}

	public Horse clone(){  
	    return new Horse(this.position, this.board, this.moveabalitiy, new ArrayList<String>(this.positionBlacklist), new ArrayList<Position>(this.positionHistory));
	}
	
}
