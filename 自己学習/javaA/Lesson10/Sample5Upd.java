import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;

public class Sample5Upd {

    public static void main(String[] args) throws IOException {

        System.out.println("整数を3つ入力してください。");

        BufferedReader br = new BufferedReader(new InputStreamReader(System.in));

        String str1 = br.readLine();
        String str2 = br.readLine();
        String str3 = br.readLine();

        int num1 = Integer.parseInt(str1);
        int num2 = Integer.parseInt(str2);
        int num3 = Integer.parseInt(str3);

        int ans = Math.max(num1, Math.max(num2, num3));

        System.out.println(num1 + "と" + num2 + "と" + num3 + "のうち大きいほうは" +
                ans + "です。");

    }

}
