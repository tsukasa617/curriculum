public class Sample8Upd {

    public static void main(String[] args) {

        Car8Upd.showSum();

        Car8Upd car1 = new Car8Upd();

        car1.setCar(1234, 20.5, "赤");

        Car8Upd.showSum();

        Car8Upd car2 = new Car8Upd();

        car2.setCar(4567, 30.5, "白");

        Car8Upd.showSum();

    }

}