public class RacingCar4Upd extends Car4Upd {

    private int course;

    public RacingCar4Upd() {
        course = 0;
        System.out.println("レーシングカーを作成しました。");
    }

    public void setCourse(int c) {
        course = c;
        System.out.println("コース番号を" + course + "にしました。");
    }

    public void show() {
        System.out.println("レーシングカーのナンバーは" + num + "です。");
        System.out.println("色は" + num + "です。");
        System.out.println("ガソリンの量は" + gas + "です。");
        System.out.println("コース番号は" + course + "です。");
    }

}
