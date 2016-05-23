package SanityTest;

import org.openqa.selenium.support.PageFactory;
import org.testng.annotations.Test;
import GenericLibrary.BrowserSelection;
import POM.HomePage;
import POM.LoginPage;
import Scenarios.Scenario1Test;


public class AddProductsToCart  extends Scenario1Test
{
	@Test
	public void AddProduct() throws Exception
	{
		Scenario1Test.log.info("WebPage Opened for AddProduct");
		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
		LoginPage login=Scenario1Test.homePageObj.SelectProducts();
		login.navigateToInsideLoginPage();
		BrowserSelection.driver.close();
	}
}
