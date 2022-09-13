public class Car8 {

    public static int sum = 0;

    private int num;
    private double gas;

    public Car8() {
        num = 0;
        gas = 0.0;
        sum++;
        System.out.println("車を作成しました。");
    }

    public void setCar(int n, double g) {
        num = n;
        gas = g;
        System.out.println("ナンバーを" + num + "にガソリンの量を" + gas + "にしました。");
    }

    public static void showSum() {
        System.out.println("車は全部で" + sum + "台あります。");
    }

    public void show() {
        System.out.println("車のナンバーは" + num + "です。");
        System.out.println("ガソリンの量は" + gas + "です。");
    }

}
