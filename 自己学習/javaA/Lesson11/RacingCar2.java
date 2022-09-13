public class RacingCar2 extends Car2 {

    private int course;

    public RacingCar2() {
        course = 0;
        System.out.println("レーシングカーを作成しました。");
    }

    public RacingCar2(int n, double g, int c) {
        super(n, g);
        course = c;
        System.out.println("コース番号を" + course + "のレーシングカーを作成しました。。");
    }

    public void setCourse(int c) {
        course = c;
        System.out.println("コース番号を" + course + "にしました。");
    }

}
