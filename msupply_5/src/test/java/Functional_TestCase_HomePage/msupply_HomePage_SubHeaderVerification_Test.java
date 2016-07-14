package Functional_TestCase_HomePage;

import org.testng.Assert;
import org.testng.annotations.Test;

import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import GenericLibrary.WebDriverCommonFunctions;
import Scenarios.Scenario1Test;

public class msupply_HomePage_SubHeaderVerification_Test extends Scenario1Test 
{
	
	@Test
	public void msupply_HomePage_SubHeaderVerification() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("Functional_HomePage");
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.EnterZipCode();
		
		
		//Check Popup is displayed
		WebDriverCommonFunctions.element_Present("Popup_Xpath","Image is Displayed","Popup Image not Displayed");
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP");
		
		
		
		//Check Service provide link
		WebDriverCommonFunctions.element_Click("HomePage_ServiceProvider_Xpath"," Clicked on Become Service Provider");
		WebDriverCommonFunctions.element_SelectDropDown("HomePage_ServiceProvider_Logo_Xpath", "INDEX", 1, "", "Selected Fisrt Index from DropDown");
		WebDriverCommonFunctions.ExplicitWait();
		WebDriverCommonFunctions.element_VerifyTextAndAssert("ServiceProvider_Xpath", "Some of our Service Providers", "Navigated to Service provider page");
		WebDriverCommonFunctions.navigateBack(1);
		CommonFunctions.LoadPageExpicitWait();
		
		//Check GooglePlay Link 
		WebDriverCommonFunctions.element_Click("Homepage_GooglePlay_Xpath", "clicked on GooglePlay");
		WebDriverCommonFunctions.element_Window_SwitchToChild("Switched to GooglePlay Window");
		Assert.assertEquals(Scenario1Test.driver.getTitle(),"mSupply – Android Apps on Google Play");
		WebDriverCommonFunctions.element_Window_SwitchToParent("Switched to msupply HomePage - Download on GooglePlay navigating to the right page");
				
		//verify Become a Seller
		WebDriverCommonFunctions.element_Click("HomePage_BecomeSeller_Xpath", "Clicked on Become a Seller");
		WebDriverCommonFunctions.element_VerifyTextAndAssert("Seller_HeaderText_Xpath","Sell On mSupply","Navigated to - Sell on msupply page");
		WebDriverCommonFunctions.navigateBack(1);

		
		
		
		
	
	}
}
