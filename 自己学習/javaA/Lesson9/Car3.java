public class Car3 {

    private int num;
    private double gas;

    public void setCar(int n) {
        num = n;
        System.out.println("ナンバーを" + num + "にしました。");
    }

    public void setCar(double g) {
        gas = g;
        System.out.println("ガソリンの量を" + gas + "にしました。");
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
