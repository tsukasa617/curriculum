public class Car5Upd {

    int num;
    double gas;
    String color;

    void setNumGas(int n, double g, String d) {
        num = n;
        gas = g;
        color = d;
        System.out.println("車のナンバーを" + num + "にガソリン量を" + gas + "にしました。");
        System.out.println("色を" + color + "にしました。");
    }

    void show() {
        System.out.println("車のナンバーは" + num + "です。");
        System.out.println("ガソリン量は" + gas + "です。");
    }

}
