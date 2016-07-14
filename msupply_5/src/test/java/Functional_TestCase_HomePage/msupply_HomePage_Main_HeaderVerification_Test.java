package Functional_TestCase_HomePage;

import java.util.ArrayList;

import org.testng.annotations.Test;

import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import GenericLibrary.WebDriverCommonFunctions;
import POM.HomePage;
import POM.ShoppingCartPage;
import Scenarios.Scenario1Test;

public class msupply_HomePage_Main_HeaderVerification_Test extends Scenario1Test 
{
	@Test
	public void msupply_HomePage_Main_HeaderVerification() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("Functional_HomePage");
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.EnterZipCode();
		
		
		//Check Popup is displayed
		WebDriverCommonFunctions.element_Present("Popup_Xpath","Image is Displayed","Popup Image not Displayed");
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP");
		
		
		//HomePage Header is Visble or not
		boolean status1=WebDriverCommonFunctions.element_isVisible("HomePage_Header_Xpath", "Home Page Header");
		if(status1==true)
			WebDriverCommonFunctions.PrintinLogAndHTMLReports("Home Page Header Visible");
		else
			WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Home Page Header not Visible");
				
		
//		//Verify Navigation Links
//		WebDriverCommonFunctions.element_MouseOver("Navigation_Shop_Xpath", "Mouse over on Navigation");
//		WebDriverCommonFunctions.element_Collection("Navigation_AllCategory_Xpath",15, true, "All categories Present");
//		WebDriverCommonFunctions.element_Selectproduct_Navigation(1,1,false,"Navigating to the Product list page");
//		WebDriverCommonFunctions.EnterZipCode();
//		
//		String Productname=WebDriverCommonFunctions.element_GetTextFromLabel("ProductName_Xpath");
//			
//		if(Productname.equalsIgnoreCase("BLOCKS"))
//			WebDriverCommonFunctions.PrintinLogAndHTMLReports("Navigated to the Product details page");
//		else
//			WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Not Navigated to the Product details page ");
//				
//		WebDriverCommonFunctions.navigateBack(2);
		
		//Check msupply Logo Image is displayed
		WebDriverCommonFunctions.element_Present("mSupply_Logo_Image_Xpath", "mSupplyLogo Present", "mSupplyLogo not Present");
		
		//Check if logo contains text msupply.com text
		String Text=WebDriverCommonFunctions.element_getTextFromImage("mSupply_Logo_Image_Xpath", "msupply Logo Image Text is :");
		if(Text.contains("Supply.com"))
			WebDriverCommonFunctions.PrintinLogAndHTMLReports("Logo Contains Text : mSupply.com");
		
		//Check if Click on logo redirects to home Page
		WebDriverCommonFunctions.element_Click("HomePage_ShoppingKart_Xpath", "Clicked on Shopping Kart Page");
		WebDriverCommonFunctions.element_Click("mSupply_Logo_Image_Xpath","Clicked on mSupply Logo");
		WebDriverCommonFunctions.element_Collection("Eight_Category_Section_Xpath", 8,true, "All Eight category Section Present on WebPage");
		
		
		//Verify SearchBox
		WebDriverCommonFunctions.element_Present("Search_Box_Xpath", "SearchBox Present", "SearchBox not Present");
		WebDriverCommonFunctions.element_GetTextFromTextField("Search_Box_Xpath", "placeholder", "Because Quality Matters", "Ghost Text Present in SearchBox");
		WebDriverCommonFunctions.element_EnterValuesToTextField("Search_Box_Xpath", "Electrical", "Enetered Value Electrical in SearchBox");
		WebDriverCommonFunctions.element_Click("Search_Box_Button_Xpath", "Clicked on Search Box Button");
		boolean status2=WebDriverCommonFunctions.element_isVisible("MarketingPromos_Xpath_1", "Checking if Search navigated to Product Page");
		if(status2==false)
			WebDriverCommonFunctions.PrintinLogAndHTMLReports("Inside Product Details page");
		else
			WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Not Navigated to Product page from cleo search");
		
		WebDriverCommonFunctions.navigateBack(1);
		
		
		//Verify Contact
		ArrayList<String> Contact=new ArrayList<String>();
		Contact.add("Contact_Header_Xpath");
		WebDriverCommonFunctions.element_MouseOver_TillElementClick(Contact, "Moved to Contact");
	    boolean Contact_1_status=WebDriverCommonFunctions.element_isVisible("Contact_Details_Xpath_1", "Drop Down");
	    boolean Contact_2_status=WebDriverCommonFunctions.element_isVisible("Contact_Details_Xpath_2", "Drop Down");
	    String Contatct_1_no=WebDriverCommonFunctions.element_GetTextFromLabel("Contact_Details_Xpath_1");
	    String Contatct_2_no=WebDriverCommonFunctions.element_GetTextFromLabel("Contact_Details_Xpath_2");
		if(Contact_1_status==true && Contact_2_status==true&&!Contatct_1_no.equals(null)&&!Contatct_2_no.equals(null))
	        WebDriverCommonFunctions.PrintinLogAndHTMLReports("Contact Drop Down is Visible");
		else
			WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Contact Drop Down is not Visible");
		
	    //Verify Email
		ArrayList<String> Email=new ArrayList<String>();
		Email.add("Email_Header_Xpath");
		WebDriverCommonFunctions.element_MouseOver_TillElementClick(Email, "Moved to Email");
	    boolean Email_1_status=WebDriverCommonFunctions.element_isVisible("Email_Details_Xpath_1", "Email Header");
	    boolean Email_2_status=WebDriverCommonFunctions.element_isVisible("Email_Details_Xpath_2", "Email Header");
	    String Email_1=WebDriverCommonFunctions.element_GetTextFromLabel("Email_Details_Xpath_1");
	    String Email_2=WebDriverCommonFunctions.element_GetTextFromLabel("Email_Details_Xpath_2");
	    
