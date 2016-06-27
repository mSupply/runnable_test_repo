package Functional_TestCases.ReviewsAndRatings;

import java.util.ArrayList;

import org.openqa.selenium.By;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.PageFactory;
import org.testng.annotations.Test;

import GenericLibrary.BrowserSelection;
import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import GenericLibrary.MagentoDBAccess;
import GenericLibrary.RetrieveXlsxData;
import GenericLibrary.WebDriverCommonFunctions;
import POM.HomePage;
import POM.ProductDetailsPage;
import POM.ReviewsPage;
import Scenarios.Scenario1Test;

public class mSupply_Product_Review_Rating_005_Test extends Scenario1Test
{
		@Test
		public void mSupply_Product_Review_Rating_005() throws Throwable
		{
			
			Credentials.url=CommonFunctions.readPropertiesFile("FuncationalReviewsRatings");
			Scenario1Test.driver.get(Credentials.url);
			WebDriverCommonFunctions.element_EnterValuesToTextField("ZipCodePOPUP_Xpath","560064","Pincode Entered");
			WebDriverCommonFunctions.element_Click("ZipCodePOPUP_GoButton_Xpath", "Clicked on ZipCode Go Button");
			WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP"); 
			
			int noOfReviews=2;
			MagentoDBAccess.addAndVerifyNumberOfPendingReviews(noOfReviews,"TestCase5");
			
			MagentoDBAccess.ConnectToBD();			
			ArrayList<String> PendingReviews=new ArrayList<String>();
			PendingReviews.add("Magento_Catalog_Xpath");
			PendingReviews.add("Magento_Reviews_Ratings_Xpath");
			PendingReviews.add("Magento_CustomerReviews_Ratings_Xpath");
			PendingReviews.add("Magento_AllCustomerReviews_Xpath");
			
			WebDriverCommonFunctions.element_MouseOver_TillElementClick(PendingReviews,"MouseOver on Catalog and clicked on All Reviews");
			String[] SKUID=RetrieveXlsxData.getExcelData("mSupply_Review_Rating_003_Test");
			WebDriverCommonFunctions.element_EnterValuesToTextField("Magento_SearchSKU_Xpath", SKUID[1],"Enetered Values to SKUID field");
			WebDriverCommonFunctions.element_Click("Magento_SearchButtonSKU_Xpath", "Clicked on Search Button");
			WebDriverCommonFunctions.element_VerifyTextAndAssert("Magento_RecentReviewStatus_Xpath", "Pending", "Recent Review is Pending");		
			WebDriverCommonFunctions.element_Click("Magento_EditStatus_Xpath", "Clicked on Edit Button");
			
			WebDriverCommonFunctions.element_SelectDropDown("Magento_StatusUpdate_Xpath",2,"Selected Not Approved Element from DropDown");
			WebDriverCommonFunctions.element_Click("Magento_SaveReview_Xpath", "Clicked on Save Button");
			WebDriverCommonFunctions.element_VerifyTextAndAssert("Magento_RecentReviewStatus_Xpath","Not Approved", "Status in Changed to Not Approved in Magento");
						
			Credentials.url=CommonFunctions.readPropertiesFile("FuncationalReviewsRatings");
			Scenario1Test.driver.get(Credentials.url);
			Scenario1Test.homePageObj = PageFactory.initElements(Scenario1Test.driver, HomePage.class);
			
			Scenario1Test.homePageObj.SelectProductsForReviewsandRatings();	
			String ActualText=WebDriverCommonFunctions.element_GetTextFromLabel("Review_1");
			if(ActualText.equals("TestCase5__Review_2"))
				WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Not Approved Review in Magento Present on WebPage");
			else
				WebDriverCommonFunctions.PrintinLogAndHTMLReports("Not Approved Review in Magento not Present on WebPage");					
		}
	
}
//	@Test
//	public static void function() throws Throwable
//	{
//		MagentoDBAccess.ConnectToBD();
//		MagentoDBAccess.changeStatusToApproved();	
//			
//		Credentials.url="http://staging.msupply.com";
//		Scenario1Test.driver.get(Credentials.url);
//		WebDriverCommonFunctions.PrintinLogAndHTMLReports("TestCase - Product Review");
//		Scenario1Test.homePageObj = PageFactory.initElements(Scenario1Test.driver, HomePage.class);
//		
//		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP");
//		Scenario1Test.homePageObj.mSupplylogin_HomePage();
//		
//		boolean ZipCodePopUpEnabled=true;
//		Scenario1Test.homePageObj.SelectProductsForReviewsandRatings(ZipCodePopUpEnabled);		
//		
//		String Date_Value_1=WebDriverCommonFunctions.element_GetTextFromLabel("ProductDetailsPage_ReviewDateOne_Xpath");
//		String NewDate1=ReviewsPage.ConstructDate(Date_Value_1);
//		
//		String Date_Value2=WebDriverCommonFunctions.element_GetTextFromLabel("ProductDetailsPage_ReviewDateTwo_Xpath");
//		String NewDate2=ReviewsPage.ConstructDate(Date_Value2);
//		
//		WebDriverCommonFunctions.element_VerifyTextAndAssert("Review_1","Testing Review Title TextBox","Latest Review updated on the details page.");
//		ReviewsPage.SortedDate(NewDate1,NewDate2);
//		
//		WebDriverCommonFunctions.PrintinLogAndHTMLReports("Dates are sorted and Latest Review updated on the details page.");
//		
//	}
//	
//}