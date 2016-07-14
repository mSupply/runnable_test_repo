package Functional_TestCase_HomePage;

import java.util.ArrayList;

import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.NoSuchElementException;
import org.openqa.selenium.WebElement;
import org.testng.Assert;
import org.testng.annotations.Test;
import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import GenericLibrary.WebDriverCommonFunctions;
import POM.BrokenLinks;
import POM.HomePage;
import SanityTest.Homepage_Test;
import Scenarios.Scenario1Test;

public class mSupply_HomePage_004_And_005_Test extends Scenario1Test
{
	
	@Test
	public void mSupply_HomePage_004_And_005() throws Throwable
	{
		Credentials.url=CommonFunctions.readPropertiesFile("Functional_HomePage");
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP");
		HomePage.ValidateLinks_HomePage();		
		//BrokenLinks.HomePageLinksTest();		
		
		
		
		//======================================Error Found=====================================================
		
		
		for(int i=0;i<HomePage.SliderNo.size();i++)
		{
			WebDriverCommonFunctions.PrintinLogAndHTMLReports("=======Error at Sliders : ======== : Product Information not found OR Best Price Not calculated"+ HomePage.SliderNo.get(i)+": Product Number => "+HomePage.ProductNo.get(i));
		}
		
		Scenario1Test.softAssert.assertAll();
		
		//======================================================================================================
		
		
	}

}
