public class Car4 {

    int num;
    double gas;

    void setNum(int n) {
        num = n;
        System.out.println("ナンバーを" + n + "にしました。");
    }

    void setGas(double g) {
        gas = g;
        System.out.println("ガソリン量を" + g + "にしました。");
    }

    void show() {
        System.out.println("車のナンバーは" + num + "です。");
        System.out.println("ガソリン量は" + gas + "です。");
    }
    
}
