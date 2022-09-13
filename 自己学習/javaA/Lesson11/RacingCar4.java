public class RacingCar4 extends Car4 {

    private int course;

    public RacingCar4() {
        course = 0;
        System.out.println("レーシングカーを作成しました。");
    }

    public void setCourse(int c) {
        course = c;
        System.out.println("コース番号を" + course + "にしました。");
    }

    public void show() {
        System.out.println("レーシングカーのナンバーは" + num + "です。");
        System.out.println("ガソリンの量は" + gas + "です。");
        System.out.println("コース番号は" + course + "です。");
    }

}
