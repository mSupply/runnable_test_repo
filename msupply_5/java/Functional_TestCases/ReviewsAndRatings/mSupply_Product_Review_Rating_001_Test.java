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
import GenericLibrary.WebDriverCommonFunctions;
import POM.HomePage;
import POM.LoginPage;
import POM.ProductDetailsPage;
import Scenarios.Scenario1Test;

public class mSupply_Product_Review_Rating_001_Test extends Scenario1Test
{
	@Test
	public void mSupply_Product_Review_Rating_001() throws Throwable
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
		
		//TestCase-3
		
		WebDriverCommonFunctions.element_VerifyTextAndAssert("Rating_Text_Xpath", "Your Rating", "Your Rating - Text is Displayed on the Page");
		WebDriverCommonFunctions.element_VerifyTextAndAssert("Review_Text_Xpath", "Your Review", "Your Review - Text is Displayed on the Page");
		
	    //TestCase-4
	    
	       /*Check for options under "Your Ratings" */
	    
	    //Check for no of ratings available
		
		List<WebElement> Rating_Stars=WebDriverCommonFunctions.element_Collection("Rating_Stars_Xpath",5,true,"Elements accessed and Size are Equal");
		
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
	    
		
		//Test Case -5
		
	    /*Check for Review Title and TextBox*/
		
	    WebDriverCommonFunctions.element_VerifyTextAndAssert("Review_Title_Label_Xpath", "* Review Title", "Review Title Present on the Page");
		WebDriverCommonFunctions.element_EnterValuesToTextField("Review_Title_TextBox_Xpath", "Testing Review Title TextBox", "Review Title TextBox accepts data");    
	    
	    /*Check for Review and TextBox*/
		WebDriverCommonFunctions.element_VerifyTextAndAssert("Review_Xpath", "* Review","Review Present on the Page");
		WebDriverCommonFunctions.element_EnterValuesToTextField("Review_TextBox_Xpath", "Testing Review TextBox","Review TextBox accepts data");    
	    
	    
	}

}
