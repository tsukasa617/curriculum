abstract class Vehicle1  {

    protected int speed;

    public void setSpeed(int s) {
        speed = s;
        System.out.println("速度を" + speed + "にしました。");
    }

    abstract void show();

}
