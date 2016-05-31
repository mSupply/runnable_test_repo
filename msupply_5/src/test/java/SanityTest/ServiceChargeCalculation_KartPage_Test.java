package SanityTest;

import org.openqa.selenium.support.PageFactory;
import org.testng.annotations.Parameters;
import org.testng.annotations.Test;
import GenericLibrary.BrowserSelection;
import GenericLibrary.Credentials;
import POM.HomePage;
import POM.LoginPage;
import POM.ShoppingCartPage;
import Scenarios.Scenario1Test;

/*

Case 1: This test will verify Shopping cart page Before login by adding 1 product to the cart 
Case 2: Verify the contents in the product details page is same in the cart page
Case 3: Verify the Prices are calculated correctly in the Kart Table and Kart List Table
Case 4: Above steps are repeated after adding the second product
Case 5: Login and verify weather 2 products are added to the cart and verify the same products exists in the cart page
Case 6: Add a product which already exist in the cart and verify the values are correctly incremented from the product details page
Case 7: Add a 4th product and verify the new product is added to the kart
Case 8: Verify the Prices are calculated correctly

*/
public class ServiceChargeCalculation_KartPage_Test  extends Scenario1Test
{
	@Test
	@Parameters({"Production_URL"})
	public void ServiceChargeCalculation_KartPage(String Production_URL) throws Throwable
	{
		Credentials.url="http://www.msupply.com";
		Scenario1Test.driver.get(Credentials.url);
		Scenario1Test.wdcf.waitForPageToLoad();
		Scenario1Test.log.info("Sanity TestCase - ServiceChargeCalculation_KartPage");
		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
		LoginPage login=Scenario1Test.homePageObj.SelectProductsforKartVerification();
		ShoppingCartPage.StoreKartPagesinList("DetailsBeforeLogin");
		login.navigateToInsideLoginPage();
		Thread.sleep(5000);
		ShoppingCartPage.StoreKartPagesinList("DetailsAfterLogin");
		ShoppingCartPage.compareBeforeLoginAfterLoginKartDetails();		
		Scenario1Test.homePageObj.SelectProductsforKartVerificationAfterLogin();		
		ShoppingCartPage.removeCartProducts();
		
	}
}