public class Car4 {

    private int num;
    private double gas;

    public Car4() {
        num = 0;
        gas = 0.0;
        System.out.println("車を作成しました。");
    }

    public void show() {
        System.out.println("車のナンバーは" + num + "です。");
        System.out.println("ガソリンの量は" + gas + "です。");
    }

}
