package GenericLibrary;

import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebElement;

import Scenarios.Scenario1Test;

public class LoadLocators 
{
	public WebElement loadElementByID(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.id(CommonFunctions.getLocatorsExcel(Element)));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}
	
	public WebElement loadElementByName(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.name(CommonFunctions.getLocatorsExcel(Element)));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}
	
	public WebElement loadElementByClassName(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.className(CommonFunctions.getLocatorsExcel(Element)));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}
	
	public WebElement loadElementByTagName(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.tagName(CommonFunctions.getLocatorsExcel(Element)));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}
	
	public WebElement loadElementByLinkText(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.linkText(CommonFunctions.getLocatorsExcel(Element)));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}
	
	public WebElement loadElementByPartialLinkText(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.partialLinkText(CommonFunctions.getLocatorsExcel(Element)));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}
	
	public WebElement loadElementByXpath(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.xpath(CommonFunctions.getLocatorsExcel(Element)));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}

	public WebElement loadElementByCssSelector(String Element) throws Throwable
	{
		WebElement element=Scenario1Test.driver.findElement(By.cssSelector(CommonFunctions.getLocatorsExcel(Element)));
		((JavascriptExecutor)Scenario1Test.driver).executeScript("arguments[0].scrollIntoView(true);", element);
		return element;
	}
	
}
