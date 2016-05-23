package Functional.TMT_Steel;

import java.io.IOException;
import java.util.Iterator;
import java.util.List;
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

public class TMT_Steel_QuantityReset {
	
	Select sel; 
	Logger log = LogReports.writeLog(TMT_Steel_ChangeSeller.class);
	static WebDriver driver;
	private WebElement selectBrand;
	private String defaultQuantity;
	private List<WebElement> quantities;
	//private WebElement productQuantity;
	private WebElement quntityDropdown;
	private String dropdown;
	private String quantityAdded;
	private List<WebElement> productValues;
	private int resetValue;
	
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
		
		log.info("Clicking on Find Products");
		findBrandProducts();
		
		log.info("Add product to My List and click on Get Best Price button");
		addProductToList();
		
		log.info("Increase the quantity of a product by '1' unit");
		increaseQuantity();
		
		log.info("Toggle the Quantity to 'Bundle' and validate, wheather the quantity is reset to '1'");
		resetQuantity();
		
	}	
	
	public void resetQuantity() throws IOException, Exception {
		
		log.info("Change quantity type from MT to Bundle");
		dropdown = new RetrieveXlsxData().getExcelData("xpath",7,3);
		quntityDropdown = driver.findElement(By.xpath(dropdown));
		sel = new Select(quntityDropdown);
		sel.selectByVisibleText("Bundle");
		
		System.out.println("Quantity type has been changed from MT to Bundle");
		
		log.info("Validate, wheather the quantity for each product in My List have been reset to '1' after converting Quantity type");
		quantityAdded = new RetrieveXlsxData().getExcelData("xpath",16,3);
		productValues = driver.findElements(By.xpath(quantityAdded));
		
		for (int i = 0; i < productValues.size(); i++) {
			resetValue = getNumber(productValues.get(i).getAttribute("value"));
			if (resetValue == 1) {
				System.out.println("Yes the quantity reset to 1 when user changes the quantity type");
			}
			System.out.println("Quantity for the product "+(i+1)+"is : "+resetValue);
		}
		
		log.info("Product quantities in My List should reset to 1");
	}

	public void increaseQuantity() throws IOException, Exception {
		int initValue = 0;
		String quantityType = defaultToggleQuantity();
		log.info("Increasing the quantity by one unit");
		defaultQuantity = new RetrieveXlsxData().getExcelData("xpath",15,3);
		quantities = driver.findElements(By.xpath(defaultQuantity));
		
		/*for (Iterator iterator = quantities.iterator(); iterator.hasNext();) {
			productQuantity = (WebElement) iterator.next();
			productQuantity.click();
		   }*/
		for (int i = 0; i < quantities.size(); i++) {
			quantities.get(i).click();
		}
		
		log.info("Quantity of product after adding one unit");
		List<WebElement> tetQuantities = driver.findElements(By.xpath(new RetrieveXlsxData().getExcelData("xpath",16,3)));
		
		for (int i = 0; i < tetQuantities.size(); i++) {
			String cvb = tetQuantities.get(i).getAttribute("value");
			System.out.println(cvb);
			
			initValue = getNumber(cvb);
			
			System.out.println(" Quantity of the product is: "+initValue +""+quantityType);
		}
	}
	
	public String defaultToggleQuantity() throws IOException, Exception{
		
		log.info("Validating default quantity type is MT");
		dropdown = new RetrieveXlsxData().getExcelData("xpath",7,3);
		quntityDropdown = driver.findElement(By.xpath(dropdown));
		sel = new Select(quntityDropdown);
		//System.out.println(quntityDropdown.getText());
		  WebElement strCurrentValue = sel.getFirstSelectedOption();
		  //Print the Currently selected value
		  System.out.println(strCurrentValue.getText());
		return strCurrentValue.getText();
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
		
	public void addProductToList() throws IOException, Exception{
			
		Thread.sleep(1000);
		driver.findElement(By.xpath("//div[@id='filters']/div/button")).click();
		String eight = new RetrieveXlsxData().getExcelData("xpath", 22, 1);
			
		Thread.sleep(1000);
		driver.findElement(By.xpath("(" + eight + ")[1]")).click();
		//driver.findElement(By.xpath("(" + eight + ")[2]")).click();
			
		JavascriptExecutor jse2 = (JavascriptExecutor)driver;
		jse2.executeScript("window.scrollBy(0,230)","");
		Thread.sleep(1000);
		log.info("Clicking on the 'Get Best Price' button");
		String qButton = new RetrieveXlsxData().getExcelData("xpath", 1, 3);
		driver.findElement(By.xpath(qButton)).click();
	}
	
	public  int getNumber(String str)
	{
		StringBuilder myNumbers = new StringBuilder();
		for (int i = 0; i < str.length(); i++)
		{
			//System.out.println(str.charAt(i));
			if (Character.isDigit(str.charAt(i)))
			{
	           myNumbers.append(str.charAt(i));
			}
			 else if(str.charAt(i)=='.')
			    {
			    	break;
			    }
		}
		String Numbers=myNumbers.toString();
		int no=Integer.parseInt(Numbers);
		return no;
	}
}
