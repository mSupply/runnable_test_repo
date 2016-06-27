package POM;

import java.io.IOException;
import java.text.DecimalFormat;

import org.apache.log4j.Logger;
import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;
import org.testng.Assert;
import org.testng.Reporter;

import GenericLibrary.LogReports;
import Scenarios.Scenario1Test;


public class PaymentCashonDelivery 
{
	    Logger log = LogReports.writeLog(PaymentCashonDelivery.class);
		
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
		
		@FindBy(xpath="(//*[@id='payment-buttons-container']/button)[5]")
		WebElement ContinueButtonPayment;
		
		@FindBy(xpath="//*[@id='review-buttons-container']/button")
		WebElement ConfirmOrderBUY;
		
		@FindBy(xpath="//*[@id='tab_paymentcheque_checkout']")
		WebElement Chequeoption;
		
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

		@FindBy(xpath="//*[@id='review-buttons-container']/button")
		WebElement ConfirmordernandBuy;
		
		@FindBy(xpath="//div[starts-with(text(),'Order Successful')]")
		WebElement OrderSuccessfullmsg;
		
		@FindBy(xpath="//div[@class='orderstatus']/span[2]")
		WebElement status;
		
		@FindBy(xpath="//*[@id='lnkAccount']/a")
		WebElement Account;
		
		@FindBy(xpath="//*[@id='divLoggedUser']/ul/li[2]")
		WebElement Myorders;
		
		@FindBy(xpath="//*[@id='my-orders-table']/tbody/tr[1]/td[1]")
		WebElement Myorders_OrderID;
		
		@FindBy(xpath="//*[@id='my-orders-table']/tbody/tr[1]/td[5]")
		WebElement Myorders_OrderStatus;
		
		public void ToCashonDelivery() throws Exception
		{
			Scenario1Test.wdcf.waitForPageToLoad();
			log.info(".........Inside Cart Page...........");
			Reporter.log(".........Inside Cart Page...........");
			
			Scenario1Test.driver.switchTo().defaultContent();
			
			Place_Order.click();
			log.info("Clicked on Place order");
			Reporter.log("Clicked on Place order");
			
			Address_Billing.click();
			log.info("Clicked on a Address");
			Reporter.log("Clicked on a Address");
						
			SaveAndContinue_Billing.click();
			log.info("Clicked on SaveAndContinue Billing");
			Reporter.log("Clicked on SaveAndContinue Billing");
			
			Address_Shipping.click();
			log.info("Clicked on Address_Shipping");
			Reporter.log("Clicked on Address_Shipping");
						
			SaveAndContinue_Shipping.click();
			log.info("Clicked on SaveAndContinue_Shipping");
			Reporter.log("Clicked on SaveAndContinue_Shipping");
			
			Chequeoption.click();
			log.info("Clicked on Cheque option");
			Reporter.log("Clicked on Cheque option");
			
			Thread.sleep(3000);
			ContinueButtonPayment.click();
			log.info("Clicked on ContinueButtonPayment"); 
			Reporter.log("Clicked on ContinueButtonPayment");
			
			  JavascriptExecutor jse2 = (JavascriptExecutor)Scenario1Test.driver;
		      jse2.executeScript("window.scrollBy(0,230)","");
		      
		    ConfirmordernandBuy.click();
		    
//		    String str=OrderSuccessfullmsg.getText();
//		    String OrderConfimationpage_Order_Status=status.getText();
//		    log.info(OrderSuccessfullmsg.getText()+""+status.getText());
//		    
//		    log.info("Mouse over on Account");
//		    Scenario1Test.wdcf.mouseOverOperation(Account);
//		    Thread.sleep(500);
//		    log.info("Clicked on My Orders");
//		    Myorders.click();
//		    log.info(Myorders_OrderID.getText()+""+Myorders_OrderStatus.getText());
//		    log.info("Verifing the values");
//		    
//		    //Extract the order No		    
//		    String orderno_from_checkout="";
//	        for(int i=0; i<str.length(); i++)
//	           if( str.charAt(i) > 47 && str.charAt(i) < 58)
//	        	   orderno_from_checkout=orderno_from_checkout+str.charAt(i);
//	        
//	        //Check from the OrderNo from OrderConfirmation Page and MyAccountPage
//	        String Orderno_MyAccount=Myorders_OrderID.getText();
//	        Assert.assertEquals(orderno_from_checkout, Orderno_MyAccount);
//	        log.info("Passed : OrderNo from OrderConfirmation Page and MyAccountPage");
//	        
//	       //Check from the Status from OrderConfirmation Page and MyAccountPage
//	        Assert.assertEquals(OrderConfimationpage_Order_Status.toLowerCase(), Myorders_OrderStatus.getText().toLowerCase());
//	        log.info("Passed : Status from OrderConfirmation Page and MyAccountPage");
		}
	

}
