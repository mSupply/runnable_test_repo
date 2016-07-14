//package Scenarios;
//
//import org.testng.annotations.Test;
//
//import GenericLibrary.BrowserSelection;
//import POM.AddItemToCart;
//import POM.HomePage;
//import POM.LoginPage;
//
//import org.testng.annotations.Test;
//import org.testng.annotations.Test;
//import java.io.IOException;
//import org.openqa.selenium.support.PageFactory;
//import org.testng.annotations.Test;
//
//
//public class PaymentGatewayPayuMoney extends Scenario1Test
//{
//	//PaymentGateway for PayUMoney
//    @Test
//    public void PaymentPayuMoney() throws Exception
//   	{    	
//   		   	
//   		Scenario1Test.log.info("WebPage Opened for PaymentPayuMoney");
//   		
//   		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
//   		LoginPage login=Scenario1Test.homePageObj.navigatetoLoginPage();   		
//   		AddItemToCart ItemtoCart=login.navigateToInsideLoginPage();
//   		POM.PaymentPayuMoney PayU=(POM.PaymentPayuMoney)ItemtoCart.navigateToAddToCart(4);
//   		PayU.PayuMoney();
//   	}
//
//}
