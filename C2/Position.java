public class Position {

	private int x = 2;
	private int y = 2;
	private char[] alphabet = {'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'};
	private static String alphabet_string = "abcdefghij";
	private int[] size = new int[] {10, 9};
	
	public Position(int newx, int newy, int[] boardsize) {
		this.size = boardsize;
		this.setPosition(newx, newy);
	}

	public Position(char newx, int newy, int[] boardsize) {
		this(Position.alphabet_string.indexOf(newx)+1, newy, boardsize);
	}
	
	public Position(String newposition, int[] boardsize) {
		this(Position.alphabet_string.indexOf(newposition.charAt(0))+1, Integer.parseInt(newposition.substring(1)), boardsize);
	}
	
	public Position(String newposition, Board board) {
		this(newposition, board.getBoardSize());
	}

	public Position(String newposition) {
		this(newposition, Board.getInstance().getBoardSize());
	}
	
	public boolean isValidMove(int deltax, int deltay) {
		return this.isValidPosition(this.x + deltax, this.y + deltay);
	}
	
	public boolean isValidPosition(int newx, int newy) {
		return newx >= 1 && newx <= this.size[0] && newy <= this.size[1] && newy >= 1;
	}
	
	public boolean move(int deltax, int deltay) {
		
		if(!isValidMove(deltax, deltay)) {
			return false;
		}
		
		this.x += deltax;
		this.y += deltay;
		
		return true;
	}
	
	public boolean setPosition(int newx, int newy) {
		
		if(!this.isValidPosition(newx, newy)) {
			return false;
		}
		
		this.x = newx;
		this.y = newy;
		
		return true;
	}
	
	public boolean setPosition(char newx, int newy) {
		return this.setPosition(Position.alphabet_string.indexOf(newx)+1, newy);
	}
	
	public boolean setPosition(String newposition) {
		return this.setPosition(newposition.charAt(0), Character.getNumericValue(newposition.charAt(1)));
	}
	
	public int[] getPositionAsArray() {
		return new int[] {this.x, this.y};
	}
	
	public String toString() {
		return String.valueOf(this.alphabet[this.x-1]) + String.valueOf(this.y);
	}
	
	public Position clone(){
		return new Position(this.toString(), this.size);
	}

}
