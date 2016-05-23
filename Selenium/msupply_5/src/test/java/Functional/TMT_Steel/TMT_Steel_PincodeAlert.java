package Functional.TMT_Steel;

import java.io.IOException;
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

public class TMT_Steel_PincodeAlert {
	
	
	Logger log = LogReports.writeLog(TMT_Steel_ChangeSeller.class);
	private WebElement selectBrand;
	private String valueIncrease;
	private WebElement increaseProduct;
	private String button;
	private WebElement buyButton;
	private String prodName;
	private WebElement prodMyList;
	private String shoppingProd;
	private WebElement prodNameShopping;
	private String prodNameList;
	private String pincod;
	private WebElement pincodTxtBox;
	private String check;
	private WebElement checkButton;
	private String expected;
	private String abov;
	private WebElement aboveGetBtn;
	private String aboveMsg;
	private String belo;
	private WebElement beloPinCod;
	private String belowMsg;
	static WebDriver driver;
	
	@BeforeTest
	public void setUp(){
		driver = new FirefoxDriver();        
		driver.manage().window().maximize();
		driver.get("http://www.msupply.com/building-material/tmt-steel.html");
		driver.manage().timeouts().setScriptTimeout(1, TimeUnit.SECONDS);
	}
	
	@Test
	public void validatePincodeScenario() throws IOException, Exception{
		
		log.info("Handling Pincode pop up");
		picodePopUp();
		
		log.info("Selecting Brand");
		selectingBrand();
		
		log.info("Finding brand products");
		findBrandProducts();
		
		log.info("Adding the products to My List");
		addProductToList();
		
		log.info("Validating Wheather the product added in My List, and after clicking on Buy button is added in the ShoppingList");
		productShopplingList();
		
		log.info("Going back and adding another product for different area pincode");
		diffPincodeArea();
	}
	
	public void diffPincodeArea() throws IOException, Exception {
		
		log.info("Navigating back to TMT_Steel page");
		driver.navigate().back();
		
		log.info("Selecting Brand");
		selectingBrand();
		
		log.info("Finding brand products");
		findBrandProducts();
		
		log.info("Adding the products to My List");
		addProductAgain();
		
		log.info("Validating Error msg when we try to add products for different areaCode");
		changePincode();
		
		validateErrorMsg();
	}

	public void productShopplingList() throws IOException, Exception {
		
		log.info("Clicking on the Buy button");
		Thread.sleep(1000);
		button = new RetrieveXlsxData().getExcelData("xpath",17,3); 
		buyButton = driver.findElement(By.xpath(button));
		buyButton.click();
		
		log.info("On click we will be directed to Shopping list page");
		System.out.println("We are now in"+driver.getTitle()+"page");
		
		log.info("Validating wheather the product added in my list is succesfully reflecting in Shopping List");
		Thread.sleep(1000);
		shoppingProd = new RetrieveXlsxData().getExcelData("xpath",18,3);
		prodNameShopping = driver.findElement(By.xpath(shoppingProd));
		
		if ((prodNameShopping.getText()).equals(prodNameList)) {
			System.out.println(" Yes the product name matches");
		}
		log.info("Validated product is succesfully added in Shopping List");
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
		driver.findElement(By.xpath("(" + eight + ")[1]")).click();
		Thread.sleep(1000);
		valueIncrease = new RetrieveXlsxData().getExcelData("xpath",15,3);
		increaseProduct = driver.findElement(By.xpath(valueIncrease));
		increaseProduct.click();
		
		JavascriptExecutor jse2 = (JavascriptExecutor)driver;
	    jse2.executeScript("window.scrollBy(0,230)","");
		Thread.sleep(1000);
	    log.info("Clicking on the 'Get Best Price' button");
	    String qButton = new RetrieveXlsxData().getExcelData("xpath", 1, 3);
		driver.findElement(By.xpath(qButton)).click();
		
		log.info("Retrieving the  product name added in My List");
		
		prodName = new RetrieveXlsxData().getExcelData("xpath", 19, 3);
		prodMyList = driver.findElement(By.xpath(prodName));
		
		prodNameList = prodMyList.getText();
		System.out.println(prodMyList.getText());
		
		
	}
	
public void addProductAgain() throws IOException, Exception{
		
		Thread.sleep(1000);
		driver.findElement(By.xpath("//div[@id='filters']/div/button")).click();
		String eight = new RetrieveXlsxData().getExcelData("xpath", 22, 1);
		
		Thread.sleep(1000);
		driver.findElement(By.xpath("(" + eight + ")[1]")).click();
		Thread.sleep(1000);
		valueIncrease = new RetrieveXlsxData().getExcelData("xpath",15,3);
		increaseProduct = driver.findElement(By.xpath(valueIncrease));
		increaseProduct.click();
		
		JavascriptExecutor jse2 = (JavascriptExecutor)driver;
	    jse2.executeScript("window.scrollBy(0,230)","");
		Thread.sleep(1000);
	    log.info("Clicking on the 'Get Best Price' button");
	    String qButton = new RetrieveXlsxData().getExcelData("xpath", 1, 3);
		driver.findElement(By.xpath(qButton)).click();
		
	}
	public void changePincode() throws IOException, Exception{
		
		log.info("Selecting a different area pincode");
		pincod = new RetrieveXlsxData().getExcelData("xpath", 22, 3);
		pincodTxtBox = driver.findElement(By.xpath(pincod));
		pincodTxtBox.sendKeys("560037");
		
		log.info("Click on the Check button....");
		check = new RetrieveXlsxData().getExcelData("xpath", 23, 3);
		checkButton = driver.findElement(By.xpath(check));
		checkButton.click();
	}
	
	public void validateErrorMsg() throws IOException, Exception{
		
		expected = "You have items in the list for pincode  560001 . Please clear the list or select same pincode";
		log.info("Click on the Buy Button");
		
		Thread.sleep(1000);
		button = new RetrieveXlsxData().getExcelData("xpath",17,3); 
		buyButton = driver.findElement(By.xpath(button));
		buyButton.click();
		
		log.info("Validating the Error message above 'Get Price Button'");
		abov = new RetrieveXlsxData().getExcelData("xpath",20,3); 
		aboveGetBtn = driver.findElement(By.xpath(abov));
		
		aboveMsg = aboveGetBtn.getText();
		if (!expected.equals(aboveMsg)) {
			System.out.println("When we try to add product for a different area code, we can find an error msg above 'Get Price' button "+aboveMsg);
		}
		
		log.info("Validating the Error message below 'Pincode Txt Box'");
		belo = new RetrieveXlsxData().getExcelData("xpath",21,3);
		beloPinCod = driver.findElement(By.xpath(belo));
		belowMsg = beloPinCod.getText();
		if (!expected.equals(belowMsg)) {
			System.out.println("When we try to add product for a different area code, we can find another error msg below 'Pincode Txt box' "+belowMsg);
		}
		log.info("Error msg validated");
	}
}
