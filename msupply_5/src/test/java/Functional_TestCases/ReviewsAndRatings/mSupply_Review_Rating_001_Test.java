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
import POM.LoginPage;
import POM.ProductDetailsPage;
import Scenarios.Scenario1Test;

public class mSupply_Review_Rating_001_Test extends Scenario1Test
{
	@Test
	public void mSupply_Review_Rating_001() throws Throwable
	{
		Credentials.url="https://www.msupply.com";
		Scenario1Test.driver.get(Credentials.url);
		Scenario1Test.log.info("TestCase - Product Review");
		Reporter.log("TestCase - Product Review",false);
		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
		Scenario1Test.homePageObj.ClickonClosePOPup();
		
		//TestCase-1 and TestCase-2
		
		boolean ZipCodePopUpEnabled=true;
		ProductDetailsPage ProductDetails=Scenario1Test.homePageObj.SelectProductsForReviewsandRatings(ZipCodePopUpEnabled);
		ProductDetails.WriteReview("BeforeLogin");
		ZipCodePopUpEnabled=false;
		Scenario1Test.homePageObj.SelectProductsForReviewsandRatings(ZipCodePopUpEnabled);
		ProductDetails.WriteReview("AfterLogin");
		
		//TestCase-3
		
		WebElement Rating_Text=GenericLibrary.LoadLocators.loadElementByXpath("Rating_Text_Xpath");
		String Actual_Value_Rating=Rating_Text.getText();
		Assert.assertEquals(Actual_Value_Rating,"Your Rating");
		log.info("Your Rating - Text is Displayed on the Page");
	    Reporter.log("Your Rating - Text is Displayed on the Page",false);
		
		WebElement Review_Text=GenericLibrary.LoadLocators.loadElementByXpath("Review_Text_Xpath");
		String Actual_Value_Review=Review_Text.getText();
		Assert.assertEquals(Actual_Value_Review,"Your Review");
		log.info("Your Review - Text is Displayed on the Page");
	    Reporter.log("Your Review - Text is Displayed on the Page",false);
		
	    CommonFunctions.scrollPageUp(0,-550);
	    
	    //TestCase-4
	    
	       /*Check for options under "Your Ratings" */
	    
	    //Check for no of ratings available
	    List<WebElement> Rating_Stars=GenericLibrary.LoadLocators.loadElementByXpath_findElements("Rating_Stars_Xpath");
		Assert.assertEquals(Rating_Stars.size(),5);
		log.info("Options for Rating is upto 5 ");
	    Reporter.log("Options for Rating is upto 5",false);
		
	    //Check for ratings is unfilled
	    //WebElement Empty_Rating_Stars=GenericLibrary.LoadLocators.loadElementByXpath("Empty_Rating_Stars_Xpath");
	    int i;
	    for(i=1;i<=Rating_Stars.size();i++)
	    {
	    	try
	    	{
	    	  String Xpath_Value="((//form[@id='review-form']//div[2])[1]/div[1]/div[2]/input)["+i+"]";
	    	  String value=Scenario1Test.driver.findElement(By.xpath(Xpath_Value)).getAttribute("checked");
	    	  if(value==null)
	    		  throw new Exception();
	    	}
	    	catch(Exception e)
	    	{
	    		//do nothing
	    	}
	    }
		
	    Assert.assertEquals(i-1,5);
	    log.info("All 5 Rating options are unfilled ");
		Reporter.log("All 5 Rating options are unfilled",false);
		
		//Test Case -5
		
	    /*Check for Review Title and TextBox*/
		
		WebElement Review_Title_Label=GenericLibrary.LoadLocators.loadElementByXpath("Review_Title_Label_Xpath");
		String Review_Title=Review_Title_Label.getText();
		Assert.assertEquals(Review_Title,"* Review Title");
		log.info("Review Title Present on the Page");
	    Reporter.log("Review Title Present on the Page",false);
	    
	    WebElement Review_Title_TextBox=GenericLibrary.LoadLocators.loadElementByXpath("Review_Title_TextBox_Xpath");
	    Review_Title_TextBox.sendKeys("Testing Review Title TextBox");
		log.info("Review Title TextBox accepts data");
	    Reporter.log("Review Title TextBox accepts data",false);
	    
	    /*Check for Review and TextBox*/
	    
	    WebElement Review=GenericLibrary.LoadLocators.loadElementByXpath("Review_Xpath");
		String Review_Value=Review.getText();
		Assert.assertEquals(Review_Value,"* Review");
		log.info("Review Present on the Page");
	    Reporter.log("Review Present on the Page",false);
	    
	    WebElement Review_TextBox=GenericLibrary.LoadLocators.loadElementByXpath("Review_TextBox_Xpath");
	    Review_TextBox.sendKeys("Testing Review TextBox");
		log.info("Review TextBox accepts data");
	    Reporter.log("Review TextBox accepts data",false);
	    
	    
	    
	    
	}

}
