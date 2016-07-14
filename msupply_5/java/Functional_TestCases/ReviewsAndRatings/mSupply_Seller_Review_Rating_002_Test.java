package Functional_TestCases.ReviewsAndRatings;

import java.util.ArrayList;

import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.PageFactory;
import org.testng.Assert;
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

public class mSupply_Seller_Review_Rating_002_Test extends Scenario1Test 
{
	@Test
	public void mSupply_Seller_Review_Rating_002() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("FuncationalReviewsRatings");
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.element_EnterValuesToTextField("ZipCodePOPUP_Xpath","560064","Pincode Entered");
		WebDriverCommonFunctions.element_Click("ZipCodePOPUP_GoButton_Xpath", "Clicked on ZipCode Go Button");
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP");
		Scenario1Test.homePageObj = PageFactory.initElements(Scenario1Test.driver, HomePage.class);
		homePageObj.mSupplylogin_HomePage();
		ArrayList myOrders=new ArrayList();
		myOrders.add("HomePage_Account_Xpath");
		myOrders.add("MyOrders_Xpath");
		WebDriverCommonFunctions.element_MouseOver_TillElementClick(myOrders, "Clicked on MyOrders");
		int orderNumber=CommonFunctions.getNumber(WebDriverCommonFunctions.element_GetTextFromLabel("First_OrderNumber_Xpath")); 
		WebElement element=WebDriverCommonFunctions.Table_SearchForElement(CommonFunctions.getElementFromExcel("AllOrders_Xpath_1"),CommonFunctions.getElementFromExcel("AllOrders_Xpath_2"),2,orderNumber);
		element.click();
        WebDriverCommonFunctions.element_Click("AllOrders_ViewDetails_Xpath", "Clicked on ViewDetails");
		WebDriverCommonFunctions.element_Click("SellerReview_Xpath", "Clicked on - Leave SellerFeedback");
		WebDriverCommonFunctions.element_Window_SwitchToChild("Opened Seller Review tab");
		WebDriverCommonFunctions.element_Click("Submit_SellerReview_Xpath","Clicked on submit review");
		WebDriverCommonFunctions.element_VerifyTextAndAssert("Rating_Stars_Errormsg_Xpath","Stars cannot be blank.", "Error Message is dispalyed if Ratings not given");
		WebDriverCommonFunctions.element_Collection_Click("SellerOrders_Rating_Stars_Xpath",3," Selected 3 - Ratings for the Seller");
		WebDriverCommonFunctions.element_Click("Submit_SellerReview_Xpath", "Clicked on Submit Button");	    
		WebDriverCommonFunctions.element_VerifyTextAndAssert("ReviewTitle_Errormsg_Xpath", "Review Title field cannot be blank.", "Error Message displayed for the Review Title");
		WebDriverCommonFunctions.element_EnterValuesToTextField("ReviewTitle_TextBox_Xpath", "Test1", "Entered value to Review Title TextField");
		WebDriverCommonFunctions.element_Click("Submit_SellerReview_Xpath", "Clicked on Submit Button");
		WebDriverCommonFunctions.element_Click("SellerReview_POPOUP_Xpath", "Clicked SellerReview POPUP OK Button");
		WebDriverCommonFunctions.element_Window_SwitchToParent("Switched to Parent");
		
		
		WebDriverCommonFunctions.element_Click("SellerReview_Xpath", "Clicked on - Leave SellerFeedback");
		WebDriverCommonFunctions.element_Window_SwitchToChild("Opened Seller Review tab");
		WebDriverCommonFunctions.element_Collection_Click("SellerOrders_Rating_Stars_Xpath",3," Selected 3 - Ratings for the Seller");
		WebDriverCommonFunctions.element_EnterValuesToTextField("ReviewTitle_TextBox_Xpath", "Test1", "Entered value to Review Title TextField");
		WebDriverCommonFunctions.element_EnterValuesToTextField("SellerReview_TextBox_Xpath", "TextBox Testing1", "Entered value to Review TextBox TextField");
		WebDriverCommonFunctions.element_Click("Submit_SellerReview_Xpath", "Clicked on Submit Button");
		WebDriverCommonFunctions.element_Click("SellerReview_POPOUP_Xpath", "Clicked SellerReview POPUP OK Button");
		
	}

}
