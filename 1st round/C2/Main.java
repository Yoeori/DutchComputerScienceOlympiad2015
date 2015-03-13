import java.util.Scanner;

public class Main {
	public static void main(String[] args) {
		boolean debug = true;
		long time = 0;
		
		Scanner scanIn = new Scanner(System.in);
		int boardSizeX = scanIn.nextInt();
		int boardSizeY = scanIn.nextInt();
		int moveAbilityX = scanIn.nextInt();
		int moveAbilityY = scanIn.nextInt();
		scanIn.close();
		
		if(debug)	time = System.currentTimeMillis();
		Ai AI = new Ai(boardSizeX, boardSizeY, moveAbilityX, moveAbilityY);
		AI.solve();
		
		System.out.println(AI.getAnswer());
		for(Position move : AI.getMoves()) {
			System.out.println(move.toString());
		}
		
		if(debug)	System.out.println("Time: " + (System.currentTimeMillis()-time) + "ms");
	}
}
