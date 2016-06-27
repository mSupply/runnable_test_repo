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

public class mSupply_Plumbing_PipesFittings_030_Test extends Scenario1Test
{

	/*Verify Add to Cart functionality without login*/
	
	@Test
	public void mSupply_Plumbing_PipesFittings_031() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("FunctionalPlumbing");
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.element_EnterValuesToTextField("ZipCodePOPUP_Xpath","560064","Pincode Entered");
		WebDriverCommonFunctions.element_Click("ZipCodePOPUP_GoButton_Xpath", "Clicked on ZipCode Go Button");
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP"); 
		
		Scenario1Test.homePageObj = PageFactory.initElements(Scenario1Test.driver, HomePage.class);
		//Scenario1Test.homePageObj.mSupplylogin_HomePage();
		
		WebDriverCommonFunctions.element_Click("Plumbing_PipesFittings_Xpath", "Clicked on Pipes and Fittings");
				
		WebDriverCommonFunctions.element_isEnabled("Plumbing_PipeType_Xpath","PVC Pipe is Selected");
		WebDriverCommonFunctions.element_SelectDropDown("Plumbing_Diameter_Measure_Xpath", 0, "Selected Diameter mm");
		WebDriverCommonFunctions.element_SelectDropDown("Plumbing_Diameter_Xpath","INDEX",1,"null","Selected Diameter from DropDown");
		WebDriverCommonFunctions.element_SelectDropDown("Plumbing_Pressure_Xpath", 1, "Selected Pressure");
		WebDriverCommonFunctions.element_SelectDropDown("Plumbing_Brand_Xpath",4,"Selected Brand");
		WebDriverCommonFunctions.element_Click("Plumbing_FindProducts_Xpath", "Clicked on FindProducts");		
		
		WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("Plumbing_AddProducts_Xpath_1"), CommonFunctions.getElementFromExcel("Plumbing_AddProducts_Xpath_2"), 1,"CLICK",1);
		ArrayList<String> ProductName=(ArrayList<String>) WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("ProductnamePipe_Xpath_1"), CommonFunctions.getElementFromExcel("ProductnamePipe_Xpath_2"), 1, "GETTEXT",1);
		String Product1Added=ProductName.get(0);
		String Product1AddedToList=WebDriverCommonFunctions.element_GetTextFromLabel("ProductNameListPage_Xpath");
		Assert.assertEquals(Product1Added, Product1AddedToList);
		
		WebDriverCommonFunctions.element_EnterValuesToTextField("EnterQuantityTextBox_Xpath", "10000", "Enetered Value 10000 to Quantity Field");
		WebDriverCommonFunctions.element_Click("GetBestPrice_Xpath", "Clicked on Best Price Button");
		WebDriverCommonFunctions.Table_SearchForElement_Action("SellerTable_Xpath_1", "SellerTable_Xpath_2", 1, "CLICK", 1);
		ArrayList<String> Sellername=(ArrayList<String>) WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("SellerName_Xpath_1"), CommonFunctions.getElementFromExcel("SellerName_Xpath_2"), 1, "GETTEXT", 1);
		WebDriverCommonFunctions.element_Click("Buy_Button_Xpath", "Clicked on Buy Button");
		WebDriverCommonFunctions.ExplicitWait();
		
		String SellerNameKartTable=WebDriverCommonFunctions.element_GetTextFromLabel("Sellername_KartTable_Xpath");
		if(!SellerNameKartTable.contains(Sellername.get(0)))
				WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Sellers Not Same");
		
		WebDriverCommonFunctions.element_Click("PlaceOrderButton_Xpath", "Clicked on place Order");
		WebDriverCommonFunctions.element_VerifyTextAndAssert("LoginPopup_Text_Xpath", "Sign in", "Sign in Popup is displayed");
		
		
			
	}

	
	
	
	
}
