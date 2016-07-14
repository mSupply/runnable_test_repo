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
		WebElement element=Scenario1Test.driver.findElement(By.id(Element));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}
	
	public static WebElement loadElementByName(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.name(Element));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}
	
	public static WebElement loadElementByClassName(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.className(Element));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}
	
	public static WebElement loadElementByTagName(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.tagName(Element));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}
	
	public static WebElement loadElementByLinkText(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.linkText(Element));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}
	
	public static WebElement loadElementByPartialLinkText(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.partialLinkText(Element));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}
	
	public static WebElement loadElementByXpath(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.xpath(Element));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}

	public static List<WebElement> loadElementByXpath_findElements(String Element) throws Throwable
	{
		List<WebElement> element=Scenario1Test.driver.findElements(By.xpath(Element));
		return element;
	}
	
	public static WebElement loadElementByCssSelector(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.cssSelector(Element));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}	
	
}
