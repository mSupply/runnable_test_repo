package SanityTest;

import org.openqa.selenium.support.PageFactory;
import org.testng.annotations.Parameters;
import org.testng.annotations.Test;

import GenericLibrary.BrowserSelection;
import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import GenericLibrary.WebDriverCommonFunctions;
import POM.HomePage;
import POM.LoginPage;
import Scenarios.Scenario1Test;

public class Product_MOQ_Verification_Test extends Scenario1Test
{
	@Test
	public void Product_MOQ_Verification() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("SanityMOQVerification");
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.element_EnterValuesToTextField("ZipCodePOPUP_Xpath","560064","Pincode Entered");
		WebDriverCommonFunctions.element_Click("ZipCodePOPUP_GoButton_Xpath", "Clicked on ZipCode Go Button");
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP");
				
		Scenario1Test.log.info("Sanity TestCase - MOQ Verification");
		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
		Scenario1Test.homePageObj.ProductsMOQverification();
		
	}	

}