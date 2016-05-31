package POM;

import java.io.IOException;

import org.apache.log4j.Logger;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.support.FindBy;
import org.openqa.selenium.support.PageFactory;

import GenericLibrary.LogReports;
import Scenarios.Scenario1Test;


public class AddItemToCart 
{
	Logger log = LogReports.writeLog(AddItemToCart.class);
	
    @FindBy(xpath="//*[@id='showhide1']")
	WebElement ShowSlideIcon;
	
	@FindBy(xpath="//div[@id='menuBLock']/li[3]/a")
	WebElement ElectricalOption;
	
	@FindBy(xpath="//div[@id='menuBLock']/li[3]/ul/li[2]")
	WebElement CircutBreaker;
	
	@FindBy(xpath="//ul[@id='subNavLevel2']/div/li/a[text()='Isolators']")
	WebElement Isolators;
	
	@FindBy(xpath="//*[@id='catalog-listing']/div[2]/div[1]/div/div[1]/div/div[2]/div[1]/a")
	WebElement ABBIsolators;
	
	@FindBy(xpath="//*[@id='popzip']")
	WebElement EnterZipCodePOP;
	
	@FindBy(xpath="//*[@id='go']")
	WebElement GoButton;
	
	@FindBy(xpath="//button[text()='Add to List']")
	WebElement AddToCart;
	
	@FindBy(xpath="//button[@title='Place Order']")
	WebElement PlaceOrder;
	
	
	public Object navigateToAddToCart(int option) throws IOException, InterruptedException 
	{
		Scenario1Test.wdcf.waitForPageToLoad();		
		
	    Scenario1Test.wdcf.mouseOverOperation(ShowSlideIcon);        
        Scenario1Test.wdcf.mouseOverOperation(ElectricalOption);        
        Scenario1Test.wdcf.mouseOverOperation(CircutBreaker);        
        Isolators.click();
        ABBIsolators.click();
        EnterZipCodePOP.sendKeys("560001");
        GoButton.click();
        AddToCart.click();
   
              
        
        switch(option)
        {
              case 1 :
       	         return PageFactory.initElements(Scenario1Test.driver, CheckoutPage.class);
            	  
              case 2 :
           	      //return PageFactory.initElements(Scenario1Test.driver, PaymentNetBanking.class);
            	  
              case 3 :
           	      //return PageFactory.initElements(Scenario1Test.driver, PaymentDebitCard.class);
            	  
              case 4 :
           	      //return PageFactory.initElements(Scenario1Test.driver, PaymentPayuMoney.class);
            	  
              case 5 :
           	      //return PageFactory.initElements(Scenario1Test.driver, PaymentChequeOrDD.class);
       	 
             case 6 :
            	 //return PageFactory.initElements(Scenario1Test.driver, PaymentCashonDelivery.class);
            	 
             default : return null;	 
        }    	 
        
	}
}
