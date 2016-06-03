package Functional_TestCases.ReviewsAndRatings;

import org.openqa.selenium.support.PageFactory;
import org.testng.Reporter;
import org.testng.annotations.Test;

import GenericLibrary.BrowserSelection;
import GenericLibrary.Credentials;
import POM.HomePage;
import POM.ProductDetailsPage;
import Scenarios.Scenario1Test;

public class mSupply_Review_Rating_007_Test extends Scenario1Test
{
	
	@Test
	public void mSupply_Review_Rating_007() throws Throwable
	{
		Credentials.url="http://staging.msupply.com";
		Scenario1Test.driver.get(Credentials.url);
		Scenario1Test.log.info("TestCase - Product Review");
		Reporter.log("TestCase - Product Review",false);
		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
		Scenario1Test.homePageObj.ClickonClosePOPup();
		Scenario1Test.homePageObj.login();
		
		boolean ZipCodePopUpEnabled=true;
		ProductDetailsPage ProductDetails=Scenario1Test.homePageObj.SelectProductsForReviewsandRatings(ZipCodePopUpEnabled);		
		ProductDetailsPage.getCustomerReviews();
		
		
		
		
		
		
		
		
		
		
		
	}

}
