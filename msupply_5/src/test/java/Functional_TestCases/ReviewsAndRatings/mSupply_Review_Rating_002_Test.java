package Functional_TestCases.ReviewsAndRatings;

import java.util.List;

import org.openqa.selenium.By;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.PageFactory;
import org.testng.Assert;
import org.testng.Reporter;
import org.testng.annotations.Test;

import GenericLibrary.BrowserSelection;
import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import POM.HomePage;
import POM.ProductDetailsPage;
import Scenarios.Scenario1Test;

public class mSupply_Review_Rating_002_Test extends Scenario1Test
{
	
	@Test
	public void mSupply_Review_Rating_001() throws Throwable
	{
		Credentials.url="http://staging.msupply.com";
		Scenario1Test.driver.get(Credentials.url);
		Scenario1Test.log.info("TestCase - Product Review");
		Reporter.log("TestCase - Product Review",false);
		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
		Scenario1Test.homePageObj.ClickonClosePOPup();		
		boolean ZipCodePopUpEnabled=true;
		ProductDetailsPage ProductDetails=Scenario1Test.homePageObj.SelectProductsForReviewsandRatings(ZipCodePopUpEnabled);
		ProductDetails.WriteReview("BeforeLogin");
		ZipCodePopUpEnabled=false;
		Scenario1Test.homePageObj.SelectProductsForReviewsandRatings(ZipCodePopUpEnabled);
		ProductDetails.WriteReview("AfterLogin");
		
	    CommonFunctions.scrollPageUp(0,-550);
	    
	    log.info("TestCase - 2  : Case -1");
		Reporter.log("TestCase - 2  : Case -1",false);
	   
	    List<WebElement> Rating_Stars=GenericLibrary.LoadLocators.loadElementByXpath_findElements("Rating_Stars_Xpath");
		Assert.assertEquals(Rating_Stars.size(),5);
		log.info("Case -1 : Options for Rating is upto 5 ");
	    Reporter.log("Case -1 : Options for Rating is upto 5",false);
		
	    //Check for ratings is unfilled
	    //WebElement Empty_Rating_Stars=GenericLibrary.LoadLocators.loadElementByXpath("Empty_Rating_Stars_Xpath");
	    int i;
	    String value = null;
	    for(i=1;i<=Rating_Stars.size();i++)
	    {
	    	  String Xpath_Value="((//form[@id='review-form']//div[2])[1]/div[1]/div[2]/input)["+i+"]";
	    	  try
	    	  {
	    	     value=Scenario1Test.driver.findElement(By.xpath(Xpath_Value)).getAttribute("checked");
	    	  }
	    	  catch(Exception e)
	    	  {
	    		  //do nothing
	    	  }
	    	  if(value.equals("checked"))
	    	  {	
	    	    	log.info("Error : Rating is filled ");
	    		    Reporter.log("Error : Rating is filled ",false);
	    	    	throw new Exception();
	    	  }
	    }
		
	    Assert.assertEquals(i-1,5);
	    log.info("Case -1 : All 5 Rating options are unfilled ");
		Reporter.log("Case -1 : All 5 Rating options are unfilled",false);
		
		//TestCase-1 : Select 4-Ratings and click on submit
		
		List<WebElement> Rating_Stars_3=GenericLibrary.LoadLocators.loadElementByXpath_findElements("Rating_Stars_Xpath");
		Rating_Stars_3.get(3).click();
		log.info("Case -1 : Selected 3 - Ratings for the Product");
	    Reporter.log("Case -1 : Selected 3 - Ratings for the Product",false);
	    
		WebElement Submit_Review=GenericLibrary.LoadLocators.loadElementByXpath("Submit_Review_Xpath");
		Submit_Review.click();
		
		CommonFunctions.scrollPageUp(0, -550);
		
		WebElement Review_Title_Textbox_ErrorMsg=GenericLibrary.LoadLocators.loadElementByXpath("Review_Title_Textbox_ErrorMsg_Xpath");
		String Review_Title_ErrorMsg=Review_Title_Textbox_ErrorMsg.getText();
		Assert.assertEquals(Review_Title_ErrorMsg,"This is a required field.");
		log.info("Case -1 : Review Title - Error msg displayed on the Page");
	    Reporter.log("Case -1 : Review Title - Error msg displayed on the Page",false);
	    CommonFunctions.scrollPageUp(0, -550);
	    
		WebElement Review_Textbox_ErrorMsg=GenericLibrary.LoadLocators.loadElementByXpath("Review_Textbox_ErrorMsg_Xpath");
		String Review_box_ErrorMsg=Review_Textbox_ErrorMsg.getText();
		Assert.assertEquals(Review_box_ErrorMsg,"This is a required field.");
		log.info("Case -1 : Review - Error msg displayed on the Page");
	    Reporter.log("Case -1 : Review - Error msg displayed on the Page",false);
	    CommonFunctions.scrollPageUp(0, -550);
	    
	    //TestCase - 2 : Give only Ratings and Review Title and submit
	    
	    log.info("TestCase - 2  : Case -2");
		Reporter.log("TestCase - 2  : Case -2",false);
		
		
	    WebElement Review_Title_TextBox=GenericLibrary.LoadLocators.loadElementByXpath("Review_Title_TextBox_Xpath");
	    Review_Title_TextBox.sendKeys("Testing Review Title TextBox");
		log.info("Case -2 : Review Title TextBox accepts data");
	    Reporter.log("Case -2 : Review Title TextBox accepts data",false);
	    CommonFunctions.scrollPageUp(0, -550);
	    Submit_Review.click();
	    CommonFunctions.LoadPageExpicitWait();
	    
	    try
	    {
	        WebElement Review_Title_Textbox_ErrorMsg_2=GenericLibrary.LoadLocators.loadElementByXpath("Review_Title_Textbox_ErrorMsg_Xpath");
		    if(Review_Title_Textbox_ErrorMsg_2.getText().equals("This is a required field.")||Review_Title_Textbox_ErrorMsg_2.getText().length()>0)
		    {
		       log.info("TestCase -2 Review Title - Error msg displayed on the Page");
	           Reporter.log("TestCase -2 Review Title - Error msg displayed on the Page",false);
	           CommonFunctions.scrollPageUp(0, -550);
	           throw new Exception();
	       }
		   else
		   {
	    	  log.info("Case -2 : Review Title - Error msg is not displayed on the Page");
	          Reporter.log("Case -2 : Review Title - Error msg is not displayed on the Page",false);
	          CommonFunctions.scrollPageUp(0, -550);
	       }
	    }
	    catch(Exception e)
	    {
	    	  log.info("Case -2 : Element not Present, Review Title - Error msg is not displayed on the Page");
	          Reporter.log("Case -2 : Element not Present, Review Title - Error msg is not displayed on the Page",false);
	          CommonFunctions.scrollPageUp(0, -550);
	    }
	    
		WebElement Review_Textbox_ErrorMsg_2=GenericLibrary.LoadLocators.loadElementByXpath("Review_Textbox_ErrorMsg_Xpath");
		String Review_box_ErrorMsg_2=Review_Textbox_ErrorMsg_2.getText();
		Assert.assertEquals(Review_box_ErrorMsg_2,"This is a required field.");
		log.info("Case -2 : Review - Error msg displayed on the Page");
	    Reporter.log("Case -2 : Review - Error msg displayed on the Page",false);
	    CommonFunctions.scrollPageUp(0, -550);
        
	    //TestCase -3 : Enter values in both fields and submit
	    
	    log.info("TestCase - 2  : Case -3");
		Reporter.log("TestCase - 2  : Case -3",false);
  
		WebElement Review_Title_TextBox_3=GenericLibrary.LoadLocators.loadElementByXpath("Review_Title_TextBox_Xpath");
		Review_Title_TextBox_3.clear();
	    Review_Title_TextBox_3.sendKeys("Testing Review Title TextBox");
		log.info("Case -3 : Review Title TextBox accepts data");
	    Reporter.log("Case -3 : Review Title TextBox accepts data",false);
	    
	    
	    WebElement Review_TextBox_3=GenericLibrary.LoadLocators.loadElementByXpath("Review_TextBox_Xpath");
	    Review_TextBox_3.clear();
	    Review_TextBox_3.sendKeys("Testing Review TextBox");
		log.info("Case -3 :Review TextBox accepts data");
	    Reporter.log("Case -3 :Review TextBox accepts data",false);
	    Submit_Review.click();
	    CommonFunctions.LoadPageExpicitWait();

	    try
	    {
	        WebElement Review_Title_Textbox_ErrorMsg_3=GenericLibrary.LoadLocators.loadElementByXpath("Review_Title_Textbox_ErrorMsg_Xpath");
		    if(Review_Title_Textbox_ErrorMsg_3.getText().equals("This is a required field.")||Review_Title_Textbox_ErrorMsg_3.getText().length()>0)
		    {	
		       log.info("Case - 3:  Review Title - Error msg displayed on the Page");
	           Reporter.log("Case - 3: Review Title - Error msg displayed on the Page",false);
	           CommonFunctions.scrollPageUp(0, -550);
	           throw new Exception();
		    }
		    else   
		    {
	    	    log.info("Case - 3: Review Title - Error msg is not displayed on the Page");
	            Reporter.log("Case - 3: Review Title - Error msg is not displayed on the Page",false);
	            CommonFunctions.scrollPageUp(0, -550);
		    }
	    }
	    catch(Exception e)
	    {
	    	    log.info("Case - 3: Element not present, Review Title - Error msg is not displayed on the Page");
	            Reporter.log("Case - 3: Element not present, Review Title - Error msg is not displayed on the Page",false);
	            CommonFunctions.scrollPageUp(0, -550);
	    	
	    }
	    
	    try
	    {
		  WebElement Review_Textbox_ErrorMsg_3=GenericLibrary.LoadLocators.loadElementByXpath("Review_Textbox_ErrorMsg_Xpath");
		  if(Review_Textbox_ErrorMsg_3.getText().equals("This is a required field.")||Review_Textbox_ErrorMsg_3.getText().length()>0)
	      {
		     log.info("Case -2 : Review - Error msg displayed on the Page");
	         Reporter.log("Case -2 : Review - Error msg displayed on the Page",false);
	         throw new Exception();
	       }      
		   else
		   {
			   log.info("Case - 3: Review  - Error msg is not displayed on the Page");
	           Reporter.log("Case - 3: Review  - Error msg is not displayed on the Page",false);
	           CommonFunctions.scrollPageUp(0, -550);
		   }
	    }
	    catch(Exception e)
	    {
	    	   log.info("Case - 3: Element not present, Review  - Error msg is not displayed on the Page");
	           Reporter.log("Case - 3: Element not present, Review  - Error msg is not displayed on the Page",false);
	           CommonFunctions.scrollPageUp(0, -550);
	    	
	    }
	    
	    
	    WebElement SuccessMessage=GenericLibrary.LoadLocators.loadElementByXpath("SuccessMessage_Xpath");
	    String Message=SuccessMessage.getText();
	    Assert.assertEquals(Message,"Your review has been accepted for moderation.");
	    log.info("Case - 3: Success Message Displayed");
        Reporter.log("Case - 3: Success Message Displayed",false);
	    
	}


}
