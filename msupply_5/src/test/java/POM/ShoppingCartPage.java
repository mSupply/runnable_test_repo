package POM;

import java.util.ArrayList;

import org.apache.log4j.Logger;
import org.openqa.selenium.By;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;
import org.testng.Assert;
import org.testng.annotations.Test;
import GenericLibrary.LogReports;
import GenericLibrary.RetrieveXlsxData;
import GenericLibrary.WebDriverCommonFunctions;
import SanityTest.ServiceChargeCalculation_KartPage_Test;
import Scenarios.Scenario1Test;


public class ShoppingCartPage 
{
	public static int SubTotal_List;
	public static double Service_Charges_calculated;
	public static int Shipping_Handling_Charges_List_Decimal;
	public static int Grand_Total_List;
	public static ArrayList ProductDetails_Kart_BeforeLogin=new ArrayList();
	public static ArrayList ProductDetails_Kart_AfterLogin=new ArrayList();
	public static Logger log;
	private static int OldProductUnitPrice;
	private static int OldProductQty;
	private static int OldProductSubTotal;
	

	
	public static void cart(String login) throws Throwable
	{
		log = LogReports.writeLog(ShoppingCartPage.class);
		
		int i=1;
		int SubTotal_Kart_All_Products=0;
		
		//Verify the SubTotal of all the Products from UnitPrice and QTY
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

	       i++;
		}
		
		
		//Verify the values from product details page and Shopping cart page is same
		if(login.equals("BeforeLogin"))
		{
		   GetProductDetailsFromKartTable(i);       
		}
        if(login.equals("AddProductAfterLogin"))
        {
        	int j=getNoOfRowsInKartTable();
        	
        	while(checkifRowExistsinTable("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+j+"]/td[5]/span/span[1]"))
    	    {
        		String ProductName_KartTable=(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+j+"]/td[2]")).getText()).toUpperCase();
        		
        		//Check for existing product
        		if(ProductDetails_Kart_BeforeLogin.contains(ProductName_KartTable))
        		{
        		
        		   GetProductDetailsFromArrayList(ProductName_KartTable);
        			
        		   int unitprice_Kart=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+j+"]/td[5]/span/span[1]")).getText());
     		       int Quantity_Kart=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+j+"]/td[6]")).getText());
     		       int SubTotal_Kart=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+j+"]/td[7]")).getText());
     		        
        		   //Verify OfferPrice
     			   Assert.assertEquals(unitprice_Kart,OldProductUnitPrice);
     		       log.info("Unit Pricing after adding existing product is same");     		      
     		       
     		       //Verify Quantity
     		       int NewProductQty=ProductDetailsPage.Quantity_Poductdetails_Page+OldProductQty;
    		       Assert.assertEquals(Quantity_Kart,NewProductQty);
    		       log.info("Quantity is correctly incremented");
    		       
    		       //Verify SubTotal
    		       int NewProductSubTotal=ProductDetailsPage.Estimated_SubTotal_Poductdetails_Page+OldProductSubTotal;
    		       Assert.assertEquals(SubTotal_Kart,NewProductSubTotal);
    		       log.info("SubTotal is correctly incremented");    			    
    		       
        			break;
        		}
        		else
        		{
        			
        			GetProductDetailsFromKartTable(i);  
        			break;
        			
        		}
           }
       }
		
		       
	       //Verify List Total Section
	       SubTotal_List=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@id='shopping-cart-totals-table']/tbody/tr[1]/td[2]")).getText());
	       double Shipping_Handling_Charges_List=getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@id='shopping-cart-totals-table']/tbody/tr[2]/td[2]")).getText());
	       double Service_charges_List=getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@id='shopping-cart-totals-table']/tbody/tr[3]/td[2]")).getText());
	       Grand_Total_List=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//*[@id='shopping-cart-totals-table']/tfoot/tr/td[2]/span/strong/span")).getText());
	       
	       //Verify SubTotal
	       Assert.assertEquals(SubTotal_Kart_All_Products, SubTotal_List);
	       log.info("Assert Passed for List Table : SubTotal from Kart Section and List Section is Same");
	       
	       //Service Charges
	       double Convience_fee,Service_Tax;
	       double SubTotal_Kart_All_Products_And_Shipping_Handling_Charges_List=Shipping_Handling_Charges_List+SubTotal_Kart_All_Products;
	       
	       if(SubTotal_Kart_All_Products_And_Shipping_Handling_Charges_List<1000)
	       {
	              Convience_fee=((10*SubTotal_Kart_All_Products_And_Shipping_Handling_Charges_List)/100);
	              Service_Tax=(double) ((15*Convience_fee)/100);
	              Service_Charges_calculated=Convience_fee+Service_Tax;
	       }
	       else
	    	     Service_Charges_calculated=(float) 115.00;

	       System.out.println(Service_Charges_calculated);
	       
	       //Compare Service charges of deimal values only
	       int Service_Charges_calculated_Decimal=(new Float(Service_Charges_calculated)).intValue();
	       int Service_charges_List_Decimal=(new Float(Service_charges_List)).intValue();
	       
	       Assert.assertEquals(Service_charges_List_Decimal, Service_Charges_calculated_Decimal);
	       log.info("Assert Passed for Service charges List Table : Calculated Service is"+Service_Charges_calculated_Decimal);

	       //Verify the SubTotal
	       int Grand_Total_List_calculated_Decimal=(int) (SubTotal_List+Shipping_Handling_Charges_List+Service_charges_List);
	       Assert.assertEquals(Grand_Total_List, Grand_Total_List_calculated_Decimal);
	       log.info("Assert Passed for GranTotal List Table : Calculated GrandTotal is"+Grand_Total_List_calculated_Decimal);	    
	    
	       Shipping_Handling_Charges_List_Decimal=new Float(Shipping_Handling_Charges_List).intValue();
	       	       
	  }    
	    	
	//Storing List Total Section
    //Store the KartDetails into List before Login, this will be used to compare with the Items after login
  
	public static int getNoOfRowsInKartTable() 
	{
        int i=1;
		while(checkifRowExistsinTable("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+i+"]/td[5]/span/span[1]"))
	    {
		   i++;	
	    }
		
      	return i;
	}

	public static void StoreKartPagesinList(String name) 
	{
		int j=1;
    	while(checkifRowExistsinTable("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+j+"]/td[5]/span/span[1]"))
	    {
    		
    		   String ProductName_KartTable=(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+j+"]/td[2]")).getText()).toUpperCase();
			   String SellerName_KartTable=Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+j+"]/td[3]")).getText();
			   String Pincode_KartTable=Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+j+"]/td[4]")).getText();
			   int unitprice_Kart=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+j+"]/td[5]/span/span[1]")).getText());
		       int Quantity_Kart=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+j+"]/td[6]")).getText());
		       float VAT_Kart=getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+j+"]/td[5]/span/span[2]")).getText());
		       int SubTotal_Kart=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+j+"]/td[7]")).getText());
	    
		       if(name.equals("DetailsBeforeLogin"))
		       {   
		    	   ProductDetails_Kart_BeforeLogin.add(ProductName_KartTable);
		    	   ProductDetails_Kart_BeforeLogin.add(SellerName_KartTable);
		    	   ProductDetails_Kart_BeforeLogin.add(Pincode_KartTable);
		    	   ProductDetails_Kart_BeforeLogin.add(unitprice_Kart);
		    	   ProductDetails_Kart_BeforeLogin.add(Quantity_Kart);
		    	   ProductDetails_Kart_BeforeLogin.add(VAT_Kart);
		    	   ProductDetails_Kart_BeforeLogin.add(SubTotal_Kart);
		       }
		       if(name.equals("DetailsAfterLogin"))
		       {
		    	   ProductDetails_Kart_AfterLogin.add(ProductName_KartTable);
		    	   ProductDetails_Kart_AfterLogin.add(SellerName_KartTable);
		    	   ProductDetails_Kart_AfterLogin.add(Pincode_KartTable);
		    	   ProductDetails_Kart_AfterLogin.add(unitprice_Kart);
		    	   ProductDetails_Kart_AfterLogin.add(Quantity_Kart);
		    	   ProductDetails_Kart_AfterLogin.add(VAT_Kart);
		    	   ProductDetails_Kart_AfterLogin.add(SubTotal_Kart);
			          
		       }
		       
	           j++;
	           
	           
	    }
    	
 	       int SubTotal_List=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@id='shopping-cart-totals-table']/tbody/tr[1]/td[2]")).getText());
		   double Shipping_Handling_Charges_List=getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@id='shopping-cart-totals-table']/tbody/tr[2]/td[2]")).getText());
		   double Service_charges_List=getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@id='shopping-cart-totals-table']/tbody/tr[3]/td[2]")).getText());
		   int Grand_Total_List=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//*[@id='shopping-cart-totals-table']/tfoot/tr/td[2]/span/strong/span")).getText());

		   
		   if(name.equals("DetailsBeforeLogin"))
	       {    
			   ProductDetails_Kart_BeforeLogin.add(SubTotal_List);
			   ProductDetails_Kart_BeforeLogin.add(Shipping_Handling_Charges_List);
			   ProductDetails_Kart_BeforeLogin.add(Service_charges_List);
			   ProductDetails_Kart_BeforeLogin.add(Grand_Total_List);
	       }
	       if(name.equals("DetailsAfterLogin"))
	       {
	    	   ProductDetails_Kart_AfterLogin.add(SubTotal_List);
	    	   ProductDetails_Kart_AfterLogin.add(Shipping_Handling_Charges_List);
	    	   ProductDetails_Kart_AfterLogin.add(Service_charges_List);
	    	   ProductDetails_Kart_AfterLogin.add(Grand_Total_List);
	             
	       }
	 	
	}
	
	
	public static void cartforPaymnetMethods()
	{	
		SubTotal_List=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@id='shopping-cart-totals-table']/tbody/tr[1]/td[2]")).getText());
	    float Shipping_Handling_Charges_List=getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@id='shopping-cart-totals-table']/tbody/tr[2]/td[2]")).getText());
	    Shipping_Handling_Charges_List_Decimal=new Float(Shipping_Handling_Charges_List).intValue();       
	       
	}
	
	public static void removeCartProducts() throws Exception
	{
		Thread.sleep(10000);
		Scenario1Test.driver.switchTo().defaultContent();
		Thread.sleep(10000);
		Scenario1Test.driver.switchTo().defaultContent();
		Scenario1Test.driver.findElement(By.xpath("//li[@id='lnkAccount']/following::li[1]")).click();
		
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

	public static void compareBeforeLoginAfterLoginKartDetails() throws Throwable 
	{
		
       for(int i=0,j=0;i<ProductDetails_Kart_BeforeLogin.size() && j<ProductDetails_Kart_AfterLogin.size();i++,j++)
       {
    	   if(ProductDetails_Kart_BeforeLogin.get(i).equals(ProductDetails_Kart_AfterLogin.get(j)))
    	   {
    		//do nothing 
    		   log.info("Pass - >Before Login : "+ProductDetails_Kart_BeforeLogin.get(i));
    		   log.info("Pass - >After Login : "+ProductDetails_Kart_AfterLogin.get(j));
    		   
    	   }
    	   else
    	   {
    		   log.info("Error - >Before Login : "+ProductDetails_Kart_BeforeLogin.get(i));
    		   log.info("Error - >Before Login : "+ProductDetails_Kart_AfterLogin.get(j));
    		   throw new Exception();
        	   
    	   }
    	  
       }
       
	}
	
	public static void GetProductDetailsFromArrayList(String ProductName) throws Throwable 
   	   {
   		
          for(int i=0;i<ProductDetails_Kart_BeforeLogin.size();i++)
          {
        	  
        	  if(ProductDetails_Kart_BeforeLogin.get(i).equals(ProductName))
      		  {
      		     
        		  OldProductUnitPrice=(Integer) ProductDetails_Kart_BeforeLogin.get(i+3);
        		  OldProductQty=(Integer) ProductDetails_Kart_BeforeLogin.get(i+4);
        		  OldProductSubTotal=(Integer) ProductDetails_Kart_BeforeLogin.get(i+6);
      		  }    		
       	    
       	  
          }
   	    
   	   }

	public static void GetProductDetailsFromKartTable(int i) throws Throwable
	{
		   int unitprice_Kart=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+(i-1)+"]/td[5]/span/span[1]")).getText());
	       int Quantity_Kart=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+(i-1)+"]/td[6]")).getText());
	       int SubTotal_Kart=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+(i-1)+"]/td[7]")).getText());
	       
	       log.info("unitprice="+unitprice_Kart+"Quantity="+Quantity_Kart+"SubTotal"+SubTotal_Kart);
	       
	       //Verify Product Name
	       log.info("Verifing Product details and cart page");
	       String ProductName_KartTable=(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+(i-1)+"]/td[2]")).getText()).toUpperCase();
		   Assert.assertEquals(ProductName_KartTable,ProductDetailsPage.ProductName_Poductdetails_Page);
		   log.info("Product Name from product details page and Shopping cart page is same");
		   
		   //Verify Seller Name
		   String SellerName_KartTable=Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+(i-1)+"]/td[3]")).getText();
		   if(SellerName_KartTable.contains(ProductDetailsPage.SellerName_ProductDetails_Page))
		      log.info("Seller Name from product details page and Shopping cart page is same");
		   else
		   {
			   log.info("Seller Name from product details page and Shopping cart page are different");
			   throw new Exception();
			   
		   }
		   
		   //Verify Pincode
		   String Pincode_KartTable=Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+(i-1)+"]/td[4]")).getText();
		   Assert.assertEquals(Pincode_KartTable, ProductDetailsPage.pincode_ProductDetails_Page);
		   log.info("Pincode from product details page and Shopping cart page is same");
		   
		   //Verify OfferPrice
		   Assert.assertEquals(ProductDetailsPage.offerPrice_Poductdetails_Page, unitprice_Kart);
	       log.info("Unit Pricing from product details page and Shopping cart page is same");
	       
	       //Verify Quantity
	       Assert.assertEquals(ProductDetailsPage.Quantity_Poductdetails_Page, Quantity_Kart);
	       log.info("Quantity from product details page and Shopping cart page is same");
	       
	       //Verify SubTotal
	       Assert.assertEquals(ProductDetailsPage.Estimated_SubTotal_Poductdetails_Page, SubTotal_Kart);
	       log.info("SubTotal from product details page and Shopping cart page is same");
	
	}

	public void placeOrder() throws Throwable 
	{
	   WebDriverCommonFunctions.element_Click("KartPage_PlaceOrderButton_Xpath", "Clicked on Place Order in Homepage");		
		
	}
	
	public static void mSupplylogin() throws Throwable
	{	   
		   String ExcelData[]=RetrieveXlsxData.getExcelData("LoginID_4");
		   String mobileNumber=ExcelData[1];
		   String password=ExcelData[2];
		   
		   WebDriverCommonFunctions.element_EnterValuesToTextField("MobileNumberField_Xpath", mobileNumber, "Entered MobileNumber");
		   WebDriverCommonFunctions.element_EnterValuesToTextField("PasswordField_Xpath", password, "Entered Password");
	       WebDriverCommonFunctions.element_Click("LoginButton_Xpath", "Clicked on Login Button");
	       
	}
	
}

