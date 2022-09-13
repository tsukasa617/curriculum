public class Dog {

    private String lastName;
    private String firstName;
    private int age;

    public void setName(String l, int a) {
        lastName = l;
        age = a;
        System.out.println("犬の名前は" + lastName + "です。");
        System.out.println("犬の年齢は" + age + "です。");
    }

    public void setName(String l, String f, int a) {
          lastName = l;
          firstName = f;
          age = a;;
        System.out.println("犬の名前は" + lastName + " " + firstName + "です。");
        System.out.println("犬の年齢は" + age + "です。");
    }

}
