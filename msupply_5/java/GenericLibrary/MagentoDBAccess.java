package GenericLibrary;

import java.util.ArrayList;

import org.openqa.selenium.By;
import org.openqa.selenium.support.PageFactory;

import Functional_TestCases.ReviewsAndRatings.mSupply_Product_Review_Rating_003_And_004_Test;
import POM.HomePage;
import POM.ProductDetailsPage;
import Scenarios.Scenario1Test;

public class MagentoDBAccess 
{
    
	public static void ConnectToBD() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("MagentoDBURL");
	   Scenario1Test.driver.get(Credentials.url);
		
		WebDriverCommonFunctions.PrintinLogAndHTMLReports("Magento Admin Panel Opened");
		WebDriverCommonFunctions.element_EnterValuesToTextField("Magento_UserName_Xpath","msupplyqa","Entered Values to UserName Field");
		WebDriverCommonFunctions.element_EnterValuesToTextField("Magento_Password_Xpath","mSQ&@123","Entered Values to Password Field");
		WebDriverCommonFunctions.element_Click("Magento_Login_Button_Xpath", "Clicked on login Button");
		
	}    
	
	
	public static int openPendingReviews() throws Throwable
	{
		ArrayList<String> elements=new ArrayList<String>();
		elements.add("Magento_Catalog_Xpath");
		elements.add("Magento_Reviews_Ratings_Xpath");
		elements.add("Magento_CustomerReviews_Ratings_Xpath");
		elements.add("Magento_PendingReviews_Xpath");
		
		WebDriverCommonFunctions.element_MouseOver_TillElementClick(elements,"MouseOver on Catalog and clicked on Pending Reviews");
		
		//get number of pending reviews
		String NumberofPendingReviews=WebDriverCommonFunctions.element_GetTextFromLabel("Magento_NumberOfPendingReviews_Xpath");
		NumberofPendingReviews=CommonFunctions.extractStringBetweenString(NumberofPendingReviews,"Total","found");
		int Number=CommonFunctions.getNumber(NumberofPendingReviews);
		return Number;
	}
	
	public static void addAndVerifyNumberOfPendingReviews(int noOfReviews,String Title) throws Throwable
	{		
		Scenario1Test.homePageObj = PageFactory.initElements(Scenario1Test.driver, HomePage.class);
		Scenario1Test.homePageObj.mSupplylogin_HomePage();
		Scenario1Test.homePageObj.SelectProductsForReviewsandRatings();
		WebDriverCommonFunctions.element_Click("Write_Review_Link_Xpath", "Clicked on Review Link");
		noOfReviews=noOfReviews-1;
		//Write 5 Reviews
		int i;
		for(i=0;i<=noOfReviews;i++)
		{
			WebDriverCommonFunctions.element_Collection_Click("Rating_Stars_Xpath",i,"Selected Ratings for the Product");
			
			WebDriverCommonFunctions.element_Clear("Review_Title_TextBox_Xpath", "TextBox Cleared");
		    WebDriverCommonFunctions.element_EnterValuesToTextField("Review_Title_TextBox_Xpath",Title+"_Review_"+(i+1),"Eneterd in Review Title TextBox");		    
		    WebDriverCommonFunctions.element_Clear("Review_TextBox_Xpath", "TextBox Cleared");
		    WebDriverCommonFunctions.element_EnterValuesToTextField("Review_TextBox_Xpath","Testing Review TextBox", "Eneterd in Review TextBox");
		    WebDriverCommonFunctions.element_Click("Submit_Review_Xpath", "Clicked on Submit Button");
		  
		}
		
		mSupply_Product_Review_Rating_003_And_004_Test.NumberOfPendingReviewsBeforeAddingProducts=mSupply_Product_Review_Rating_003_And_004_Test.NumberOfPendingReviewsBeforeAddingProducts+i;
		
	   
	}
	
	
	public static void add3Reviews(int noOfReviews) throws Throwable
	{		
		Scenario1Test.homePageObj = PageFactory.initElements(Scenario1Test.driver, HomePage.class);
		
		Scenario1Test.homePageObj.mSupplylogin_HomePage();
		Scenario1Test.homePageObj.SelectProductsForReviewsandRatings();
		WebDriverCommonFunctions.element_Click("Write_Review_Link_Xpath", "Clicked on Review Link");
		noOfReviews=noOfReviews-1;
		//Write 5 Reviews
		int i;
		for(i=0;i<=noOfReviews;i++)
		{
			WebDriverCommonFunctions.element_Collection_Click("Rating_Stars_Xpath",i,"Selected Ratings for the Product");
			
			WebDriverCommonFunctions.element_Clear("Review_Title_TextBox_Xpath", "TextBox Cleared");
		    WebDriverCommonFunctions.element_EnterValuesToTextField("Review_Title_TextBox_Xpath", "Title"+(i+1), "Eneterd in Review Title TextBox");		    
		    WebDriverCommonFunctions.element_Clear("Review_TextBox_Xpath", "TextBox Cleared");
		    WebDriverCommonFunctions.element_EnterValuesToTextField("Review_TextBox_Xpath","TextInField"+(i+1), "Eneterd in Review TextBox");
		    WebDriverCommonFunctions.element_Click("Submit_Review_Xpath", "Clicked on Submit Button");
		  
		}
	}
	
	
	public static void changeStatusToApproved() throws Throwable
	{
		ArrayList<String> elements=new ArrayList<String>();
		elements.add("Magento_Catalog_Xpath");
		elements.add("Magento_Reviews_Ratings_Xpath");
		elements.add("Magento_CustomerReviews_Ratings_Xpath");
		elements.add("Magento_AllCustomerReviews_Xpath");
		
		WebDriverCommonFunctions.element_MouseOver_TillElementClick(elements,"MouseOver on Catalog and clicked on All Reviews");
		
		String[] SKUID=RetrieveXlsxData.getExcelData("mSupply_Review_Rating_003_Test");
		WebDriverCommonFunctions.element_EnterValuesToTextField("Magento_SearchSKU_Xpath", SKUID[1],"Enetered Values to SKUID field");
		WebDriverCommonFunctions.element_Click("Magento_SearchButtonSKU_Xpath", "Clicked on Search Button");
		WebDriverCommonFunctions.element_Click("Magento_EditStatus_Xpath", "Clicked on Edit Button");
		WebDriverCommonFunctions.element_SelectDropDown("Magento_StatusUpdate_Xpath",0,"Selected Element from DropDown");
		WebDriverCommonFunctions.element_Click("Magento_SaveReview_Xpath", "Clicked on Save Button");
		
		
	}
	
	
}
