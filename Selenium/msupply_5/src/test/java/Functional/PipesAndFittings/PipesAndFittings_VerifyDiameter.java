package Functional.PipesAndFittings;

import java.io.IOException;
import java.util.List;
import java.util.concurrent.TimeUnit;

import org.apache.log4j.Logger;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.interactions.Actions;
import org.openqa.selenium.support.ui.Select;
import org.testng.annotations.BeforeTest;
import org.testng.annotations.Test;

import GenericLibrary.LogReports;
import GenericLibrary.RetrieveXlsxData;
import GenericLibrary.WebDriverCommonFunctions;

public class PipesAndFittings_VerifyDiameter extends WebDriverCommonFunctions{

	Logger log = LogReports.writeLog(PipesAndFittings_VerifyDiameter.class);
	private WebDriver driver;
	private String menu;
	private WebElement menuBox;
	private String plumbing;
	private WebElement plumbingLink;
	private String pipesFitt;
	private WebElement pipesFittingsLink;
	private String dia;
	private WebElement diameter;
	private List<WebElement> measures;
	private String mnsd;
	
	
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
		
		log.info("Verifying what are the diameter measures available for Pipes and Fittings");
		measuresDiameter();
		
		log.info(" Validating wheather 'mm' is auto selected by deafault");
		defaultMeasureSelected();
		
	}
	
	public void defaultMeasureSelected() {
		
		
		Select sel = new Select(diameter);
		WebElement WebElement = sel.getFirstSelectedOption();
		System.out.println("The default diameter measure selected is: "+WebElement.getText());
	}


	public void measuresDiameter() throws IOException, Exception {
		StringBuilder sb =  new StringBuilder();
		dia = new RetrieveXlsxData().getExcelData("PipesFittings", 10, 1);
		diameter = driver.findElement(By.xpath(dia));
		Select select = new Select(diameter);
		measures = select.getOptions();
		log.info("Retrieving all the measures available for Diameter");
		for (int i = 0; i < measures.size(); i++) {
			String webElement = measures.get(i).getText();
			sb.append(webElement+ " ,");
			System.out.println(sb);
			
		}
		String data = sb.toString();
		data.trim();
		int length = data.length();
		data = data.substring(0,length - 1) + " ";
		System.out.println("Measures: "+data);
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
}
