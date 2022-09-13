public class Sample6 {

    public static void main(String[] args) {

        Car6 car1;
        System.out.println("car1を宣言しました。");
        car1 = new Car6();
        car1.setCar(1234, 20.5);

        Car6 car2;
        System.out.println("car2を宣言しました。");
        car2 = car1;
        System.out.println("car2にcar1を代入しました。");

        System.out.print("car1さがす");
        car1.show();
        System.out.print("car2さがす");
        car2.show();

    }

}