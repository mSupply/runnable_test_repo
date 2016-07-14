package Demo;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.testng.annotations.Test;

import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import GenericLibrary.WebDriverCommonFunctions;
import Scenarios.Scenario1Test;

public class Demo extends Scenario1Test
{
	@Test
	public void main() throws Throwable
	{
		Credentials.url="http://www.msupply.com";
		Scenario1Test.driver.get(Credentials.url);
		WebDriverCommonFunctions.element_Click("closeIcon_xpath","Clicked on Close Icon POPUP"); 
           
		CommonFunctions.LoadPageExpicitWait();
		Scenario1Test.driver.switchTo().defaultContent();
		CommonFunctions.scrollDownPage(0,2500);
		Scenario1Test.driver.switchTo().defaultContent();
		Thread.sleep(5000);
		Scenario1Test.driver.switchTo().defaultContent();
		Thread.sleep(5000);
		Scenario1Test.driver.switchTo().defaultContent();
		boolean status=Scenario1Test.driver.findElement(By.xpath("(//div[@id='brandSlider']/div[1]/div/div/div/img)[11]")).isDisplayed();
		System.out.println(status);
		
		
		
		
//		CommonFunctions.scrollDownPage(0,600);
//		
//		 Scenario1Test.driver.findElement(By.xpath("(//div[@class='owl-next']/a)[4]")).click();
//		 Thread.sleep(2000);
//		 Scenario1Test.driver.findElement(By.xpath("(//div[@class='owl-next']/a)[4]")).click();
//		 Thread.sleep(5000);
//		 Scenario1Test.driver.switchTo().defaultContent();
//		Scenario1Test.driver.findElement(By.xpath("(//div[@class='hmptitleblock'])[57]")).click();
		
		
//		WebDriverCommonFunctions.element_Selectproduct_Navigation(4,2,true,"Navigation => Buildingmaterial => Blocks");
//		WebDriverCommonFunctions.element_SelectProduct_ProductListPage(true);
			
		
	}

}
