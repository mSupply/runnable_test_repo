package GenericLibrary;

import java.util.List;

import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebElement;

import Scenarios.Scenario1Test;

public class LoadLocators 
{
	public static WebElement loadElementByID(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.id(CommonFunctions.getLocatorsExcel(Element)));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}
	
	public static WebElement loadElementByName(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.name(CommonFunctions.getLocatorsExcel(Element)));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}
	
	public static WebElement loadElementByClassName(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.className(CommonFunctions.getLocatorsExcel(Element)));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}
	
	public static WebElement loadElementByTagName(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.tagName(CommonFunctions.getLocatorsExcel(Element)));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}
	
	public static WebElement loadElementByLinkText(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.linkText(CommonFunctions.getLocatorsExcel(Element)));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}
	
	public static WebElement loadElementByPartialLinkText(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.partialLinkText(CommonFunctions.getLocatorsExcel(Element)));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}
	
	public static WebElement loadElementByXpath(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.xpath(CommonFunctions.getLocatorsExcel(Element)));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}

	public static List<WebElement> loadElementByXpath_findElements(String Element) throws Throwable
	{
		List<WebElement> element=Scenario1Test.driver.findElements(By.xpath(CommonFunctions.getLocatorsExcel(Element)));
		JavascriptExecutor jse2 = (JavascriptExecutor)Scenario1Test.driver;
	    jse2.executeScript("window.scrollBy(0,-530)","");
		return element;
	}
	
	public static WebElement loadElementByCssSelector(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.cssSelector(CommonFunctions.getLocatorsExcel(Element)));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}
	
}
