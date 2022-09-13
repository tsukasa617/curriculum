public class Car2 {

    private int num;
    private double gas;

    public void setNumGas(int n, double g) {
        if (g > 0 && g < 100) {
            num = n;
            gas = g;
            System.out.println("ナンバーを" + num + "にガソリンの量を" + gas + "にしました。");
        } else {
            System.out.println(g + "は正しいガソリンではありませんでした。");
            System.out.println("ガソリン量を変更できませんでした。");
        }
    }
    public void show() {
        System.out.println("車のナンバーは" + num + "です。");
        System.out.println("ガソリンの量は" + gas + "です。");
    }

}
