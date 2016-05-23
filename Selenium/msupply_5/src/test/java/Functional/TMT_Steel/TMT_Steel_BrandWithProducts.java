package Functional.TMT_Steel;

import java.util.List;

import org.openqa.selenium.Alert;
import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.testng.annotations.Test;

import GenericLibrary.BrowserSelection;


/**
 * @author Anshuman M
 *
 */
public class TMT_Steel_BrandWithProducts {
	
	WebDriver dr = new FirefoxDriver();
	 List<WebElement> products;
	 WebElement steelProd;
	 List<WebElement> moq;
	 int value;
	 int minMoq = 2;
	 List<WebElement> premovelist; 
	 List<WebElement> variants;
	 List<WebElement> varialtprod;
	 List<WebElement> sellers;
	 WebElement selected;
	 int sellersFound;
	 @Test
	public void appProduct() throws Exception{
		dr.manage().window().maximize();
		dr.get("http://www.msupply.com/building-material/tmt-steel.html");
		
		picodePopUp();
		dr.findElement(By.xpath("//label[@id='Tata']")).click();
		Thread.sleep(1000);
		dr.findElement(By.xpath(".//*[@id='filters']/div[3]/button")).click();
		//div[@id='filters']/div/button[@class='btn_pupdate']
		Thread.sleep(1000);
		JavascriptExecutor jse2 = (JavascriptExecutor)dr;
	    jse2.executeScript("window.scrollBy(0,330)","");
	    addProdLoop();
	    getPriceButton();
	    changeBrandOK();
	    changeBrandCancel();
	    closeConnections();
	}

	public void picodePopUp(){
 		dr.findElement(By.xpath("//div[@id='popup_box']//div/input[@id='popzip']")).sendKeys("560102");
 		dr.findElement(By.xpath("//div[@id='popup_box']//div/input[@id='go']")).click();
 	}
	public void addProdLoop(){
		products = dr.findElements(By.xpath("(//table[@id='pipeTable']/tbody/tr//button)"));
		for (int i = 1; i <= products.size(); i++) {
			steelProd = dr.findElement(By.xpath("(//table[@id='pipeTable']/tbody/tr//button)["+i+"]"));
			if (steelProd.isEnabled()) {
				steelProd.click();
			}
		}
	}
	public void changeBrandOK() throws InterruptedException{
		dr.findElement(By.xpath("//label[@id='SK Super']")).click();
		Thread.sleep(2000);
		Alert a = dr.switchTo().alert();
		a.accept();
	}
	public void changeBrandCancel() throws InterruptedException{
		dr.findElement(By.xpath(".//*[@id='filters']/div[3]/button")).click();
		dr.findElement(By.xpath("//table[@id='pipeTable']/tbody/tr//button")).click();
		dr.findElement(By.xpath("//label[@id='Tata']")).click();
		Thread.sleep(2000);
		Alert a = dr.switchTo().alert();
		a.dismiss();
	}
	public void getPriceButton() throws Exception{
		dr.findElement(By.xpath("//div[@id='cbheading']/following-sibling::div//button[text()='Get Best Price']")).click();
		Boolean flag = dr.findElement(By.xpath("//div[@id='cbheading']/following-sibling::div//div[@class='list-totalprice list_totalprice']")).isDisplayed();
		System.out.println(flag);
		Thread.sleep(1000);
		String price = dr.findElement(By.xpath("//div[@id='cbheading']/following-sibling::div//div[@class='list-totalprice list_totalprice']")).getText();
		if (flag) {
			System.out.println(getNumber(price));
		}
		System.out.println("validate seller table");
		sellerTable();
	}
	
	public void sellerTable(){
		sellers = dr.findElements(By.xpath("//div[@id='zipsearchresult']//table/tbody/tr/td[1]"));
		sellersFound = sellers.size();
		System.out.println(sellersFound);
		for (int i = 0; i < sellersFound; i++) {
			selected = dr.findElement(By.xpath("(//div[@id='zipsearchresult']//table/tbody/tr/td[1])["+(i+1)+"]/following-sibling::td/input[@type='button']"));
			if (!selected.isEnabled()) {
				System.out.println(sellers.get(i).getText());
			} 
		}
	}
	private  int getNumber(String str)
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
	public void closeConnections(){
		dr.quit();
	}
}	
