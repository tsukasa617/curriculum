import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;

public class  Lesson5B2 {

    public static void main(String[] args) throws IOException {

        System.out.println("年を入力してください");
        
        BufferedReader br = new BufferedReader(new InputStreamReader(System.in));

        String str = br.readLine();
        int res = Integer.parseInt(str);

        if(res % 4 != 0){
            System.out.println(res + "年はうるう年ではありません");
        }else if(res % 100 != 0){
            System.out.println(res + "年はうるう年です");
        }else if(res % 400 != 0){
            System.out.println(res + "年はうるう年ではありません");
        }else{
            System.out.println(res + "年はうるう年です");
        }
 
    }

}
