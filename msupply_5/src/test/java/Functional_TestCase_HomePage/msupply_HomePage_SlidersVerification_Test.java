package Functional_TestCase_HomePage;

import java.util.List;

import org.openqa.selenium.WebElement;
import org.testng.annotations.Test;

import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import GenericLibrary.WebDriverCommonFunctions;
import POM.BrokenLinks;
import POM.HomePage;
import Scenarios.Scenario1Test;

public class msupply_HomePage_SlidersVerification_Test extends Scenario1Test
{
	
	@Test
	public void msupply_HomePage_SlidersVerification() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("Functional_HomePage");
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP");

		
		        //Check 8-Category Sections Displayed
				List<WebElement> element=WebDriverCommonFunctions.element_Collection("Eight_Category_Section_Xpath", 8,true, "All Eight category Section Present on WebPage");
				for(int i=0;i<element.size();i++)
				{
					   CommonFunctions.scrollPageUp(0,-1000);
					   CommonFunctions.SearchForElement(element.get(i));
					   if(element.get(i).isDisplayed()==true)
						   WebDriverCommonFunctions.PrintinLogAndHTMLReports("Slider="+(i+1)+" is displayed");
					   else
						   WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Slider="+(i+1)+" is not displayed");
				}	
				
				
				
				//Check Header Names
				List<WebElement> elements4=(List<WebElement>)WebDriverCommonFunctions.element_Collection("CategoryName_Xpath", 8,true, "Category Names");
				for(int i=0;i<elements4.size();i++)
				{
					   CommonFunctions.scrollPageUp(0,-1000);
					   CommonFunctions.SearchForElement(elements4.get(i));
					   if(elements4.get(i).getText()==null)
						   WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("No Header Name available for the Slider");
					
				}		
				WebDriverCommonFunctions.PrintinLogAndHTMLReports("Header Name available for the Slider");
				

				
				

		//Verify Sliders
		HomePage.Sliders_ProductLink_Verification();
		HomePage.Pricing_In_SlidersVerification2();
			
				
		//======================================Error Found=====================================================
		
		
		for(int i=0;i<HomePage.SliderNo.size();i++)
		{
			WebDriverCommonFunctions.PrintinLogAndHTMLReports("=======Error at Sliders : ======== : Product Information not found OR Best Price Not calculated"+ HomePage.SliderNo.get(i)+": Product Number => "+HomePage.ProductNo.get(i));
		}
		
		Scenario1Test.softAssert.assertAll();
		
		//======================================================================================================
	}


}
