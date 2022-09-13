public class Car4Upd {

    protected int num;
    protected double gas;
    protected String color;

    public Car4Upd() {
        num = 0;
        gas = 0.0;
        color = "赤";
        System.out.println("車を作成しました。");
    }

    public void setCar(int n, double g, String c) {
        num = n;
        gas = g;
        color = c;
        System.out.println("ナンバーを" + num + "にガソリンの量を" + gas + "にしました。");
        System.out.println("色を" + color + "にしました。");
    }

    public void show() {
        System.out.println("車のナンバーは" + num + "です。");
        System.out.println("ガソリンの量は" + gas + "です。");
    }

}
