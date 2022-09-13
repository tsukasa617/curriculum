public class Bike1Upd extends Vehicle1Upd {

    private int power;

    public Bike1Upd(int l) {
        power = l;
        System.out.println("バイクを作成しました。(出力)" + power);
    }

    public void show() {
        System.out.println("バイクの出力は" + power);
        System.out.println("速度は" + speed + "です。");
    }

}

