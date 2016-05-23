package SanityTest;

import org.openqa.selenium.support.PageFactory;
import org.testng.annotations.Test;

import GenericLibrary.BrowserSelection;

import POM.HomePage;
import POM.LoginPage;
import Scenarios.Scenario1Test;

public class Product_MOQ_Verification_Test extends Scenario1Test
{
	@Test
	public void Product_MOQ_Verification() throws Exception
	{
		Scenario1Test.log.info("WebPage Opened for AddProductLoginCheckoutTest");
		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
		Scenario1Test.homePageObj.ProductsMOQverification();
		
	}	

}