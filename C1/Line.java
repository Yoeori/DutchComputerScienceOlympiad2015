import java.util.ArrayList;

public class Line {
	
	protected int lineSize;
	protected int currentFullness = 0;
	protected ArrayList<Integer> pieces = new ArrayList<Integer>();
	
	public Line(int lineSize) {
		this.lineSize = lineSize;
	}
	
	public boolean addPiece(int piece) {
		if(!pieceFits(piece))
			return false;
		
		this.currentFullness += piece;
		this.pieces.add(piece);
		
		return true;
	}
	
	public boolean removePiece(int piece) {
		pieces.remove((Integer) piece);
		this.currentFullness -= piece;
		
		return true;
	}
	
	public boolean pieceFits(int piecesize) {
		return (this.lineSize-this.currentFullness) >= piecesize;
	}
	
	public int numberOfPieces() {
		return this.pieces.size();
	}
	
	public Line copy() {
		Line newLine = new Line(this.lineSize);
		newLine.currentFullness = this.currentFullness;
		newLine.pieces = new ArrayList<Integer>(this.pieces);
		return newLine;
	}
}
