import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;

public class Sample7Upd {

    public static void main(String[] args) throws IOException {

        System.out.println("あなた服のサイズは何ですか？");
        System.out.println("SまたはMを入力してください。");
        
        BufferedReader br = new BufferedReader(new InputStreamReader(System.in));

        String str = br.readLine();
        char res = str.charAt(0);

        if (res == 'S' || res == 's') {
            System.out.println("あなたはSサイズですね。");
        } else if (res == 'M' || res == 'm') {
            System.out.println("あなたはMサイズですね。");
        } else {
            System.out.println("SまたはMを入力してください。");
        }

    }

}
