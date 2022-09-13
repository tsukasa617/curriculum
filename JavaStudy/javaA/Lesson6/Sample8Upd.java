public class Sample8Upd {

    public static void main(String[] args) {

        boolean b1 = false;

        for (int i = 20; i > 13; i--) {
            for (int j = 0; j < 7; j++) {
                if (b1 == false) {
                    System.out.print("+");
                    b1 = true;
                } else {
                    System.out.print("-");
                    b1 = false;
                }

            }

            System.out.print("\n");

        }

    }

}
