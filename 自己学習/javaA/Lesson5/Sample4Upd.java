import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;

public class Sample4Upd {

    public static void main(String[] args) throws IOException {

        System.out.println("整数を入力してください");

        BufferedReader br = new BufferedReader(new InputStreamReader(System.in));

        String str = br.readLine();
        int res = Integer.parseInt(str);

        if (res == 100) {
            System.out.println("100が入力されました。");
        } else if (res == 200) {
            System.out.println("200が入力されました。");
        } else {
            System.out.println("100か200を入力してください。");
        }

    }

}
