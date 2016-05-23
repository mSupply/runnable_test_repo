package GenericLibrary;

import java.util.concurrent.TimeUnit;

import org.openqa.selenium.Alert;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.interactions.Actions;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.Select;
import org.openqa.selenium.support.ui.WebDriverWait;

public class WebDriverCommonFunctions 
{
	
	public void waitForPageToLoad()
	{
		BrowserSelection.driver.manage().timeouts().implicitlyWait(30, TimeUnit.SECONDS);
	}
	
	/**
	 * This method waits for the web element to be present in UI.The web element Xpath is passed by the user.
	 * @param xpath
	 */
	public void waitForXpathPresent(String xpath)
	{
		WebDriverWait wait=new WebDriverWait(BrowserSelection.driver, 20);
		wait.until(ExpectedConditions.presenceOfElementLocated(By.xpath(xpath)));		
	}
	
	/**
	 * This method waits for the link to be present in UI.The link text is passed by the user.
	 * @param link
	 */
	public void waitForLinkPresent(String link)
	{
		WebDriverWait wait=new WebDriverWait(BrowserSelection.driver, 30);
		wait.until(ExpectedConditions.presenceOfElementLocated(By.linkText(link)));		
	}
	
	
	/**
	 * This method is used to select any option from the drop down menu based on the visible text in the UI.
	 * @param we
	 * @param option
	 */
	public void select(WebElement we,String option)
	{
		Select sel=new Select(we);
		sel.selectByVisibleText(option);
	}
	
	
	/**
	 * This method is used to select any option from the drop down menu based on the position in the UI.
	 * @param we
	 * @param index
	 * @throws Exception 
	 */
	public void select(WebElement we, int index) throws Exception
	{
		Select sel=new Select(we);
		//Thread.sleep(3000);
		sel.selectByIndex(index);
	}
	
	/**
	 * This method is used to accept the invisible pop ups.
	 */
	public void acceptAlert()
	{
		Alert a=BrowserSelection.driver.switchTo().alert();
		a.accept();
	}
	
	/**
	 * This method is used to dismiss the invisible pop ups.
	 */
	public void cancelAlert()
	{
		Alert a=BrowserSelection.driver.switchTo().alert();
		a.dismiss();
	}
	
	/**
	 * This method is used to perform a mouse over operation on WebElement. 
	 */
	public void mouseOverOperation(WebElement element)
	{
		Actions act = new Actions(BrowserSelection.driver);
		act.moveToElement(element).perform();	
	}
	
	
	public void mouseOverOperations(WebElement element, WebDriver WebDriver)
	{
		Actions act = new Actions(WebDriver);
		act.moveToElement(element).perform();	
	}
	/**
	 * This method is used to maximizing Window
	 */
	public void maximizingWindow() 
	{
		BrowserSelection.driver.manage().window().maximize();
		
	}

}
