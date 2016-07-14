package SanityTest;

import org.openqa.selenium.support.PageFactory;
import org.testng.Reporter;
import org.testng.annotations.Parameters;
import org.testng.annotations.Test;
import GenericLibrary.BrowserSelection;
import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import GenericLibrary.WebDriverCommonFunctions;
import POM.HomePage;
import POM.LoginPage;
import POM.PaymentCashonDelivery;
import Scenarios.Scenario1Test;


public class PlaceOrder_Cheque_Test  extends Scenario1Test
{
	
	@Test
	public void PlaceOrder_CashOnDelivery() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("SanityPlaceOrder");
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.element_EnterValuesToTextField("ZipCodePOPUP_Xpath","560064","Pincode Entered");
		WebDriverCommonFunctions.element_Click("ZipCodePOPUP_GoButton_Xpath", "Clicked on ZipCode Go Button");
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP");
		
		Scenario1Test.log.info("Testcase - Place Order through Cash on Delivery");
		Reporter.log("Testcase - Place Order through Cash on Delivery");		
		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
		LoginPage login=Scenario1Test.homePageObj.SelectProducts();
		PaymentCashonDelivery Pay=(PaymentCashonDelivery) login.PlaceOrderToLoginPage(6);
		Pay.ToCashonDelivery();
	}
}
	