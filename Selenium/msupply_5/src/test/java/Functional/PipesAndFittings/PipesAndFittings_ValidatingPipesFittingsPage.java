package Functional.PipesAndFittings;

import java.io.IOException;
import java.util.Iterator;
import java.util.List;
import java.util.concurrent.TimeUnit;

import org.apache.log4j.Logger;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.interactions.Action;
import org.openqa.selenium.interactions.Actions;
import org.openqa.selenium.support.ui.Select;
import org.testng.annotations.BeforeTest;
import org.testng.annotations.Test;

import GenericLibrary.LogReports;
import GenericLibrary.RetrieveXlsxData;
import GenericLibrary.WebDriverCommonFunctions;

public class PipesAndFittings_ValidatingPipesFittingsPage extends WebDriverCommonFunctions{
	
	Logger log = LogReports.writeLog(PipesAndFittings_ValidatingPipesFittingsPage.class);
	private WebDriver driver;
	private String menu;
	private WebElement menuBox;
	private String plumbing;
	private WebElement plumbingLink;
	private String pipesFitt;
	private WebElement pipesFittingsLink;
	private String pageInfo;
	private String bedcrum;
	private List<WebElement> bedcrumBlock;
	private String guide;
	private WebElement buyingG;
	private String clIcon;
	private WebElement closeButton;
	private String wPipe;
	private WebElement whatPipe;
	private String dia;
	private WebElement diameter;
	private String quantDia;
	private WebElement diameterQty;
	private String brandXpath;
	private WebElement selectBrand;
	private String findP;
	private WebElement fndProduct;
	private String error;
	private WebElement errorMsg;
	private String pressureO;
	private WebElement selectPressure;
	private String add;
	private List<WebElement> addButton;
	private String plunB;
	private List<WebElement> listPlumBox;
	private String quantityP;
	private WebElement increaseQuantity;
	private String getPrice;
	private WebElement getBestPriceB;
	
	
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
		log.info("Validating If we are in Pipes and Fittings page");
		
		pageInfo = driver.getTitle();
		System.out.println("Page Title: "+pageInfo);
		
		log.info("Validating Breadcrum block");
		validatingBreadcrumBlock();
		
		log.info("Validating Buying Guide");
		buyingGuide();
		
		log.info("Validating Select Diameter");
		selectDiameter();
		
		log.info("Validating Brand option");
		selectBrand();
		
		log.info("Clicking on Find Product without selecting Pressure");
		validatingPressureError();
		
		log.info("Validating Pressure option");
		selectPressure();
		
		log.info("Selecting related fittings");
		selectFittings();
		
		log.info("Validating if the product is added in My List");
		myListRelated();
		
		log.info("Increasing the quantity of the product");
		increaseQuantity();
		
