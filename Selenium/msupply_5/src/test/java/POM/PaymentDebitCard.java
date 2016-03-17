package POM;

import java.io.IOException;
import java.text.DecimalFormat;

import org.apache.log4j.Logger;
import org.apache.poi.openxml4j.exceptions.InvalidFormatException;
import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;

import GenericLibrary.LogReports;
import Scenarios.Scenario1Test;
import junit.framework.Assert;

public class PaymentDebitCard 
{
	   Logger log = LogReports.writeLog(PaymentDebitCard.class);
		
		@FindBy(xpath="//div[contains(@id,'addresseList')][2]/div/address")
		WebElement Address2_Billing;
		
		@FindBy(xpath="//div[@id='shipping_fields']/div/div/div[contains(@id,'addresseList')][2]/div/address")
		WebElement Address2_Shipping;
		
		@FindBy(xpath="//*[@id='billing-buttons-container']/div/div[2]/button")
		WebElement SaveAndContinue_Billing;
		
		@FindBy(xpath="//*[@id='shipping-buttons-container']/div[2]/span[3]/button")
		WebElement SaveAndContinue_Shipping;
		
		//@FindBy(xpath="//*[@id='tab_paymenthdfc_standard']")
		@FindBy(xpath="//a[@id='tab_paymenthdfcdc_standard']/label[text()='Debit Card ']")
		WebElement DebitcardOption;
		
		@FindBy(xpath="//*[@id='sub_charge']")
		WebElement ActualSubTotal;
		
		@FindBy(xpath="//*[@id='checkout-payment-method-load']/div[2]/div/ul/li[2]/span[2]")
		WebElement ActualShippingCharges;
		
		@FindBy(xpath="//*[@id='checkout-payment-method-load']/div[2]/div/ul/li[3]/span[2]")
		WebElement ActualVAT;
		
		@FindBy(xpath="//*[@id='pay_charge']")
		WebElement ActualServiceCharge;
		
		@FindBy(xpath="//*[@id='gtotal']")
		WebElement ActualGrandTotal;
		
		@FindBy(xpath="//div[@id='payment_form_hdfcdc_standard']/div/button")
		WebElement ContinueButtonPayment;
		
		@FindBy(xpath="//*[@id='checkout-review-table']/tfoot/tr[1]/td[2]")
		WebElement ConfirmOrderSubtotal;
		
		@FindBy(xpath="//*[@id='checkout-review-table']/tfoot/tr[2]/td[2]")
		WebElement ConfirmOrderShippingCharges;
		
		@FindBy(xpath="//*[@id='checkout-review-table']/tfoot/tr[3]/td[2]")
		WebElement ConfirmOrderVAT;
		
		@FindBy(xpath="//*[@id='checkout-review-table']/tfoot/tr[4]/td[2]")
		WebElement ConfirmOrderServicecharges;
		
		@FindBy(xpath="//*[@id='checkout-review-table']/tfoot/tr[5]/td[2]")
		WebElement ConfirmOrderGrandTotal;
		
		@FindBy(xpath="//button[@title='Place Order']")
		WebElement PlaceOrder;
		
		@FindBy(xpath="//button[@class='button btn-checkout']")
		WebElement ConfirmOrderBUY;
		
