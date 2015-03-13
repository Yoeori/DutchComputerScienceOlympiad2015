import java.util.Scanner;

public class Main {
	public static void main(String[] args) {
		
		boolean debug = true;
		int lineWidth;
		int[] clothes;
		
		if(debug != true) {
			Scanner scan = new Scanner(System.in);
			
			lineWidth = scan.nextInt();
			clothes = new int[scan.nextInt()];
			for(int i = 0; i < clothes.length; i++) {
				clothes[i] = scan.nextInt();
			}
			
			scan.close();
		} else {
			lineWidth = 200;
			clothes = new int[] {10,100,70,35,140,45,77,121,17,91,83,10,100,70,35,140,45,77,121,17,91,83};
		}

		long time = System.currentTimeMillis();
		
		Ai AI = new Ai(lineWidth, clothes);
		AI.solve();
		System.out.println(AI.getAnswer());
		
		if(debug)
			System.out.println("Time: " + ((System.currentTimeMillis()-time)) + "ms");
		
	}
}
