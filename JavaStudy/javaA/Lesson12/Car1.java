public class Car1 extends Vehicle1 {

    private int num;
    private double gas;

    public Car1(int n, double g) {
        num = n;
        gas = g;
        System.out.println("ナンバー" + num + "ガソリン量" + gas + "の車を作成しました。");
    }

    public void show() {
        System.out.println("車のナンバーは" + num + "です。");
        System.out.println("ガソリンの量は" + gas + "です。");
        System.out.println("速度は" + speed + "です。");
    }

}
