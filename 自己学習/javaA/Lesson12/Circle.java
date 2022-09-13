public class Circle implements Shape {

    private double radius;

public Circle(double radius) {
    this.radius = radius;
     }

public double calcArea() {
    double Shape = radius * radius * 3.14;
    return Shape;
 }

    }