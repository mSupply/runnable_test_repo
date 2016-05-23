package Functional.TMT_Steel;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.util.ArrayList;
import java.util.Collections;
import java.util.Iterator;
import java.util.List;
import java.util.Set;
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
import Scenarios.Scenario1Test;

public class TMT_Steel_VerifyMyList {
	
	static WebDriver driver;
	List<WebElement> brands;
	List<WebElement> moq;
	String tmtBrand;
	String brandName;
	WebElement selectBrand;
	BufferedReader br = new BufferedReader(new InputStreamReader(System.in));
	public int value;
	Logger log = LogReports.writeLog(TMT_Steel_VerifyMyList.class);
	List<WebElement> myList;
	List<WebElement> suppliers;
	List<WebElement> prices;
	List<WebElement> variantsList;
	int lowest;
	String prodName; 
	WebElement bBtn;
	WebElement getPrice;
	WebElement myListPrice;
	int moQuantity;
	@BeforeTest
	public void setUp(){
		driver = new FirefoxDriver();        
		driver.manage().window().maximize();
		driver.get("http://www.msupply.com/");
		driver.manage().timeouts().setScriptTimeout(1, TimeUnit.SECONDS);
	}
	
	@Test
	public void myListValidations() throws IOException, Exception{
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
		navigateDesiredPage();
		picodePopUp();
		verifyBrandsAvailable();
		chooseBrand();
		findBrandProducts();
		brandProducts();
		thickness();
		validatingMyList();
		
		
	}
	public void findBrandProducts() throws IOException, Exception {
		System.out.println("click");
		/*Thread.sleep(500);
		driver.findElement(By.xpath(new RetrieveXlsxData().getExcelData("xpath",19,1))).click();*/
		driver.findElement(By.xpath("//div[@id='filters']/div/button")).click();
	}

	public void navigateDesiredPage() throws IOException, Exception{
		 
		String tmtObject = new RetrieveXlsxData().getExcelData("xpath",0,1);
		 driver.findElement(By.xpath(tmtObject)).click();
	 }
	
	public static void picodePopUp(){
 		driver.findElement(By.xpath("//div[@id='popup_box']//div/input[@id='popzip']")).sendKeys("560001");
 		driver.findElement(By.xpath("//div[@id='popup_box']//div/input[@id='go']")).click();
 	}
	
