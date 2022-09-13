import java.util.Scanner;
import java.io.IOException;

 
public class Lesson5B4  {

  public static void main(String[] args) throws IOException {

    Scanner stdIn = new Scanner(System.in);
 
    System.out.print("・身長(cm)を入力してください：");

    double height = stdIn.nextDouble(); 
    
    System.out.print("・体重(Kg)を入力してください：");

    double weight = stdIn.nextDouble(); 
    
    double bmi = weight / ((height / 100) * (height / 100));
 
    if (bmi <= 18.5) {
        System.out.println("あなたの肥満指数は" + bmi + "です。やせてます");
    } else if (bmi > 18.5 && bmi < 25) {
        System.out.println("あなたの肥満指数は" + bmi + "です。正常です");
    } else if (bmi >= 25 && bmi < 30) {
        System.out.println("あなたの肥満指数は" + bmi + "です。太ってます");
    } else if (bmi >= 30) {
        System.out.println("あなたの肥満指数は" + bmi + "です。肥満");
    }

  }

}