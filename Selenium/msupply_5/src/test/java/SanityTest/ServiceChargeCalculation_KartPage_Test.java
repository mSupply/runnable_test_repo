package SanityTest;

import org.openqa.selenium.support.PageFactory;
import org.testng.annotations.Test;
import GenericLibrary.BrowserSelection;
import POM.HomePage;
import POM.LoginPage;
import POM.ShoppingCartPage;
import Scenarios.Scenario1Test;


public class ServiceChargeCalculation_KartPage_Test  extends Scenario1Test
{
	@Test
	public void ServiceChargeCalculation_KartPage() throws Exception
	{
		Scenario1Test.wdcf.waitForPageToLoad();
		Scenario1Test.log.info("WebPage Opened for AddProductLoginCheckoutTest");
		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
		LoginPage login=Scenario1Test.homePageObj.SelectProductsforKartVerification();
		login.navigateToInsideLoginPage();
		Thread.sleep(5000);
		ShoppingCartPage.cart("AfterLogin");
		ShoppingCartPage.removeCartProducts();
	}
}