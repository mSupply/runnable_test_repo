package Functional.TMT_Steel;

import java.util.List;

import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.testng.annotations.Test;

public class TMT_Steel_AddRemove {
	
	WebDriver dr = new FirefoxDriver();
	 List products;
	 WebElement steelProd;
	 List moq;
	 int value;
	 int minMoq = 2;
	
	@Test
	public void appProduct() throws InterruptedException{
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
		myList();
		
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
	public void myList(){
		moq = dr.findElements(By.xpath("//input[@id='qty_auto']"));
		for (int i = 1; i <= moq.size(); i++) {
			value = Integer.parseInt(dr.findElement(By.xpath("//input[@id='qty_auto']")).getAttribute("value"));
			value = value + value;
			System.out.println(value);	
				
					for (int k = 2; k < 70; k=k+2) {
						dr.findElement(By.xpath("//span[@class='quantity-box prodSpan-218"+k+"']/input[3]")).click();
					}
				
			
		}
	}

}
