
public class Board {

	private static Board instance;
	private int[] boardsize;
	
	Board(int[] boardsize) {
		this.boardsize = boardsize;
		Board.instance = this;
	}
	
	public Board(int x, int y) {
		this(new int[] {x, y});
	}

	public static Board getInstance() {
		return Board.instance;
	}
	
	public int[] getBoardSize() {
		return this.boardsize;
	}
	
}
