package POM;

import org.apache.log4j.Logger;
import org.openqa.selenium.By;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;
import org.testng.Assert;
import org.testng.annotations.Test;
import GenericLibrary.LogReports;
import Scenarios.Scenario1Test;


public class ShoppingCartPage 
{
	static int SubTotal_List;
	static int ExciseDuty_List_table_Decimal;
	static float Service_Charges_calculated;
	static int Shipping_Handling_Charges_List_Decimal;
	static int Grand_Total_List;
	static int ExciseDuty_Calculated;
	
	public static void cart(String login)
	{
		Logger log = LogReports.writeLog(ShoppingCartPage.class);
		
		int i=1;
		int SubTotal_Kart_All_Products=0;
		float SubTotal_Kart_All_Products_Without_VAT=0;
	    
		while(checkifRowExistsinTable("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+i+"]/td[5]/span/span[1]"))
	    {
		   int unitprice_Kart=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+i+"]/td[5]/span/span[1]")).getText());
		   float VAT_Kart=getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+i+"]/td[5]/span/span[2]")).getText());	
	       int Quantity_Kart=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+i+"]/td[6]")).getText());
	       int SubTotal_Kart=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+i+"]/td[7]")).getText());
	       log.info("unitprice="+unitprice_Kart+"VAT="+VAT_Kart+"Quantity="+Quantity_Kart+"SubTotal"+SubTotal_Kart);
	       
	       //Verify SubTotal
	       int CalculatedSubTotal=unitprice_Kart*Quantity_Kart;	       
	       Assert.assertEquals(SubTotal_Kart, CalculatedSubTotal);
	       log.info("Assert Passed for Kart Table : SubTotal and CalculatedSubToatal is Same");
	       
	       SubTotal_Kart_All_Products=SubTotal_Kart_All_Products+SubTotal_Kart;
	       
	       //Calculate SubTotal Without VAT	       
	       float SubTotal_Kart_without_VAT;
	       float var1=1+(VAT_Kart/100);	       
	       float var2=SubTotal_Kart/var1;	       
	       SubTotal_Kart_without_VAT=var2;       
	       SubTotal_Kart_All_Products_Without_VAT=SubTotal_Kart_All_Products_Without_VAT+SubTotal_Kart_without_VAT;
	       
	       i++;
		}
		
		if(login.equals("BeforeLogin"))
		{
			
			   int unitprice_Kart=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+(i-1)+"]/td[5]/span/span[1]")).getText());
		       int Quantity_Kart=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+(i-1)+"]/td[6]")).getText());
		       int SubTotal_Kart=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+(i-1)+"]/td[7]")).getText());
		       log.info("unitprice="+unitprice_Kart+"Quantity="+Quantity_Kart+"SubTotal"+SubTotal_Kart);
		       
		       
		       log.info("Verifing Product details and cart page");
		       Assert.assertEquals(HomePage.offerPrice_Poductdetails, unitprice_Kart);
		       log.info("Unit Pricing from product details page and Shopping cart page is same");
		       Assert.assertEquals(HomePage.Quantity_Poductdetails, Quantity_Kart);
		       log.info("Quantity from product details page and Shopping cart page is same");
		       Assert.assertEquals(HomePage.Estimated_SubTotal_Poductdetails, SubTotal_Kart);
		       log.info("SubTotal from product details page and Shopping cart page is same");
			
		}
		
		
	       //Verify List Total Section
	       SubTotal_List=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@id='shopping-cart-totals-table']/tbody/tr[1]/td[2]")).getText());
	       float Shipping_Handling_Charges_List=getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@id='shopping-cart-totals-table']/tbody/tr[2]/td[2]")).getText());
	       float Service_charges_List=getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@id='shopping-cart-totals-table']/tbody/tr[3]/td[2]")).getText());
	       float Excise_Duty_List=getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@id='shopping-cart-totals-table']/tbody/tr[4]/td[2]")).getText());
	       Grand_Total_List=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//*[@id='shopping-cart-totals-table']/tfoot/tr/td[2]/span/strong/span")).getText());
	       
	       //Verify SubTotal
	       Assert.assertEquals(SubTotal_Kart_All_Products, SubTotal_List);
	       log.info("Assert Passed for List Table : SubTotal from Kart Section and List Section is Same");
	       
	       //Service Charges
	       float Convience_fee,Service_Tax;
	       
	       if(SubTotal_Kart_All_Products_Without_VAT<1000)
	       {
	              Convience_fee=((10*SubTotal_Kart_All_Products_Without_VAT)/100);
	              Service_Tax=(float) ((14.5*Convience_fee)/100);
	              Service_Charges_calculated=Convience_fee+Service_Tax;
	       }
	       else
	    	     Service_Charges_calculated=(float) 114.50;

	       //Compare Service charges of deimal values only
	       int Service_Charges_calculated_Decimal=(new Float(Service_Charges_calculated)).intValue();
	       int Service_charges_List_Decimal=(new Float(Service_charges_List)).intValue();
	       
	       Assert.assertEquals(Service_charges_List_Decimal, Service_Charges_calculated_Decimal);
	       log.info("Assert Passed for Service charges List Table : Calculated Service is"+Service_Charges_calculated_Decimal);
	       
	       //Calculate the Excise Duty	       
	       ExciseDuty_List_table_Decimal=(new Float(Excise_Duty_List)).intValue();	       
	       Assert.assertEquals(ExciseDuty_List_table_Decimal,ExciseDuty_Calculated);	 
	       log.info("Assert Passed for Excise duty List Table : Calculated is"+ExciseDuty_List_table_Decimal);
	       
	       //Verify the SubTotal
	       int Grand_Total_List_calculated_Decimal=(int) (SubTotal_List+Shipping_Handling_Charges_List+Service_charges_List+Excise_Duty_List);
	       Assert.assertEquals(Grand_Total_List, Grand_Total_List_calculated_Decimal);
	       log.info("Assert Passed for GranTotal List Table : Calculated GrandTotal is"+Grand_Total_List_calculated_Decimal);
	    
	    
	       Shipping_Handling_Charges_List_Decimal=new Float(Shipping_Handling_Charges_List).intValue();
	       
	       
	}    

	
	public static void CartforRMC(String login)
	{
		Logger log = LogReports.writeLog(ShoppingCartPage.class);
		
		int i=1;
		int SubTotal_Kart_All_Products=0;
		float SubTotal_Kart_All_Products_Without_VAT=0;
	    
		while(checkifRowExistsinTable("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+i+"]/td[5]/span/span[1]"))
	    {
		   int unitprice_Kart=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+i+"]/td[5]/span/span[1]")).getText());
		   float VAT_Kart=getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+i+"]/td[5]/span/span[2]")).getText());	
	       int Quantity_Kart=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+i+"]/td[6]")).getText());
	       int SubTotal_Kart=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+i+"]/td[7]")).getText());
	       log.info("unitprice="+unitprice_Kart+"VAT="+VAT_Kart+"Quantity="+Quantity_Kart+"SubTotal"+SubTotal_Kart);
	       
	       //Verify SubTotal
	       int CalculatedSubTotal=unitprice_Kart*Quantity_Kart;	       
	       Assert.assertEquals(SubTotal_Kart, CalculatedSubTotal);
	       log.info("Assert Passed for Kart Table : SubTotal and CalculatedSubToatal is Same");
	       
	       SubTotal_Kart_All_Products=SubTotal_Kart_All_Products+SubTotal_Kart;
	       
	       //Calculate SubTotal Without VAT	       
	       float SubTotal_Kart_without_VAT;
	       float var1=1+(VAT_Kart/100);	      
	       float var2=SubTotal_Kart/var1;	       
	       SubTotal_Kart_without_VAT=var2;       
	       SubTotal_Kart_All_Products_Without_VAT=SubTotal_Kart_All_Products_Without_VAT+SubTotal_Kart_without_VAT;
	       
	       i++;
		}
	    
		
		if(login.equals("BeforeLogin"))
		{
			
			   int unitprice_Kart=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+(i-1)+"]/td[5]/span/span[1]")).getText());
		       int Quantity_Kart=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+(i-1)+"]/td[6]")).getText());
		       int SubTotal_Kart=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+(i-1)+"]/td[7]")).getText());
		       log.info("unitprice="+unitprice_Kart+"Quantity="+Quantity_Kart+"SubTotal"+SubTotal_Kart);
		       
		       
		       log.info("Verifing Product details and cart page");
		       Assert.assertEquals(HomePage.offerPrice_Poductdetails, unitprice_Kart);
		       log.info("Unit Pricing from product details page and Shopping cart page is same");
		       Assert.assertEquals(HomePage.Quantity_Poductdetails, Quantity_Kart);
		       log.info("Quantity from product details page and Shopping cart page is same");
		       Assert.assertEquals(HomePage.Estimated_SubTotal_Poductdetails, SubTotal_Kart);
		       log.info("SubTotal from product details page and Shopping cart page is same");
			
		}
		
	       //Verify List Total Section
	       int SubTotal_List=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@id='shopping-cart-totals-table']/tbody/tr[1]/td[2]")).getText());
	       float Shipping_Handling_Charges_List=getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@id='shopping-cart-totals-table']/tbody/tr[2]/td[2]")).getText());
	       float Service_charges_List=getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@id='shopping-cart-totals-table']/tbody/tr[3]/td[2]")).getText());
	       float Excise_Duty_List=getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@id='shopping-cart-totals-table']/tbody/tr[4]/td[2]")).getText());
	       int Grand_Total_List=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//*[@id='shopping-cart-totals-table']/tfoot/tr/td[2]/span/strong/span")).getText());
	       
	       //Verify SubTotal
	       Assert.assertEquals(SubTotal_Kart_All_Products, SubTotal_List);
	       log.info("Assert Passed for List Table : SubTotal from Kart Section and List Section is Same");
	       
	       //Service Charges
	       float Convience_fee,Service_Tax,Service_Charges_calculated;
	       
	       if(SubTotal_Kart_All_Products_Without_VAT<1000)
	       {
	              Convience_fee=((10*SubTotal_Kart_All_Products_Without_VAT)/100);
	              Service_Tax=(float) ((14.5*Convience_fee)/100);
	              Service_Charges_calculated=Convience_fee+Service_Tax;
	       }
	       else
	    	     Service_Charges_calculated=(float) 114.50;

	       //Compare Service charges of deimal values only
	       int Service_Charges_calculated_Decimal=(new Float(Service_Charges_calculated)).intValue();
	       int Service_charges_List_Decimal=(new Float(Service_charges_List)).intValue();
	       
	       Assert.assertEquals(Service_charges_List_Decimal, Service_Charges_calculated_Decimal);
	       log.info("Assert Passed for Service charges List Table : Calculated Service is"+Service_Charges_calculated_Decimal);
	       
	       //Calculate the Excise Duty
	       ExciseDuty_Calculated=(new Float((2*(SubTotal_Kart_All_Products_Without_VAT))/100)).intValue();
	       ExciseDuty_List_table_Decimal=(new Float(Excise_Duty_List)).intValue();
	       Assert.assertEquals(ExciseDuty_Calculated, ExciseDuty_List_table_Decimal);
	       log.info("Assert Passed for Excise duty List Table : Calculated is"+ExciseDuty_Calculated);
	       
	       //Verify the SubTotal
	       int Grand_Total_List_calculated_Decimal=(int) (SubTotal_List+Shipping_Handling_Charges_List+Service_charges_List+Excise_Duty_List);
	       Assert.assertEquals(Grand_Total_List, Grand_Total_List_calculated_Decimal);
	       log.info("Assert Passed for GranTotal List Table : Calculated GrandTotal is"+Grand_Total_List_calculated_Decimal);
	       
	    
	}  
	
	
	public static void cartforPaymnetMethods()
	{	
		SubTotal_List=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@id='shopping-cart-totals-table']/tbody/tr[1]/td[2]")).getText());
	    float Shipping_Handling_Charges_List=getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@id='shopping-cart-totals-table']/tbody/tr[2]/td[2]")).getText());
	    float Excise_Duty_List=getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@id='shopping-cart-totals-table']/tbody/tr[4]/td[2]")).getText());
	    Shipping_Handling_Charges_List_Decimal=new Float(Shipping_Handling_Charges_List).intValue();
	    ExciseDuty_List_table_Decimal=(new Float(Excise_Duty_List)).intValue();	       
	       
	}
	
	public static void removeCartProducts()
	{
		int i=1;
		
		while(checkifRowExistsinTable("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+i+"]/td[5]/span/span[1]"))
	    {
		   Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+i+"]/td[8]/a")).click();		  
	    }
	}		

	
	
	private static boolean checkifRowExistsinTable(String Xpath)
	{
	    	int size=Scenario1Test.driver.findElements(By.xpath(Xpath)).size();
	    	if(size>0) return true;
	    	else return false;
	}
	private static float getNumber(String str)
	{
		StringBuilder myNumbers = new StringBuilder();
		for (int i = 0; i < str.length(); i++)
		{
		    if (Character.isDigit(str.charAt(i))||str.charAt(i)=='.')
		       {
		           myNumbers.append(str.charAt(i));
		           if(str.charAt(i)=='.')
		           {
		           	for(int j=i+1;j<(i+2);j++)
		           		myNumbers.append(str.charAt(j));
		           	break;
		           }
		       }
		}
		   
		   String Numbers=myNumbers.toString();
		   float a=Float.parseFloat(Numbers);
		   return a;
	}
}

