package SanityTest;

import org.testng.annotations.Test;
import org.testng.asserts.SoftAssert;

import java.util.Iterator;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.interactions.Actions;
import org.openqa.selenium.support.ui.Select;
import org.testng.annotations.BeforeTest;
import org.testng.annotations.Test;

import GenericLibrary.BrowserSelection;
import GenericLibrary.Credentials;
import GenericLibrary.LogReports;
import GenericLibrary.RetrieveXlsxData;
import GenericLibrary.WebDriverCommonFunctions;
import Scenarios.Scenario1Test;

public class CheckBoxTest extends Scenario1Test
{
	
	
	 
	 String noOfItems = "//div[@id='catalog-listing']//strong";
	 int price; 
	 String skuId;
	 String specilPrice;
	 int discountPriceList;
	
    @Test
    public void verifyDiscount()
    {
    	
    	driver.findElement(By.xpath("//*[@id='x']")).click();
		Actions action =  new Actions(driver);
		action.moveToElement(driver.findElement(By.xpath("//a[@id='showhide1']/i"))).perform();
		try {
			Thread.sleep(500);
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		action.moveToElement(driver.findElement(By.xpath("//*[@id='menuBLock']/li[2]/a"))).perform();
		try {
			Thread.sleep(500);
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		driver.findElement(By.xpath("//*[@id='menuBLock']/li[2]/ul/li[3]/a")).click();
		driver.findElement(By.xpath("(//dd[@id='blockDiscount Range']/ol/li/a)[1]")).click();
		Select select = new Select(driver.findElement(By.xpath("(//div[@id='catalog-listing']//select)[1]")));
		select.selectByVisibleText("12");
		int num = getNumberOfElementsFound(By.xpath("//div[@id='catalog-listing']/div/div/div/div/div/ul/li"));
		System.out.println(num);
		loopingPage(num);
		
		
    }
   public  void loopingPage(int n){
	   
	   String PageNavigationXpath = "//div[@id='catalog-listing']//li/a[@class='next']";
	  /* String temp = driver.findElement(By.xpath(noOfItems)).getText();
	   int totalItem = getNumber(temp);
	   //n>Integer.parseInt(visibleText)
    	if(n>12){
    		
    			for(int j = 1; j <= n; j++ ){

   				 System.out.println("==========================="+j+"==================================");
  				 
   				discountPriceList =  productInfo(j-1);
   				System.out.println(discountPriceList);
   			    getElementWithIndex(By.xpath("//div[@id='catalog-listing']/div[2]/div[1]/div/div"), j-1).click();
   				
   				if (j == 1)
   				{
   					picodePopUp();
   				}
   				
   				try {
   					Thread.sleep(8000);
   				} catch (InterruptedException e) {
   					// TODO Auto-generated catch block
   					e.printStackTrace();
   				}
   				
   				skuId = driver.findElement(By.className("pdt-skuid")).getText();
   				
   				String getNumber = driver.findElement(By.xpath("//span[@class='dis-percent']")).getText();
   				
   				int discountPriceDetail = getNumber(getNumber);
   				System.out.println(discountPriceDetail);
   				
   				if (discountPriceList == discountPriceDetail) {
					System.out.println("Discount Offer For the "+skuId+" matches");
				}
   				else
   				{	
   				     
   				     System.out.println("Discount Offer For the "+skuId+" matches do not match");
   				
   			         
   			
   				}   
   			   driver.navigate().back();
   				
    			}
    			 
    	}else {*/
    		
			for(int j = 1; j <= n; j++ ){

				 System.out.println("==========================="+j+"==================================");
				 
				discountPriceList =  productInfo(j-1);
				System.out.println(discountPriceList);
			    getElementWithIndex(By.xpath("//div[@id='catalog-listing']/div[2]/div[1]/div/div"), j-1).click();
				
				if (j == 1)
				{
					picodePopUp();
				}
				
				try {
					Thread.sleep(8000);
				} catch (InterruptedException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				
				skuId = driver.findElement(By.className("pdt-skuid")).getText();
				
				String getNumber = driver.findElement(By.xpath("//span[@class='dis-percent']")).getText();
				
				int discountPriceDetail = getNumber(getNumber);
				System.out.println(discountPriceDetail);
				
				if (discountPriceList == discountPriceDetail) {
				System.out.println("Discount Offer For the "+skuId+" matches");
			}
				else
				{	
				     
				     System.out.println("Discount Offer For the "+skuId+" matches do not match");
				
			         
			
				}   
			   driver.navigate().back();
				
			}
			if (n>12) {
				if (driver.findElement(By.xpath(PageNavigationXpath)).isEnabled()) {
					driver.findElement(By.xpath(PageNavigationXpath)).click();
				} 
			}	
		}
	
   		
   
    	public static int getNumberOfElementsFound(By by) {
    	    return driver.findElements(by).size();	
    }
    	public static WebElement getElementWithIndex(By by, int pos) {
    	    return driver.findElements(by).get(pos);
    	  }

    	public static int productInfo(int i)
    	{		
    		String discount= driver.findElement(By.xpath("//span[@class='dis-percent']")).getText();
    		int discountPrice = getNumber(discount);
    	    return discountPrice;
    	}
    	public static void picodePopUp(){
    		driver.findElement(By.xpath("//div[@id='popup_box']//div/input[@id='popzip']")).sendKeys("560102");
    		driver.findElement(By.xpath("//div[@id='popup_box']//div/input[@id='go']")).click();
    	}
    	
    	private static int getNumber(String str)
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
