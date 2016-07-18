package Functional_TestCase_HomePage;

import java.util.List;

import org.openqa.selenium.By;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;
import org.testng.Assert;
import org.testng.annotations.Test;

import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import GenericLibrary.WebDriverCommonFunctions;
import Scenarios.Scenario1Test;

public class mSupply_HomePage_001_003_And_009_Test extends Scenario1Test
{
	
	@Test
	public void mSupply_HomePage_001_003_And_009() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("Functional_HomePage");
		Scenario1Test.driver.get(Credentials.url);
		CommonFunctions.sheetname=CommonFunctions.readPropertiesFile("Locators_Sandeep");
		
		
		
		//Check Popup is displayed
		//WebDriverCommonFunctions.element_Present("Popup_Xpath","Image is Displayed","Popup Image not Displayed");
		//WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP");
		
		//HomePage Header is Visble or not
		boolean status1=WebDriverCommonFunctions.element_isVisible("HomePage_Header_Xpath", "Home Page Header");
		if(status1==true)
			WebDriverCommonFunctions.PrintinLogAndHTMLReports("Home Page Header Visible");
		else
			WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Home Page Header not Visible");
		
		       //=======================================TestCase-3
		
		        //Check msupply Logo Image is displayed
				WebDriverCommonFunctions.element_Present("mSupply_Logo_Image_Xpath", "mSupplyLogo Present", "mSupplyLogo not Present");
				
				//Check if logo contains text msupply.com text
				String Text=WebDriverCommonFunctions.element_getTextFromImage("mSupply_Logo_Image_Xpath", "msupply Logo Image Text is :");
				if(Text.contains("Supply.com"))
					WebDriverCommonFunctions.PrintinLogAndHTMLReports("Logo Contains Text : mSupply.com");
				
				//Check if Click on logo redirects to home Page
				WebDriverCommonFunctions.element_Click("HomePage_ShoppingKart_Xpath", "Clicked on Shopping Kart Page");
				WebDriverCommonFunctions.element_Click("mSupply_Logo_Image_Xpath","Clicked on mSupply Logo");
				WebDriverCommonFunctions.element_Collection("Eight_Category_Section_Xpath", 8,true, "All Eight category Section Present on WebPage");
				
				
				//=======================================TestCase-3		
				
		
		//Check Hero Image Slider is displayed
		WebDriverCommonFunctions.element_Present("Hero_Images_Xpath","Sliders Displayed on HomePage","Sliders not Displayed on HomePage");
		List<WebElement> elements=(List<WebElement>)WebDriverCommonFunctions.element_Collection("All_Hero_Images_Xpath", 5,true, "All Sliders Present on WebPage");
		for(int i=0;i<elements.size();i++)
		      WebDriverCommonFunctions.verifyimageActive(elements.get(i),"src");
		
		
				
		
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
		
		
		
		//Verify marketing Promos are dispalyed
		WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("Marketing_Promos_Xpath_1"),CommonFunctions.getElementFromExcel("Marketing_Promos_Xpath_2"), 1, "ELEMENT_IS_DISPLAYED", 8);
		
		
		
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
				
				
		
		
		//Verify Footer Section
		WebDriverCommonFunctions.element_Present("Footer_Section_1_Xpath", "msuppy Footer-1 Present", "msuppy Footer-1 not Present");
		WebDriverCommonFunctions.element_Present("Footer_Section_2_Xpath", "Payment Methods Footer-2 Present", "Payment Methods Footer-2 not Present");
		WebDriverCommonFunctions.element_Present("Footer_Section_2_Xpath", "Quick Links Footer-3 Present", "Quick Links Footer-3 not Present");
				
		
		//verify Payment Methods 
		WebDriverCommonFunctions.element_VerifyTextAndAssert("PaymentMethod_Text_Xpath", "Payment Method", "Payment Method text is Displayed");
		WebDriverCommonFunctions.element_Collection("PaymentMethod_Types_Xpath", 7,true, "Payment Types Displayed");
		
		
		
		//verify Delivery Partner
		WebDriverCommonFunctions.element_VerifyTextAndAssert("DeliveryPartner_Text_Xpath", "Delivery Partners", "Delivery Partners text is Displayed");
		WebDriverCommonFunctions.element_Collection("DeliveryPartner_Types_Xpath", 2,true, "Delivery Partners Displayed");

		
	}
	
	

}
