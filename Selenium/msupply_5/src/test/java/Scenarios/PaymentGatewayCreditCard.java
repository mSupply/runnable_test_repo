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
//
//import org.apache.poi.openxml4j.exceptions.InvalidFormatException;
//import org.openqa.selenium.support.PageFactory;
//import org.testng.annotations.Test;
//
//
//public class PaymentGatewayCreditCard extends Scenario1Test
//{
//	//PaymentGateway for CreditCard
//    @Test
//    public void PaymentCreditCard() throws IOException, InterruptedException, Exception
//   	{    	
//   		   	
//   		Scenario1Test.log.info("WebPage Opened for PaymentCreditCard");
//  
//   		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
//   		LoginPage login=Scenario1Test.homePageObj.navigatetoLoginPage();   		
//   		AddItemToCart ItemtoCart=login.navigateToInsideLoginPage();
//   	    POM.PaymentCreditCard credit=(POM.PaymentCreditCard)ItemtoCart.navigateToAddToCart(6);
//   	    credit.ToCreditCard();     		
//   	}
//}
