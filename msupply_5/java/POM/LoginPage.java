package POM;

import java.io.IOException;
import java.util.ArrayList;

import org.apache.log4j.Logger;
import org.apache.poi.openxml4j.exceptions.InvalidFormatException;
import org.openqa.selenium.By;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;
import org.openqa.selenium.support.PageFactory;
import org.testng.Assert;
import org.testng.Reporter;
import org.testng.annotations.Test;

import GenericLibrary.LogReports;
import GenericLibrary.RetrieveXlsxData;
import Scenarios.Scenario1Test;


public class LoginPage 
{

	Logger log = LogReports.writeLog(LoginPage.class);
	
	@FindBy(xpath="//*[@id='lnkAccount']/a")
	WebElement Account;
	
	@FindBy(xpath="//*[@id='divAccount']/ul/li[1]/a")
	WebElement Login;
	
	@FindBy(xpath="//*[@id='magestore-sociallogin-popup-email']")
	WebElement MobileNumbers;
	
	@FindBy(xpath="//*[@id='magestore-sociallogin-popup-pass']	")
	WebElement Password;
	
	@FindBy(xpath="//*[@id='magestore-sociallogin-form']/div[1]/span/input")
	WebElement RememberMeCheckBox;
	
	@FindBy(xpath="//*[@id='magestore-button-sociallogin']")
	WebElement LoginButton;
	
	@FindBy(xpath="//a[@class='button btn-proceed-checkout btn-checkout']")
	WebElement Place_Order;

	@FindBy(xpath="//*[@id='x']")
	WebElement closeIcon;
	
	@FindBy(xpath="//*[@id='lnkAccount']/a")
	WebElement mouseonAccount;
	
	@FindBy(xpath="//*[@id='btnLogin']")
	WebElement LoginButton_HomePage;
	
	@FindBy(xpath="//*[@id='magestore-sociallogin-form']/div[1]/h3")
	WebElement Login_POPUP_SignIn;
	
	@FindBy(xpath="//*[@id='magestore-sociallogin-create-new-customer']/span[2]")
	WebElement Login_POPUP_Registrationlink;
	
	@FindBy(xpath="//*[@id='magestore-sociallogin-form-create']/div[1]/h3")
	WebElement Registration_HeaderText;
		
	@FindBy(xpath="//*[@id='magestore-button-sociallogin-create']")
	WebElement RegisterButton;
	
	@FindBy(xpath="//*[@id='magestore-create-back']")
	WebElement LoginLink_on_Registration;
	
	@FindBy(xpath="//*[@id='magestore-forgot-password']")
	WebElement ForgotPasswordlink;
	
	@FindBy(xpath="//*[@id='magestore-sociallogin-form-forgot']/div[1]/h3")
	WebElement ForgotPassword_HeaderText;
	
	@FindBy(xpath="//*[@id='sociallogin-close-popup']")
	WebElement Close_ForgotPassword_Popup;
	
	@FindBy(xpath="//*[@id='magestore-button-sociallogin-forgot']")
	WebElement Submit_ForgotPassword_Popup;
	
	@FindBy(xpath="//*[@id='divAccount']/ul/li[2]/label/a")
	WebElement Register;
	
	@FindBy(xpath="//*[@id='btnLogout']")
	WebElement LogOut;
	
	public void navigateToInsideLoginPage() throws Exception 
	{
		Scenario1Test.wdcf.waitForPageToLoad();
		
//		log.info("Clicked on Close Icon");
//		closeIcon.click();
		Scenario1Test.wdcf.mouseOverOperation(Account);
		log.info("Moved to Account in Home page");
		Reporter.log("Moved to Account in Home page");
		
		Thread.sleep(500);	
		Login.click();
		log.info("Clicked on Login Button");
		Reporter.log("Clicked on Login Button");
		
		String MobileNumberText=Scenario1Test.rXlsx.getExcelData("Sheet3", 1, 0);
		log.info("Mobile Number is"+MobileNumberText);
		Reporter.log("Mobile Number is"+MobileNumberText);
		
		MobileNumbers.sendKeys(MobileNumberText);
		log.info("Entered Mobile Number");
		Reporter.log("Entered Mobile Number");
		
		String PasswordText=Scenario1Test.rXlsx.getExcelData("Sheet3", 1, 1);
		log.info("Password is"+PasswordText);
		Reporter.log("Password is"+PasswordText);
		
		Password.sendKeys(PasswordText);
		log.info("Entered Password");
		Reporter.log("Entered Password");
		
		LoginButton.click();
		log.info("Clicked on Login Button");
		Reporter.log("Clicked on Login Button");
		
		

		
	}
	
