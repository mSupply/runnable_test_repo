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


public class LoginForRegisteredUsers extends Scenario1Test
{
	//Login For Registered Users
    @Test
   	public void UserLogin() throws Exception
   	{    	
   		   	
   		Scenario1Test.log.info("WebPage Opened for UserLogin");
   		
   		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
   		   		
   	    //For Existing Users	
   		Scenario1Test.homePageObj.navigatetoLoginPage()
   		           .navigateToInsideLoginPage();
   	}
    

}
