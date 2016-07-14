package Demo;

import org.testng.annotations.Test;
import org.testng.asserts.SoftAssert;

public class Demo4 
{
	@Test
	public void fun()
	{
		SoftAssert softAssert = new SoftAssert();		
		softAssert.assertEquals(1, 2);
		softAssert.assertAll();
		
	}

}
