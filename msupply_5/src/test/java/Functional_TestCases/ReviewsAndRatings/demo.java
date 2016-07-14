package Functional_TestCases.ReviewsAndRatings;

import org.testng.annotations.Test;

import GenericLibrary.Credentials;
import GenericLibrary.WebDriverCommonFunctions;
import Scenarios.Scenario1Test;

public class demo extends Scenario1Test
{
	
	@Test
	public void fun() throws Throwable
	{
		Credentials.url="http://staging.msupply.com";
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP"); 
		String name=WebDriverCommonFunctions.element_getTextFromImage("Last","Test");
		System.out.println(name);
		
		
		
	}

}
