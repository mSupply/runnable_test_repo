package Functional.PipesAndFittings;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Iterator;
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

public class PipesAndFittings_ValidatingBrandSelection {
	
	Logger log = LogReports.writeLog(PipesAndFittings_ValidatingBrandSelection.class);
	private WebDriver driver;
	private String menu;
	private WebElement menuBox;
	private String plumbing;
	private WebElement plumbingLink;
	private String pipesFitt;
	private WebElement pipesFittingsLink;
	private String dia;
	private WebElement diameter;
	private String quantDia;
	private WebElement diameterQty;
	private String pressureO;
	private WebElement selectPressure;
	private WebElement fndProduct;
	private String brand;
	private WebElement brandWebElement;
	private String fndProd;
	private WebElement frndProdButton;
	private String create;
	private List<WebElement> createList;
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
		
		log.info("Selecting Diameter and Pressure");
		selectDiameterPressure();
		
		log.info("Validating we can select one brand at one time");
		selectBrand();
	}
	
	public void selectBrand() throws IOException, Exception {
		
		log.info("Verifying wheather any brand is auto selected");
		brand = new RetrieveXlsxData().getExcelData("PipesFittings", 11, 1);
		brandWebElement = driver.findElement(By.xpath(brand));
		
		Select sel = new Select(brandWebElement);
	
		if (sel.getFirstSelectedOption().getText().equals("Select")) {
			System.out.println("No the Brand value is not auto selected");
		}
		
		log.info("Validating wheather we can select two brands at a time");
		log.info("Selecting Supreme");
		sel.selectByVisibleText("Supreme");
		log.info("Clicking Find Product");
		
		fndProd = new RetrieveXlsxData().getExcelData("PipesFittings", 12, 1);
		frndProdButton = driver.findElement(By.xpath(fndProd));
		
		frndProdButton.click();
		
		log.info("Retrieving products displayed in below Create your list");
		create = new RetrieveXlsxData().getExcelData("PipesFittings", 19, 1);
		createList = driver.findElements(By.xpath(create));
		List<WebElement> products = new ArrayList<>();
		for (Iterator iterator = createList.iterator(); iterator.hasNext();) {
			WebElement webElement = (WebElement) iterator.next();
			products.add(webElement);
		}
		System.out.println("Products present in Create your list"+products);
		
		log.info("Changing the brand");
		sel.selectByVisibleText("Astral");
		
		log.info("Validating if the products in Create your list get removed");
		
		if (createList.size() == 0) {
			System.out.println("Yes we cannot add multiple brand at a time");
		}
	}


	public void selectDiameterPressure() throws IOException, Exception {
		
		dia = new RetrieveXlsxData().getExcelData("PipesFittings", 10, 1);
		diameter = driver.findElement(By.xpath(dia));
		
		log.info("Selecting inch in diameter");
		new WebDriverCommonFunctions().select(diameter, "mm");
		
		log.info("Selecting how much diameter");
		quantDia = new RetrieveXlsxData().getExcelData("PipesFittings", 5, 1);
		diameterQty = driver.findElement(By.xpath(quantDia));
		Select sel = new Select(diameterQty);
		sel.selectByValue("15 mm");
		
		log.info("Diameter validated");
		
		log.info("Selecting Pressure");
		pressureO = new RetrieveXlsxData().getExcelData("PipesFittings", 6, 1);
		selectPressure = driver.findElement(By.xpath(pressureO));
		new WebDriverCommonFunctions().select(selectPressure, "10 kg/cm2");
		
	}


	public void navigatingToPipesandFittingPage() throws IOException, Exception{
		
		menu = new RetrieveXlsxData().getExcelData("PipesFittings", 0, 1);
		menuBox = driver.findElement(By.xpath(menu));
		log.info("Clicking On Pipes and Fittings");
		new WebDriverCommonFunctions().mouseOverOperations(menuBox,driver);
		plumbing = new RetrieveXlsxData().getExcelData("PipesFittings", 1, 1);
		plumbingLink = driver.findElement(By.xpath(plumbing));
		new WebDriverCommonFunctions().mouseOverOperations(plumbingLink,driver);
		
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
