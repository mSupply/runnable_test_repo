package Functional_TestCases.ReviewsAndRatings;

import java.util.ArrayList;

import org.openqa.selenium.By;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.PageFactory;
import org.testng.annotations.Test;

import GenericLibrary.AdminPanel;
import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import GenericLibrary.WebDriverCommonFunctions;
import POM.CheckoutPage;
import POM.HomePage;
import POM.ProductDetailsPage;
import POM.ShoppingCartPage;
import Scenarios.Scenario1Test;

public class mSupply_Seller_Review_Rating_001_Test extends Scenario1Test 
{
    
	@Test
	public void mSupply_Seller_Review_Rating_001() throws Throwable
	{
		/*User should navigate to Seller review page in a new tab by PlacingOrder*/
		
		//TestCase-1
		Credentials.url=CommonFunctions.readPropertiesFile("FuncationalReviewsRatings");
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.PrintinLogAndHTMLReports("TestCase - Seller Review");
		WebDriverCommonFunctions.EnterZipCode();
		
		
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP");
		   
		Scenario1Test.homePageObj = PageFactory.initElements(Scenario1Test.driver, HomePage.class);
		ProductDetailsPage ProductPgobj=PageFactory.initElements(Scenario1Test.driver, ProductDetailsPage.class);
		ShoppingCartPage Kart=PageFactory.initElements(Scenario1Test.driver, ShoppingCartPage.class);
		CheckoutPage CheckOut=PageFactory.initElements(Scenario1Test.driver, CheckoutPage.class);				
		homePageObj.mSupplylogin_HomePage();		
		  
		homePageObj.SelectProductsForReviewsandRatings();
		ProductPgobj.addProductTocart();
		Kart.placeOrder();
		CheckOut.placeorder_Cheque();
		Thread.sleep(15000);
		WebDriverCommonFunctions.ExplicitWait();
		CommonFunctions.LoadPageExpicitWait();
		
		//TestCase-2 and 3
		ArrayList myOrders=new ArrayList();
		myOrders.add("HomePageAccount_Xpath");
		myOrders.add("MyOrders_Xpath");
		
		WebDriverCommonFunctions.element_MouseOver_TillElementClick(myOrders, "Clicked on MyOrders");
	    int orderNumber=CommonFunctions.getNumber(WebDriverCommonFunctions.element_GetTextFromLabel("First_OrderNumber_Xpath")); 
		
	    WebDriverCommonFunctions.ExplicitWait();
		AdminPanel.login_AdminPanel();
		AdminPanel.changeOrderToDelivered(orderNumber);
		
		//TestCase-4
		Credentials.url=CommonFunctions.readPropertiesFile("FuncationalReviewsRatings");
		Scenario1Test.driver.get(Credentials.url);		
		WebDriverCommonFunctions.element_MouseOver_TillElementClick(myOrders, "Clicked on MyOrders");
		WebElement element=WebDriverCommonFunctions.Table_SearchForElement(CommonFunctions.getElementFromExcel("AllOrders_Xpath_1"),CommonFunctions.getElementFromExcel("AllOrders_Xpath_2"),2,	orderNumber);
		element.click();
        WebDriverCommonFunctions.element_Click("AllOrders_ViewDetails_Xpath", "Clicked on ViewDetails");
		WebDriverCommonFunctions.element_Click("SellerReview_Xpath", "Clicked on - Leave SellerFeedback");
		WebDriverCommonFunctions.element_Window_SwitchToChild("Opened Seller Review tab");
		WebDriverCommonFunctions.element_VerifyTextAndAssert("SellerReview_Tab_Xpath", "SELLER RATING AND REVIEW", "Child Tab opened for SELLER RATING");
		
		
		/*Verify that customer is able to give seller review*/
		
		
		
		
		
		
		
	}
	
	
	
}
