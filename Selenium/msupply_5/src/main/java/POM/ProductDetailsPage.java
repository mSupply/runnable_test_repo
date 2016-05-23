package POM;

import java.util.ArrayList;
import java.util.List;

import org.apache.log4j.Logger;
import org.openqa.selenium.By;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;
import org.testng.Assert;

import GenericLibrary.LogReports;
import Scenarios.Scenario1Test;

public class ProductDetailsPage 
{	

	Logger log = LogReports.writeLog(ProductDetailsPage.class);
	
	
	
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
            	WebElement Estimated_SubTotal=Scenario1Test.driver.findElement(By.xpath("//*[@id='product_addtocart_form']/div[2]/div[2]/div[1]/div[6]"));
				
				int offerPrice_Pricing=getNumber(offerPrice.getText());
				int Quantity_Pricing=getNumber(Quantity.getAttribute("value"));
				int Estimated_SubTotal_Pricing=getNumber(Estimated_SubTotal.getText());
				int SubTotal=(offerPrice_Pricing*Quantity_Pricing);
				
				//System.out.println("Quantity_Pricing"+offerPrice_Pricing+"Quantity_Pricing"+Quantity_Pricing+"Estimated_SubTotal_Pricing"+Estimated_SubTotal_Pricing);
				
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

