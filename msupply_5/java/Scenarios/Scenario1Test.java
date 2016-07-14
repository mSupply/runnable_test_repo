package Scenarios;

import java.io.File;
import java.io.IOException;
import org.apache.commons.io.FileUtils;
import org.openqa.selenium.OutputType;
import org.openqa.selenium.TakesScreenshot;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.support.PageFactory;
import org.openqa.selenium.support.events.EventFiringWebDriver;
import org.testng.ITestResult;
import org.testng.annotations.AfterTest;
import org.testng.annotations.BeforeTest;
import org.testng.annotations.Test;
import org.testng.asserts.SoftAssert;

import GenericLibrary.*;
import POM.ShoppingCartPage;

public class Scenario1Test
{
    public static WebDriverCommonFunctions wdcf;
    public static RetrieveXlsxData rXlsx;
    public static WebDriver driver;
    public static org.apache.log4j.Logger log;
    public static POM.HomePage homePageObj;
    public static SoftAssert softAssert;
    public static boolean SoftAssert_AfterText;
    @BeforeTest
    public void beforeTestCofig()
    {
    	/*Object initialization*/
    	wdcf = new WebDriverCommonFunctions();
		rXlsx = new RetrieveXlsxData();
		log = LogReports.writeLog(Scenario1Test.class);
		driver=BrowserSelection.selectBrowserDriver("firefox");		
		WebDriverCommonFunctions wb=new WebDriverCommonFunctions();
		wb.maximizingWindow();
		Scenario1Test.wdcf.waitForPageToLoad();
		softAssert = new SoftAssert();
    }   
   
    
    @AfterTest
	public void tearDown() throws Throwable
	{
    	Scenario1Test.softAssert.assertAll();
    	
//    	ShoppingCartPage.removeCartProducts();
//      	driver.quit();
	}
    
}
