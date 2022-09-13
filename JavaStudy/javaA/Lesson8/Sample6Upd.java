public class Sample6Upd {

    public static void main(String[] args) {

        Car6Upd car1 = new Car6Upd();

        car1.setNumGas(1234, 20.5, "赤");

        int number = car1.getNum();
        double gasoline = car1.getGas();
        String color1 = car1.getColor();

        System.out.println("サンプルを調べたところ");
        System.out.println("ナンバーは" + number + "ガソリン量は" + gasoline + "でした。") ;
        System.out.println("色は" + color1 + "でした。") ;

    }

}