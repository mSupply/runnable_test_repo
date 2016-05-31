package SanityTest;

import org.openqa.selenium.support.PageFactory;
import org.testng.Reporter;
import org.testng.annotations.Parameters;
import org.testng.annotations.Test;
import GenericLibrary.BrowserSelection;
import GenericLibrary.Credentials;
import POM.HomePage;
import POM.LoginPage;
import POM.ShoppingCartPage;
import Scenarios.Scenario1Test;

/**
 * Checking cart.
 * @author Sandeep K
 *
 */
public class AddProductsToCart_Test  extends Scenario1Test
{
	@Test
	@Parameters({"Production_URL"})
	public void AddProduct(String Production_URL) throws Exception
	{
		Credentials.url=Production_URL;
		Scenario1Test.driver.get(Credentials.url);
		Scenario1Test.log.info("Sanity TestCase - AddProduct");
		Reporter.log("TestCase - for AddProduct to cart");
		
		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
		LoginPage login=Scenario1Test.homePageObj.SelectProducts();
		login.navigateToInsideLoginPage();
		ShoppingCartPage.removeCartProducts();
	}
}