	public void validateLogin() throws Throwable
	{
		//Verify for Null Values
		Scenario1Test.wdcf.mouseOverOperation(Account);
		log.info("Moved to Account in Home page");
		Thread.sleep(500);
		
		Login.click();
		log.info("Clicked on Login Button");
		
		//Verify null values
		LoginButton.click();
		log.info("Clicked on Login Button");
		Thread.sleep(3000);
		Assert.assertEquals(Login_POPUP_SignIn.getText(),"Sign in");
			
		//Verify Registation link in LoginPOPup
		Login_POPUP_Registrationlink.click();
		Thread.sleep(3000);
		Assert.assertEquals(Registration_HeaderText.getText(),"Create New Account");

        //Verify Registration null values
		RegisterButton.click();
		Thread.sleep(3000);
		Assert.assertEquals(Registration_HeaderText.getText(),"Create New Account");
		
		//Verify login popup is displayed
		LoginLink_on_Registration.click();
		Thread.sleep(3000);
		Assert.assertEquals(Login_POPUP_SignIn.getText(),"Sign in");
		
		//Verify ForgotPassword link in loginpage
		ForgotPasswordlink.click();
        Assert.assertEquals(ForgotPassword_HeaderText.getText(),"Forgot Password ?");

        //Verify ForgotPassword with null values
        Submit_ForgotPassword_Popup.click();
        Assert.assertEquals(ForgotPassword_HeaderText.getText(),"Forgot Password ?");
        Close_ForgotPassword_Popup.click();
        
        //Verify with valid data
        Scenario1Test.wdcf.mouseOverOperation(Account);
		log.info("Moved to Account in Home page");
		Thread.sleep(500);
		
		Login.click();
		log.info("Clicked on Login Button");
		
		//Verify Registation link in LoginPOPup
		Login_POPUP_Registrationlink.click();
		Thread.sleep(3000);
		Assert.assertEquals(Registration_HeaderText.getText(),"Create New Account");
        
		//Verify login popup is displayed
		LoginLink_on_Registration.click();
		Thread.sleep(3000);
		Assert.assertEquals(Login_POPUP_SignIn.getText(),"Sign in");
		
		
		verifywithTestData();
		
		
	}
	
	public  void verifywithTestData() throws Throwable
	{	
		ArrayList<String> ErrorMessage=new ArrayList<String>();
		ErrorMessage.add("//*[@id='magestore-invalid-email']");
		ErrorMessage.add("Invalid login or password.");
		ErrorMessage.add("Please enter a valid Password.");
		ErrorMessage.add("Please enter a valid mobile number.");
			
		
		
		int countofRowsExcel=RetrieveXlsxData.rowCount("LoginTestData");
		for(int RowNumber=1;RowNumber<countofRowsExcel;RowNumber++)
		{
		   String TestCaseID=RetrieveXlsxData.getTestCaseID(RowNumber);
	
		   if(TestCaseID.contains("LoginID"))
		   {	   
               String sData[]=RetrieveXlsxData.getExcelData(TestCaseID);
		       String MobileNumberText=sData[1];
		       log.info("Mobile Number is"+MobileNumberText);
		
		       MobileNumbers.sendKeys(MobileNumberText);
		       log.info("Entered Mobile Number");
		
		       String PasswordText=sData[2];
		       log.info("Password is"+PasswordText);
		
		       Password.sendKeys(PasswordText);
		       log.info("Entered Password");
		
		       LoginButton.click();
		       log.info("Clicked on Login Button");
		
		       Thread.sleep(6000);
		       if(RowNumber<5)//For valid login in row-4 no assertion required
		       {	   
		    	  System.out.println(RowNumber);
		          String Errormsg=Scenario1Test.driver.findElement(By.xpath(ErrorMessage.get(0))).getText();
		          Assert.assertEquals(Errormsg, ErrorMessage.get(RowNumber-1));
		          MobileNumbers.clear();
			      Password.clear();
		       }
		       
		      
		   }
		}
	}

