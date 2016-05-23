package GenericLibrary;

import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.ie.InternetExplorerDriver;

public class BrowserSelection 
{
	
	public  static WebDriver driver;
	
	public static WebDriver selectBrowserDriver(String browser)
	{
		if (browser.equalsIgnoreCase("chrome")) 
		{
			
			System.setProperty("webdriver.chrome.driver", "C:\\Users\\Anshuman\\BrowserDrivers\\chromedriver.exe");
			driver = new ChromeDriver();
			
		} 
		else if (browser.equalsIgnoreCase("ie")) 
		{
			
			System.setProperty("webdriver.ie.driver", "C:\\Users\\Anshuman\\BrowserDrivers\\IEDriverServer.exe");
			driver = new InternetExplorerDriver();
			
		} 
		if(browser.equalsIgnoreCase("firefox"))
		{
			driver = new FirefoxDriver();
		}
		return driver;
	}
}

