public class Sample5Upd {

    public static void main(String[] args) {

        int a = 1;
        int b = 0;

        b = a++;

        System.out.println("代入後にインクリメントしたのでbの値は" + b + "です。");

        b = ++a;

        System.out.println("代入後にインクリメントしたのでbの値は" + b + "です。");

    }
    
}
