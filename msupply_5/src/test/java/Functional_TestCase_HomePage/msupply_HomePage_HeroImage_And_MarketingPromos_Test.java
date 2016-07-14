package Functional_TestCase_HomePage;

import java.util.List;

import org.openqa.selenium.WebElement;
import org.testng.annotations.Test;

import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import GenericLibrary.WebDriverCommonFunctions;
import POM.HomePage;
import Scenarios.Scenario1Test;

public class msupply_HomePage_HeroImage_And_MarketingPromos_Test extends Scenario1Test
{

	@Test
	public void msupply_HomePage_HeroImage_And_MarketingPromos() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("Functional_HomePage");
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.EnterZipCode();
		
		
		//Check Popup is displayed
		WebDriverCommonFunctions.element_Present("Popup_Xpath","Image is Displayed","Popup Image not Displayed");
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP");
		
		
		
		//Check Hero Image Slider is displayed
		WebDriverCommonFunctions.element_Present("Hero_Images_Xpath","Sliders Displayed on HomePage","Sliders not Displayed on HomePage");
		List<WebElement> elements=(List<WebElement>)WebDriverCommonFunctions.element_Collection("All_Hero_Images_Xpath", 5,true, "All Sliders Present on WebPage");
		for(int i=0;i<elements.size();i++)
		      WebDriverCommonFunctions.verifyimageActive(elements.get(i),"src");

		//Verify marketing Promos are dispalyed
		WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("Marketing_Promos_Xpath_1"),CommonFunctions.getElementFromExcel("Marketing_Promos_Xpath_2"), 1, "ELEMENT_IS_DISPLAYED", 8);
				
						
		//Verify marketting promos
		 HomePage.Functional_MarketingPromos();

		
		
	}
	
	
}
