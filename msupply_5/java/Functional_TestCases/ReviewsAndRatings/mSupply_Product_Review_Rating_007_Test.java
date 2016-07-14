package Functional_TestCases.ReviewsAndRatings;

import org.openqa.selenium.support.PageFactory;
import org.testng.Reporter;
import org.testng.annotations.Test;

import GenericLibrary.BrowserSelection;
import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import GenericLibrary.WebDriverCommonFunctions;
import POM.HomePage;
import POM.ProductDetailsPage;
import Scenarios.Scenario1Test;

public class mSupply_Product_Review_Rating_007_Test extends Scenario1Test
{
	
	@Test
	public void mSupply_Product_Review_Rating_007() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("FuncationalReviewsRatings");
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.PrintinLogAndHTMLReports("TestCase - Product Review");
		WebDriverCommonFunctions.EnterZipCode();
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP"); 
		
		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
		ProductDetailsPage ProductPgobj=PageFactory.initElements(Scenario1Test.driver, ProductDetailsPage.class);
		Scenario1Test.homePageObj.mSupplylogin_HomePage();
	
		Scenario1Test.homePageObj.SelectProductsForReviewsandRatings();		
		
		int noofReviews=ProductDetailsPage.getCustomerReviews();
		WebDriverCommonFunctions.PrintinLogAndHTMLReports("Reviews are sorted");
		WebDriverCommonFunctions.navigateBack(1);
		ProductPgobj.CustomerReviews_ProductDetailsPage(noofReviews);
		
		
		
	}

}
