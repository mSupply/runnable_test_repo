package SanityTest;

import org.openqa.selenium.support.PageFactory;
import org.testng.annotations.Test;
import GenericLibrary.BrowserSelection;
import POM.HomePage;
import POM.LoginPage;
import POM.PaymentCashonDelivery;
import Scenarios.Scenario1Test;


public class OrderID_Verification_CashOnDelivery_Test  extends Scenario1Test
{
	@Test
	public void OrderID_Verification_CashOnDelivery() throws Exception
	{
		Scenario1Test.log.info("WebPage Opened for AddProductLoginCheckoutTest_Cheque");
		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
		LoginPage login=Scenario1Test.homePageObj.SelectProducts();
		PaymentCashonDelivery Pay=(PaymentCashonDelivery) login.PlaceOrderToLoginPage(6);
		Pay.ToCashonDelivery();
		BrowserSelection.driver.close();
	}
}
	