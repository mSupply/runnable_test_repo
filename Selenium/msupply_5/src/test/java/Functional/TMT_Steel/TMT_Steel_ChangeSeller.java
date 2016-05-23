package Functional.TMT_Steel;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import java.util.concurrent.TimeUnit;

import org.apache.log4j.Logger;
import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.interactions.Actions;
import org.testng.Assert;
import org.testng.annotations.BeforeTest;
import org.testng.annotations.Test;

import GenericLibrary.LogReports;
import GenericLibrary.RetrieveXlsxData;

public class TMT_Steel_ChangeSeller {
	
	Logger log = LogReports.writeLog(TMT_Steel_ChangeSeller.class);
	static WebDriver driver;
	private WebElement selectBrand;
	private WebElement myListPrice;
	private int lowest;
	private List<WebElement> selectButtons;
	int lowestValue;
	private WebElement sellerName;
	private WebElement changeSeller;
	private String selBTN;
	private int zxc;
	
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
		
		log.info("Validating lowest price selected by default in Sellers table");
		verifyLowestPriceSelected();
		
		log.info("Validating lowest price appears in My List");
		validatingLowestPrice();
		
		log.info("Validating seller change");
		validateSellerChange();
		
	
}
	public void validateSellerChange() throws IOException, Exception {
		
		log.info("Validating whether seller changes after selecting some other seller");
		
		log.info("Retrieving seller name before changing seller");
		
		String seller = new RetrieveXlsxData().getExcelData("xpath",13,3);
		sellerName = driver.findElement(By.xpath(seller));
		
		System.out.println("Seller by default selected: "+sellerName.getText());
		
		log.info("Click on the 'XChange Seller' button");
		
		String change = new RetrieveXlsxData().getExcelData("xpath", 14, 3);
		
		JavascriptExecutor jse2 = (JavascriptExecutor)driver;
	    jse2.executeScript("window.scrollBy(0,230)","");
		changeSeller = driver.findElement(By.xpath(change));
		changeSeller.click();
		
		log.info("Click on the Select button in Seller's table");
		
		for( int i = 0; i< selectButtons.size(); i++){
			System.out.println(selectButtons.get(i).getAttribute("class"));
			if ((selectButtons.get(i).getAttribute("class")).equals("selectvendor")) {
				selectButtons.get(i).click();
				
				System.out.println("Another seller is selected");
				break;
			}
		}
		
		log.info("Seller should change");
		System.out.println("Seller after changing seller is: "+sellerName.getText());
		log.info("Seller is succesfully changed: validated");
		
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
		driver.findElement(By.xpath("(" + eight + ")[2]")).click();
		
		JavascriptExecutor jse2 = (JavascriptExecutor)driver;
	    jse2.executeScript("window.scrollBy(0,230)","");
		Thread.sleep(1000);
	    log.info("Clicking on the 'Get Best Price' button");
	    String qButton = new RetrieveXlsxData().getExcelData("xpath", 1, 3);
		driver.findElement(By.xpath(qButton)).click();
	}
	
	public void validatingLowestPrice() throws IOException, Exception{
		
		log.info("Validating if the Lowest price offered by the sellers is displayed");
		
		log.info("Fetching the price shown in the My List after clicking on the 'Get Best Price' button");
		String priceMyList = new RetrieveXlsxData().getExcelData("xpath", 6, 3);
		myListPrice = driver.findElement(By.xpath(priceMyList));
		lowest = getNumber(myListPrice.getText());
		System.out.println(" Lowest price offered : "+lowest);
		log.info("Validating the price shown in the 'My List' with the Price in sellers table");
		
		int lowestFromSellers =  lowestPriceSellerTable();
		if (lowest == lowestFromSellers) {
			System.out.println(" Lowest price offered is: "+lowest);
		}
		log.info("Price validated");
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
	public int lowestPriceSellerTable() throws IOException, Exception {
		
		String allPrice = new RetrieveXlsxData().getExcelData("xpath", 3, 3);
		List<WebElement> prices = driver.findElements(By.xpath(allPrice));
		
		List<Integer> pList = new ArrayList<>();
		/*Iterator<WebElement> itera = prices.iterator();
		if (itera.hasNext()) {
			pList.add(getNumber(itera.next().getText()));
		}*/
		for (int i = 0; i< prices.size();i++) {
			pList.add(getNumber(prices.get(i).getText()));
			System.out.println(pList);
		}
		System.out.println(pList);
		Collections.sort(pList);
		log.info("After sorting");
		
		System.out.println(pList);
		System.out.println(pList.size());
		for (int i = 0; i < pList.size(); i++) {
			zxc = pList.get(i);
			break;
		}
		return zxc;
		
	}
	
	public int lowestPricveAutoSelected() throws IOException, Exception{
		
		log.info("Validating wheather the lowest price is selected by default");
		
		selBTN = new RetrieveXlsxData().getExcelData("xpath", 11, 3);
		selectButtons = driver.findElements(By.xpath(selBTN));
		
		for( int i = 0; i< selectButtons.size(); i++){
			System.out.println(selectButtons.get(i).getAttribute("class"));
			if ((selectButtons.get(i).getAttribute("class")).equals("selectvendor tick")) {
				WebElement totalP = driver.findElement(By.xpath("("+selBTN+")["+(i+1)+"]/../preceding-sibling::td[1]"));
				lowestValue = getNumber(totalP.getText());
				System.out.println(lowestValue);
			}
		}
		return lowestValue;
	}
	
	public void verifyLowestPriceSelected() throws IOException, Exception
	{
		
		log.info("Checking the lowest seller price is selected by default");
		if (lowestPriceSellerTable()== lowestPricveAutoSelected()) {
			System.out.println("Verified: Lowest price is by default selected");
		}
		
	}
}