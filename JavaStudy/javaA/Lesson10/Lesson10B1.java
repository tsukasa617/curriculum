public class Lesson10B1 {

    public static void main(String[] args) {

        double a = 100;
        double b = 3;
        double answer1 = a / b;

        double c = 77;
        double d = 9;
        double answer2 = c / d;

        System.out.println("四捨五入前:" + answer1);
        System.out.println("四捨五入後:" + Math.round(answer1));

        System.out.println("四捨五入前:" + answer2);
        System.out.println("四捨五入後:" + Math.round(answer2));

    }
}
