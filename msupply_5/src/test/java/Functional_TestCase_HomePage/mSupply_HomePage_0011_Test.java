package Functional_TestCase_HomePage;

import java.util.List;

import org.openqa.selenium.By;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.ui.WebDriverWait;
import org.testng.annotations.Test;

import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import GenericLibrary.WebDriverCommonFunctions;
import Scenarios.Scenario1Test;

public class mSupply_HomePage_0011_Test extends Scenario1Test{
	
	@Test
	public void productSliderVerification() throws Throwable
	{
		
		Credentials.url=CommonFunctions.readPropertiesFile("Functional_HomePage");
		Scenario1Test.driver.get(Credentials.url);
		try {
			WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP");
		} catch (Throwable e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		
	    
		
		/*Scenario1Test.driver.findElement(By.xpath("//*[@id='brandSlider']/div[2]/div/div[1]/a/i")).click();
		
		Thread.sleep(1000);
		boolean status2=Scenario1Test.driver.findElement(By.xpath("(//div[@id='brandSlider']/div[1]/div/div/div/img)[50]")).isDisplayed();
		if(status2==true)
		      WebDriverCommonFunctions.PrintinLogAndHTMLReports("50th BrandImage present");
		else
			WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("10th BrandImage not present");
		
		//check if Brand is clickable
		WebDriverWait we = new WebDriverWait(Scenario1Test.driver,15);
	
			if (Scenario1Test.driver.findElement(By.xpath("//div[@id='brandSlider']/div[1]/div/div/div/img)[50]")).isEnabled()) 
			{
				WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Element is  clickable");
			}
			else
			{
				WebDriverCommonFunctions.PrintinLogAndHTMLReports("Element is  clickable");
			}
		
		Scenario1Test.driver.findElement(By.xpath("//*[@id='brandSlider']/div[2]/div/div[2]/a/i")).click();
		Thread.sleep(1000);
						
		boolean status3=Scenario1Test.driver.findElement(By.xpath("(//div[@id='brandSlider']/div[1]/div/div/div/img)[50]")).isDisplayed();
		if(status3==false)
		      WebDriverCommonFunctions.PrintinLogAndHTMLReports("50th BrandImage not present");
		else
			WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("10th BrandImage present");
		
		
		//Check 8-Category Sections Displayed
		WebDriverCommonFunctions.element_Collection("Eight_Category_Section_Xpath", 8,true, "All Eight category Section Present on WebPage");
		
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
		
		//Verify marketing Promos are dispalyed
		WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("Marketing_Promos_Xpath_1"),CommonFunctions.getElementFromExcel("Marketing_Promos_Xpath_2"), 1, "ELEMENT_IS_DISPLAYED", 8);
		
		//Verify Seller image is Present
		WebDriverCommonFunctions.element_Present("Seller_Image_Xpath", "ServiceProvide Image Present", "ServiceProvide Image not Present");
		WebDriverCommonFunctions.element_VerifyTextAndAssert("Customer_Text_Xpath", "Are you looking for Contractor, Architect, Plumber, Electrician or Carpenter?", "Customer Message is displayed");
		WebDriverCommonFunctions.element_VerifyTextAndAssert("ServiceProvide_Text_Xpath", "Are you an Architect, Interior Designer or Contractor?", "Service Provider Message is displayed");
		
		if(WebDriverCommonFunctions.element_ReturnWebElement("ServiceProvider_registerButton_Xpath").isEnabled()==true)
			WebDriverCommonFunctions.PrintinLogAndHTMLReports("Service provider register Button is Clickable");
		else
			WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Service provider register Button is not Clickable");
				
		if(WebDriverCommonFunctions.element_ReturnWebElement("Customer_AskNow_Button_Xpath").isEnabled()==true)
			WebDriverCommonFunctions.PrintinLogAndHTMLReports("Customer AskNow Button is Clickable");
		else
			WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Customer AskNow Button is not Clickable");
		
		
		//Verify Customer Testimonials
		WebDriverCommonFunctions.element_Present("Customer_Testimonials_Xpath", "Customer Testimonials Image Present", "Customer Testimonials Image not Present");
		WebDriverCommonFunctions.element_VerifyTextAndAssert("Customer_Testimonials_HeaderText_Xpath", "Customer Testimonial", "Customer Testimonial Header is displayed");
		
		//Verify Footer Section
		WebDriverCommonFunctions.element_Present("Footer_Section_1_Xpath", "Footer-1 Present", "Footer-1 not Present");
		WebDriverCommonFunctions.element_Present("Footer_Section_2_Xpath", "Footer-2 Present", "Footer-2 not Present");
		WebDriverCommonFunctions.element_Present("Footer_Section_2_Xpath", "Footer-3 Present", "Footer-3 not Present");
	*/}
}
