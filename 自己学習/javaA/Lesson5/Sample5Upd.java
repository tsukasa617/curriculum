import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;

public class Sample5Upd {

    public static void main(String[] args) throws IOException {

        System.out.println("整数を入力してください");

        BufferedReader br = new BufferedReader(new InputStreamReader(System.in));

        String str = br.readLine();
        int res = Integer.parseInt(str);

        switch (res) {
            case 100:
                System.out.println("100が入力されました。");
                break;

            case 200:
                System.out.println("200が入力されました。");
                break;
                
            default:
                System.out.println("100か200を入力してください。");
                break;
        }

    }

}