	public void validateRegistration() throws Throwable 
	{
	
		//Verify for Null Values
		Thread.sleep(5000);
		Scenario1Test.wdcf.mouseOverOperation(Account);
		log.info("Moved to Account in Home page");
		Thread.sleep(500);
		LogOut.click();
		
		Thread.sleep(2000);
		Scenario1Test.wdcf.mouseOverOperation(Account);
		log.info("Moved to Account in Home page");
		Thread.sleep(500);
		
		Register.click();
		log.info("Clicked on Register Button");
		
	    //Verify Registration null values
		RegisterButton.click();
		Thread.sleep(3000);
		Assert.assertEquals(Registration_HeaderText.getText(),"Create New Account");
		
		//Verify login popup is displayed
		LoginLink_on_Registration.click();
		Thread.sleep(3000);
		Assert.assertEquals(Login_POPUP_SignIn.getText(),"Sign in");
		
		//Verify ForgotPassword link in loginpage
		ForgotPasswordlink.click();
        Assert.assertEquals(ForgotPassword_HeaderText.getText(),"Forgot Password ?");

        //Verify ForgotPassword with null values
        Submit_ForgotPassword_Popup.click();
        Assert.assertEquals(ForgotPassword_HeaderText.getText(),"Forgot Password ?");
        Close_ForgotPassword_Popup.click();
        
	}
	

	public Object PlaceOrderToLoginPage(int option) throws Exception 
	{
		Scenario1Test.wdcf.waitForPageToLoad();

		log.info(".........Inside Cart Page...........");
		Reporter.log(".........Inside Cart Page...........");
		
		
		Place_Order.click();
		String MobileNumberText=Scenario1Test.rXlsx.getExcelData("Sheet3", 1, 0);
		log.info("Mobile Number is"+MobileNumberText);
		Reporter.log("Mobile Number is"+MobileNumberText);
		
		MobileNumbers.sendKeys(MobileNumberText);
		log.info("Entered Mobile Number");
		Reporter.log("Entered Mobile Number");
		
		String PasswordText=Scenario1Test.rXlsx.getExcelData("Sheet3", 1, 1);
		log.info("Password is"+PasswordText);
		Reporter.log("Password is"+PasswordText);
		
		Password.sendKeys(PasswordText);
		log.info("Entered Password");
		Reporter.log("Entered Password");
		LoginButton.click();
		log.info("Clicked on Login Button");
		Reporter.log("Clicked on Login Button");
	
		switch(option)
        {
              case 0 :
       	         return PageFactory.initElements(Scenario1Test.driver, CheckoutPage.class);
            	  
//              case 2 :
//           	      return PageFactory.initElements(Scenario1Test.driver, PaymentNetBanking.class);
//            	  
//              case 3 :
//           	      return PageFactory.initElements(Scenario1Test.driver, PaymentDebitCard.class);
//            	  
//              case 4 :
//           	      return PageFactory.initElements(Scenario1Test.driver, PaymentPayuMoney.class);
//            	  
//              case 5 :
//           	      return PageFactory.initElements(Scenario1Test.driver, PaymentChequeOrDD.class);
//       	 
                case 6 :
                	 return PageFactory.initElements(Scenario1Test.driver, PaymentCashonDelivery.class);
            	 
             default : return null;	 
        }   
		
	}


	
}
