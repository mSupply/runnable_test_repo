package SanityTest;

import java.io.IOException;

import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.interactions.Actions;
import org.testng.annotations.BeforeTest;
import org.testng.annotations.Test;

import GenericLibrary.RetrieveXlsxData;
import Scenarios.Scenario1Test;

public class TMTsteel extends Scenario1Test {
	
	 @Test
	    public void tmtValidations() throws IOException, Exception
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
			action.moveToElement(driver.findElement(By.xpath("//div[@id='menuBLock']/li[2]/a"))).perform();
			try {
				Thread.sleep(500);
			} catch (InterruptedException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			clickTmtSteel();
			picodePopUp();
			driver.findElement(By.xpath("//label[@id='Tata']")).click();
			Thread.sleep(6000);
			driver.findElement(By.xpath(".//*[@id='filters']/div[3]/button")).click();
			//div[@id='filters']/div/button[@class='btn_pupdate']
			driver.findElement(By.xpath("(//table[@id='pipeTable']/tbody/tr//button)[1]")).click();
			//driver.findElement(By.xpath("//span[@class='quantity-box prodSpan-21856']/input[3]")).click();
			Thread.sleep(6000);
			JavascriptExecutor jse2 = (JavascriptExecutor)driver;
		    jse2.executeScript("window.scrollBy(0,230)","");
			driver.findElement(By.xpath("//div[@id='cbheading']/following-sibling::div//button[text()='Get Best Price']")).click();
//			Thread.sleep(1000);
//			driver.findElement(By.xpath("//div[@id='cbheading']/following-sibling::div//button[@id='buy_btn']")).click();
			//div[@class='wrapper-container']//div/button[text()='Get Best Price']
			//div[@id='cbheading']/following-sibling::div//button[@id='buy_btn']
			double value = Double.parseDouble(driver.findElement(By.xpath("//input[@id='qty_auto']")).getAttribute("value"));
			System.out.println(value);
			double moq = Double.parseDouble(driver.findElement(By.xpath("//table/tbody/tr[@class='clickmetoselect cust-trb seller-10000052']/td[text()='2']")).getText());
			if (value<=moq) {
				driver.findElement(By.xpath("//span[@class='quantity-box prodSpan-21856']/input[3]")).click();	
			}
			driver.findElement(By.xpath("//div[@id='cbheading']/following-sibling::div//button[@id='buy_btn']")).click();
	    }
	 public void clickTmtSteel() throws IOException, Exception{
		 String tmtObject = null; 
		
		  tmtObject = new RetrieveXlsxData().getExcelData("xpath",0,1);
		 
		
		  driver.findElement(By.xpath(tmtObject)).click();
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