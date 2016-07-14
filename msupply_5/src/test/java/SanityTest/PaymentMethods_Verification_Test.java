package SanityTest;

import org.openqa.selenium.support.PageFactory;
import org.testng.annotations.Parameters;
import org.testng.annotations.Test;
import GenericLibrary.BrowserSelection;
import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import GenericLibrary.WebDriverCommonFunctions;
import POM.CheckoutPage;
import POM.HomePage;
import POM.LoginPage;
import POM.ShoppingCartPage;
import Scenarios.Scenario1Test;


public class PaymentMethods_Verification_Test  extends Scenario1Test
{
	@Test
	public void PaymentMethods_Verification() throws Throwable
	{
		Credentials.url="http://staging.msupply.com";
		Scenario1Test.driver.get(Credentials.url);
		
		WebDriverCommonFunctions.element_EnterValuesToTextField("ZipCodePOPUP_Xpath","560064","Pincode Entered");
		WebDriverCommonFunctions.element_Click("ZipCodePOPUP_GoButton_Xpath", "Clicked on ZipCode Go Button");
				
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP");
		
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
