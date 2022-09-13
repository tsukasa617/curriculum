import java.io.IOException;
import java.util.ArrayList;
import java.util.Scanner;

public class Lesson14B1 {

	public static void main(String[] args) throws IOException {

	    System.out.print("数字を入力してください : ");
	 
        Scanner sc = new Scanner(System.in);
        String[] array = sc.nextLine().split(" ", 0);
		ArrayList<Integer> numbers = new ArrayList<Integer>();
	 
        for(int i = 0; i < array.length ; i++){
        	numbers.add(Integer.parseInt(array[i]));
        }
		
		int listSize = numbers.size();
		
		//並び変える
		for(int i = 0; i < (listSize - 1); i++) {
			for(int j =0; j < (listSize - 1- i); j++) {
				if(numbers.get(j) < numbers.get(j + 1)) {
					int alt = numbers.get(j);
					numbers.set(j, numbers.get(j+1));
					numbers.set(j+1, alt);
				}				
			}			
		}
		
		try {

            String s = String.valueOf(i);
    
        } catch (NumberFormatException e) {
            System.out.println("数字以外が入力されました。");
        } 

		System.out.println("\n最大値：" + numbers.get(0) +"\n"
			+ "最小値：" + numbers.get(listSize - 1));
	}
}
