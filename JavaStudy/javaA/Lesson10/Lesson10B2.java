import java.util.Scanner;

public class Lesson10B2 {

    public static void main(String[] args) {

        Scanner scanner = new Scanner(System.in);

        System.out.print("名前： ");

        String name = scanner.next();

        System.out.println("入力した文章は" + name + "です。");

        StringBuilder strb = new StringBuilder(name);
        name = strb.reverse().toString();
        System.out.println("入力した文章を逆から読むと" + " " + name);

    }
}
