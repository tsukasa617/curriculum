public class Car5 {

    int num;
    double gas;

    void setNumGas(int n, double g) {
        num = n;
        gas = g;
        System.out.println("車のナンバーを" + num + "にガソリン量を" + gas + "にしました。");
    }

    void show() {
        System.out.println("車のナンバーは" + num + "です。");
        System.out.println("ガソリン量は" + gas + "です。");
    }

}
