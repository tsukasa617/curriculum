abstract class Vehicle1Upd {
    
    protected int speed;

    public void setSpeed(int s) {
        speed = s;
        System.out.println("速度を" + speed + "にしました。");
    }

    abstract void show();

}
