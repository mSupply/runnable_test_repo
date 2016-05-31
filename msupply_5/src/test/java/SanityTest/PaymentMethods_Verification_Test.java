package SanityTest;

import org.openqa.selenium.support.PageFactory;
import org.testng.annotations.Parameters;
import org.testng.annotations.Test;
import GenericLibrary.BrowserSelection;
import GenericLibrary.Credentials;
import POM.CheckoutPage;
import POM.HomePage;
import POM.LoginPage;
import POM.ShoppingCartPage;
import Scenarios.Scenario1Test;


public class PaymentMethods_Verification_Test  extends Scenario1Test
{
	@Test
	@Parameters({"Production_URL"})
	public void PaymentMethods_Verification(String Production_URL) throws Throwable
	{
		Credentials.url=Production_URL;
		Scenario1Test.driver.get(Credentials.url);
		Scenario1Test.log.info("Sanity TestCase - PaymentMethods verification");
		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
		LoginPage login=Scenario1Test.homePageObj.SelectProductsforKartVerification();
		CheckoutPage Pay=(CheckoutPage) login.PlaceOrderToLoginPage(0);
		Scenario1Test.wdcf.waitForPageToLoad();
		Thread.sleep(5000);
		ShoppingCartPage.cartforPaymnetMethods();
		Pay.ToCreditCard();
		Pay.ToNetBanking();
		Pay.ToDebitCard();
		Pay.ToPayuMoney();
		Pay.ToCheque();
		ShoppingCartPage.removeCartProducts();
	}	
}
