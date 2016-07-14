package Functional_TestCases.ReviewsAndRatings;

import java.text.SimpleDateFormat;
import java.util.Calendar;
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
import GenericLibrary.MagentoDBAccess;
import GenericLibrary.RetrieveXlsxData;
import GenericLibrary.WebDriverCommonFunctions;
import POM.HomePage;
import POM.ProductDetailsPage;
import Scenarios.Scenario1Test;

public class mSupply_Product_Review_Rating_002_Test extends Scenario1Test
{
	
	@Test
	public void mSupply_Product_Review_Rating_002() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("FuncationalReviewsRatings");
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.EnterZipCode();
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP"); 
		
		WebDriverCommonFunctions.PrintinLogAndHTMLReports("TestCase - Product Review");
		
		Scenario1Test.homePageObj = PageFactory.initElements(Scenario1Test.driver, HomePage.class);
		ProductDetailsPage ProductPgobj=PageFactory.initElements(Scenario1Test.driver, ProductDetailsPage.class);
		
		//TestCase-1 and TestCase-2		
		
		Scenario1Test.homePageObj.SelectProductsForReviewsandRatings();
		
		ProductPgobj.WriteReview("BeforeLogin");
		
		Scenario1Test.homePageObj.SelectProductsForReviewsandRatings();
		ProductPgobj.WriteReview("AfterLogin");
		
	    WebDriverCommonFunctions.PrintinLogAndHTMLReports("TestCase - 2  : Case -1");
	   
