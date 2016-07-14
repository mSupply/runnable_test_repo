package Functional_TestCase_HomePage;

import java.util.List;

import org.openqa.selenium.By;
import org.openqa.selenium.WebElement;
import org.testng.annotations.Test;

import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import GenericLibrary.WebDriverCommonFunctions;
import Scenarios.Scenario1Test;

public class mSupply_HomePage_001_Test extends Scenario1Test
{
	
	@Test
	public void mSupply_HomePage_001() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("Functional_HomePage");
		Scenario1Test.driver.get(Credentials.url);
		
		//Check Popup is displayed
		WebDriverCommonFunctions.element_Present("Popup_Xpath","Image is Displayed","Image not Displayed");
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP");
       
		//Check Hero Image Slider is displayed
		WebDriverCommonFunctions.element_Present("Hero_Images_Xpath","Sliders Displayed on HomePage","Sliders not Displayed on HomePage");
		List<WebElement> elements=(List<WebElement>)WebDriverCommonFunctions.element_Collection("All_Hero_Images_Xpath", 5,true, "All Sliders Present on WebPage");
		for(int i=0;i<elements.size();i++)
		      WebDriverCommonFunctions.verifyimageActive(elements.get(i),"src");
		
		
		//Check BrandImage is displayed
		WebDriverCommonFunctions.element_Present("BrandImage_Xpath","BrandSlider Displayed on HomePage","BrandSlider not Displayed on HomePage");
		List<WebElement> elements2=(List<WebElement>)WebDriverCommonFunctions.element_Collection("All_BrandImage_Xpath",0,false,"All Sliders Present on WebPage");
		if(elements2.size()>0)
			WebDriverCommonFunctions.PrintinLogAndHTMLReports("Brands displayed on the Slider");
		else
			WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Brands not displayed on the Slider");
		
		//check if Sliders are changing the brands on left and right arrow button
		
		CommonFunctions.scrollDownPage(0,2500);
		
		boolean status=Scenario1Test.driver.findElement(By.xpath("(//div[@id='brandSlider']/div[1]/div/div/div/img)[11]")).isDisplayed();
		if(status==false)
		      WebDriverCommonFunctions.PrintinLogAndHTMLReports("10th BrandImage not present");
		else
			WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("10th BrandImage present");
			
		WebDriverCommonFunctions.element_Click("BrandImage_RightArrowButton_Xpath", "Clicked on Right Arrow of BrandSlider");
		boolean status2=Scenario1Test.driver.findElement(By.xpath("(//div[@id='brandSlider']/div[1]/div/div/div/img)[11]")).isDisplayed();
		if(status2==false)
		      WebDriverCommonFunctions.PrintinLogAndHTMLReports("10th BrandImage not present");
		else
			WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("10th BrandImage present");
		
		WebDriverCommonFunctions.element_Click("BrandImage_LeftArrowButton_Xpath", "Clicked on Right Arrow of BrandSlider");
		boolean status3=Scenario1Test.driver.findElement(By.xpath("(//div[@id='brandSlider']/div[1]/div/div/div/img)[11]")).isDisplayed();
		if(status3==false)
		      WebDriverCommonFunctions.PrintinLogAndHTMLReports("10th BrandImage not present");
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
		
		//Verify Customer Testimonials
		WebDriverCommonFunctions.element_Present("Customer_Testimonials_Xpath", "Customer Testimonials Image Present", "Customer Testimonials Image not Present");
		WebDriverCommonFunctions.element_VerifyTextAndAssert("Customer_Testimonials_HeaderText_Xpath", "Customer Testimonial", "Customer Testimonial Header is displayed");
		
		//Verify Footer Section
		WebDriverCommonFunctions.element_Present("Footer_Section_1_Xpath", "Footer-1 Present", "Footer-1 not Present");
		WebDriverCommonFunctions.element_Present("Footer_Section_2_Xpath", "Footer-2 Present", "Footer-2 not Present");
		WebDriverCommonFunctions.element_Present("Footer_Section_2_Xpath", "Footer-3 Present", "Footer-3 not Present");
		
		//verify Payment Methods 
		WebDriverCommonFunctions.element_VerifyTextAndAssert("PaymentMethod_Text_Xpath", "Payment Method", "Payment Method text is Displayed");
		WebDriverCommonFunctions.element_Collection("PaymentMethod_Types_Xpath", 7,true, "Payment Types Displayed");
		
		//verify Delivery Partner
		WebDriverCommonFunctions.element_VerifyTextAndAssert("DeliveryPartner_Text_Xpath", "Delivery Partners", "Delivery Partners text is Displayed");
		WebDriverCommonFunctions.element_Collection("DeliveryPartner_Types_Xpath", 2,true, "Delivery Partners Displayed");

		
	}
	
	

}
