//package Scenarios;
//
//import org.testng.annotations.Test;
//
//import GenericLibrary.BrowserSelection;
//import POM.HomePage;
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
//public class LoginAndAddtoCart extends Scenario1Test
//{
//	  //Login And AddToCart and placeorder
//    @Test
//    public void UserLoginAndAddToCart() throws Exception
//   	{    	
//   		   	
//   		Scenario1Test.log.info("WebPage Opened for UserLoginAndAddToCart");
//   		
//   		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
//   		   		
//   	    //For Existing Users	
//   		Scenario1Test.homePageObj.navigatetoLoginPage()
//   		             .navigateToInsideLoginPage()
//   		             .navigateToAddToCart(0);
//   	}
//
//}
