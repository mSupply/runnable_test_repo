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

public class mSupply_Plumbing_PipesFittings_031_Test extends Scenario1Test
{
	/*Verify that user is not able to add the product in Shopping cart for different different Pincode*/
	
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
		
		WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("Plumbing_AddProducts_Xpath_1"), CommonFunctions.getElementFromExcel("Plumbing_AddProducts_Xpath_2"), 1,"CLICK",3);
		ArrayList<String> AllProductName=(ArrayList<String>) WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("ProductnamePipe_Xpath_1"), CommonFunctions.getElementFromExcel("ProductnamePipe_Xpath_2"), 1, "GETTEXT",3);
		List<WebElement> ProductNamesList=WebDriverCommonFunctions.element_Collection("AllProductNameListPage_Xpath", 3, "All ProductName from List");
		for(int i=0;i<=2;i++)
		{
			if(!AllProductName.get(i).equals(ProductNamesList.get(i).getText()))
		             WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Items in List not Same");
		}
		
		WebDriverCommonFunctions.element_EnterValuesToTextField("EnterQuantityTextBox_Xpath", "10000", "Enetered Value 10000 to Quantity Field");
		WebDriverCommonFunctions.element_Click("GetBestPrice_Xpath", "Clicked on Best Price Button");
		WebDriverCommonFunctions.element_Click("Buy_Button_Xpath", "Clicked on Buy Button");
		WebDriverCommonFunctions.ExplicitWait();
		
		Scenario1Test.driver.navigate().back();
		
		WebDriverCommonFunctions.element_isEnabled("Plumbing_PipeType_Xpath","PVC Pipe is Selected");
		WebDriverCommonFunctions.element_SelectDropDown("Plumbing_Diameter_Measure_Xpath", 0, "Selected Diameter mm");
		WebDriverCommonFunctions.element_SelectDropDown("Plumbing_Diameter_Xpath","INDEX",1,"null","Selected Diameter from DropDown");
		WebDriverCommonFunctions.element_SelectDropDown("Plumbing_Pressure_Xpath", 1, "Selected Pressure");
		WebDriverCommonFunctions.element_SelectDropDown("Plumbing_Brand_Xpath",4,"Selected Brand");
		WebDriverCommonFunctions.element_Click("Plumbing_FindProducts_Xpath", "Clicked on FindProducts");		
		WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("Plumbing_AddProducts_Xpath_1"), CommonFunctions.getElementFromExcel("Plumbing_AddProducts_Xpath_2"), 1,"CLICK",1);
		WebDriverCommonFunctions.element_EnterValuesToTextField("EnterQuantityTextBox_Xpath", "10000", "Enetered Value 10000 to Quantity Field");
		WebDriverCommonFunctions.element_Click("GetBestPrice_Xpath", "Clicked on Best Price Button");
		WebDriverCommonFunctions.element_EnterValuesToTextField("ZipCodeTextBox_Xpath", "560001", "Entered ZipCode 560001");
		WebDriverCommonFunctions.element_Click("SearchButton_Xpath", "Clicked on Search ZipCode Button");
		WebDriverCommonFunctions.element_Click("Buy_Button_Xpath", "Clicked on Buy Button");
		String ActualMsg=WebDriverCommonFunctions.element_GetTextFromLabel("PincodeErrorMsg_Xpath");
		if(!ActualMsg.contains("select same pincode"))
		   WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Error Msg not Displayed");	
		
		
	
	}

}
