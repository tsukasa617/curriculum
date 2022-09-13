import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;

public class Lesson6B3 {

    public static void main(String[] args) throws IOException {

        System.out.println("値を入力してください");

        BufferedReader br = new BufferedReader(new InputStreamReader(System.in));

        String str = br.readLine();
        int res = Integer.parseInt(str);

        if (1 <= res && res <= 20) {
            for (int i = 1; i <= res && i <= 20; i++) {
                System.out.println("Hello!");
            }
        } else if (res == 0 || res >= 21) {
            System.out.println("数字は1～20の間で入力してください。");
        }

    }

}
