package SanityTest;

import org.openqa.selenium.support.PageFactory;
import org.testng.annotations.Test;

import GenericLibrary.BrowserSelection;
import POM.HomePage;
import Scenarios.Scenario1Test;

public class Homepage_Test extends Scenario1Test
{
	@Test
	public void HomePage_verification() throws Exception
	{
		Scenario1Test.log.info("WebPage Opened for HomePage verification");
		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
		Scenario1Test.homePageObj.ClickonClosePOPup();
		Scenario1Test.homePageObj.HeaderImageVerification();	
		//Scenario1Test.homePageObj.SlidersVerification();		
		
	}

}