		if(Email_1_status==true&&Email_2_status==true&&!Email_1.equals(null)&&!Email_2.equals(null))
	        WebDriverCommonFunctions.PrintinLogAndHTMLReports("Email Drop Down is Visible");
		else
			WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Email Drop Down is not Visible");
		
		
		//verify Account
		ArrayList<String> Account=new ArrayList<String>();
		Account.add("HomePageAccount_Xpath");
		WebDriverCommonFunctions.element_MouseOver_TillElementClick(Account, "Moved to Account");
		boolean Login_1_status=WebDriverCommonFunctions.element_isVisible("HomePageLogin_Xpath", "Drop Down");
	    boolean Signup_2_status=WebDriverCommonFunctions.element_isVisible("HomePageSignIn_Xpath", "Drop Down");
	    String Login=WebDriverCommonFunctions.element_GetTextFromLabel("HomePageLogin_Xpath");
	    String Signup=WebDriverCommonFunctions.element_GetTextFromLabel("HomePageSignIn_Xpath");
	    if(Login_1_status==true && Signup_2_status==true&&!Login.equals(null)&&!Signup.equals(null))
	        WebDriverCommonFunctions.PrintinLogAndHTMLReports("Account Drop Down is Visible");
		else
			WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Account Drop Down is not Visible");
		
		
		//Verify LoginPopup
		ArrayList<String> Loginelements=new ArrayList<String>();
		Loginelements.add("HomePageAccount_Xpath");
		Loginelements.add("HomePageLogin_Xpath");		
		WebDriverCommonFunctions.element_MouseOver_TillElementClick(Loginelements, "Clicked on Login Button");
		WebDriverCommonFunctions.element_VerifyTextAndAssert("LoginPOPUp_Header_Xpath", "Sign in", "Sign In popup present on the WebPage");
		WebDriverCommonFunctions.element_Click("LoginPOPUp_CloseButton_Xpath", "Clicked on Close Button - LoginPopup");
				
		HomePage.mSupplylogin_HomePage();
		WebDriverCommonFunctions.element_VerifyTextAndAssert("HelloText_AfterLogin_Xpath", "Hello", "User Logged into the Website");
	    HomePage.mSupplylogout_HomePage();
	    WebDriverCommonFunctions.element_MouseOver_TillElementClick(Loginelements, "Clicked on Login Button");
		WebDriverCommonFunctions.element_VerifyTextAndAssert("LoginPOPUp_Header_Xpath", "Sign in", "Sign In popup present on the WebPage");
		WebDriverCommonFunctions.element_Click("LoginPOPUp_CloseButton_Xpath", "Clicked on Close Button - LoginPopup");
			
		
		//Verify SignInpopup
		ArrayList<String> NewAccountelements=new ArrayList<String>();
		NewAccountelements.add("HomePageAccount_Xpath");
		NewAccountelements.add("HomePageSignIn_Xpath");		
		WebDriverCommonFunctions.element_MouseOver_TillElementClick(NewAccountelements, "Clicked on SigIn Button");
		WebDriverCommonFunctions.element_VerifyTextAndAssert("SignIn_Header_Xpath", "Create New Account", "Create New Account popup present on the WebPage");
		WebDriverCommonFunctions.element_Click("SignIn_CloseButton_Xpath", "Clicked on Close Button - Create New Account");
		
				
		//Verify Shopping Kart Page
		WebDriverCommonFunctions.element_Click("HomePage_ShoppingKart_Xpath", "Clicked on Shopping kart Page");
		WebDriverCommonFunctions.ExplicitWait();
		WebDriverCommonFunctions.element_VerifyTextAndAssert("ShoppingKart_Header_Xpath","Your Shopping List is empty !", "Navigated to ShoppingKart Page");
		WebDriverCommonFunctions.navigateBack(1);
		
		WebDriverCommonFunctions.element_Selectproduct_Navigation(4, 1, false, "Selected Product-1 from Navigation");
		WebDriverCommonFunctions.element_Click("AddToList_Xpath", "Clicked on Add to List");
		WebDriverCommonFunctions.element_Selectproduct_Navigation(4, 2, false, "Selected Product-2 from Navigation");
		WebDriverCommonFunctions.element_Click("AddToList_Xpath", "Clicked on Add to List");
		WebDriverCommonFunctions.element_Selectproduct_Navigation(4, 3, false, "Selected Product-3 from Navigation");
		WebDriverCommonFunctions.element_Click("AddToList_Xpath", "Clicked on Add to List");
		int CountofProductsBeforeLogin=ShoppingCartPage.getNoOfRowsInKartTable();
		if(CountofProductsBeforeLogin==3)
			WebDriverCommonFunctions.PrintinLogAndHTMLReports("Products are added to the Kart");
		else
			WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Products not added to the Kart");
		
		
		WebDriverCommonFunctions.element_Click("PlaceOrderButton_Xpath", "Clicked on PlaceOrder");
		ShoppingCartPage.mSupplylogin();
		int CountofProductsAfterLogin=ShoppingCartPage.getNoOfRowsInKartTable();
		if(CountofProductsAfterLogin==3)
			WebDriverCommonFunctions.PrintinLogAndHTMLReports("Products are added to the Kart");
		else
			WebDriverCommonFunctions.Print_WithException_inLogAndHTMLReports("Products not added to the Kart");
		
		
		
		
		
		
	}
	

	
	
}
