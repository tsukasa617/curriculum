public class Lesson12B {
    
    public static void main(String[] args) {

        double radius = 5.0;
        double takasa = 7.0;
        double joutei = 6.0;
        double katei = 9.0;
        double height = 11.0;
        
        
        Shape a = new Circle(radius);
        Shape b = new Trapezoid(joutei, katei, takasa);
        Pillar c = new Pillar();
        
        System.out.println("半径" + radius + "の円の面積は"+ a.calcArea() + "です。");
        System.out.println("高さが" + height + "の上記円の円柱の体積は"+ c.calcVolume(a,height) + "です。");
        System.out.println("上底" + joutei + "、下底"+ katei + "、高さ" + takasa + "の台形の面積は" + b.calcArea() + "です。");
        System.out.println("高さが" + height + "の上記台形の台形柱の体積は"+ c.calcVolume(b,height) + "です。");
        }
}
