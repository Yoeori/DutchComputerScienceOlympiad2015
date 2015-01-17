public class Ai {

	private int lineSize;
	private int answer = -1;
	private int[] pieces;
	
	public Ai(int lineWidth, int[] clothes) {
		this.lineSize = lineWidth;
		this.pieces = clothes;
	}
	
	public void solve() {
		
		AiFirstFitDecreasing firstFitDecreasingSolver = new AiFirstFitDecreasing(this.lineSize, this.pieces);
		firstFitDecreasingSolver.solve();
		
		AiForce forceSolver = new AiForce(this.lineSize, this.pieces);
		forceSolver.solve();
		
		if(forceSolver.getAnswer() == -1 || forceSolver.getAnswer() > firstFitDecreasingSolver.getAnswer()) {
			this.answer = firstFitDecreasingSolver.getAnswer();
		} else {
			this.answer = forceSolver.getAnswer();
		}
		
	}
	
	public int getAnswer() {
		return this.answer;
	}

}
