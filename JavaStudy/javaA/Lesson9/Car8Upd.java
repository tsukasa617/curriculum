public class Car8Upd {

    public static int sum = 0;

    private int num;
    private double gas;
    private String color;

    public Car8Upd() {
        num = 0;
        gas = 0.0;
        sum++;
        System.out.println("車を作成しました。");
    }

    public void setCar(int n, double g, String c) {
        num = n;
        gas = g;
        color = c;
        System.out.println("ナンバーを" + num + "にガソリンの量を" + gas + "にしました。");
        System.out.println(color + "色です");
    }

    public static void showSum() {
        System.out.println("車は全部で" + sum + "台あります。");
    }

    public void show() {
        System.out.println("車のナンバーは" + num + "です。");
        System.out.println("ガソリンの量は" + gas + "です。");
    }

}
