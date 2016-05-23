package POM;

import java.io.IOException;
import java.math.BigDecimal;
import java.text.DecimalFormat;
import java.util.ArrayList;
import java.util.Iterator;

import org.apache.log4j.Logger;

import org.openqa.selenium.By;
import org.openqa.selenium.Dimension;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;
import org.testng.Assert;

import GenericLibrary.LogReports;
import Scenarios.Scenario1Test;


public class CheckoutPage 
{
	
    Logger log = LogReports.writeLog(CheckoutPage.class);
	
	@FindBy(xpath="//div[@class='checkout-types chkop']/button")
	WebElement Place_Order;
	
	@FindBy(xpath="//*[@id='919']/address")
	WebElement Address_Billing;
		
	@FindBy(xpath="//*[@id='billing-buttons-container']/div/div[3]/button")
	WebElement SaveAndContinue_Billing;
	
	@FindBy(xpath="//div[@id='shipping_fields']/div/div/div[2]/div/address")
	WebElement Address_Shipping;
	
	@FindBy(xpath="//*[@id='shipping-buttons-container']/div[3]/span[3]/button")
	WebElement SaveAndContinue_Shipping;
	
	@FindBy(xpath="//div[@id='payment-buttons-container']/button")
	WebElement ContinueButtonPayment;
	
	@FindBy(xpath="//*[@id='review-buttons-container']/button")
	WebElement ConfirmOrderBUY;
	
	@FindBy(xpath="//a[@id='tab_paymenthdfc_standard']/label[text()='Credit Card ']")
	WebElement CreditCardOption;
	
	@FindBy(xpath="//li[@id='opc-payment']")
	WebElement PaymentDetails_Header;
	
	@FindBy(xpath="//*[@id='tab_paymenthdfcnb_standard']")
	WebElement NetBanking;
	
	@FindBy(xpath="//div[@id='payment_form_hdfcnb_standard']/div/button")
	WebElement NetBanking_Continue;
	
	@FindBy(xpath="//*[@id='tab_paymenthdfcdc_standard']")
	WebElement DebitCard;
	
	@FindBy(xpath="//div[@id='payment_form_hdfcdc_standard']/div/button")
	WebElement Debitcard_Continue;
	
	@FindBy(xpath="//*[@id='tab_paymentpayucheckout_shared']")
	WebElement PayuMoney;
	
	@FindBy(xpath="//div[@id='payment_form_payucheckout_shared']/div/button")
	WebElement PayuMoney_Continue;
	
	@FindBy(xpath="//div[@id='payment_form_cheque_checkout']/div/button")
	WebElement Cheque_Continue;
	
	@FindBy(xpath="//div[@id='payment_form_cashin']/div/button")
	WebElement COD_Continue;
	
	@FindBy(xpath="//*[@id='tab_paymentcheque_checkout']")
	WebElement Cheque;
	
	@FindBy(xpath="//*[@id='tab_paymentcashin']")
	WebElement COD;

	@FindBy(xpath="//*[@id='sub_charge']")
	WebElement SubTotal_Payment;
	
	@FindBy(xpath="//*[@id='checkout-payment-method-load']/div[2]/div/ul/li[2]/span[2]")
	WebElement ShippingandHandling_Payment;
	
	@FindBy(xpath="//*[@id='checkout-payment-method-load']/div[2]/div/ul/li[3]/span[2]")
	WebElement ExciseDuty_Payment;
	
	@FindBy(xpath="//*[@id='pay_charge']")
	WebElement ServiceCharges_Payment;
	
	@FindBy(xpath="//*[@id='checkout-review-table']/tfoot/tr[1]/td[2]/span/span")
	WebElement SubTotal_Confirm;
	
	@FindBy(xpath="//*[@id='checkout-review-table']/tfoot/tr[2]/td[2]/span")
	WebElement Shippingandhandling_Confirm;
	
	@FindBy(xpath="//*[@id='checkout-review-table']/tfoot/tr[4]/td[2]/span")
	WebElement Excise_Confirm;
	
	@FindBy(xpath="//*[@id='checkout-review-table']/tfoot/tr[3]/td[2]/span")
	WebElement ServiceCharges_Confirm;
	
	@FindBy(xpath="//*[@id='gtotal']")
	WebElement Total_Payment;
	
	@FindBy(xpath="//*[@id='checkout-review-table']/tfoot/tr[5]/td[2]/span/strong/span")
	WebElement Total_Confirm;
	
