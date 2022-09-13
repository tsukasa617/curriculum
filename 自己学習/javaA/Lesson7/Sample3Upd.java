public class Sample3Upd {

    public static void main(String[] args) {

        int [] test = new int [6];

        test [0] = 800;
        test [1] = 600;
        test [2] = 202;
        test [3] = 500;
        test [4] = 705;
        test [5] = 750;

        for (int i = 0; i < 6; i++) {
            System.out.println((i + 1) + "番目の人の点数は" + test [i] + "です。");
        }
        
    }

}
