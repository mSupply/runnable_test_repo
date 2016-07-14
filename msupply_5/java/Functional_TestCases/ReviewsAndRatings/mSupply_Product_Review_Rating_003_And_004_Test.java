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

public class mSupply_Product_Review_Rating_003_And_004_Test extends Scenario1Test
{
	public static int NumberOfPendingReviewsBeforeAddingProducts;
	public static int NumberOfPendingReviewsAfterAddingProducts;
	
	@Test(priority=1)
	public static void getPendingReviews() throws Throwable
	{
		MagentoDBAccess.ConnectToBD();
		NumberOfPendingReviewsBeforeAddingProducts=MagentoDBAccess.openPendingReviews();
		
	}	
	@Test(priority=2)
	public static void addReviewsToProduct() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("FuncationalReviewsRatings");
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.EnterZipCode();
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP"); 
		
		int noOfReviews=1;
		MagentoDBAccess.addAndVerifyNumberOfPendingReviews(noOfReviews,"TestCase3And4");
		
	}
	
	@Test(priority=3)
	public static void ValidateNumberOfReviews() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("MagentoDBURL");
		Scenario1Test.driver.get(Credentials.url);
		NumberOfPendingReviewsAfterAddingProducts=MagentoDBAccess.openPendingReviews();
		WebDriverCommonFunctions.Assert_IntegerValuesAndPrintinLogAndHTMLReports(NumberOfPendingReviewsBeforeAddingProducts,NumberOfPendingReviewsAfterAddingProducts,"Reviews are updated correctly");
		WebDriverCommonFunctions.element_VerifyTextAndAssert("Magento_RecentReviewTitle_Xpath", "TestCase3And4_Review_1", "Recent Review Present in Magento");

	}
	
	@Test(priority=4)
	public static void Reviews() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("MagentoDBURL");
	    Scenario1Test.driver.get(Credentials.url);
		
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

		ArrayList<String> Options=new ArrayList<String>();
		Options.add("Approved");
		Options.add("Pending");
		Options.add("Not Approved");
		
		WebDriverCommonFunctions.element_SelectAllOptionsDropDownAndVerify("Magento_SelectOptions_Xpath",Options,"All Options available in DropDown");
		WebDriverCommonFunctions.element_SelectDropDown("Magento_StatusUpdate_Xpath",0,"Selected Element from DropDown");
		WebDriverCommonFunctions.element_Click("Magento_SaveReview_Xpath", "Clicked on Save Button");
		WebDriverCommonFunctions.element_VerifyTextAndAssert("Magento_RecentReviewStatus_Xpath","Approved", "Status in Changed to Approved in Magento");
		
		
		Credentials.url=CommonFunctions.readPropertiesFile("FuncationalReviewsRatings");
		Scenario1Test.driver.get(Credentials.url);
		Scenario1Test.homePageObj = PageFactory.initElements(Scenario1Test.driver, HomePage.class);
		
		Scenario1Test.homePageObj.SelectProductsForReviewsandRatings();		
		WebDriverCommonFunctions.element_VerifyTextAndAssert("Review_1", "TestCase3And4_Review_1", "Recent Review Present in Magento");
		
	}
	
	
}