	static Float SubTotal_p,ShippingandHandling_p,ExciseDuty_p,ServiceCharges_p,Total_P;
	static Float CalulatedServiceCharge;
	static Float SubTotal_c,ShippingandHandling_c,ExciseDuty_c,ServiceCharges_c,Total_c;
	static int CalulatedServiceCharge_decimal,ServiceCharges_p_decimal,ExciseDuty_p_decimal,CalulatedExciseDuty_decimal;
	
	
	public void ToCreditCard() throws Exception
	{
		Scenario1Test.wdcf.waitForPageToLoad();
		log.info(".........Cart Page...........");
		Place_Order.click();
		log.info("Clicked on Place order");
		Address_Billing.click();
		log.info("Clicked on a Address");
		SaveAndContinue_Billing.click();
		log.info("Clicked on SaveAndContinue Billing");
		Address_Shipping.click();
		log.info("Clicked on Address_Shipping");
		SaveAndContinue_Shipping.click();
		log.info("Clicked on SaveAndContinue_Shipping");
		CreditCardOption.click();
		log.info("======================Clicked on CreditCardOption===============");	
		PaymentChargeCalculation(1);
	}
	
	public void ToNetBanking() throws Exception
	{
		Scenario1Test.wdcf.waitForPageToLoad();   
		Thread.sleep(12000);
		PaymentDetails_Header.click(); 
		log.info("Clicked on PaymentDetails");
		NetBanking.click();
		log.info("Clicked on NetBanking");
		log.info("======================Clicked on Netbanking===============");
		PaymentChargeCalculation(2);
	}
	
	public void ToDebitCard() throws Exception
	{
		Scenario1Test.wdcf.waitForPageToLoad();
		Thread.sleep(12000);
		PaymentDetails_Header.click();
		log.info("Clicked on PaymentDetails");
		DebitCard.click();
		log.info("Clicked on Debitcard");
		log.info("======================Clicked on Debitcard===============");
		PaymentChargeCalculation(3);
		
	}
	
	public void ToPayuMoney() throws Exception
	{
		Scenario1Test.wdcf.waitForPageToLoad();
		Thread.sleep(12000);
		PaymentDetails_Header.click();
		log.info("Clicked on PaymentDetails");		
		PayuMoney.click();
		log.info("Clicked on PayuMoney");
		log.info("======================Clicked on PayUmoney===============");
		PaymentChargeCalculation(4);
		
	}
	
	public void ToCheque() throws Exception
	{
		Scenario1Test.wdcf.waitForPageToLoad();
		Thread.sleep(12000);
		PaymentDetails_Header.click();
		log.info("Clicked on PaymentDetails");		
		Cheque.click();
		log.info("Clicked on Chequw");
		log.info("======================Clicked on Cheque===============");
		PaymentChargeCalculation(5);
		
	}
	
	public void ToCOD() throws Exception
	{
		Scenario1Test.wdcf.waitForPageToLoad();
		Thread.sleep(12000);
		PaymentDetails_Header.click();
		log.info("Clicked on PaymentDetails");		
		COD.click();
		log.info("======================Clicked on COD===============");
		PaymentChargeCalculation(6);
		
	}
//	public void EmptyCartPage() throws Exception
//	{
//		Scenario1Test.wdcf.waitForPageToLoad();
//		Thread.sleep(12000);
//		log.info("======================Clear kart page===============");
//				
//	}
	
