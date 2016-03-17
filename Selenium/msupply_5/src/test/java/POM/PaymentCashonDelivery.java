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
		
		@FindBy(xpath="//div[@id='payment_form_cashin']/div[1]/button/span")
		WebElement ContinueButtonPayment;
		
		@FindBy(xpath="//*[@id='review-buttons-container']/button")
		WebElement ConfirmOrderBUY;
		
		@FindBy(xpath="//*[@id='tab_paymentcashin']")
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
		
		@FindBy(xpath="//*[@id='divLoggedUser']/ul/li[3]")
		WebElement Myorders;
		
		@FindBy(xpath="//*[@id='my-orders-table']/tbody/tr[1]/td[1]")
		WebElement Myorders_OrderID;
		
		@FindBy(xpath="//*[@id='my-orders-table']/tbody/tr[1]/td[5]")
		WebElement Myorders_OrderStatus;
		
		public void ToCashonDelivery() throws Exception
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
			Chequeoption.click();
			log.info("Clicked on Chequeoption");
			Thread.sleep(3000);
			ContinueButtonPayment.click();
			log.info("Clicked on ContinueButtonPayment"); 
			
			  JavascriptExecutor jse2 = (JavascriptExecutor)Scenario1Test.driver;
		      jse2.executeScript("window.scrollBy(0,230)","");
		      
		    ConfirmordernandBuy.click();
		    
		    log.info(OrderSuccessfullmsg.getText()+""+status.getText());
		    
		    log.info("Mouse over on Account");
		    Scenario1Test.wdcf.mouseOverOperation(Account);
		    Thread.sleep(500);
		    log.info("Clicked on My Orders");
		    Myorders.click();
		    log.info(Myorders_OrderID.getText()+""+Myorders_OrderStatus.getText());
		    log.info("Verifing the values");
		    //Assert.assertEquals("Verifing the values", expected, actual);
		    //OrderSuccessfullmsg.getText().split(regex)
		}
	

}
