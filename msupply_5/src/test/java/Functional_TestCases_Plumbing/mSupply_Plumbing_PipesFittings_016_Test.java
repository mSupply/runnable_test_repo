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

public class mSupply_Plumbing_PipesFittings_016_Test extends Scenario1Test
{
	/* Verify the content of 'My List' table */
	@Test
	public void mSupply_Plumbing_PipesFittings_016() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("FunctionalPlumbing");
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.element_EnterValuesToTextField("ZipCodePOPUP_Xpath","560064","Pincode Entered");
		WebDriverCommonFunctions.element_Click("ZipCodePOPUP_GoButton_Xpath", "Clicked on ZipCode Go Button");
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP"); 
		
		Scenario1Test.homePageObj = PageFactory.initElements(Scenario1Test.driver, HomePage.class);
		//Scenario1Test.homePageObj.mSupplylogin_HomePage();
		
		WebDriverCommonFunctions.element_Click("Plumbing_PipesFittings_Xpath", "Clicked on Pipes and Fittings");
				
		//Select the Particular combination
		
		WebDriverCommonFunctions.element_Click("CPVC_Option_Xpath","CPVC Pipe is Selected");
		WebDriverCommonFunctions.element_SelectDropDown("Plumbing_Diameter_Measure_Xpath", 0, "Selected Diameter mm");
		WebDriverCommonFunctions.element_SelectDropDown("Plumbing_Diameter_Xpath","VISIBLETEXT",0,"75 mm","Selected Diameter from DropDown");
		WebDriverCommonFunctions.element_SelectDropDown("Plumbing_Class_Xpath", 2, "Selected Class");
		WebDriverCommonFunctions.element_SelectDropDown("Plumbing_Brand_Xpath",3,"Selected Brand Astral");
		WebDriverCommonFunctions.element_Click("Plumbing_FindProducts_Xpath", "Clicked on FindProducts");		
		
		//Add pipes and verify List Section
		
		WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("AddPipes_Xpath_1"), CommonFunctions.getElementFromExcel("AddPipes_Xpath_2"), 1,"CLICK",2);		
		ArrayList<String> ProductNameTable=(ArrayList<String>) WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("Pipename_Xpath_1"), CommonFunctions.getElementFromExcel("Pipename_Xpath_2"), 1,"GETTEXT",2);
		List<WebElement> ProductNamesList=WebDriverCommonFunctions.element_Collection("AllProductNameListPage_Xpath", 2, "2 ProductName from List");
		for(int i=0;i<=1;i++)
		{
			if(!ProductNameTable.get(i).equals(ProductNamesList.get(i).getText()))
		             WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Items in List not Same");
		}
		
		//Add Fittings with pipes and verify list
		
		WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("Plumbing_AddProducts_Xpath_1"), CommonFunctions.getElementFromExcel("Plumbing_AddProducts_Xpath_2"), 1,"CLICK",2);
		ArrayList<String> ProductName=(ArrayList<String>) WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("ProductnamePipe_Xpath_1"), CommonFunctions.getElementFromExcel("ProductnamePipe_Xpath_2"), 1, "GETTEXT",2);
		ProductNameTable.add(ProductName.get(0));
		ProductNameTable.add(ProductName.get(1));
		
		List<WebElement> ProductNamesListupdated=WebDriverCommonFunctions.element_Collection("AllProductNameListPage_Xpath", 4, "4 ProductName from List");
		for(int i=0;i<=3;i++)
		{
			if(!ProductNameTable.get(i).equals(ProductNamesListupdated.get(i).getText()))
		             WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Items in List not Same");
		}
		
		//Verify Unit price is present in List
		
		WebDriverCommonFunctions.element_Click("GetBestPrice_Xpath", "Clicked on Best Price Button");
		
		ArrayList<String> UnitPrice_ListSection=(ArrayList<String>) WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("UnitPrice_List_Xpath_1"), CommonFunctions.getElementFromExcel("UnitPrice_List_Xpath_2"), 1, "GETTEXT",4);
		CommonFunctions.CheckifStringContainsNumbers(UnitPrice_ListSection, "UnitPrice");
		//Verify Total price is present in List
		
       ArrayList<String> TotalPrice_ListSection=(ArrayList<String>) WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("TotalPrice_List_Xpath_1"), CommonFunctions.getElementFromExcel("TotalPrice_List_Xpath_2"), 1, "GETTEXT",4);
	   CommonFunctions.CheckifStringContainsNumbers(TotalPrice_ListSection, "TotalPrice");
		
		
		//Verify the Image is Present for Each Product in List
		
		WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("Plumbing_ImageListSection_Xpath_1"), CommonFunctions.getElementFromExcel("END"), 1, "CHECK_IMAGE_PRESENT",4);
		
		//Verify if Diameter Option is Present
		
		ArrayList<String> DiameterValues=(ArrayList<String>) WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("Plumbing_Diameter_Xpath_1"), CommonFunctions.getElementFromExcel("END"), 1, "GETTEXT",4);
		CommonFunctions.CheckifStringContainsNumbers(DiameterValues, "Diameter");
		
		//Verify Total Quantity
		WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("Quantity_TextBox_Xpath_1"), CommonFunctions.getElementFromExcel("END"), 1, "ELEMENT_IS_DISPLAYED",4);
		WebDriverCommonFunctions.element_VerifyTextAndAssert("TotalQuantity_Text_Xpath", "Total Quantity", "Total Quantity Text Present");
		String Quantity=WebDriverCommonFunctions.element_GetTextFromLabel("TotalQuantity_Xpath");
		Assert.assertEquals(CommonFunctions.getNumber(Quantity),4);
		
		//Verify SubTotal
		WebDriverCommonFunctions.element_VerifyTextAndAssert("SubTotal_TextBox_Xpath", "Sub Total", "SubTotal Text Present");
		
		ArrayList<String> SubTotal=new ArrayList<String>();
		SubTotal.add(WebDriverCommonFunctions.element_GetTextFromLabel("SubTotal_Xpath"));
		CommonFunctions.CheckifStringContainsNumbers(SubTotal, "SubTotal");
		
		//BuyButton
		WebElement element=WebDriverCommonFunctions.element_ReturnWebElement("Buy_Button_Xpath");
	    Assert.assertEquals(element.isDisplayed(),true);
		
		//Remove Button
		WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("Plumbing_DeleteButton_Xpath"),CommonFunctions.getElementFromExcel("END"), 1, "ELEMENT_IS_DISPLAYED",4);
		
		
	}
	

}