		public void DebitCard() throws IOException, InterruptedException 
		{ 
			Scenario1Test.wdcf.waitForPageToLoad();
					
		    //Calculate VAT : This is for Getting VAT information of the Items added to cart
			log.info("Verifing VAT Charges");
			float ExpectedVAT=0; 
			int i=1; //Start from the First row of the Table
			while(checkifRowExistsinTableCart("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+i+"]"))
			{
			 float percentage=getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+i+"]/td[5]")).getText());
			 float TotalCalculated=getNumber(Scenario1Test.driver.findElement(By.xpath("//table[@class='cart-table bdtable table table-condensed']/tbody/tr["+i+"]/td[7]")).getText());
			 float temp=percentage*(TotalCalculated)/100;
			 ExpectedVAT=ExpectedVAT+temp;
			 log.info(percentage+":"+TotalCalculated+":"+temp);
			 i=i+1;	
			}
			ExpectedVAT=Roundretain2Decimal(ExpectedVAT); //This Will round from 13.345 to 13.35
			log.info("Calculated VAT="+ExpectedVAT);
					
			//Scroll down to click on Place order Button since the element is not visible 
	        JavascriptExecutor jse1 = (JavascriptExecutor)Scenario1Test.driver;
	        jse1.executeScript("window.scrollBy(0,330)", "");      
	        
	        log.info("Clicked on PaceOrder");
	        PlaceOrder.click();		
			log.info("Click on Address2 in Billing");
			Address2_Billing.click();			
			log.info("Click on SaveAndContinue in Billing");
			SaveAndContinue_Billing.click();	
			log.info("Click on Address2 in Shipping");
			Address2_Shipping.click();	
			log.info("Click on SaveAndContinue in Shipping");
			SaveAndContinue_Shipping.click();
			Thread.sleep(3000);		
			
			//Step 1: Select payment method as NetBanking
			log.info("Click on Debitcard Option");
			DebitcardOption.click();

			       
			String str=null;
			
			/*Get information from Payment details page*/
			str=ActualSubTotal.getText();
			float ActualSubTotalValue=getNumber(str);				
			str=ActualServiceCharge.getText();
			float ActualServiceChargeValue=getNumber(str);	
			str=ActualShippingCharges.getText();
			float ActualShippingChargesvalue=getNumber(str);		
			str=ActualVAT.getText();
			float ActualVATValue=getNumber(str);		
			str=ActualGrandTotal.getText();
			float ActualGrandTotalValue=getNumber(str);
			
			//Step 2 : Calculate Payment Charges 1.15% for Debit card and Validate
			if(ActualSubTotalValue<1000)
			{	
			   //Calculate the Service charge for SubTotal below 1000 rupees, 1.15% is added for Debit card
				//Service charge is 10% of Subtotal+14.5% of(10% of subtotal)+1.15% of subtotal
				
			   float ConvienceFee1=10*(ActualSubTotalValue)/100;
			   float ConvienceFee2=(float) (14.5*(ConvienceFee1)/100);
			   float CreditcardPaymentCharges=(float) (1.15*(ActualSubTotalValue)/100);
			   float ExpectedServiceCharge=ConvienceFee1+ConvienceFee2+CreditcardPaymentCharges;
			   log.info("ExpectedServiceCharge without removing decimal"+ExpectedServiceCharge);
			   try
			   {
			      ExpectedServiceCharge=retain2Decimal(ExpectedServiceCharge);
			   }
			   catch(Exception e)
			   {
				   System.out.println("Exception="+ExpectedServiceCharge);
			   }
			
			   log.info("Expected servicecharge"+ExpectedServiceCharge);
			   log.info("Actual servicecharge"+ActualServiceChargeValue);		
			   Assert.assertEquals(ExpectedServiceCharge,ActualServiceChargeValue);
			   log.info("Assert values for ServiceChages are same");		
			}
			else
			{
				//Calculate the Service charge for SubTotal above 1000 rupees, 1.15% is added for Debit Card
				//Service charge is 100+14.5%(100)+1.15% of subtotal
				
			   float ConvienceFee1=100;
			   float ConvienceFee2=(float) (14.5*(ConvienceFee1)/100);
			   float CreditcardPaymentCharges=(float) (1.15*(ActualSubTotalValue)/100);
			   float ExpectedServiceCharge=ConvienceFee1+ConvienceFee2+CreditcardPaymentCharges;
			   log.info("ExpectedServiceCharge without removing decimal"+ExpectedServiceCharge);
			   try
			   {
			      ExpectedServiceCharge=retain2Decimal(ExpectedServiceCharge);
			   }
			   catch(Exception e)
			   {
				   System.out.println("Exception="+ExpectedServiceCharge);
			   }
			
			   log.info("Expected servicecharge"+ExpectedServiceCharge);
			   log.info("Actual servicecharge"+ActualServiceChargeValue);		
			   Assert.assertEquals(ExpectedServiceCharge,ActualServiceChargeValue);
			   log.info("Assert values for ServiceChages are same");		
			}
			
			//Step 3 : Validate VAT charges, ExpectedVAT is got from the PlaceOrder/ShoppingList page
			log.info("Validating VAT");
			log.info("ExpectedVAT"+ExpectedVAT+":"+"ActualVATValue"+ActualVATValue);
			Assert.assertEquals(ExpectedVAT, ActualVATValue);
			log.info("Assert value for VAT are same");
			
			// Validate GrandTotal is calculated correctly						
			float ExpectedGrandTotal=ActualSubTotalValue+ActualShippingChargesvalue+ActualVATValue+ActualServiceChargeValue;
			ExpectedGrandTotal=Roundretain2Decimal(ExpectedGrandTotal);
			
			log.info(ActualSubTotalValue+":"+ActualShippingChargesvalue+":"+ActualVATValue+":"+ActualServiceChargeValue);
			log.info(ExpectedGrandTotal);
			log.info("Expected GrandTotal"+ExpectedGrandTotal);
			log.info("Actual GrandTotal"+ActualGrandTotalValue);		
			Assert.assertEquals(ExpectedGrandTotal, ActualGrandTotalValue);
			log.info("Assert values for GranTotal are same");
			
			//Step 4: Should navigate to Confirm Order page
			ContinueButtonPayment.click();

			
			//Step 5: Check whether all charges are showing correctly As per the Payment Page
			str=ConfirmOrderSubtotal.getText();
			float ConfirmOrderSubtotalvalue=getNumber(str);		
			str=ConfirmOrderShippingCharges.getText();
			float ConfirmOrderShippingChargesvalue=getNumber(str);		
			str=ConfirmOrderVAT.getText();
			float ConfirmOrderVATvalue=getNumber(str);		
			str=ConfirmOrderServicecharges.getText();
			float ConfirmOrderServicechargesvalue=getNumber(str);		
			str=ConfirmOrderGrandTotal.getText();
			float ConfirmOrderGrandTotalvalue=getNumber(str);
			
			log.info("ConfirmOrderSubtotalvalue validation");
			Assert.assertEquals(ConfirmOrderSubtotalvalue, ActualSubTotalValue);
			log.info("ConfirmOrderShippingChargesvalue validation");
			Assert.assertEquals(ConfirmOrderShippingChargesvalue, ActualShippingChargesvalue);
			log.info("ConfirmOrderVATvalue validation");
			Assert.assertEquals(ConfirmOrderVATvalue, ActualVATValue);
			log.info("ConfirmOrderServicechargesvalue validation");
			Assert.assertEquals(ConfirmOrderServicechargesvalue, ActualServiceChargeValue);
			log.info("ConfirmOrderGrandTotalvalue validation");
			Assert.assertEquals(ConfirmOrderGrandTotalvalue, ActualGrandTotalValue);		
					
			//Step 6 : Click on Confirm & Buy
			log.info("Click on Confirm and Buy");
	        JavascriptExecutor jse2 = (JavascriptExecutor)Scenario1Test.driver;
	        jse2.executeScript("window.scrollBy(0,230)","");

	        ConfirmOrderBUY.click();
		}
		public float getNumber(String str)
		{
			StringBuilder myNumbers = new StringBuilder();
			for (int i = 0; i < str.length(); i++)
			{
			    if (Character.isDigit(str.charAt(i))||str.charAt(i)=='.')
			       {
			           myNumbers.append(str.charAt(i));
			       }
			}
			   
			   String Numbers=myNumbers.toString();
			   float a=Float.parseFloat(Numbers);
			   return a;
		}
		public float retain2Decimal(float value)
		{
			String str =Float.toString(value);
			
			StringBuilder myNumbers = new StringBuilder();
			for (int i = 0; i < str.length(); i++)
			{
			    if (Character.isDigit(str.charAt(i))||str.charAt(i)=='.')
			    {
			           myNumbers.append(str.charAt(i));
			           if(str.charAt(i)=='.')
			           {
			           	for(int j=i+1;j<(i+3);j++)
			           		myNumbers.append(str.charAt(j));
			           	break;
			           }
			    }
			}
			String Numbers=myNumbers.toString();
			float a=Float.parseFloat(Numbers);
			return a;
			
		}
	    public float Roundretain2Decimal(float value)
	    {        
	    	DecimalFormat df = new DecimalFormat("#.##");      
	        Float temp = Float.valueOf(df.format(value));
	        value=(float) temp;
	        return value;
	    }
	    public boolean checkifRowExistsinTableCart(String Xpath)
	    {
	    	int size=Scenario1Test.driver.findElements(By.xpath(Xpath)).size();
	    	if(size>0) return true;
	    	else return false;
	    }

}
