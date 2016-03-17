package Scenarios;

import org.testng.annotations.Test;

import GenericLibrary.BrowserSelection;
import POM.HomePage;

import org.testng.annotations.Test;
import org.testng.annotations.Test;
import java.io.IOException;

import org.apache.poi.openxml4j.exceptions.InvalidFormatException;
import org.openqa.selenium.support.PageFactory;
import org.testng.annotations.Test;


public class NewUserRegistration extends Scenario1Test
{

	//New User Registration
    @Test
	public void UserRegistration() throws Exception
	{   	
    	Scenario1Test.log.info("WebPage Opened for UserRegistration");
		
		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
		
		//For New User Registration
		Scenario1Test.homePageObj.navigatetoregisterpage()
		           .navigateToregisteredUserspage();
	}
}
