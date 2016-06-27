package Functional_TestCases.ReviewsAndRatings;

import java.util.ArrayList;

import org.openqa.selenium.support.PageFactory;
import org.testng.annotations.Test;

import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import GenericLibrary.MagentoDBAccess;
import GenericLibrary.RetrieveXlsxData;
import GenericLibrary.WebDriverCommonFunctions;
import POM.HomePage;
import Scenarios.Scenario1Test;

public class mSupply_Product_Review_Rating_006_Test extends Scenario1Test
{
	public static int NumberOfPendingReviews;
	public static int NumberOfApprovedReviews;
	public static int NumberOfNotApprovedReviews;	
	public static int NumberOfPendingReviewsBeforeAddingProducts;
	public static int NumberOfPendingReviewsAfterAddingProducts;
	
	
	@Test(priority=1)
	public static void addReviewsToProduct() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("FuncationalReviewsRatings");
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.element_EnterValuesToTextField("ZipCodePOPUP_Xpath","560064","Pincode Entered");
		WebDriverCommonFunctions.element_Click("ZipCodePOPUP_GoButton_Xpath", "Clicked on ZipCode Go Button");
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP"); 
		int noOfReviews=3;
		MagentoDBAccess.add3Reviews(noOfReviews);
		
	}
	
	@Test(priority=2)
	public static void Reviews() throws Throwable
	{
		
		MagentoDBAccess.ConnectToBD();		
		
		ArrayList<String> AllReviews=new ArrayList<String>();
		AllReviews.add("Magento_Catalog_Xpath");
		AllReviews.add("Magento_Reviews_Ratings_Xpath");
		AllReviews.add("Magento_CustomerReviews_Ratings_Xpath");
		AllReviews.add("Magento_AllCustomerReviews_Xpath");
		
		WebDriverCommonFunctions.element_MouseOver_TillElementClick(AllReviews,"MouseOver on Catalog and clicked on All Reviews");
		String[] SKUID=RetrieveXlsxData.getExcelData("mSupply_Review_Rating_003_Test");
		WebDriverCommonFunctions.element_EnterValuesToTextField("Magento_SearchSKU_Xpath", SKUID[1],"Enetered Values to SKUID field");
		WebDriverCommonFunctions.element_Click("Magento_SearchButtonSKU_Xpath", "Clicked on Search Button");
		
		   WebDriverCommonFunctions.element_VerifyTextAndAssert("Magento_RecentReviewStatus_Xpath", "Pending", "Recent Review is Pending");		
		   WebDriverCommonFunctions.element_Click("Magento_EditStatus_Xpath", "Clicked on Edit Button");
		   WebDriverCommonFunctions.element_SelectDropDown("Magento_StatusUpdate_Xpath",0,"Selected Approved Element from DropDown");
		   WebDriverCommonFunctions.element_Click("Magento_SaveReview_Xpath", "Clicked on Save Button");
		   WebDriverCommonFunctions.element_VerifyTextAndAssert("Magento_RecentReviewStatus_Xpath","Approved", "Status in Changed to Approved in Magento");
		
		   WebDriverCommonFunctions.element_VerifyTextAndAssert("Magento_RecentReviewStatus_2_Xpath", "Pending", "Recent Review is Pending");		
		   WebDriverCommonFunctions.element_Click("Magento_EditStatus_2_Xpath", "Clicked on Edit Button");
		   WebDriverCommonFunctions.element_SelectDropDown("Magento_StatusUpdate_Xpath",2,"Selected Approved Element from DropDown");
		   WebDriverCommonFunctions.element_Click("Magento_SaveReview_Xpath", "Clicked on Save Button");
		   WebDriverCommonFunctions.element_VerifyTextAndAssert("Magento_RecentReviewStatus_2_Xpath","Not Approved", "Status in Changed to Not Approved in Magento");
			
		   
		 Scenario1Test.driver.get(Credentials.url);
		 WebDriverCommonFunctions.element_MouseOver_TillElementClick(AllReviews,"MouseOver on Catalog and clicked on All Reviews");
		 WebDriverCommonFunctions.element_EnterValuesToTextField("Magento_SearchSKU_Xpath", SKUID[1],"Enetered Values to SKUID field");
		 WebDriverCommonFunctions.element_Click("Magento_SearchButtonSKU_Xpath", "Clicked on Search Button");
		
		 WebDriverCommonFunctions.element_VerifyTextAndAssert("Magento_ReviewTitle_1_Xpath", "Title3", "Title3 Present");
		 WebDriverCommonFunctions.element_VerifyTextAndAssert("Magento_RecentReviewStatus_Xpath", "Approved", "Approved Review Present");
		 
		 WebDriverCommonFunctions.element_VerifyTextAndAssert("Magento_ReviewTitle_2_Xpath", "Title2", "Title2 Present");
		 WebDriverCommonFunctions.element_VerifyTextAndAssert("Magento_RecentReviewStatus_2_Xpath", "Not Approved", "Not-Approved Review Present");
		 
		 WebDriverCommonFunctions.element_VerifyTextAndAssert("Magento_ReviewTitle_3_Xpath", "Title1", "Title1 Present");
		 WebDriverCommonFunctions.element_VerifyTextAndAssert("Magento_RecentReviewStatus_3_Xpath", "Pending", "Pending Review Present");
		 
			
	}

}
