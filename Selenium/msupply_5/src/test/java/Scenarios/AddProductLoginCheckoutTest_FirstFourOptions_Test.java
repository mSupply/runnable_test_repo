package Scenarios;

import org.openqa.selenium.support.PageFactory;
import org.testng.annotations.Test;

import GenericLibrary.BrowserSelection;
import POM.HomePage;
import POM.LoginPage;
import POM.PaymentChequeOrDD;
import POM.PaymentCreditCard;

public class AddProductLoginCheckoutTest_FirstFourOptions_Test  extends Scenario1Test
{
	@Test
	public void AddProductLoginCheckout() throws Exception
	{
		Scenario1Test.log.info("WebPage Opened for AddProductLoginCheckoutTest");
		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
		LoginPage login=Scenario1Test.homePageObj.SelectProducts();
		PaymentCreditCard Pay=(PaymentCreditCard) login.PlaceOrderToLoginPage(0);
		Pay.ToCreditCard();
		Pay.ToNetBanking();
		Pay.ToDebitCard();
		Pay.ToPayuMoney();
	}

}