		log.info("Clicking on Get Best Price");
		clickGetBestPrice();
	}
	
	public void clickGetBestPrice() throws IOException, Exception {
		
		log.info("Clicking on the GetBestPrice button");
		getPrice = new RetrieveXlsxData().getExcelData("PipesFittings", 17, 1);
		getBestPriceB = driver.findElement(By.xpath(getPrice));
		getBestPriceB.click();
	}

	public void increaseQuantity() throws IOException, Exception {
		
		quantityP = new RetrieveXlsxData().getExcelData("PipesFittings", 16, 1);
		increaseQuantity = driver.findElement(By.xpath(quantityP));
		
		log.info("Increasing the product by 500");
		increaseQuantity.clear();
		
		increaseQuantity.sendKeys("500");
	}

	public void myListRelated() throws IOException, Exception {
		
		plunB = new RetrieveXlsxData().getExcelData("PipesFittings", 15, 1);
		listPlumBox = driver.findElements(By.xpath(plunB));
		
		for (int i = 0; i < listPlumBox.size(); i++) {
			
			if (listPlumBox.size()>0) {
				System.out.println(" Yes the product has been succesfully added to My List");
				break;
			}
		}
	}

	public void selectFittings() throws IOException, Exception {
		
		log.info("Adding a product to My List");
		
		add = new RetrieveXlsxData().getExcelData("PipesFittings", 14, 1);
		addButton = driver.findElements(By.xpath(add));
		
		for (int i = 0; i < addButton.size();) {
			addButton.get(i).click();
			break;
		}
	}

	public void selectPressure() throws IOException, Exception {
		
		log.info("Selecting Pressure");
		pressureO = new RetrieveXlsxData().getExcelData("PipesFittings", 6, 1);
		selectPressure = driver.findElement(By.xpath(pressureO));
		new WebDriverCommonFunctions().select(selectPressure, "10 kg/cm2");
		
		log.info("Clicking on the Find Product button");
		fndProduct.click();
	}

	public void validatingPressureError() throws IOException, Exception {
		
		log.info("Clicking on Find Product button");
		findP = new RetrieveXlsxData().getExcelData("PipesFittings", 12, 1);
		fndProduct = driver.findElement(By.xpath(findP));
		fndProduct.click();
		
		log.info("Validating wheather error message appears when we click on Find product button without selecting pressure");
		error = new RetrieveXlsxData().getExcelData("PipesFittings", 13, 1);
		errorMsg = driver.findElement(By.xpath(error));
		System.out.println(" Error message above Find Product button: "+errorMsg.getText());
		
	}

	public void selectBrand() throws IOException, Exception {
		
		brandXpath = new RetrieveXlsxData().getExcelData("PipesFittings", 11, 1);
		selectBrand = driver.findElement(By.xpath(brandXpath));
		new WebDriverCommonFunctions().select(selectBrand, "Supreme");
	}

	public void selectDiameter() throws IOException, Exception {
		
		dia = new RetrieveXlsxData().getExcelData("PipesFittings", 10, 1);
		diameter = driver.findElement(By.xpath(dia));
		
		log.info("Selecting inch in diameter");
		new WebDriverCommonFunctions().select(diameter, "inch");
		
		log.info("Selecting how much diameter");
		quantDia = new RetrieveXlsxData().getExcelData("PipesFittings", 5, 1);
		diameterQty = driver.findElement(By.xpath(quantDia));
		Select sel = new Select(diameterQty);
		sel.selectByValue("1");
		
		log.info("Diameter validated");
	}

	public void buyingGuide() throws IOException, Exception {
		
		guide = new RetrieveXlsxData().getExcelData("PipesFittings", 7, 1);
		buyingG = driver.findElement(By.xpath(guide));
		
		log.info("Clicking on Buying Guide and validating wheather the Buying Guide Pop Up appears");
		buyingG.click();
		wPipe = new RetrieveXlsxData().getExcelData("PipesFittings", 9, 1);
		whatPipe = driver.findElement(By.xpath(wPipe));
		System.out.println("The very first heading from Buying Guide frame is "+whatPipe.getText());
		
		log.info("Validated Buying Guide, and closing it");
		clIcon = new RetrieveXlsxData().getExcelData("PipesFittings", 8, 1);
		closeButton = driver.findElement(By.xpath(clIcon));
		closeButton.click();
		
	}

	public void validatingBreadcrumBlock() throws IOException, Exception {
	
		bedcrum = new RetrieveXlsxData().getExcelData("PipesFittings", 3, 1);
		bedcrumBlock = driver.findElements(By.xpath(bedcrum));
		
		StringBuilder sb =  new StringBuilder();
		for (Iterator iterator = bedcrumBlock.iterator(); iterator.hasNext();) {
			
			WebElement webElement = (WebElement) iterator.next();
			sb.append(webElement.getText() + " > ");
			System.out.println(sb);
		}
		String data = sb.toString();
		data.trim();
		int length = data.length();
		data = data.substring(0,length - 2) + " ";
		System.out.println(data);
		
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
