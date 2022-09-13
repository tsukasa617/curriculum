import java.util.Arrays;
import java.util.Random;

public class Lesson7B4 {
    public static void main(String[] args) throws Exception {

        int[] array = new int[100];
        Random random = new Random();

        for (int i = 0; i < 100; i++) {
            array[i] = random.nextInt(999)+1; 
        }

        System.out.println("ソート前");

        for (int i = 0; i < 100; i++) {
            System.out.printf("%3d ",array[i]);
            if ((i + 1) % 10 == 0) {
                System.out.println();
            }
        }

        Arrays.sort(array);

        System.out.println("ソート後");

        for(int i=0; i < array.length-1; i++) {
            for(int ii=0; ii < array.length-i-1; ii++) {
            	if(array[ii] < array[ii+1]) {
            		int tmp = array[ii];
            		array[ii] = array[ii+1];
            		array[ii+1] = tmp;
            	}
            }
        }
        
        for(int i = 0; i < array.length; i++) {
        	System.out.print(array[i] + " ");
            if ((i + 1) % 10 == 0) {
                System.out.println();
            }
        }

    }
}