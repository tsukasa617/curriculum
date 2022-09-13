import java.util.Arrays;
import java.util.Random;

public class Lesson7B3 {
    public static void main(String[] args) throws Exception {

        int[] array = new int[100];
        Random random = new Random();   

        for (int i=0; i < 100; i++) {
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

        for (int i = 0; i < 100; i++) {
            System.out.printf("%3d ",array[i]);
            if ((i + 1) % 10 == 0) {
                System.out.println();
            }
        }

    }
}