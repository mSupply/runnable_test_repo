package Functional_TestCase_HomePage;

import org.testng.annotations.Test;

import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import GenericLibrary.WebDriverCommonFunctions;
import POM.HomePage;
import Scenarios.Scenario1Test;

public class msupply_HomePage_FooterSections_Test extends Scenario1Test
{	
	@Test
	public void msupply_HomePage_FooterSections() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("Functional_HomePage");
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.EnterZipCode();
		
		
		//Check Popup is displayed
		WebDriverCommonFunctions.element_Present("Popup_Xpath","Image is Displayed","Popup Image not Displayed");
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP");
		
		
		
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
				
		
				
		//Verify footer-1 links
		 HomePage.msupplyAboutusFooter();
			
		//Verify footer-1 Product category links
		 HomePage.ProductQuickLinks();
		 		 
		
	}

}
