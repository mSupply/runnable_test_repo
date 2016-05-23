package Functional.TMT_Steel;

import java.io.IOException;
import java.util.concurrent.TimeUnit;

import org.apache.log4j.Logger;
import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.interactions.Actions;
import org.openqa.selenium.support.ui.Select;
import org.testng.Assert;
import org.testng.annotations.BeforeTest;
import org.testng.annotations.Test;

import GenericLibrary.LogReports;
import GenericLibrary.RetrieveXlsxData;

public class TMT_Steel_VerifyQuantityMeasureToggle {
	
	Logger log = LogReports.writeLog(TMT_Steel_VerifyQuantityMeasureToggle.class);
	static WebDriver driver;
	private WebElement selectBrand;
	private WebElement quntityDropdown;
	Select sel; 
	WebElement myListPrice;
	int lowest;
	private WebElement totalEstWeight;
	private WebElement unitEstWeight;
	private WebElement unitEstPrice;
	private String estUnitPrice;
	private String estUnitWeight;
	private String totalWeight;
	private String priceMyList;
	
	@BeforeTest
	public void setUp(){
		driver = new FirefoxDriver();        
		driver.manage().window().maximize();
		driver.get("http://www.msupply.com/");
		driver.manage().timeouts().setScriptTimeout(1, TimeUnit.SECONDS);
	}
	
