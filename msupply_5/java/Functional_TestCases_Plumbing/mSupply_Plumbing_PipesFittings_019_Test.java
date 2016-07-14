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

public class mSupply_Plumbing_PipesFittings_019_Test extends Scenario1Test
{

	/* Verify the Brand change functionality */
	
	@Test
	public void mSupply_Plumbing_PipesFittings_019() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("FunctionalPlumbing");
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.EnterZipCode();
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP"); 
		
		Scenario1Test.homePageObj = PageFactory.initElements(Scenario1Test.driver, HomePage.class);
		//Scenario1Test.homePageObj.mSupplylogin_HomePage();
		
		WebDriverCommonFunctions.element_Click("Plumbing_PipesFittings_Xpath", "Clicked on Pipes and Fittings");
		WebDriverCommonFunctions.EnterZipCode();
		
		WebDriverCommonFunctions.element_Click("CPVC_Option_Xpath","CPVC Pipe is Selected");
		WebDriverCommonFunctions.element_SelectDropDown("Plumbing_Diameter_Measure_Xpath", 0, "Selected Diameter mm");
		WebDriverCommonFunctions.element_SelectDropDown("Plumbing_Diameter_Xpath","VISIBLETEXT",0,"75 mm","Selected Diameter from DropDown");
		WebDriverCommonFunctions.element_SelectDropDown("Plumbing_Class_Xpath", 2, "Selected Class");
		WebDriverCommonFunctions.element_SelectDropDown("Plumbing_Brand_Xpath",3,"Selected Brand Astral");
		WebDriverCommonFunctions.element_Click("Plumbing_FindProducts_Xpath", "Clicked on FindProducts");		
		
		
		WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("AddPipes_Xpath_1"), CommonFunctions.getElementFromExcel("AddPipes_Xpath_2"), 1,"CLICK",2);		
		ArrayList<String> ProductNameTable=(ArrayList<String>) WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("Pipename_Xpath_1"), CommonFunctions.getElementFromExcel("Pipename_Xpath_2"), 1,"GETTEXT",2);
		List<WebElement> ProductNamesList=WebDriverCommonFunctions.element_Collection("AllProductNameListPage_Xpath", 2,true, "2 ProductName from List");
		for(int i=0;i<=1;i++)
		{
			if(!ProductNameTable.get(i).equals(ProductNamesList.get(i).getText()))
		             WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Items in List not Same");
		}
		
		
		WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("Plumbing_AddProducts_Xpath_1"), CommonFunctions.getElementFromExcel("Plumbing_AddProducts_Xpath_2"), 1,"CLICK",2);
		ArrayList<String> ProductName=(ArrayList<String>) WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("ProductnamePipe_Xpath_1"), CommonFunctions.getElementFromExcel("ProductnamePipe_Xpath_2"), 1, "GETTEXT",2);
		ProductNameTable.add(ProductName.get(0));
		ProductNameTable.add(ProductName.get(1));
		
		List<WebElement> ProductNamesListupdated=WebDriverCommonFunctions.element_Collection("AllProductNameListPage_Xpath", 4,true, "4 ProductName from List");
		for(int i=0;i<=3;i++)
		{
			if(!ProductNameTable.get(i).equals(ProductNamesListupdated.get(i).getText()))
		             WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Items in List not Same");
		}
		
		WebDriverCommonFunctions.element_Click("GetBestPrice_Xpath", "Clicked on Best Price Button");
		
		ArrayList<String> UnitPrice_ListSection=(ArrayList<String>) WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("UnitPrice_List_Xpath_1"), CommonFunctions.getElementFromExcel("UnitPrice_List_Xpath_2"), 1, "GETTEXT",4);
		
		CommonFunctions.CheckifStringContainsNumbers(UnitPrice_ListSection, "UnitPrice");
		
       ArrayList<String> TotalPrice_ListSection=(ArrayList<String>) WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("TotalPrice_List_Xpath_1"), CommonFunctions.getElementFromExcel("TotalPrice_List_Xpath_2"), 1, "GETTEXT",4);
       CommonFunctions.CheckifStringContainsNumbers(TotalPrice_ListSection, "TotalPrice");
		
		WebDriverCommonFunctions.element_SelectDropDown("Plumbing_Brand_Xpath",2,"Selected Brand Ashirvad");
		String TextPopup=WebDriverCommonFunctions.element_GetTextFromLabel("ChangebrandPopUp_Xpath");
		if(TextPopup.contains("Do you want to change the brand?"))
			WebDriverCommonFunctions.PrintinLogAndHTMLReports("Correct Text is displayed on the POPup");
		
		WebDriverCommonFunctions.element_VerifyTextAndAssert("YesButton_Xpath", "Yes", "Yes Button is displayed on the POPup");
		WebDriverCommonFunctions.element_VerifyTextAndAssert("NoButton_Xpath", "No", "No Button is displayed on the POPup");
		
		WebDriverCommonFunctions.element_Click("YesButton_Xpath", "Clicked on Yes Button");
		
		ArrayList<String> TotalPrice_ListSection_Check=(ArrayList<String>) WebDriverCommonFunctions.Table_SearchForElement_Action(CommonFunctions.getElementFromExcel("TotalPrice_List_Xpath_1"), CommonFunctions.getElementFromExcel("TotalPrice_List_Xpath_2"), 1, "GETTEXT",4);
		try
		{
			TotalPrice_ListSection_Check.get(0);
		}
		catch(Exception e)
		{
			WebDriverCommonFunctions.PrintinLogAndHTMLReports("List is Empty");
		}
		
	}
	
}
