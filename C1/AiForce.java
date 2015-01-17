import java.util.ArrayList;
import java.util.List;

public class AiForce {
	
	private ArrayList<Line> lines = new ArrayList<Line>();
	private List<Integer> pieces;
	private int answer = -1;
	private long startTime;
	
	public AiForce(int lineWidth, int[] clothes) {
		
		this.pieces = new ArrayList<Integer>();
		for(int i = 0; i < clothes.length; i++) {
			this.pieces.add(clothes[clothes.length-i-1]);
			this.lines.add(new Line(lineWidth));
		}
		
	}
	
	public int getAnswer() {
		return this.answer;
	}
	
	public void solve() {
		this.startTime = System.currentTimeMillis();
		this.solver(this.pieces, 0);
	}
	
	public void solver(List<Integer> pieces, int currentPosition) {
		
		if (currentPosition >= pieces.size()) {
            int filledLines = this.getFilledNumberOfLines();
            
            if (filledLines < this.answer || this.answer == -1) {
            	this.answer = filledLines;
            }
            
            return;
        }
        
        Integer currentItem = pieces.get(currentPosition);
        for (Line line : this.lines) {
        	if((System.currentTimeMillis()-this.startTime) > 20000) {
        		break;
        	}
        	
            if (line.addPiece(currentItem)) {
                this.solver(pieces, currentPosition + 1);
                line.removePiece(currentItem);
            }
        }
		
	}
	
	private int getFilledNumberOfLines() {
        int lines = 0;
        for (Line line : this.lines) {
            if (line.numberOfPieces() != 0) {
            	lines++;
            }
        }
        return lines;
    }
	
	public List<Line> copyLines(List<Line> lines) {
		
        ArrayList<Line> copy = new ArrayList<Line>();
        
        for (int i = 0; i < lines.size(); i++) {
            copy.add(lines.get(i).copy());
        }
        
        return copy;
    }

}
