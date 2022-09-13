public class Car3 {

    int num;
    double gas;

    void show() {
        System.out.println("車のナンバーは" + num + "です。");
        System.out.println("ガソリン量は" + gas + "です。");
    }

    void showCar() {
        System.out.println("これらの車の情報を表示します。");
        show();
    }

}
