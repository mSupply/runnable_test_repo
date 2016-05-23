package Functional.TMT_Steel;

import java.io.IOException;
import java.util.List;
import java.util.concurrent.TimeUnit;

import org.apache.log4j.Logger;
import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.testng.Assert;
import org.testng.annotations.BeforeTest;
import org.testng.annotations.Test;

import GenericLibrary.LogReports;
import GenericLibrary.RetrieveXlsxData;

public class TMT_Steel_VerifyPricesQuantity {
	
	Logger log = LogReports.writeLog(TMT_Steel_VerifyPricesQuantity.class);
	private WebElement selectBrand;
	private String valueIncrease;
	private List<WebElement> increaseProduct;
	private String prodName;
	private List<WebElement> prodMyList;
	private String prodNameList;
	private String price;
	private List<WebElement> variantPrices;
	private String remIco;
	private List<WebElement> remTcons;
	private WebElement closeIcon;
	private String val;
	private List<WebElement> valuesVar;
	private WebElement quantiVal;
	private String unitPr;
	private WebElement unitPrices;
	private static WebDriver driver;
	
	@BeforeTest
	public void setUp(){
		driver = new FirefoxDriver();        
		driver.manage().window().maximize();
		driver.get("http://www.msupply.com/building-material/tmt-steel.html");
		driver.manage().timeouts().setScriptTimeout(1, TimeUnit.SECONDS);
	}
	
	@Test
	public void validatePricesAndQuantity() throws IOException, Exception{
		
		log.info("Handling Pincode pop up");
		picodePopUp();
		
		log.info("Selecting Brand");
		selectingBrand();
		
		log.info("Finding brand products");
		findBrandProducts();
		
		log.info("Adding the products to My List");
		addProductToList();
		
		removeVariant();
	}
	
	public static void picodePopUp(){
 		driver.findElement(By.xpath("//div[@id='popup_box']//div/input[@id='popzip']")).sendKeys("560001");
 		driver.findElement(By.xpath("//div[@id='popup_box']//div/input[@id='go']")).click();
 	}
	
	public void selectingBrand() throws IOException, Exception{
		String aOneGold = new RetrieveXlsxData().getExcelData("xpath",2,1);
		selectBrand = driver.findElement(By.xpath(aOneGold));
		if (selectBrand.isEnabled()) {
			selectBrand.click();
		}
		Thread.sleep(500);
		String message = "brand is selected";
		Assert.assertTrue(selectBrand.isEnabled());
		System.out.println(message);
	}
	
	public void findBrandProducts() throws IOException, Exception {
		System.out.println("click");
		/*Thread.sleep(500);
		driver.findElement(By.xpath(new RetrieveXlsxData().getExcelData("xpath",19,1))).click();*/
		String findBTN = new RetrieveXlsxData().getExcelData("xpath",19,1);
		driver.findElement(By.xpath(findBTN)).click();
	}
	
	public void addProductToList() throws IOException, Exception{
		
		Thread.sleep(1000);
		driver.findElement(By.xpath("//div[@id='filters']/div/button")).click();
		String eight = new RetrieveXlsxData().getExcelData("xpath", 22, 1);
		
		Thread.sleep(1000);
		for (int i = 1; i < 4; i++) {
			driver.findElement(By.xpath("(" + eight + ")["+i+"]")).click();
		}
		Thread.sleep(1000);
		
		valueIncrease = new RetrieveXlsxData().getExcelData("xpath",15,3);
		increaseProduct = driver.findElements(By.xpath(valueIncrease));
		for (int i = 0; i < increaseProduct.size(); i++) {
			increaseProduct.get(i).click();
		}
		
		val = new RetrieveXlsxData().getExcelData("xpath",16,3);
		valuesVar = driver.findElements(By.xpath(val));
		
		for (int i = 0; i < valuesVar.size(); i++) {
			System.out.println(valuesVar.size());
			quantiVal = valuesVar.get(i);
			for (int j = 1; j <= valuesVar.size(); j++) {
				if (valuesVar.get(i).getAttribute("value").equals(valuesVar.get(j).getAttribute("value"))) {
					System.out.println("The quantity of variant: "+j+1+" is "+quantiVal.getAttribute("value") );
				}
			}
		}
		JavascriptExecutor jse2 = (JavascriptExecutor)driver;
	    jse2.executeScript("window.scrollBy(0,230)","");
		
	    Thread.sleep(1000);
	    log.info("Clicking on the 'Get Best Price' button");
	    String qButton = new RetrieveXlsxData().getExcelData("xpath", 1, 3);
		driver.findElement(By.xpath(qButton)).click();
		
		}
	
	@SuppressWarnings("unused")
	public void removeVariant() throws IOException, Exception{
		String priceO;
		
		log.info("Retrieving the prices of each variants added in My List");
		
		price = new RetrieveXlsxData().getExcelData("xpath", 24, 3);
		variantPrices = driver.findElements(By.xpath(price));
		
		for (int i = 0; i < variantPrices.size(); i++) {
			priceO = variantPrices.get(i).getText();
			for (int j = 1; j < variantPrices.size(); j++) {
				if (priceO.equals(variantPrices.get(j).getText())) {
					System.out.println(" Prices of all the variants are same "+priceO);
				}
				
			}
			break;
		}
		
		
		log.info("Now remove the one variant from the My List");
		
		remIco = new RetrieveXlsxData().getExcelData("xpath", 25, 3);
		
		
		prodName = new RetrieveXlsxData().getExcelData("xpath", 19, 3);
		prodMyList = driver.findElements(By.xpath(prodName));
		
		
		log.info("Removing one of the variants added in My List");
		
		for (int i = 0; i < prodMyList.size(); i++) {
			
			System.out.println("Removing the variant with the name: "+prodMyList.get(i).getText());
			
			break;
		}
		
		System.out.println(remIco);
		driver.findElement(By.xpath(remIco)).click();
		log.info("Checking if quantities remain unchange even after we try to remove variant from My List");
		System.out.println(quantiVal.getAttribute("value"));
		
		log.info("Yes we quantities did not change");
		
		log.info("Validating if prices reset to Zero");
		
		unitPr = new RetrieveXlsxData().getExcelData("xpath", 10, 3);
		unitPrices = driver.findElement(By.xpath(unitPr));
		if (!unitPrices.isDisplayed()) {
			System.out.println("The prices after removing a variant is not available");
		}
		log.info("Prices disappears");
	}
	
	
}
