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
//public class PaymentGatewayNetBanking extends Scenario1Test
//{
//	//PaymentGateway for NetBanking
//    @Test
//    public void PaymentNetBanking() throws Exception
//   	{    	
//   		   	
//   		Scenario1Test.log.info("WebPage Opened for PaymentNetBanking");
//   		
//   		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
//   		LoginPage login=Scenario1Test.homePageObj.navigatetoLoginPage();   		
//   		AddItemToCart ItemtoCart=login.navigateToInsideLoginPage();
//   		POM.PaymentNetBanking NBanking=(POM.PaymentNetBanking)ItemtoCart.navigateToAddToCart(2);
//   		NBanking.NetBanking();
//   	}
//
//}
