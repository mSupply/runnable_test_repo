package POM;

import java.io.IOException;
import java.math.BigDecimal;
import java.text.DecimalFormat;
import java.util.ArrayList;
import java.util.Iterator;

import org.apache.log4j.Logger;
import org.apache.poi.openxml4j.exceptions.InvalidFormatException;
import org.openqa.selenium.By;
import org.openqa.selenium.Dimension;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;

import GenericLibrary.LogReports;
import Scenarios.Scenario1Test;
import junit.framework.Assert;

public class PaymentCreditCard 
{
	
    Logger log = LogReports.writeLog(PaymentCreditCard.class);
	
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
		log.info("Clicked on CreditCardOption");
		ContinueButtonPayment.click();
		log.info("Clicked on ContinueButtonPayment");        
		
	}
	
	public void ToNetBanking() throws Exception
	{
		   
		Thread.sleep(12000);
		PaymentDetails_Header.click();
		log.info("Clicked on PaymentDetails");
		NetBanking.click();
		NetBanking_Continue.click();
	}
	
	public void ToDebitCard() throws Exception
	{
		Thread.sleep(12000);
		PaymentDetails_Header.click();
		log.info("Clicked on PaymentDetails");
		DebitCard.click();
		Debitcard_Continue.click();
	}
	
	public void ToPayuMoney() throws Exception
	{
		Thread.sleep(12000);
		PaymentDetails_Header.click();
		log.info("Clicked on PaymentDetails");
		PayuMoney.click();
		PayuMoney_Continue.click();
		
	}
	
	
	   
}