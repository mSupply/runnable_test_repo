package Scenarios;

import org.openqa.selenium.support.PageFactory;
import org.testng.annotations.Test;
import GenericLibrary.BrowserSelection;
import POM.HomePage;
import POM.LoginPage;
import POM.PaymentChequeOrDD;


public class AddProductLoginCheckoutTest_Cheque  extends Scenario1Test
{
	@Test
	public void AddProductLoginCheckout() throws Exception
	{
		Scenario1Test.log.info("WebPage Opened for AddProductLoginCheckoutTest_Cheque");
		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
		LoginPage login=Scenario1Test.homePageObj.SelectProducts();
		PaymentChequeOrDD Pay=(PaymentChequeOrDD) login.PlaceOrderToLoginPage(5);
		Pay.ToChequeDD();
	}

}
