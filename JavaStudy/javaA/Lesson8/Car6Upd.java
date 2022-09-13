public class Car6Upd {

    int num;
    double gas;
    String color;

    int getNum() {
        System.out.println("ナンバーを調べました。");
        return num;
    }

    double getGas() {
        System.out.println("ガソリンを調べました。");
        return gas;
    }

    String getColor() {
        System.out.println("色を調べました。");
        return color;
    }

    void setNumGas(int n, double g, String c) {
        num = n;
        gas = g;
        color = c;
        System.out.println("車のナンバーを" + num + "にガソリン量を" + gas + "にしました。");
        System.out.println("色を" + color + "にしました。");
    }

    void show() {
        System.out.println("車のナンバーは" + num + "です。");
        System.out.println("ガソリン量は" + gas + "です。");
    }

}
