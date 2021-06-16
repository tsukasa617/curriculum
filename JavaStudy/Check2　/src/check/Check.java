package check;

import constants.Constants;

public class Check {

	private static String firstName="高田";
	private static String lastName="司";
	 private static String printName(String first_name,String last_name){
	    	return first_name+last_name;
		}


public static void main(String[] args) {


    System.out.println("printNameメソッド"+printName(firstName,lastName));








Pet a= new Pet(Constants.CHECK_CLASS_JAVA, Constants.CHECK_CLASS_HOGE);
a.introduce();


RobotPet b= new RobotPet(Constants.CHECK_CLASS_R2D2,Constants.CHECK_CLASS_LUKE);
b.introduce();

}
}

