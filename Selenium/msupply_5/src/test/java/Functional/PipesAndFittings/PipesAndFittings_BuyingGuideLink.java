package Functional.PipesAndFittings;

import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.util.Iterator;
import java.util.List;
import java.util.concurrent.TimeUnit;

import org.apache.log4j.Logger;
import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.Keys;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.interactions.Actions;
import org.testng.annotations.BeforeTest;
import org.testng.annotations.Test;

import GenericLibrary.LogReports;
import GenericLibrary.RetrieveXlsxData;
import GenericLibrary.WebDriverCommonFunctions;

public class PipesAndFittings_BuyingGuideLink extends WebDriverCommonFunctions{
	
	Logger log = LogReports.writeLog(PipesAndFittings_BuyingGuideLink.class);
	private WebDriver driver;
	private String menu;
	private WebElement menuBox;
	private String plumbing;
	private WebElement plumbingLink;
	private String pipesFitt;
	private WebElement pipesFittingsLink;
	private String guide;
	private WebElement buyingG;
	private String wPipe;
	private WebElement whatPipe;
	
	@BeforeTest
	public void initialSetUp() {
		driver = new FirefoxDriver();
		driver.manage().window().maximize();
		driver.manage().timeouts().setScriptTimeout(10,TimeUnit.SECONDS);
		driver.get("http://www.msupply.com/");
		driver.findElement(By.xpath("//img[@id='x']")).click();
	}
	
	@Test
	public void validatePipesFittings()throws IOException, Exception{
		
		log.info("Navigating to PipesAndFittingPage");
		navigatingToPipesandFittingPage();
		
		log.info("Handling pincode popup, by entering pincode");
		picodePopUp();
		
		log.info("validating Buying Duide contents");
		buyingGuide();
		
		log.info("Quiting Webdriver");
		driver.quit();
	}
	
   public void navigatingToPipesandFittingPage() throws IOException, Exception{
		
		menu = new RetrieveXlsxData().getExcelData("PipesFittings", 0, 1);
		menuBox = driver.findElement(By.xpath(menu));
		log.info("Clicking On Pipes and Fittings");
		mouseOverOperations(menuBox,driver);
		plumbing = new RetrieveXlsxData().getExcelData("PipesFittings", 1, 1);
		plumbingLink = driver.findElement(By.xpath(plumbing));
		mouseOverOperations(plumbingLink,driver);
		
		pipesFitt = new RetrieveXlsxData().getExcelData("PipesFittings", 2, 1);
		pipesFittingsLink = driver.findElement(By.xpath(pipesFitt));
		Actions at = new Actions(driver);
		at.moveToElement(pipesFittingsLink).click().perform();
	}
	public void picodePopUp() throws InterruptedException{
 		driver.findElement(By.xpath("//div[@id='popup_box']//div/input[@id='popzip']")).sendKeys("560001");
 		Thread.sleep(500);
 		driver.findElement(By.xpath("//div[@id='popup_box']//div/input[@id='go']")).click();
 	}
	
	public void buyingGuide() throws IOException, Exception {
		
		guide = new RetrieveXlsxData().getExcelData("PipesFittings", 7, 1);
		buyingG = driver.findElement(By.xpath(guide));
		
		log.info("Clicking on Buying Guide and validating wheather the Buying Guide Pop Up appears");
		buyingG.click();
		wPipe = new RetrieveXlsxData().getExcelData("PipesFittings", 18, 1);
		whatPipe = driver.findElement(By.xpath(wPipe));
		
		//String test = whatPipe.getText();
		log.info("Validating Wheather the page is scrollable");
		checkAndPrintScrollStatus();
		writeContent(whatPipe);
		log.info("Validated Buying Guide, and closing it");
		/*clIcon = new RetrieveXlsxData().getExcelData("PipesFittings", 8, 1);
		closeButton = driver.findElement(By.xpath(clIcon));
		closeButton.click();*/
		
		Actions mart = new Actions(driver);
		mart.sendKeys(Keys.ESCAPE);
		
	}

	public void writeContent(WebElement webElement) {
		
		String sFilePath = "D:\\Web\\msupply_5\\src\\test\\resources\\Buying Guide.txt"; 
		   try {
		     //Creating File object
		     File file = new File(sFilePath);
		     // if file doesn't exists, then create it
		     if (!file.exists()) {
		      file.createNewFile();
		     }
		     //Creating FileWriter object
		     //using file object we got the filePath
		     FileWriter fw = new FileWriter(file.getAbsoluteFile());
		     //Creating BufferedWriter object
		     BufferedWriter bw = new BufferedWriter(fw);
		     //Writing content into file
		     bw.write(webElement.getText());
		     //Adding new line 
		     bw.newLine();
		     bw.close();
		     System.out.println("Data is Successfully written");

		    } catch (IOException e) {
		     e.printStackTrace();
		    }
		
	}
	
	public void checkAndPrintScrollStatus(){ 
		JavascriptExecutor javascript = (JavascriptExecutor) driver; 
		//Check If horizontal scroll Is present or not. 
		Boolean b1 = (Boolean) javascript.executeScript("return document.documentElement.scrollWidth>document.documentElement.clientWidth;"); 
		//Check If vertical scroll Is present or not. 
		Boolean b2 = (Boolean) javascript.executeScript("return document.documentElement.scrollHeight>document.documentElement.clientHeight;"); 
		if (b1 == true && b2 == true) { 
		System.out.println("Horizontal and vertical Scrollbar is present on page."); 
		} 
		else if (b1 == false && b2 == true) { 
		System.out.println("Horizontal Scrollbar not present on page."); 
		System.out.println("Vertical Scrollbar is present on page."); 
		}else if (b1 == true && b2 == false) { 
		System.out.println("Horizontal Scrollbar Is present on page."); 
		System.out.println("Vertical Scrollbar not present on page."); 
		}else if (b1 == false && b2 == false) { 
		System.out.println("Horizontal and Vertical Scrollbar not present on page."); 
		} 
		System.out.println("<----------x--------x--------->"); 
		} 
}
