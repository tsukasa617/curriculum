import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;

public class Sample5 {

    public static void main(String[] args) throws IOException {

        System.out.println("整数を入力してください");

        BufferedReader br = new BufferedReader(new InputStreamReader(System.in));

        String str = br.readLine();
        int res = Integer.parseInt(str);

        switch (res) {
            case 1:
                System.out.println("1が入力されました。");
                break;

            case 2:
                System.out.println("2が入力されました。");
                break;
                
            default:
                System.out.println("1か2を入力してください。");
                break;
        }

    }

}
