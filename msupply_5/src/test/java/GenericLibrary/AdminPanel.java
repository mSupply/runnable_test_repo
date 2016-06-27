package GenericLibrary;

import org.openqa.selenium.WebElement;

import Scenarios.Scenario1Test;

public class AdminPanel 
{
	
	public static void login_AdminPanel() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("AdminPanel");
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.element_Click("ClickHere_LinkText_LinkText", "Click on the Link");
		WebDriverCommonFunctions.element_EnterValuesToTextField("AdminPanel_Email_Xpath","admin_qa@msupply.com","Entered Email");
		WebDriverCommonFunctions.element_EnterValuesToTextField("AdminPanel_PasswordField_Xpath","123456","Entered Password");
		WebDriverCommonFunctions.element_Click("AdminPanel_LoginButton_Xpath", "Clicked on Login Button");
		
	}
	public static void changeOrderToDelivered(int OrderNumber) throws Throwable
	{
		WebDriverCommonFunctions.element_Click("ManageOrder_Xpath", "Clicked on Manage Order");
		WebElement element=WebDriverCommonFunctions.Table_SearchForElement(CommonFunctions.getElementFromExcel("Xpath_Part_1"),CommonFunctions.getElementFromExcel("Xpath_Part_2"),1,OrderNumber);
		if(element==null)
		{
			WebDriverCommonFunctions.PrintinLogAndHTMLReports("No Order Number generated");
		}
		else
		{
			element.click();
		}
		
		WebDriverCommonFunctions.element_Click("AdminPanel_ConfirmButton_Xpath", "Clicked on Confirm Button");
		WebDriverCommonFunctions.element_Click("AdminPanel_UpdateButton_Xpath","Clicked on UpdateButton");
		WebDriverCommonFunctions.element_SelectDropDown("AdminPanel_SelectDropDown_Xpath", 1, "Success Option Selected");
		WebDriverCommonFunctions.element_Click("AdminPanel_UpdateButton_1_Xpath","Clicked on UpdateButton");
		WebDriverCommonFunctions.element_Click("AdminPanel_AcceptButton_Xpath", "Clicked on Accept Button");
		WebDriverCommonFunctions.element_Click("AdminPanel_ReadyToShipButton_Xpath", "Clicked on ReadyToShip Button");
		WebDriverCommonFunctions.element_Click("AdminPanel_ShipOrderButton_Xpath", "Clicked on ShipOrder Button");
		WebDriverCommonFunctions.element_Click("AdminPanel_DeliverButton_Xpath", "Clicked on ShipOrder Button");
	}

}
