public class Car2 {

    private int num;
    private double gas;

    public Car2() {
        num = 0;
        gas = 0.0;
        System.out.println("車を作成しました。");
    }

    public Car2(int n, double g) {
        num = n;
        gas = g;
        System.out.println("ナンバー" + num + "にガソリンの量を" + gas + "の車を作成しました。");
    }

    public void setCar(int n, double g) {
        num = n;
        gas = g;
        System.out.println("ナンバーを" + num + "にガソリンの量を" + gas + "にしました。");
    }

    public void show() {
        System.out.println("車のナンバーは" + num + "です。");
        System.out.println("ガソリンの量は" + gas + "です。");
    }

}
