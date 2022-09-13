public class RacingCar1 extends Car1 {

    private int course;

    public  RacingCar1() {
            course = 0;
            System.out.println("レーシングカーを作成しました。");
        }

    public void setCourse(int c) {
        course = c;
        System.out.println("コース番号を" + course + "にしました。");
    }

}
