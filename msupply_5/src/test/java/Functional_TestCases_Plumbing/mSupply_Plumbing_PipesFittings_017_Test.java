package Functional_TestCases_Plumbing;

import java.util.ArrayList;
import java.util.List;

import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.PageFactory;
import org.testng.Assert;
import org.testng.annotations.Test;

import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import GenericLibrary.WebDriverCommonFunctions;
import POM.HomePage;
import Scenarios.Scenario1Test;

public class mSupply_Plumbing_PipesFittings_017_Test extends Scenario1Test
{
	
	@Test
	public void mSupply_Plumbing_PipesFittings_019() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("FunctionalPlumbing");
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.element_EnterValuesToTextField("ZipCodePOPUP_Xpath","560064","Pincode Entered");
		WebDriverCommonFunctions.element_Click("ZipCodePOPUP_GoButton_Xpath", "Clicked on ZipCode Go Button");
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP"); 
		
		Scenario1Test.homePageObj = PageFactory.initElements(Scenario1Test.driver, HomePage.class);
		//Scenario1Test.homePageObj.mSupplylogin_HomePage();
		
		WebDriverCommonFunctions.element_Click("Plumbing_PipesFittings_Xpath", "Clicked on Pipes and Fittings");
				
		WebDriverCommonFunctions.element_Click("CPVC_Option_Xpath","CPVC Pipe is Selected");
		WebDriverCommonFunctions.element_SelectDropDown("Plumbing_Diameter_Measure_Xpath", 0, "Selected Diameter mm");
		WebDriverCommonFunctions.element_SelectDropDown("Plumbing_Diameter_Xpath","VISIBLETEXT",0,"75 mm","Selected Diameter from DropDown");
		WebDriverCommonFunctions.element_SelectDropDown("Plumbing_Class_Xpath", 2, "Selected Class");
		WebDriverCommonFunctions.element_SelectDropDown("Plumbing_Brand_Xpath",3,"Selected Brand Astral");
		WebDriverCommonFunctions.element_Click("Plumbing_FindProducts_Xpath", "Clicked on FindProducts");		
		
		
		WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("AddPipes_Xpath_1"), CommonFunctions.getElementFromExcel("AddPipes_Xpath_2"), 1,"CLICK",1);		
		WebDriverCommonFunctions.element_GetTextFromTextField("EnterQuantityTextBox_Xpath","value","1","Expected Value 1 Present");
		WebDriverCommonFunctions.element_Click("MinusButton_Xpath", "Clicked on Minus Button");
		WebDriverCommonFunctions.element_GetTextFromTextField("EnterQuantityTextBox_Xpath","value","1","Expected Value 1 Present");
		WebDriverCommonFunctions.element_Click("PlusButton_Xpath", "Clicked on Plus Button");
		WebDriverCommonFunctions.element_GetTextFromTextField("EnterQuantityTextBox_Xpath","value","2","Expected Value 1 Present");
    	
		WebDriverCommonFunctions.element_EnterValuesToTextField("EnterQuantityTextBox_Xpath", "-10000", "Enetered Value -10000 to Quantity Field");
    	WebDriverCommonFunctions.element_Click("GetBestPrice_Xpath", "Clicked on Best Price Button");
    	WebDriverCommonFunctions.element_GetTextFromTextField("EnterQuantityTextBox_Xpath","value","0","Expected Value 1 Present");
		
    	WebDriverCommonFunctions.element_EnterValuesToTextField("EnterQuantityTextBox_Xpath", "55.65", "Enetered Value 55.65 to Quantity Field");
    	WebDriverCommonFunctions.element_Click("GetBestPrice_Xpath", "Clicked on Best Price Button");
    	WebDriverCommonFunctions.element_GetTextFromTextField("EnterQuantityTextBox_Xpath","value","5565","Expected Value 1 Present");
		
    	WebDriverCommonFunctions.element_EnterValuesToTextField("EnterQuantityTextBox_Xpath", "ABCD", "Enetered Value ABCD to Quantity Field");
    	WebDriverCommonFunctions.element_Click("GetBestPrice_Xpath", "Clicked on Best Price Button");
    	WebDriverCommonFunctions.element_GetTextFromTextField("EnterQuantityTextBox_Xpath","value","","Expected Value 1 Present");
    	
    	WebDriverCommonFunctions.element_EnterValuesToTextField("EnterQuantityTextBox_Xpath", " ", "Enetered Empty Value to Quantity Field");
    	WebDriverCommonFunctions.element_Click("GetBestPrice_Xpath", "Clicked on Best Price Button");
    	String value=WebDriverCommonFunctions.element_GetTextFromLabel("ErrorMsgEmptyValue_Xpath");
    	Assert.assertEquals(value, "Empty quantity");
    	
	
	}
	

}
