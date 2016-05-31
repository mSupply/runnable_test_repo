package SanityTest;

import org.openqa.selenium.support.PageFactory;
import org.testng.annotations.Parameters;
import org.testng.annotations.Test;

import GenericLibrary.BrowserSelection;
import GenericLibrary.Credentials;
import POM.HomePage;
import POM.LoginPage;
import Scenarios.Scenario1Test;

public class Product_MOQ_Verification_Test extends Scenario1Test
{
	@Test
	@Parameters({"Production_URL"})
	public void Product_MOQ_Verification(String Production_URL) throws Exception
	{
		Credentials.url=Production_URL;
		Scenario1Test.driver.get(Credentials.url);
		Scenario1Test.log.info("Sanity TestCase - MOQ Verification");
		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
		Scenario1Test.homePageObj.ProductsMOQverification();
		
	}	

}