public class Sample1Upd {
    
    public static void main(String[] args) {

        Vehicle1Upd[] vc;
        vc = new Vehicle1Upd[3];

        vc[0] = new Car1Upd(1234, 20.5);
        vc[0].setSpeed(60);

        vc[1] = new Plane1Upd(232);
        vc[1].setSpeed(500);

        vc[2] = new Bike1Upd(62);
        vc[2].setSpeed(800);

        for (int i = 0; i < vc.length; i++) {
            vc[i].show();
        }

    }

}
