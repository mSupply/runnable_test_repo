package POM;

import java.io.IOException;
import org.apache.log4j.Logger;
import org.apache.poi.openxml4j.exceptions.InvalidFormatException;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;
import org.openqa.selenium.support.PageFactory;

import GenericLibrary.LogReports;
import Scenarios.Scenario1Test;

public class RegistrationPage 
{
	Logger log = LogReports.writeLog(RegistrationPage.class);
	
	@FindBy(xpath="//*[@id='firstname']")
	WebElement Firstname;
	
	@FindBy(xpath="//*[@id='lastname']")
	WebElement Lasttname;
	
	@FindBy(xpath="//*[@id='mobile']")
	WebElement MobileNumber;
	
	@FindBy(xpath="//*[@id='email_address']")
	WebElement Email;
	
	@FindBy(xpath="//*[@id='password']")
	WebElement Password;
	
	@FindBy(xpath="//*[@id='confirmation']")
	WebElement ConfirmPassword;
	
	@FindBy(xpath="//*[@id='primary_select']")
	WebElement UserType1DropDown;
	
	
	@FindBy(xpath="//*[@id='form-validate']/div/ul[2]/li[4]/div/dl/dt/a/p")
	WebElement UserType2DropDown;
	
	@FindBy(xpath="//*[@id='Apartment Association Representative']")
	WebElement UserType2DropDownCheck1;
	
	@FindBy(xpath="//*[@id='terms']")
	WebElement TermsCheckBox;
	
	@FindBy(xpath="//*[@id='form-validate']/div/ul[2]/li[8]/input")
	WebElement RecieveOfferCheckBox;
	
	@FindBy(xpath="//*[@id='form-validate']/div/ul[2]/li[9]/button")
	WebElement RegisterButton;
	

	
	public void navigateToregisteredUserspage() throws Exception 
	{
		String Firstnametext=Scenario1Test.rXlsx.getExcelData("Sheet2", 1, 0);
		Firstname.sendKeys(Firstnametext);
		
		String Lastnametext=Scenario1Test.rXlsx.getExcelData("Sheet2", 1, 1);
		Lasttname.sendKeys(Lastnametext);
		
		String MobileNumbertext=Scenario1Test.rXlsx.getExcelData("Sheet2", 1, 2);
		MobileNumber.sendKeys(MobileNumbertext);
		
		String EmailText=Scenario1Test.rXlsx.getExcelData("Sheet2", 1, 3);
		Email.sendKeys(EmailText);
		
		String PasswordText=Scenario1Test.rXlsx.getExcelData("Sheet2", 1, 4);
		Password.sendKeys(PasswordText);
		
		
		String ConfirmPasswordText=Scenario1Test.rXlsx.getExcelData("Sheet2", 1, 5);
		ConfirmPassword.sendKeys(ConfirmPasswordText);
		
		String UserType1=Scenario1Test.rXlsx.getExcelData("Sheet2", 1, 6);
		int type1=Integer.parseInt(UserType1);
		Scenario1Test.wdcf.select(UserType1DropDown, type1);
		
		UserType2DropDown.click();
		Thread.sleep(2000);
		
		UserType2DropDownCheck1.click();
		Thread.sleep(2000);
		
		UserType2DropDown.click();
		Thread.sleep(2000);
		
		TermsCheckBox.click();
		
		RecieveOfferCheckBox.click();
		Thread.sleep(2000);
		        
		//Scroll down to click on Register Button since the element is not visible 
        JavascriptExecutor jse = (JavascriptExecutor)Scenario1Test.driver;
        jse.executeScript("window.scrollBy(0,250)", "");
        
		RegisterButton.click();

	}
}
