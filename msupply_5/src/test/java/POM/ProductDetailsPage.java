package POM;

import java.util.ArrayList;
import java.util.List;

import org.apache.log4j.Logger;
import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;
import org.testng.Assert;
import org.testng.Reporter;

import GenericLibrary.CommonFunctions;
import GenericLibrary.LoadLocators;
import GenericLibrary.LogReports;
import GenericLibrary.RetrieveXlsxData;
import Scenarios.Scenario1Test;

public class ProductDetailsPage extends LoadLocators
{	
	
	public static String ProductName_Poductdetails_Page;
	public static int offerPrice_Poductdetails_Page;
	public static int Quantity_Poductdetails_Page;
	public static int Estimated_SubTotal_Poductdetails_Page;
	public static String SellerName_ProductDetails_Page;	
	public static String pincode_ProductDetails_Page;
	public static int UnitPrice_Table_ProductDetails_Page;
	public static int MOQ_Table_ProductDetails_Page;
	
	static Logger log = LogReports.writeLog(ProductDetailsPage.class);
	
	
	public static void getCustomerReviews() throws Throwable
	{
		
		WebElement No_of_Customer_Reviews_DetailsPage=loadElementByXpath("No_of_Customer_Reviews_DetailsPage_Xpath");
		String ActualText=No_of_Customer_Reviews_DetailsPage.getText();
	
		int Reviews=getNumber(ActualText);
		log.info(Reviews+"Reviews Present on the Product Details Page");
		Reporter.log(Reviews+"Reviews Present on the Product Details Page",false);		
				
		CommonFunctions.scrollPageUp(0,-550);
		No_of_Customer_Reviews_DetailsPage.click();
		CommonFunctions.LoadPageExpicitWait();
		
		
		int noOfReviews = 0;
		if(Reviews>=1)
		{
		   noOfReviews = 1;
		   while(checkifRowExistsinTable("(//div[@class='col-lg-9 customer_reviews pull-right']/div)["+noOfReviews+"]"))
		   {
			   WebElement Reviews_Date=loadElementByXpath("Review_Date_Xpath");
			   String Date_Value=Reviews_Date.getText();
			   ReviewsPage.ConstructDate(Date_Value,noOfReviews);
			
			   noOfReviews=noOfReviews+1;
		   }
         
		}
		if(noOfReviews==Reviews)
		{
			log.info(Reviews+"All Reviews present in the Review Page");
			Reporter.log(Reviews+"All Reviews present in the Review Page",false);	
		}
		
		WebElement Review_Date=loadElementByXpath("Review_Date_Xpath");
		String Date=Review_Date.getText();
		
		
		
		
	 }
		
		
		
		
	
	public void WriteReview(String Status) throws Throwable
	{
		//Verify for the "Write Review Text" is present
		WebElement Write_Review_Link=loadElementByLinkText("Write_Review_Link_Xpath");
		String ActualText=Write_Review_Link.getText();
		Assert.assertEquals(ActualText,"Write Your Review");
		
		log.info("Write Review is Present on the Product Details Page");
		Reporter.log("Write Review is Present on the Product Details Page",false);
		
		//Verify link is Clikable and navigate to the "Your Review Page"
		try 
		{
			CommonFunctions.scrollPageUpToFindElement(Write_Review_Link);
			Write_Review_Link.click();
			
			log.info("Present on the Product Details Page");
			Reporter.log("Present on the Product Details Page",false);
		}
		catch(Exception e)
		{
			log.info("Not Present on the Product Details Page");
			Reporter.log("Not Present on the Product Details Page",false);
			throw new Exception();
		}		
		
		if(Status.equals("BeforeLogin"))
		{
		   //Login and Navigate to Review and Rating
		   WebElement Login_For_Review_And_Rating=loadElementByLinkText("Login_For_Review_And_Rating_LinkText");
		   Login_For_Review_And_Rating.click();
		
		   String ExcelData[]=RetrieveXlsxData.getExcelData("LoginID_4");
		
		   WebElement MobileNumberField=loadElementByXpath("MobileNumberField_Xpath");
		   MobileNumberField.sendKeys(ExcelData[1]);
	       log.info("Mobile Number is"+ExcelData[1]);
	       Reporter.log("Mobile Number is"+ExcelData[1],false);
	       
	       WebElement PasswordField=loadElementByXpath("PasswordField_Xpath");
	       PasswordField.sendKeys(ExcelData[2]);
	       log.info("Mobile Number is"+ExcelData[2]);
	       Reporter.log("Mobile Number is"+ExcelData[2],false);
	       
	       WebElement LoginButton=loadElementByXpath("LoginButton_Xpath");
	       LoginButton.click();
		
	       CommonFunctions.LoadPageExpicitWait();
		}
	    
	    
	}
	