	public void verifyBrandsAvailable() throws IOException{
		brands = driver.findElements(By.xpath("//div[@id='filters']//label"));
		for (Iterator<WebElement> iterator = brands.iterator(); iterator.hasNext();) {
			WebElement webElement = (WebElement) iterator.next();
			tmtBrand = webElement.getText();
			System.out.println(tmtBrand);
			/*brandName = webElement.getAttribute("id");
			System.out.println(brandName);*/
			
	}
		
	}
	public void chooseBrand() throws Exception{
			
			brandName = br.readLine();
			switch (brandName) {
			case "A-one gold":
				if (brandName != "A-one gold") {
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
				break;
			case "Agni":
				if (brandName != "Agni") {
					String agni = new RetrieveXlsxData().getExcelData("xpath",3,1);
					selectBrand = driver.findElement(By.xpath(agni));
					selectBrand.click();
				}
				break;
			case "Apex":
				if (brandName != "Apex") {
					String apex = new RetrieveXlsxData().getExcelData("xpath",4,1);
					selectBrand = driver.findElement(By.xpath(apex));
					selectBrand.click();
				}
				break;
			case "Bhuwalka":
				if (brandName != "Bhuwalka") {
					String bhuwalka = new RetrieveXlsxData().getExcelData("xpath",5,1);
					selectBrand = driver.findElement(By.xpath(bhuwalka));
					selectBrand.click();
				}
				break;
			case "I Steel Gold":
				if (brandName != "I Steel Gold") {
					String iSteelGold = new RetrieveXlsxData().getExcelData("xpath",6,1);
					selectBrand = driver.findElement(By.xpath(iSteelGold));
					selectBrand.click();
				}
				break;
			case "Indus":
				if (brandName != "Indus") {
					String indus = new RetrieveXlsxData().getExcelData("xpath",7,1);
					selectBrand = driver.findElement(By.xpath(indus));
					selectBrand.click();
				}
				break;
			case "Jindal":
				if (brandName != "Jindal") {
					String jindal = new RetrieveXlsxData().getExcelData("xpath",8,1);
					selectBrand = driver.findElement(By.xpath(jindal));
					selectBrand.click();
				}
				break;
			case "Kamachi":
				if (brandName != "Kamachi") {
					String kamachi = new RetrieveXlsxData().getExcelData("xpath",9,1);
					selectBrand = driver.findElement(By.xpath(kamachi));
					selectBrand.click();
				}
				break;
			case "Kamadhenu":
				if (brandName != "Kamadhenu") {
					
					String kamadhenu = new RetrieveXlsxData().getExcelData("xpath",10,1);
					selectBrand = driver.findElement(By.xpath(kamadhenu));
					selectBrand.click();
				}
				break;
			case "MS Life":
				if (brandName != "MS Life") {
					String msLife = new RetrieveXlsxData().getExcelData("xpath",11,1);
					selectBrand = driver.findElement(By.xpath(msLife));
					selectBrand.click();
				}
				break;
			case "Meenakshi":
				if (brandName != "Meenakshi") {
					String meenakshi = new RetrieveXlsxData().getExcelData("xpath",12,1);
					selectBrand = driver.findElement(By.xpath(meenakshi));
					selectBrand.click();
				}
				break;	
			case "Primegold":
				if (brandName != "Primegold") {
					String primeGold = new RetrieveXlsxData().getExcelData("xpath",13,1);
					selectBrand = driver.findElement(By.xpath(primeGold));
					selectBrand.click();
				}
				break;	
			case "SAIL":
				if (brandName != "SAIL") {
					String sail = new RetrieveXlsxData().getExcelData("xpath",14,1);
					selectBrand = driver.findElement(By.xpath(sail));
					selectBrand.click();
				}
				break;	
			case "SK Super":
				if (brandName != "SK Super") {
					String skSuper = new RetrieveXlsxData().getExcelData("xpath",15,1);
					selectBrand = driver.findElement(By.xpath(skSuper));
					selectBrand.click();
				}
				break;	
			case "Shimoga":
				if (brandName != "Shimoga") {
					String shimoga = new RetrieveXlsxData().getExcelData("xpath",16,1);
					selectBrand = driver.findElement(By.xpath(shimoga));
					selectBrand.click();
				}
				break;	
			
			case "VRKP":
				if (brandName != "VRKP") {
					String vrkp = new RetrieveXlsxData().getExcelData("xpath",18,1);
					selectBrand = driver.findElement(By.xpath(vrkp));
					selectBrand.click();
				}
				break;	
				
			default:
				
					String tata = new RetrieveXlsxData().getExcelData("xpath",17,1);
					selectBrand = driver.findElement(By.xpath(tata));
					selectBrand.click();
					break;
				
			}

	}
	
	public void brandProducts() throws IOException, Exception{
		System.out.println("------------Products----------");
		String lists = new RetrieveXlsxData().getExcelData("xpath",20,1);
		List<WebElement> variantsList =  driver.findElements(By.xpath(lists));
		 
		 for (int i = 0; i < variantsList.size(); i++) {
			prodName = variantsList.get(i).getText();
			System.out.println(prodName);	
		}
		
	}
	public void thickness() throws IOException, Exception{
		System.out.println("---------------Thickness----------------");
		String lists = new RetrieveXlsxData().getExcelData("xpath",21,1);
		variantsList =  driver.findElements(By.xpath(lists));
		String thickness;  
		 for (int i = 0; i < variantsList.size(); i++) {
			Iterator<WebElement> iterator = variantsList.listIterator(i);
			thickness = iterator.next().getText();
			System.out.println(thickness);	
		}
	}
	
	public void addToList() throws Exception{
		log.info("Add Product"); 
		
		for (int i = 0; i < 2; i++) {
			
			switch (br.readLine()) {
			case "8mm":
				String eight = new RetrieveXlsxData().getExcelData("xpath", 22, 1);
				driver.findElement(By.xpath("(" + eight + ")[1]")).click();
				break;
			case "10mm":
				String ten = new RetrieveXlsxData().getExcelData("xpath", 22, 1);
				driver.findElement(By.xpath("(" + ten + ")[2]")).click();
				break;
			case "12mm":
				String twelve = new RetrieveXlsxData().getExcelData("xpath", 22, 1);
				driver.findElement(By.xpath("(" + twelve + ")[3]")).click();
				break;
			case "16mm":
				String sixteen = new RetrieveXlsxData().getExcelData("xpath", 22, 1);
				driver.findElement(By.xpath("(" + sixteen + ")[4]")).click();
				break;
			case "20mm":
				String twenty = new RetrieveXlsxData().getExcelData("xpath", 22, 1);
				driver.findElement(By.xpath("(" + twenty + ")[5]")).click();
				break;	
			default:
				break;
			}
		}
	}
	
	public void validatingMyList() throws IOException, Exception{
		log.info("Verfying  My List before adding products");
		
		myList = driver.findElements(By.xpath(new RetrieveXlsxData().getExcelData("xpath",0,3)));
				
		if (myList.size()!=0) {
		{
			log.info("No products had been added");
			System.out.println(myList.size());
			addToList();
			//System.out.println(driver.findElement(By.xpath("//*[@id='qty_auto']")).getAttribute("value"));
		}
		//System.out.println(myList.size());
		log.info("Validating moq");
		validatingMOQ();
		
		}
	}
	
	public void validatingMOQ() throws IOException, Exception{
		JavascriptExecutor jse2 = (JavascriptExecutor)driver;
	     jse2.executeScript("window.scrollBy(0,230)","");
		String qButton = new RetrieveXlsxData().getExcelData("xpath", 1, 3);
		driver.findElement(By.xpath(qButton)).click();
		
		/*String buyBtn = new RetrieveXlsxData().getExcelData("xpath", 4, 3);
		bBtn = driver.findElement(By.xpath(buyBtn));*/
		log.info(" 'Get Best Price' button is clicked");
		validatingSellerTable();
	}

	public void validatingSellerTable() throws IOException, Exception {
		log.info("Validating if seller table is displayed after 'Get Best Price' button is clicked");
		suppliers = driver.findElements(By.xpath(new RetrieveXlsxData().getExcelData("xpath", 2, 3)));
		if (suppliers.size()>0) {
			log.info("seller table is displayed");
		}else {
			String noSeller = new RetrieveXlsxData().getExcelData("xpath", 5, 3);
			WebElement noSellers = driver.findElement(By.xpath(noSeller));
			log.info("----"+noSellers.getText()+"----");
		}
		
		validatingLowestPrice();
	
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
		return pList.get(0);
		
		
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
