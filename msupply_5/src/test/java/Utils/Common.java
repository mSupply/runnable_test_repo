package Utils;

import org.seleniumhq.jetty9.util.log.Log;

public class Common {

	public static boolean isEmptyOrNull(String value){
		if((value != null)||(value.isEmpty())){
			System.out.println("Value is Empty or null");
			return true;
		}else{
			System.out.println("Value is not Empty : " + value);
			return false;	
		}
	}
}
