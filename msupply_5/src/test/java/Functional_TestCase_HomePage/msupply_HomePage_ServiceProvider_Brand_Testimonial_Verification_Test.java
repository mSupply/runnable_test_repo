package Functional_TestCase_HomePage;

import java.util.List;

import org.openqa.selenium.By;
import org.openqa.selenium.WebElement;
import org.testng.Assert;
import org.testng.annotations.Test;

import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import GenericLibrary.WebDriverCommonFunctions;
import Scenarios.Scenario1Test;

public class msupply_HomePage_ServiceProvider_Brand_Testimonial_Verification_Test extends Scenario1Test
{

	@Test
	public void msupply_HomePage_ServiceProvider_Brand_Testimonial_Verification() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("Functional_HomePage");
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.EnterZipCode();
		
		
		//Check Popup is displayed
		WebDriverCommonFunctions.element_Present("Popup_Xpath","Image is Displayed","Popup Image not Displayed");
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP");
		
		
		//Verify Seller image is Present
				WebDriverCommonFunctions.element_Present("Seller_Image_Xpath", "ServiceProvide Image Present", "ServiceProvide Image not Present");
				
				
				
				//Verify Customer Section
				WebDriverCommonFunctions.element_VerifyTextAndAssert("Customer_Text_Xpath", "Are you looking for Contractor, Architect, Plumber, Electrician or Carpenter?", "Customer Message is displayed");
				WebDriverCommonFunctions.element_EnterValuesToTextField("Customer_NameTextField_Xpath", "Test", "Name Field accepts value");
				WebDriverCommonFunctions.element_EnterValuesToTextField("Customer_MobileTextField_Xpath", "Test123", "Mobile Field accepts value");
				WebDriverCommonFunctions.element_EnterValuesToTextField("Customer_EmailTextField_Xpath", "Test@gmail.com", "Email field accepts value");
				WebDriverCommonFunctions.element_EnterValuesToTextField("Customer_MessageTextField_Xpath", "Test Message", "Message field accepts value");		
				WebDriverCommonFunctions.element_isVisible("Customer_ButtonField_Xpath","Ask-Now button Visible");
				
				
				
				
				//Verify ServiceProvider Section		
				WebDriverCommonFunctions.element_VerifyTextAndAssert("ServiceProvide_Text_Xpath", "Are you an Architect, Interior Designer or Contractor?", "Service Provider Message is displayed");
				WebDriverCommonFunctions.element_EnterValuesToTextField("ServiceProvider_NameTextField_Xpath", "NameField", "Service Provider NameField accepts value");
				WebDriverCommonFunctions.element_EnterValuesToTextField("ServiceProvider_MobileTextField_Xpath", "MobileField123", "Service Provider Mobile accepts value");		
				
				String Value=WebDriverCommonFunctions.element_ReturnWebElement("ServiceProvider_SelectDropDown_VisibleText_Xpath").getAttribute("value");
				Assert.assertEquals(Value, "Architect");
				WebDriverCommonFunctions.PrintinLogAndHTMLReports("ServiceProvider DropDown default value is > Architect");
				boolean status10=WebDriverCommonFunctions.element_isEnabled("ServiceProvider_OtherField_Xpath");
				if(status10==false)
					WebDriverCommonFunctions.PrintinLogAndHTMLReports("Service Provider Other Field is Disabled");
				else
					WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Service Provider Other Field is enabled");
				
				WebDriverCommonFunctions.element_isVisible("ServiceProvider_registerButton_Xpath","Register button Visible");
				
				
				
				
				
				//Verify Customer Testimonials
				WebDriverCommonFunctions.element_Present("Customer_Testimonials_Xpath", "Customer Testimonials Image Present", "Customer Testimonials Image not Present");
				WebDriverCommonFunctions.element_VerifyTextAndAssert("Customer_Testimonials_HeaderText_Xpath", "Customer Testimonial", "Customer Testimonial Header is displayed");
				
				
				
				        //Check BrandImage is displayed
						WebDriverCommonFunctions.element_Present("BrandImage_Xpath","BrandSlider Displayed on HomePage","BrandSlider not Displayed on HomePage");
						List<WebElement> elements2=(List<WebElement>)WebDriverCommonFunctions.element_Collection("All_BrandImage_Xpath",0,false,"All Sliders Present on WebPage");
						if(elements2.size()>0)
							WebDriverCommonFunctions.PrintinLogAndHTMLReports("Brands displayed on the Slider");
						else
							WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Brands not displayed on the Slider");
						
						
						
						//check if Sliders are changing the brands on left and right arrow button
						
						Scenario1Test.driver.navigate().refresh();
						CommonFunctions.scrollDownPage(0,-2500);
						CommonFunctions.scrollDownPage(0,2500);
						CommonFunctions.LoadPageExpicitWait();
						
						boolean status=Scenario1Test.driver.findElement(By.xpath("(//div[@id='brandSlider']/div[1]/div/div/div/img)[11]")).isDisplayed();
						if(status==false)
						      WebDriverCommonFunctions.PrintinLogAndHTMLReports("50th BrandImage not present");
						else
							WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("50th BrandImage present");
							
						Scenario1Test.driver.findElement(By.xpath("//*[@id='brandSlider']/div[2]/div/div[1]/a/i")).click();
						
						Thread.sleep(1000);
						boolean status2=Scenario1Test.driver.findElement(By.xpath("(//div[@id='brandSlider']/div[1]/div/div/div/img)[50]")).isDisplayed();
						if(status2==true)
						      WebDriverCommonFunctions.PrintinLogAndHTMLReports("50th BrandImage present");
						else
							WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("50th BrandImage not present");
						
						Scenario1Test.driver.findElement(By.xpath("//*[@id='brandSlider']/div[2]/div/div[2]/a/i")).click();
						Thread.sleep(1000);
										
						boolean status3=Scenario1Test.driver.findElement(By.xpath("(//div[@id='brandSlider']/div[1]/div/div/div/img)[50]")).isDisplayed();
						if(status3==false)
						      WebDriverCommonFunctions.PrintinLogAndHTMLReports("50th BrandImage not present");
						else
							WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("10th BrandImage present");
						
						
		
		
		
	}
	
	

}
