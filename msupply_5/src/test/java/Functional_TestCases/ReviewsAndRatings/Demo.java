package Functional_TestCases.ReviewsAndRatings;

import org.openqa.selenium.support.PageFactory;
import org.testng.Reporter;
import org.testng.annotations.Test;

import GenericLibrary.BrowserSelection;
import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import POM.HomePage;
import POM.ProductDetailsPage;
import Scenarios.Scenario1Test;
//
public class Demo extends Scenario1Test
{
	
	@Test
	public void function() throws Throwable
	{
		Credentials.url="http://www.msupply.com/review/product/list/id/34936/category/279/#review-form";
		Scenario1Test.driver.get(Credentials.url);
		Thread.sleep(5000);
		CommonFunctions.getLocatorsExcel("Login_For_Review_And_Rating_LinkText");
		
		
	}

}
