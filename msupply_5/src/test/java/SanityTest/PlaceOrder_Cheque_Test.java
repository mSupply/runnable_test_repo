package SanityTest;

import org.openqa.selenium.support.PageFactory;
import org.testng.Reporter;
import org.testng.annotations.Parameters;
import org.testng.annotations.Test;
import GenericLibrary.BrowserSelection;
import GenericLibrary.Credentials;
import POM.HomePage;
import POM.LoginPage;
import POM.PaymentCashonDelivery;
import Scenarios.Scenario1Test;


public class PlaceOrder_Cheque_Test  extends Scenario1Test
{
	
	@Test
	@Parameters({"STAGING_URL"})
	public void PlaceOrder_CashOnDelivery(String STAGING_URL) throws Exception
	{
		Credentials.url=STAGING_URL;
		Scenario1Test.driver.get(Credentials.url);
		Scenario1Test.log.info("Testcase - Place Order through Cash on Delivery");
		Reporter.log("Testcase - Place Order through Cash on Delivery");		
		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
		LoginPage login=Scenario1Test.homePageObj.SelectProducts();
		PaymentCashonDelivery Pay=(PaymentCashonDelivery) login.PlaceOrderToLoginPage(6);
		Pay.ToCashonDelivery();
	}
}
	