import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;

public class Lesson5B3 {

    public static void main(String[] args) throws IOException {

        System.out.println("値を入力してください");

        BufferedReader br = new BufferedReader(new InputStreamReader(System.in));

        String str = br.readLine();
        int res = Integer.parseInt(str);

        if (res >= 45) {
            System.out.println("大きい");
        } else if (res <= 25) {
            System.out.println("小さい");
        } else if (res >= 44) {
            System.out.println("少し大きい");
        } else if (res <= 26) {
            System.out.println("少し小さい");
        } else if (res == 35) {
            System.out.println("正解");
        }

    }

}
