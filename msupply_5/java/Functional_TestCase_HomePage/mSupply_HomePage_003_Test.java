package Functional_TestCase_HomePage;

import org.testng.annotations.Test;

import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import GenericLibrary.WebDriverCommonFunctions;
import Scenarios.Scenario1Test;

public class mSupply_HomePage_003_Test extends Scenario1Test
{
	
	@Test
	public void mSupply_HomePage_003() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("Functional_HomePage");
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP");
		
		//Check msupply Logo Image is displayed
		WebDriverCommonFunctions.element_Present("mSupply_Logo_Image_Xpath", "mSupplyLogo Present", "mSupplyLogo not Present");
		
		//Check if logo contains text msupply.com text
		String Text=WebDriverCommonFunctions.element_getTextFromImage("mSupply_Logo_Image_Xpath", "msupply Logo Image Text is :");
		if(Text.contains("Supply.com"))
			WebDriverCommonFunctions.PrintinLogAndHTMLReports("Logo Contains Text : mSupply.com");
		
		//Check if Click on logo redirects to home Page
		WebDriverCommonFunctions.element_Click("mSupply_Logo_Image_Xpath","Clicked on mSupply Logo");
		WebDriverCommonFunctions.element_Collection("Eight_Category_Section_Xpath", 8,true, "All Eight category Section Present on WebPage");
		
		
	}

}
