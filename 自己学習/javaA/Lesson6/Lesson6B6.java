public class Lesson6B6 {

  public static void main(String[] args) {

    int j = 1;
    int count = 0;
    int n = 2;

    for (int k = 2;; k++) {
      j *= n;
      count++;
      if (j >= 100000) {
        System.out.println("2のn乗 > 100000 を満たす最小のnは" + count + "です。");
        System.out.println("その時の値は" + j + "です。");
        break;
      }
    }

  }

}
