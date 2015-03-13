import java.util.ArrayList;
import java.util.Arrays;

public class AiFirstFitDecreasing {

	private int lineSize;
	private int answer = -1;
	private ArrayList<Integer> pieces;
	private ArrayList<Line> lines = new ArrayList<Line>();
	
	public AiFirstFitDecreasing(int lineWidth, int[] clothes) {
		this.lineSize = lineWidth;
		
		lines.add(new Line(this.lineSize));
		
		Arrays.sort(clothes);
		this.pieces = new ArrayList<Integer>();
		for(int i = 0; i < clothes.length; i++) {
			this.pieces.add(clothes[clothes.length-i-1]);
		}
	}
	
	public void solve() {
		//Based on the "First Fit Decreasing" algorithm
		while(!this.pieces.isEmpty()) {
			
			int piece = this.pieces.get(0);
			this.pieces.remove(0);
			
			Line bestLine = null;
			for(Line line : this.lines) {
				if(line.pieceFits(piece)) {
					bestLine = line;
					break;
				}
			}
			
			if(bestLine == null) {
				this.lines.add(new Line(this.lineSize));
				bestLine = this.lines.get(this.lines.size()-1);
			}
			
			bestLine.addPiece(piece);
			
		}
		
		this.answer = this.lines.size();
	}
	
	public int getAnswer() {
		return this.answer;
	}

}
