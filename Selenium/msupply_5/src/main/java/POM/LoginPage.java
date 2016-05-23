package POM;

import java.io.IOException;

import org.apache.log4j.Logger;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;
import org.openqa.selenium.support.PageFactory;
import org.testng.annotations.Test;

import GenericLibrary.LogReports;
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
	
		
	public void navigateToInsideLoginPage() throws Exception 
	{
		Scenario1Test.wdcf.waitForPageToLoad();
		
//		log.info("Clicked on Close Icon");
//		closeIcon.click();
		Scenario1Test.wdcf.mouseOverOperation(Account);
		log.info("Moved to Account in Home page");
		Thread.sleep(500);	
		Login.click();
		log.info("Clicked on Login Button");
		String MobileNumberText=Scenario1Test.rXlsx.getExcelData("Sheet3", 1, 0);
		log.info("Mobile Number is"+MobileNumberText);
		MobileNumbers.sendKeys(MobileNumberText);
		log.info("Entered Mobile Number");
		String PasswordText=Scenario1Test.rXlsx.getExcelData("Sheet3", 1, 1);
		log.info("Password is"+PasswordText);
		Password.sendKeys(PasswordText);
		log.info("Entered Password");
		LoginButton.click();
		log.info("Clicked on Login Button");
		

		
	}
	public Object PlaceOrderToLoginPage(int option) throws Exception 
	{
		Scenario1Test.wdcf.waitForPageToLoad();

		log.info(".........Cart Page...........");
		Place_Order.click();
		String MobileNumberText=Scenario1Test.rXlsx.getExcelData("Sheet3", 1, 0);
		log.info("Mobile Number is"+MobileNumberText);
		MobileNumbers.sendKeys(MobileNumberText);
		log.info("Entered Mobile Number");
		String PasswordText=Scenario1Test.rXlsx.getExcelData("Sheet3", 1, 1);
		log.info("Password is"+PasswordText);
		Password.sendKeys(PasswordText);
		log.info("Entered Password");
		LoginButton.click();
		log.info("Clicked on Login Button");
	
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
