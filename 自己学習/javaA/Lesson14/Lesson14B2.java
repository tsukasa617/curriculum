import java.util.Scanner;

public class Lesson14B2 {
    
    public static void main(String[] args){

        Scanner scanner = new Scanner(System.in);
    
        System.out.println("二つの整数を入力してください");
        int num1 = scanner.nextInt();
        int num2 = scanner.nextInt();

        int num3 = num1 /num2 ;
        int num4 = num1 % num2;

        try {

            String s = String.valueOf(i);
    
        } catch (NumberFormatException e) {
            System.out.println("数字以外が入力されました。");
        } 

System.out.println(num1 + "÷" + num2 + "の商は、" + num3 + "余りは" + num4 + "です。");

    }
}
