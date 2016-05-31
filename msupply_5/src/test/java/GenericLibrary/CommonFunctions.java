package GenericLibrary;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.util.Properties;

import org.apache.log4j.Logger;
import org.apache.poi.ss.usermodel.Sheet;
import org.apache.poi.ss.usermodel.Workbook;
import org.apache.poi.ss.usermodel.WorkbookFactory;
import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;

import POM.HomePage;
import Scenarios.Scenario1Test;

public class CommonFunctions 
{
   static String currentPath = System.getProperty("user.dir");
   static Logger log = LogReports.writeLog(CommonFunctions.class);

   
   public static boolean isClickable(WebElement element)      
   {
      try
      {
          WebDriverWait wait = new WebDriverWait(Scenario1Test.driver, 5);
          wait.until(ExpectedConditions.elementToBeClickable(element));
          return true;
      }
      catch (Exception e)
      {
          return false;
      }
   }
   
   
  //Scroll WebPage Up till Element is clicked	
   public static void scrollPageUpToFindElement(WebElement Buildingmaterial_Cement_Product1) 
   {
	  boolean clicked = false;
	  int yPosition=100;
	  while(!clicked)
	  {
		  try 
		    {
			    Thread.sleep(5000);
			    Scenario1Test.driver.switchTo().defaultContent();
		    	clicked = true;
		        JavascriptExecutor jse2 = (JavascriptExecutor)Scenario1Test.driver;
			    jse2.executeScript("window.scrollBy(0,-530)","");
		     } 
		    catch (Exception e)
		    {
		       
		       JavascriptExecutor jse2 = (JavascriptExecutor)Scenario1Test.driver;
		       jse2.executeScript("window.scrollBy(0,-"+yPosition+")","");
		       e.toString();
		       log.info("=========> Finding the Element <======: Buildingmaterial_Cement_Product1 " + e.getMessage());
		       yPosition=yPosition+100;
		     }  
	  }
	}
   
  //Scroll WebPage Up	
    public static void scrollPageUp(int x, int y) 
    {
   	 JavascriptExecutor jse2 = (JavascriptExecutor)Scenario1Test.driver;
     jse2.executeScript("window.scrollBy("+x+","+y+")","");
	}
    
   //Scroll Down WebPage
	public static void scrollDownPage(int x,int y)
	{
		
		 JavascriptExecutor jse2 = (JavascriptExecutor)Scenario1Test.driver;
	     jse2.executeScript("window.scrollBy("+x+","+y+")","");
	}
	public static void SwitchtoWebPage()
	{
		Scenario1Test.driver.switchTo().defaultContent();
	}
	
	
  //Read Locators from Excel File	
	public static String getLocatorsExcel(String Key) throws Throwable
	{
		String filePath = currentPath +"/src/test/resources/Locators.xlsx";
		String LocatorValue = null;				
		File file = new File(filePath);
		FileInputStream fis = new FileInputStream(file);
			
			Workbook wb = WorkbookFactory.create(fis);
			Sheet sht =  wb.getSheet("Data");
			int LastRowExcel = sht.getLastRowNum();
			for(int i=1;i<=LastRowExcel;i++)
			{				
				if(sht.getRow(i).getCell(0).getStringCellValue().equals(Key))
				{								
					LocatorValue=sht.getRow(i).getCell(1).getStringCellValue();					
				}
			}
		return LocatorValue;
		
	}

	//Wait for Page to Load using Explicit Wait
	public static void LoadPageExpicitWait() 
	{
		JavascriptExecutor js = (JavascriptExecutor)Scenario1Test.driver;
		
		for (int i=0; i<25; i++)
		{ 
			try 
			{ 
				Thread.sleep(1000); 
		    }
			catch (Exception e) 
			{
				if (js.executeScript("return document.readyState").toString().equals("complete"))
					break;
			} 
		}
		
	}
	

}
