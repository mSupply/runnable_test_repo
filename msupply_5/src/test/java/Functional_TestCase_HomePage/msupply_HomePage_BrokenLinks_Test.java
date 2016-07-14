package Functional_TestCase_HomePage;

import org.testng.annotations.Test;

import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import GenericLibrary.WebDriverCommonFunctions;
import POM.BrokenLinks;
import POM.HomePage;
import Scenarios.Scenario1Test;

public class msupply_HomePage_BrokenLinks_Test extends Scenario1Test
{
	
	@Test
	public void msupply_HomePage_BrokenLinks() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("Functional_HomePage");
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP");

		//Verify 404 Pagesin HomePage
		BrokenLinks.HomePageLinksTest();		
				
		//======================================Error Found=====================================================
		
		
		for(int i=0;i<HomePage.SliderNo.size();i++)
		{
			WebDriverCommonFunctions.PrintinLogAndHTMLReports("=======Error at Sliders : ======== : Product Information not found OR Best Price Not calculated"+ HomePage.SliderNo.get(i)+": Product Number => "+HomePage.ProductNo.get(i));
		}
		
		Scenario1Test.softAssert.assertAll();
		
		//======================================================================================================
	}

}
