package Functional_TestCase_HomePage;

import org.testng.annotations.Test;

import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import GenericLibrary.WebDriverCommonFunctions;
import POM.HomePage;
import Scenarios.Scenario1Test;

public class mSupply_HomePage_005_Test extends Scenario1Test
{
	
	@Test
	public void mSupply_HomePage_005() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("Functional_HomePage");
		Scenario1Test.driver.get(Credentials.url);		
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP"); 		
		HomePage.Header1Verification();
		
		
	}

}