	@Test
	public void quantityMeasureValidations() throws IOException, Exception{
		driver.findElement(By.xpath("//img[@id='x']")).click();
		Actions action =  new Actions(driver);
		action.moveToElement(driver.findElement(By.xpath("//a[@id='showhide1']/i"))).perform();
		try {
			Thread.sleep(500);
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		action.moveToElement(driver.findElement(By.xpath("//div[@id='menuBLock']/li[2]/a"))).perform();
		try {
			Thread.sleep(500);
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		log.info("navigating to TMT steel");
		navigateDesiredPage();
		
		log.info("Enter 560001 in pincode popup");
		picodePopUp();
		
		log.info("Selecting A-one gold brand");
		selectingBrand();
		log.info("validating default 'Quantity type' selected");
		defaultQuantityValidation();
		log.info("convert MT to Bundle");
		converToBundle();
		log.info("Convert Bundle to Kg");
		converToKG();
	}
	
	public void navigateDesiredPage() throws IOException, Exception{
		 
		String tmtObject = new RetrieveXlsxData().getExcelData("xpath",0,1);
		 driver.findElement(By.xpath(tmtObject)).click();
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
	
	public void defaultQuantityValidation() throws IOException, Exception{
		String expected = "MT";
		log.info("Validating default quantity type is MT");
		String dropdown = new RetrieveXlsxData().getExcelData("xpath",7,3);
		quntityDropdown = driver.findElement(By.xpath(dropdown));
		sel = new Select(quntityDropdown);
		System.out.println(quntityDropdown.getText());
		  WebElement strCurrentValue = sel.getFirstSelectedOption();
		  //Print the Currently selected value
		  System.out.println(strCurrentValue.getText());
		
	
		if(expected.equals(strCurrentValue.getText())){
			System.out.println("Default quantity selected is: "+expected);
		}
		log.info("Default 'Quantity type' validated");
	}
	
	public void converToBundle() throws IOException, Exception{
		driver.findElement(By.xpath("//div[@id='filters']/div/button")).click();
		String eight = new RetrieveXlsxData().getExcelData("xpath", 22, 1);
		
		Thread.sleep(1000);
		driver.findElement(By.xpath("(" + eight + ")[1]")).click();
		driver.findElement(By.xpath("(" + eight + ")[2]")).click();
		
		JavascriptExecutor jse2 = (JavascriptExecutor)driver;
	    jse2.executeScript("window.scrollBy(0,230)","");
		
	    log.info("Clicking on the 'Get Best Price' button");
	    String qButton = new RetrieveXlsxData().getExcelData("xpath", 1, 3);
		driver.findElement(By.xpath(qButton)).click();
		
		log.info("Fetching the price shown in the My List after clicking on the 'Get Best Price' button for quantity in MT");
		
		priceMyList = new RetrieveXlsxData().getExcelData("xpath", 6, 3);
		myListPrice = driver.findElement(By.xpath(priceMyList));
		lowest = getNumber(myListPrice.getText());
		System.out.println(" Lowest price offered : "+lowest);
		
		log.info("Total est. Weight");
		totalWeight = new RetrieveXlsxData().getExcelData("xpath", 8, 3);
		totalEstWeight = driver.findElement(By.xpath(totalWeight));
		
		log.info(" Retrieving the total weight in MT");
		System.out.println(" Total weight in MT: "+totalEstWeight.getText());
		
		log.info("Retrieving unit est weight when Quantity is in MT");
		
		estUnitWeight = new RetrieveXlsxData().getExcelData("xpath", 9, 3);
		unitEstWeight = driver.findElement(By.xpath(estUnitWeight));
		
		System.out.println(unitEstWeight.getText());
		log.info("Retrieving unit price when Quantity is in MT");
		
		estUnitPrice = new RetrieveXlsxData().getExcelData("xpath", 10, 3);
		unitEstPrice = driver.findElement(By.xpath(estUnitPrice));
		System.out.println(unitEstPrice.getText());
		
		log.info("Convert MT to Bundle");
		
		Thread.sleep(2000);
		sel.selectByVisibleText("Bundle");
		
		log.info(" Checking the est. unit weight after conversion");
		System.out.println(" Unit weight after conversion: "+unitEstWeight.getText());
		
		log.info(" Checking the est. unit price after conversion ");
		System.out.println(" Unit Price after conversion: "+unitEstPrice.getText());
		
		log.info("Checking total est. weight after conversion");
		System.out.println(" Total Est. weight after conversion: "+totalEstWeight.getText());
		
		log.info("Checking total price after conversion");
		System.out.println("Total price: "+getNumber(myListPrice.getText()));
		
		
	}
	
	public void converToKG() throws IOException, Exception{
		/*driver.findElement(By.xpath("//div[@id='filters']/div/button")).click();
		String eight = new RetrieveXlsxData().getExcelData("xpath", 22, 1);
		driver.findElement(By.xpath("(" + eight + ")[1]")).click();
		driver.findElement(By.xpath("(" + eight + ")[2]")).click();*/
		
		JavascriptExecutor jse2 = (JavascriptExecutor)driver;
	    jse2.executeScript("window.scrollBy(0,100)","");
		
	    /*log.info("Clicking on the 'Get Best Price' button");
	    String qButton = new RetrieveXlsxData().getExcelData("xpath", 1, 3);
		driver.findElement(By.xpath(qButton)).click();*/
		
		
		log.info("Convert Bundle to Kg ");
		sel.selectByVisibleText("Kg");
		log.info("Fetching the price shown in the My List after selecting quantity in KG");
		priceMyList = new RetrieveXlsxData().getExcelData("xpath", 6, 3);
		myListPrice = driver.findElement(By.xpath(priceMyList));
		lowest = getNumber(myListPrice.getText());
		System.out.println(" Lowest price offered : "+lowest);
		
		log.info("Total est. Weight");
		totalWeight = new RetrieveXlsxData().getExcelData("xpath", 8, 3);
		totalEstWeight = driver.findElement(By.xpath(totalWeight));
		
		log.info(" Retrieving the total weight in Kg");
		System.out.println(" Total weight in Kg: "+totalEstWeight.getText());
		
		log.info("Retrieving unit est weight when Quantity is in Kg");
		
		estUnitWeight = new RetrieveXlsxData().getExcelData("xpath", 9, 3);
		unitEstWeight = driver.findElement(By.xpath(estUnitWeight));
		
		System.out.println(unitEstWeight.getText());
		log.info("Retrieving unit price when Quantity is in Kg");
		
		estUnitPrice = new RetrieveXlsxData().getExcelData("xpath", 10, 3);
		unitEstPrice = driver.findElement(By.xpath(estUnitPrice));
		System.out.println(unitEstPrice.getText());
		
		/*log.info("Convert Bundle to Kg ");
		sel.selectByVisibleText("Kg");
		
		log.info(" Checking the est. unit weight after conversion");
		System.out.println(" Unit weight after conversion: "+unitEstWeight.getText());
		
		log.info(" Checking the est. unit price after conversion ");
		System.out.println(" Unit Price after conversion: "+unitEstPrice.getText());
		
		log.info("Checking total est. weight after conversion");
		System.out.println(" Total Est. weight after conversion: "+totalEstWeight.getText());
		
		log.info("Checking total price after conversion");
		System.out.println("Total price: "+getNumber(myListPrice.getText()));*/
		
		
	}
	public  int getNumber(String str)
	{
		StringBuilder myNumbers = new StringBuilder();
		for (int i = 0; i < str.length(); i++)
		{
		    if (Character.isDigit(str.charAt(i)))
		       {
		           myNumbers.append(str.charAt(i));
		       }
		   
		}
		String Numbers=myNumbers.toString();
		int no=Integer.parseInt(Numbers);
		return no;
	}
}
