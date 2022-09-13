public class Lesson6B7 {

    public static void main(String[] args) {

        int j = 1;

        for (int i = 2;; i++) {
            j += i;
            if (j >= 10000) {
                System.out.println("総和は" + j + "、最後に足した数は" + i + "です");
                break;
            }
        }

    }

}