package SanityTest;

import org.openqa.selenium.support.PageFactory;
import org.testng.annotations.Test;
import GenericLibrary.BrowserSelection;
import POM.CheckoutPage;
import POM.HomePage;
import POM.LoginPage;
import POM.ShoppingCartPage;
import Scenarios.Scenario1Test;


public class PaymentMethods_Verification_Test  extends Scenario1Test
{
	@Test
	public void PaymentMethods_Verification() throws Exception
	{
		Scenario1Test.log.info("WebPage Opened for AddProductLoginCheckoutTest");
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
		Pay.ToCOD();		
	}	
}
