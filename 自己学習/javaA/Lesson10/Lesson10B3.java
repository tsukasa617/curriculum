import java.time.format.DateTimeFormatter;
import java.time.LocalDateTime;

public class Lesson10B3 {

  public static void main(String[] args) {

    LocalDateTime nowDate = LocalDateTime.now();

    DateTimeFormatter dtf = DateTimeFormatter.ofPattern("yyyy年MM月dd日 (E) HH時mm分ss秒");
    String formatNowDate = dtf.format(nowDate);

    System.out.println(formatNowDate);

  }
  
}
