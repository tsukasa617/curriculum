public class Trapezoid implements Shape {

    private double joutei;
    private double katei;
    private double takasa;

public Trapezoid(double joutei, double katei, double takasa) {
this.joutei = joutei;
this.katei = katei;
this.takasa = takasa;
     }

public double calcArea() {
    double Shape = (joutei + katei) * takasa / 2;
     return  Shape;
}

    }