	    //Check for ratings is unfilled
	    //WebElement Empty_Rating_Stars=GenericLibrary.LoadLocators.loadElementByXpath("Empty_Rating_Stars_Xpath");
		List<WebElement> Rating_Stars=WebDriverCommonFunctions.element_Collection("Rating_Stars_Xpath",5,true,"Rating stars are - 5");
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
	    	  if(value==null)
	    	  {
	    		  //do nothing
	    	  }
	    	  else if(value.equals("checked"))
	    	  {	
	    		    WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Error : Rating is filled ");
	    	  }
	    	  
	    }
		
	    Assert.assertEquals(i-1,5);
	    WebDriverCommonFunctions.PrintinLogAndHTMLReports("All 5 Rating options are unfilled ");	    
		
		//TestCase-1 : Select 4-Ratings and click on submit
	
	    WebDriverCommonFunctions.element_Collection_Click("Rating_Stars_Xpath",3,"Case -1 : Selected 3 - Ratings for the Product");
		WebDriverCommonFunctions.element_Click("Submit_Review_Xpath", "Clicked on Submit Button");	    
		
		WebDriverCommonFunctions.element_VerifyTextAndAssert("Review_Title_Textbox_ErrorMsg_Xpath", "This is a required field.", "Case -1 : Review Title - Error msg displayed on the Page");
		WebDriverCommonFunctions.element_VerifyTextAndAssert("Review_Textbox_ErrorMsg_Xpath", "This is a required field.", "Case -1 : Review - Error msg displayed on the Page");
		
	    //TestCase - 2 : Give only Ratings and Review Title and submit
	    
		WebDriverCommonFunctions.PrintinLogAndHTMLReports("TestCase - 2  : Case -2");
	    WebDriverCommonFunctions.element_EnterValuesToTextField("Review_Title_TextBox_Xpath", "Testing Review Title TextBox", "Case -2 : Review Title TextBox accepts data");
		
	   
	    WebDriverCommonFunctions.element_Click("Submit_Review_Xpath", "Clicked on Submit Button");
	    
	    try
	    {
	    	WebElement Review_Title_Textbox_ErrorMsg_2=GenericLibrary.LoadLocators.loadElementByXpath("Review_Title_Textbox_ErrorMsg_Xpath");
		    if(Review_Title_Textbox_ErrorMsg_2.getText().equals("This is a required field.")||Review_Title_Textbox_ErrorMsg_2.getText().length()>0)
		    {
		       WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("TestCase -2 Review Title - Error msg displayed on the Page");
		       
	        }
		    else
		    {
		      WebDriverCommonFunctions.PrintinLogAndHTMLReports("Case -2 : Review Title - Error msg is not displayed on the Page");
			}
	    }
	    catch(Exception e)
	    {
	    	  WebDriverCommonFunctions.PrintinLogAndHTMLReports("Case -2 : Element not Present, Review Title - Error msg is not displayed on the Page");	    	 
	    }
	    
	    
	    try
	    {
	    	WebElement Review_Textbox_ErrorMsg=GenericLibrary.LoadLocators.loadElementByXpath("Review_Textbox_ErrorMsg_Xpath");
		    if(Review_Textbox_ErrorMsg.getText().equals("This is a required field.")||Review_Textbox_ErrorMsg.getText().length()>0)
		    {
		       WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("TestCase -2 Review Title - Error msg displayed on the Page");
		       
	        }
		    else
		    {
		      WebDriverCommonFunctions.PrintinLogAndHTMLReports("Case -2 : Review Title - Error msg is not displayed on the Page");
			}
	    }
	    catch(Exception e)
	    {
	    	  WebDriverCommonFunctions.PrintinLogAndHTMLReports("Case -2 : Element not Present, Review - Error msg is not displayed on the Page");	    	 
	    }
	            
	    //TestCase -3 : Enter values in both fields and submit
	    
	    WebDriverCommonFunctions.PrintinLogAndHTMLReports("TestCase - 2  : Case -3");
	 
	    WebDriverCommonFunctions.element_Clear("Review_Title_TextBox_Xpath", "TextBox Cleared");
	    WebDriverCommonFunctions.element_EnterValuesToTextField("Review_Title_TextBox_Xpath", "Testing Review Title TextBox", "Case -3 : Review Title TextBox accepts data");
	    
	    WebDriverCommonFunctions.element_Clear("Review_TextBox_Xpath", "TextBox Cleared");
	    WebDriverCommonFunctions.element_EnterValuesToTextField("Review_TextBox_Xpath","Testing Review TextBox", "Case -3 :Review TextBox accepts data");
	    WebDriverCommonFunctions.element_Click("Submit_Review_Xpath", "Clicked on Submit Button");
	    
	    
	    Calendar cal = Calendar.getInstance();
        SimpleDateFormat sdf = new SimpleDateFormat("HH:mm:ss");
        String Time=sdf.format(cal.getTime());
        
        
	    //RetrieveXlsxData.writeExcelData("mSupply_Review_Rating_003_Test",Time);
	    //WebDriverCommonFunctions.PrintinLogAndHTMLReports("Time Written to Excel");
	    
	    
	    
	    try
	    {
	        WebElement Review_Title_Textbox_ErrorMsg_3=GenericLibrary.LoadLocators.loadElementByXpath("Review_Title_Textbox_ErrorMsg_Xpath");
		    if(Review_Title_Textbox_ErrorMsg_3.getText().equals("This is a required field.")||Review_Title_Textbox_ErrorMsg_3.getText().length()>0)
		    {	
		    	WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Case - 3:  Review Title - Error msg displayed on the Page");
		       
		    }
		    else   
		    {
		    	WebDriverCommonFunctions.PrintinLogAndHTMLReports("Case - 3: Review Title - Error msg is not displayed on the Page");
	    	    
		    }
	    }
	    catch(Exception e)
	    {
	    	    WebDriverCommonFunctions.PrintinLogAndHTMLReports("Case - 3: Element not present, Review Title - Error msg is not displayed on the Page");
	    	    
	    }
	    try
	    {
		  WebElement Review_Textbox_ErrorMsg_3=GenericLibrary.LoadLocators.loadElementByXpath("Review_Textbox_ErrorMsg_Xpath");
		  if(Review_Textbox_ErrorMsg_3.getText().equals("This is a required field.")||Review_Textbox_ErrorMsg_3.getText().length()>0)
	      {
			  WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Case -2 : Review - Error msg displayed on the Page");
		    
	      }      
		  else
		  {
			  WebDriverCommonFunctions.PrintinLogAndHTMLReports("Case - 3: Review  - Error msg is not displayed on the Page");			  
		  }
	    }
	    catch(Exception e)
	    {
	    	   WebDriverCommonFunctions.PrintinLogAndHTMLReports("Case - 3: Element not present, Review  - Error msg is not displayed on the Page");
	    	  
	    }
	    WebDriverCommonFunctions.element_VerifyTextAndAssert("SuccessMessage_Xpath", "Your review has been accepted for moderation.", "Case - 3: Success Message Displayed");
	    
	}
}