	public float getNumber(String str)
	{
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
	public double ServiceChargeCalculation(int PaymentMethod)
	{
        double Conviencefee_temp,Conviencefee,SericeTax,servicecharges_temp = 0,Total,servicecharges;

        Total=SubTotal_p+ShippingandHandling_p+ExciseDuty_p;
		
		switch(PaymentMethod)
		{
		case 1: servicecharges_temp=((1.95*(Total))/100);break;
		case 2: servicecharges_temp=((2.06*(Total))/100);break;
		case 3: servicecharges_temp=((1.15*(Total))/100);break;
		case 4: servicecharges_temp=((2.29*(Total))/100);break;
		case 5: servicecharges_temp=0;break;
		case 6: servicecharges_temp=0;break;
		}
		servicecharges=servicecharges_temp;

		return servicecharges;
		
	}
	public void PaymentChargeCalculation(int PaymentMethod) throws Exception
	{        
		Scenario1Test.wdcf.waitForPageToLoad();
		SubTotal_p=getNumber(SubTotal_Payment.getText());
		ShippingandHandling_p=getNumber(ShippingandHandling_Payment.getText());
		ExciseDuty_p=getNumber(ExciseDuty_Payment.getText());
		ServiceCharges_p=getNumber(ServiceCharges_Payment.getText());
		Total_P=getNumber(Total_Payment.getText());
		
		if(PaymentMethod==5||PaymentMethod==6)
		{
			//CalulatedServiceCharge=new Float(114.50);
			CalulatedServiceCharge=ShoppingCartPage.Service_Charges_calculated;
		}
		else
		   CalulatedServiceCharge=getNumber(Double.toString(ServiceChargeCalculation(PaymentMethod)))+ShoppingCartPage.Service_Charges_calculated;	
		
		CalulatedServiceCharge_decimal=CalulatedServiceCharge.intValue();
		
		log.info(".............................Kart page and Payment page Verification......................................................");
		
		//Compare Pricing from Cart page and Payment page [for subtotal, shipping charges and excise duty]
		
		int SubTotal_payment_decimal=SubTotal_p.intValue();
		int ShippingandHandling_payment_decimal=ShippingandHandling_p.intValue();
		int ExciseDuty_payment_decimal=ExciseDuty_p.intValue();
		
		Assert.assertEquals(ShoppingCartPage.SubTotal_List, SubTotal_payment_decimal);
		log.info("SubTotal from cart page and payment page is same");
		Assert.assertEquals(ShoppingCartPage.Shipping_Handling_Charges_List_Decimal,ShippingandHandling_payment_decimal);
		log.info("Shipping charges from cart page and payment page is same");
		Assert.assertEquals(ShoppingCartPage.ExciseDuty_List_table_Decimal, ExciseDuty_payment_decimal);
		log.info("ExciseDuty from cart page and payment page is same");	
		
		log.info("..............................Payment Details and Confirm order ..............................................................");
		
		//Service Charge verification
		ServiceCharges_p_decimal=ServiceCharges_p.intValue();
		log.info("Calculated Service Charges"+CalulatedServiceCharge_decimal+"   "+"Service Charges from payment page"+ServiceCharges_p_decimal);
		Assert.assertEquals(ServiceCharges_p_decimal, CalulatedServiceCharge_decimal);
		
		//Excise Duty verification
		ExciseDuty_p_decimal=ExciseDuty_p.intValue();
		CalulatedExciseDuty_decimal=ShoppingCartPage.ExciseDuty_List_table_Decimal; //From Shopping cart Page
		log.info("Calculated ExciseDuty"+CalulatedExciseDuty_decimal+"   "+"ExciseDuty from payment page"+ExciseDuty_p_decimal);
		Assert.assertEquals(ExciseDuty_p_decimal, CalulatedExciseDuty_decimal);
		
		
		switch(PaymentMethod)
		{
		   case 1: ContinueButtonPayment.click();break;
		   case 2: NetBanking_Continue.click(); break;
		   case 3: Debitcard_Continue.click(); break;  
		   case 4: PayuMoney_Continue.click();break;
		   case 5: Cheque_Continue.click();break;
		   case 6: COD_Continue.click();break;
		}  
		
		Thread.sleep(15000);
			
		SubTotal_c=getNumber(SubTotal_Confirm.getText());
		ShippingandHandling_c=getNumber(Shippingandhandling_Confirm.getText());
		ExciseDuty_c=getNumber(Excise_Confirm.getText());
		ServiceCharges_c=getNumber(ServiceCharges_Confirm.getText());
		Total_c=getNumber(Total_Confirm.getText());
		
    	Assert.assertEquals(SubTotal_p, SubTotal_c);
		log.info("SubTotal Similar in Payment page and ConfirmOrder Page");
		Assert.assertEquals(ShippingandHandling_p, ShippingandHandling_c);
		log.info("ShippingandHandling Similar in Payment page and ConfirmOrder Page");
		Assert.assertEquals(ExciseDuty_p, ExciseDuty_c);
		log.info("ExciseDuty Similar in Payment page and ConfirmOrder Page");
		Assert.assertEquals(ServiceCharges_p, ServiceCharges_c);
		log.info("ServiceCharges Similar in Payment page and ConfirmOrder Page");
		Assert.assertEquals(Total_P, Total_c);
		log.info("Grand Total Similar in Payment page and ConfirmOrder Page");
	}
	
	   
}