	public static void getValuesFromProductDetailspage() 
	{
	    
		   WebElement offerPrice=Scenario1Test.driver.findElement(By.xpath("//*[@id='product-price-3753']/span[1]"));
		   WebElement Quantity=Scenario1Test.driver.findElement(By.xpath("//*[@id='qty']"));
    	   WebElement Estimated_SubTotal=Scenario1Test.driver.findElement(By.xpath("//*[@id='product_addtocart_form']/div[2]/div[2]/div[1]/div[7]"));
    	   WebElement ProductName=Scenario1Test.driver.findElement(By.xpath("//*[@id='product_addtocart_form']/div[2]/div[1]/div/div/div/div[2]/div/h1"));
    	   
    	   ProductName_Poductdetails_Page=ProductName.getText();
    	   offerPrice_Poductdetails_Page=(int) getNumber(offerPrice.getText());
		   Quantity_Poductdetails_Page=(int) getNumber(Quantity.getAttribute("value"));
		   Estimated_SubTotal_Poductdetails_Page=(int) getNumber(Estimated_SubTotal.getText());		   
		   
		   getSellerNameFromSellerTable();
	}
	
	public static void getSellerNameFromSellerTable()
	{
		  JavascriptExecutor jse2 = (JavascriptExecutor)Scenario1Test.driver;
	      jse2.executeScript("window.scrollBy(0,230)","");
		
		int CheckBox=1;
		if(checkifRowExistsinTable("//*[@id='zipsearchHeadingResult']/tr["+CheckBox+"]/td[6]"))
		{
			//Check which row is selected
			while(checkifRowExistsinTable("//*[@id='zipsearchHeadingResult']/tr["+CheckBox+"]/td[6]"))
			{
				if((Scenario1Test.driver.findElement(By.xpath("//*[@id='zipsearchHeadingResult']/tr["+CheckBox+"]/td[6]/input[2]")).isSelected())==true)
				{					
					break;
				}
				CheckBox=CheckBox+1;
			}
				
			//Get the UNITPRICE and MOQ and Selected Seller
			 SellerName_ProductDetails_Page=Scenario1Test.driver.findElement(By.xpath("//*[@id='zipsearchHeadingResult']/tr[1]/td[1]")).getText();
			 pincode_ProductDetails_Page=Scenario1Test.driver.findElement(By.xpath("//div[@class='input-group customzipcode']/input[2]")).getAttribute("value");
			 UnitPrice_Table_ProductDetails_Page = getNumber(Scenario1Test.driver.findElement(By.xpath("//*[@id='zipsearchHeadingResult']/tr["+CheckBox+"]/td[5]")).getText());
			 MOQ_Table_ProductDetails_Page = getNumber(Scenario1Test.driver.findElement(By.xpath("//*[@id='zipsearchHeadingResult']/tr["+CheckBox+"]/td[4]")).getText());
			 System.out.println(SellerName_ProductDetails_Page);
			 System.out.println(pincode_ProductDetails_Page);
			 System.out.println(UnitPrice_Table_ProductDetails_Page);
			 System.out.println(MOQ_Table_ProductDetails_Page);
			 
		}
	}
	
	
	public static void Verify_ProductDetailsPage_MOQ() throws Exception 
	{
		Scenario1Test.wdcf.waitForPageToLoad();
		Logger log = LogReports.writeLog(ProductDetailsPage.class);
		
		int finalrow_unitprice=1;
		int finalrow_MOQ=1;
		int unitprice_rowNumber=1; //Start from the First row of the Table
		int MOQ_rowNumber=1;
		
		int UnitPrice,UnitPrice1;
		int MOQ,MOQ1;
		
		String UnitPrice_xpath;
		String MOQ_xpath;
		
		int CheckBox=1;
		if(checkifRowExistsinTable("//*[@id='zipsearchHeadingResult']/tr["+CheckBox+"]/td[6]"))
		{
			//Check which row is selected
			while(checkifRowExistsinTable("//*[@id='zipsearchHeadingResult']/tr["+CheckBox+"]/td[6]"))
			{
				if((Scenario1Test.driver.findElement(By.xpath("//*[@id='zipsearchHeadingResult']/tr["+CheckBox+"]/td[6]/input[2]")).isSelected())==true)
				{					
					break;
				}
				CheckBox=CheckBox+1;
			}
				
			//Get the UNITPRICE and MOQ of Selected Seller
			 UnitPrice = getNumber(Scenario1Test.driver.findElement(By.xpath("//*[@id='zipsearchHeadingResult']/tr["+CheckBox+"]/td[5]")).getText());
			 MOQ = getNumber(Scenario1Test.driver.findElement(By.xpath("//*[@id='zipsearchHeadingResult']/tr["+CheckBox+"]/td[4]")).getText());
			 
			 log.info("CheckBox Selected is="+CheckBox+"  UnitPrice="+UnitPrice+"  MOQ="+MOQ);
			 
			 int checkfromrow_for_unitprice=1;
			 while(checkifRowExistsinTable("//*[@id='zipsearchHeadingResult']/tr["+checkfromrow_for_unitprice+"]/td[5]"))
			 {
			       if(checkfromrow_for_unitprice==CheckBox)
			       {
			    	   //do nothing
			       }
			       else //check if any seller has got less Unitprice
			       {
			    	   UnitPrice1 = getNumber(Scenario1Test.driver.findElement(By.xpath("//*[@id='zipsearchHeadingResult']/tr["+CheckBox+"]/td[5]")).getText());
			    	   if(UnitPrice1<UnitPrice)
			    	   {
			    		        log.info("Selected wrong unitprice="+UnitPrice+"Expected is="+UnitPrice1); 
							    throw new Exception(); //There is a value lesser
			    	   }	   
			    	   
			       }
			       checkfromrow_for_unitprice=checkfromrow_for_unitprice+1;
			 }//End of while
			 
			 
			 int checkfromrow_for_MOQ=1;
			 while(checkifRowExistsinTable("//*[@id='zipsearchHeadingResult']/tr["+checkfromrow_for_MOQ+"]/td[4]"))
			 {
			       if(checkfromrow_for_MOQ==CheckBox)
			       {
			    	   //do nothing
			       }
			       //Check for least MOQ
			       else if(getNumber(Scenario1Test.driver.findElement(By.xpath("//*[@id='zipsearchHeadingResult']/tr["+checkfromrow_for_MOQ+"]/td[5]")).getText())==UnitPrice)
			       {
			    	   MOQ1 = getNumber(Scenario1Test.driver.findElement(By.xpath("//*[@id='zipsearchHeadingResult']/tr["+checkfromrow_for_MOQ+"]/td[4]")).getText());
			    	   if(MOQ1<MOQ)
			    	   {
			    			    log.info("Selected wrong MOQ="+MOQ+"Expected is="+MOQ1);
							    throw new Exception(); //There is a value lesser
			    	   }	   
			    	   
			       }
			       checkfromrow_for_MOQ=checkfromrow_for_MOQ+1;
			 }//End of while
			   
				WebElement offerPrice=Scenario1Test.driver.findElement(By.xpath("//*[@id='product-price-3753']/span[1]"));
				WebElement Quantity=Scenario1Test.driver.findElement(By.xpath("//*[@id='qty']"));
            	WebElement Estimated_SubTotal=Scenario1Test.driver.findElement(By.xpath("//*[@id='estimated_price']"));
				
				int offerPrice_Pricing=getNumber(offerPrice.getText());
				int Quantity_Pricing=getNumber(Quantity.getAttribute("value"));
				int Estimated_SubTotal_Pricing=getNumber(Estimated_SubTotal.getText());
				int SubTotal=(offerPrice_Pricing*Quantity_Pricing);
				
				System.out.println("Quantity_Pricing"+offerPrice_Pricing+"Quantity_Pricing"+Quantity_Pricing+"Estimated_SubTotal_Pricing"+Estimated_SubTotal_Pricing);
				
				Assert.assertEquals(UnitPrice, offerPrice_Pricing);
				log.info("Asserion Passed : Selected least seller Price from the Table");
				
				Assert.assertEquals(Estimated_SubTotal_Pricing,SubTotal);
				log.info("Asserion Passed : Estimated SubTotal is same");
				
				
				
				
				//Assert.assertEquals(actual, expected);
				
				
			 
		}
		else
		{
			    log.info("No Sellers are Available at this Pincode");
				throw new Exception();
			
		}
		
  }
	private static boolean checkifRowExistsinTable(String Xpath)
	{
	    	int size=Scenario1Test.driver.findElements(By.xpath(Xpath)).size();
	    	if(size>0) return true;
	    	else return false;
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

//		if((checkifRowExistsinTable("//*[@id='zipsearchHeadingResult']/tr["+unitprice_rowNumber+"]/td[5]")))
//		{
//			int UnitPrice1 = getNumber(Scenario1Test.driver.findElement(By.xpath("//*[@id='zipsearchHeadingResult']/tr["+unitprice_rowNumber+"]/td[5]")).getText());		    	      		    	      
//  	        UnitPrice=UnitPrice1;		    	      
//  	        UnitPrice_xpath="//*[@id='zipsearchHeadingResult']/tr["+unitprice_rowNumber+"]/td[5]";
//  	      
//			switch(1)
//			{
//			     case 1: //Get lowest UnitPrice//Verifying if Row2 exists
//		    	      
//		    	      unitprice_rowNumber=unitprice_rowNumber+1;
//		    	      
//			    	  while(checkifRowExistsinTable("//*[@id='zipsearchHeadingResult']/tr["+(unitprice_rowNumber)+"]/td[5]"))
//			    	  {  
//			    	      int UnitPrice2 = getNumber(Scenario1Test.driver.findElement(By.xpath("//*[@id='zipsearchHeadingResult']/tr["+unitprice_rowNumber+"]/td[5]")).getText());
//			    	     
//			    	      if(UnitPrice1>UnitPrice2)
//			    	      {			    	    	  
//			    	    	  finalrow_unitprice=unitprice_rowNumber;
//			    	      }
//			    	      
//			    	      unitprice_rowNumber=unitprice_rowNumber+1;
//			    	     
//			    	  }     
//			    	 
//			     case 2: //Get lowest MOQ 
//			    	  
//			    	 MOQ_rowNumber=MOQ_rowNumber+1;
//			    	 
//			    	 while(checkifRowExistsinTable("//*[@id='zipsearchHeadingResult']/tr["+(MOQ_rowNumber)+"]/td[4]"))
//			    	  {  
//			    	      int MOQ2 = getNumber(Scenario1Test.driver.findElement(By.xpath("//*[@id='zipsearchHeadingResult']/tr["+MOQ_rowNumber+"]/td[4]")).getText());
//			    	     
//			    	     
//			    	     
//			    	  }  
//			    	
//			    	 
//			}
//			
//			
//		}
//		else
//		{
//			try 
//			{
//				throw new Exception();
//			} 
//			catch (Exception e) 
//			{
//				e.printStackTrace();
//			}
//			
//		}
//		
//		while(checkifRowExistsinTable("//*[@id='zipsearchHeadingResult']/tr["+i+"]/td[4]"))
//		{
//			//getNumber Changes String to Number
//		    MOQ.add(getNumber(Scenario1Test.driver.findElement(By.xpath("//*[@id='zipsearchHeadingResult']/tr["+i+"]/td[4]")).getText()));
//	
//		 i=i+1;	
//		}
//		System.out.println(MOQ);
//		
//		
//		//Step2 : Get the UnitPrice of Each Seller
//		List UnitPrice=new ArrayList();
//		int j=1; //Start from the First row of the Table
//		while(checkifRowExistsinTable("//*[@id='zipsearchHeadingResult']/tr["+j+"]/td[5]"))
//		{
//			//getNumber Changes String to Number
//			UnitPrice.add(getNumber(Scenario1Test.driver.findElement(By.xpath("//*[@id='zipsearchHeadingResult']/tr["+j+"]/td[5]")).getText()));
//	
//		 j=j+1;	
//		}
//		System.out.println(UnitPrice);

