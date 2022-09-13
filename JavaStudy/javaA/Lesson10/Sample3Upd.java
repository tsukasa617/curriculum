import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;

public class Sample3Upd {

    public static void main(String[] args) throws IOException {

        System.out.println("文字列を入力してください。");

        BufferedReader br = new BufferedReader(new InputStreamReader(System.in));

        String str1 = br.readLine();

        System.out.println("検索文字を入力してください。");

        String str2 = br.readLine();
        char ch = str2.charAt(0);

        int num = str1.indexOf(ch);

        if (num != -1)
            System.out.println(str1 + "の" + (num + 1) + "番目に「" + ch + "」がみつかりました。");
        else
            System.out.println(str1 + "の" + (num + 1) + "番目に「" + ch + "」はありません。");

        System.out.println("追加する文字を入力してください。");

        String str3 = br.readLine();
        StringBuffer sb = new StringBuffer(str1);
        sb.append(str3);

        System.out.println(str1 + "に" + str3 + "を追加すると" + sb + "です。");

    }

}
