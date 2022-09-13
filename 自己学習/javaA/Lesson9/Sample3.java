public class Sample3 {

    public static void main(String[] args) {

        Car3 car1 = new Car3();

        car1.setCar(1234, 20.5);
        car1.show();

        System.out.println("車のナンバーだけ変更します。");
        car1.setCar(2345);
        car1.show();

        System.out.println("ガソリン量だけ変更します。");
        car1.setCar(30.5);
        car1.show();

    }

}