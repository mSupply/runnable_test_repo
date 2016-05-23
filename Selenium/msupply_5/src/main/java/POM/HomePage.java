package POM;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;
import java.util.Set;

import org.apache.log4j.Logger;
import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.interactions.Actions;
import org.openqa.selenium.support.FindBy;
import org.openqa.selenium.support.PageFactory;
import org.testng.Assert;

import GenericLibrary.LogReports;
import Scenarios.Scenario1Test;



public class HomePage 
{
	Logger log = LogReports.writeLog(HomePage.class);
	
	@FindBy(xpath="//*[@id='x']")
	WebElement closeIcon;
	
	@FindBy(xpath="//*[@id='lnkAccount']/a")
	WebElement mouseonAccount;
	
	@FindBy(xpath="//*[@id='btnLogin']")
	WebElement LoginButton;
	
	@FindBy(xpath="//*[@id='divAccount']/ul/li[2]/label/a")
	WebElement Signuplink;

	@FindBy(xpath="//a[@id='showhide1'and @class='default showhide1']")
	WebElement shop;
	
	@FindBy(xpath="//div[@id='menuBLock']/li[2]/a")
	WebElement Buildingmaterial;
	
	@FindBy(xpath="//*[@id='menuBLock']/li[2]/ul/li[3]/a")
	WebElement Buildingmaterial_Cement;
	
	@FindBy(xpath="//*[@id='menuBLock']/li[2]/ul/li[3]/ul/div[1]/li[3]/a")
	WebElement Buildingmaterial_Cement_PPC;
	
	@FindBy(xpath="//*[@id='catalog-listing']/div[2]/div[1]/div/div[1]/div/div[2]/div[1]/a")
	WebElement Buildingmaterial_Cement_PPC_Nagarjuna;
	
	@FindBy(xpath=".//*[@id='popzip']")
	WebElement zipcode_popup;
	
	@FindBy(xpath=".//*[@id='go']")
	WebElement zipcode_popup_Go;
	
	@FindBy(xpath="//div[@id='seller_choosen']/div/div[3]/button[2]")
	WebElement Buildingmaterial_Blocks_ConcreteCover_15mm_AddtoList;
	
	@FindBy(xpath="//form[@id='search_mini_form']/div/input")
	WebElement SearchBox_electrical;
	
	@FindBy(xpath="//*[@id='search_mini_form']/div/button")
	WebElement SearchBox_Button;
		
	@FindBy(xpath="//div[@id='catalog-listing']/div[2]/div[1]/div/div[1]/div/div[2]/div/a")
	WebElement SearchBox_electrical_wire_black;
	
	@FindBy(xpath="(//*[@id='product-addtocart-button'])[2]")
	WebElement Add_to_List;
	
	@FindBy(xpath="//*[@id='mainLogo']/a/img[1]")
	WebElement HomepageLogo;
	
	@FindBy(xpath="//*[@id='cementSlide']/div[1]/div/div[2]/li/div[1]/a")
	WebElement Cement_Product_Slider;
	
	@FindBy(xpath="(//*[@id='product-addtocart-button'])[2]")
	WebElement Cement_Product_AddToList;
	
	@FindBy(xpath="//*[@id='lnkAccount']/a")
	WebElement Account;
	
	@FindBy(xpath="//*[@id='divAccount']/ul/li[1]/a")
	WebElement Login;
	
	@FindBy(xpath="//*[@id='magestore-sociallogin-popup-email']")
	WebElement MobileNumbers;
	
	@FindBy(xpath="//*[@id='magestore-sociallogin-popup-pass']	")
	WebElement Password;
	
	@FindBy(xpath="//*[@id='magestore-sociallogin-form']/div[1]/span/input")
	WebElement RememberMeCheckBox;
	
	@FindBy(xpath="//*[@id='menuBLock']/li[2]/ul/li[5]/a")
	WebElement BuildingMaterial_RMC;

	@FindBy(xpath="//*[@id='catalog-listing']/div[2]/div[1]/div/div[1]/div/div[2]/div[1]/a")
	WebElement BuildingMaterial_RMC_ConcreteBag;
	
	@FindBy(xpath="//*[@id='menuBLock']/li[2]/ul/li[1]/a")
	WebElement BuildingMaterial_Blocks;
	
	@FindBy(xpath="//*[@id='catalog-listing']/div[2]/div[1]/div/div[1]/div/div[2]/div[1]/a")
	WebElement BuildingMaterial_Blocks_SolidConcrete;

	@FindBy(xpath="//*[@id='product_addtocart_form']/div[2]/div[2]/div[1]/div[4]/div[2]/div/div[1]/div/span/input[7]")
	WebElement Increase;
	
	@FindBy(xpath="//*[@id='product_addtocart_form']/div[2]/div[2]/div[1]/div[4]/div[2]/div/div[1]/div/span/input[6]")
	WebElement Decrease;
	
	@FindBy(xpath="//select[@ng-model='check']")
	WebElement ServiceProvider;
	
	@FindBy(xpath="html/body//div[@class='main']//h2[text()='Some of our Service Providers']")
	WebElement ServiceProvidertext;

	public static int offerPrice_Poductdetails;
	public static int Quantity_Poductdetails;
	public static int Estimated_SubTotal_Poductdetails;
	
	public RegistrationPage navigatetoregisterpage() throws InterruptedException
	{
		closeIcon.click();
		log.info("............Clicked on Close Button.........");	
		Scenario1Test.wdcf.mouseOverOperation(mouseonAccount);
        Thread.sleep(3000);
		Signuplink.click();
		log.info("............Moved to SignUp Page............");

		return PageFactory.initElements(Scenario1Test.driver, RegistrationPage.class);
	}
	
	public LoginPage navigatetoLoginPage() throws Exception
	{
		return PageFactory.initElements(Scenario1Test.driver, LoginPage.class);
	}
	
	
	public LoginPage SelectProducts() throws Exception
	{
		Scenario1Test.wdcf.waitForPageToLoad();
		closeIcon.click();
		log.info("............Clicked on Close Button.........");
		
		log.info("............Selecting Product from Navigation.........");
		addCementProduct();
		zipcode_popup.sendKeys("560064");
		log.info("Moved to : zipcode_popup");
		zipcode_popup_Go.click();
		log.info("Moved to : zipcode_popup_Go");			
		Buildingmaterial_Blocks_ConcreteCover_15mm_AddtoList.click();
		log.info("Moved to : Buildingmaterial_Blocks_ConcreteCover_15mm_AddtoList");
		Thread.sleep(12000);
		Scenario1Test.driver.switchTo().defaultContent();
		
		addElectricalProduct();	
		Add_to_List.click();		
		
		
		addCementProduct_2();
		Cement_Product_AddToList.click();
		log.info("............Click on Cement product_Add to List/Cart.........");
		
		return PageFactory.initElements(Scenario1Test.driver, LoginPage.class);
	}

	public void ProductsMOQverification() throws Exception
	{
		Scenario1Test.wdcf.waitForPageToLoad();
		closeIcon.click();
		log.info("............Clicked on Close Button.........");
		
		addBlocks();
		log.info("MOQ verification for Blocks");
		zipcode_popup.sendKeys("560064");
		log.info("Moved to : zipcode_popup");
		zipcode_popup_Go.click();
		log.info("Moved to : zipcode_popup_Go");
        ProductDetailsPage.Verify_ProductDetailsPage_MOQ();
		log.info("MOQ verification Completed for Blocks");
		
		log.info(".................................................");
		
		addCementProduct();		
		log.info("MOQ verification for Cement Product");
		Thread.sleep(12000);
		Scenario1Test.driver.switchTo().defaultContent();
		ProductDetailsPage.Verify_ProductDetailsPage_MOQ();
		log.info("MOQ verification Completed for Blocks");		
	}

	
	public LoginPage SelectProductsforKartVerification() throws Exception
	{
		Scenario1Test.wdcf.waitForPageToLoad();
		closeIcon.click();
		log.info("............Clicked on Close Button.........");

		addRMCProduct();
		zipcode_popup.sendKeys("560064");
		zipcode_popup_Go.click();
		getPricesFromProductDetailspage();
		Add_to_List.click();
		log.info("Moved to : Kart Page ");		
		Thread.sleep(12000);
		Scenario1Test.driver.switchTo().defaultContent();		
		ShoppingCartPage.CartforRMC("BeforeLogin");
		
		log.info(".................................................");
		
		addCementProduct();
		getPricesFromProductDetailspage();
		Add_to_List.click();	
	    log.info("Moved to : Kart Page ");		
	    Thread.sleep(12000);
	    Scenario1Test.driver.switchTo().defaultContent();
	    Scenario1Test.driver.switchTo().defaultContent();		
		ShoppingCartPage.cart("BeforeLogin");
	    
		log.info(".................................................");
		
//	    addElectricalProduct();
//	    zipcode_popup.sendKeys("560064");
//		zipcode_popup_Go.click();
//		//IncreaseQuantity(10);
//		getPricesFromProductDetailspage();
//		Add_to_List.click();	
//	    log.info("Moved to : Kart Page ");		
//	    Thread.sleep(12000);
//	    Scenario1Test.driver.switchTo().defaultContent();
//	    ShoppingCartPage.cart("BeforeLogin");
//	    
//		addCementProduct();
//		IncreaseQuantity(10);
//		getPricesFromProductDetailspage();
//        Add_to_List.click();	
//	    log.info("Moved to : Kart Page ");		
//	    Thread.sleep(12000);
//	    Scenario1Test.driver.switchTo().defaultContent();
//	    ShoppingCartPage.cart("BeforeLogin");  
	    
		
		return PageFactory.initElements(Scenario1Test.driver, LoginPage.class);
	}
	
	public void getPricesFromProductDetailspage() 
	{
	    
		   WebElement offerPrice=Scenario1Test.driver.findElement(By.xpath("//*[@id='product-price-3753']/span[1]"));
		   WebElement Quantity=Scenario1Test.driver.findElement(By.xpath("//*[@id='qty']"));
    	   WebElement Estimated_SubTotal=Scenario1Test.driver.findElement(By.xpath("//*[@id='product_addtocart_form']/div[2]/div[2]/div[1]/div[6]"));
    	
    	   offerPrice_Poductdetails=(int) getNumber(offerPrice.getText());
		   Quantity_Poductdetails=(int) getNumber(Quantity.getAttribute("value"));
		   Estimated_SubTotal_Poductdetails=(int) getNumber(Estimated_SubTotal.getText());		   
		
	}

	public void addRMCProduct() throws Exception
	{
		log.info("............Selecting RMC Product from Navigation.........");
		Scenario1Test.wdcf.mouseOverOperation(shop);
		Thread.sleep(500);
		Scenario1Test.wdcf.mouseOverOperation(Buildingmaterial);
		Thread.sleep(500);
		BuildingMaterial_RMC.click();;
		log.info("Moved to : Buildingmaterial RMC Product");		
		BuildingMaterial_RMC_ConcreteBag.click();
		log.info("Moved to : BuildingMaterial_RMC_ConcreteBag");
		
	}
	public void addElectricalProduct() throws Exception
	{
		log.info("............Selecting Electrical Product from Search Box.........");
		SearchBox_electrical.sendKeys("electrical");
		log.info("Moved to : SearchBox and entering value Electrical");
		Thread.sleep(500);
		SearchBox_Button.click();
		SearchBox_electrical_wire_black.click();
		log.info("Moved to : Clicked on a Electrical Product");
		
	}
	public void addCementProduct() throws Exception
	{
		log.info("............Selecting Product from Navigation.........");
		Scenario1Test.wdcf.mouseOverOperation(shop);
		Thread.sleep(500);
		Scenario1Test.wdcf.mouseOverOperation(Buildingmaterial);
		Thread.sleep(500);
		Scenario1Test.wdcf.mouseOverOperation(Buildingmaterial_Cement);
		Thread.sleep(500);
		Buildingmaterial_Cement_PPC.click();
		log.info("Moved to : Buildingmaterial_Cement_PPC");		
		Buildingmaterial_Cement_PPC_Nagarjuna.click();
		log.info("Moved to : Buildingmaterial_Cement_PPC_Nagarjuna");
	}
	public void addCementProduct_2() throws Exception
	{
		log.info("............Selecting Product from Home page.........");		
		HomepageLogo.click();
		log.info("............Click on Home Page Icon.........");		
		Cement_Product_Slider.click();
		log.info("............Click on Home Page_Cement product.........");		
		
	}
	public void addBlocks() throws Exception
	{
		log.info("............Selecting Product from Navigation.........");
		Scenario1Test.wdcf.mouseOverOperation(shop);
		Thread.sleep(500);
		Scenario1Test.wdcf.mouseOverOperation(Buildingmaterial);
		Thread.sleep(500);
		BuildingMaterial_Blocks.click();
		Thread.sleep(500);
		BuildingMaterial_Blocks_SolidConcrete.click();
		log.info("Moved to : Buildingmaterial Blocks");		
		
	}

	public void IncreaseQuantity(int number)
	{
		
		for(int i=0;i<number;i++)
		{
			Increase.click();
		}
		
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
		   //System.out.println(a);
		   return a;
	}
	
	private static long getLongNumber(String str)
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
		   long a=Long.parseLong(Numbers);
		   //System.out.println(a);
		   return a;
	}
	
	public static void SlidersVerification() throws Exception
	{
		ArrayList<String> SliderType=new ArrayList();
		SliderType.add("cementSlide");
		SliderType.add("electricalSlide");
		SliderType.add("plumbingSlide");
		SliderType.add("wallSlide");
		SliderType.add("blockSlide");
		SliderType.add("bathSlide");
		SliderType.add("kitchenSlide");
		SliderType.add("finishSlide");
		
	   for(int j=0;j<SliderType.size();j++)	
	   {	
		
		    JavascriptExecutor jse2 = (JavascriptExecutor)Scenario1Test.driver;
	        jse2.executeScript("window.scrollBy(0,250)","");
	        
	        int Price;
	        
		   for(int i=1;i<16;i++)
		   {
			  if(i==6||i==11)
			  {  
				  Scenario1Test.driver.findElement(By.xpath("//*[@id='"+SliderType.get(j)+"']/div[2]/div/div[2]/a")).click();
				  Thread.sleep(1000);
			  }
			  Price=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("//*[@id='"+SliderType.get(j)+"']/div[1]/div/div["+i+"]/li/div[2]/span[3]")).getText());
			  Scenario1Test.log.info(Price);
			  if(Price==0)
			  {
				   Scenario1Test.log.info("Price is displaying as Zero in"+SliderType.get(j));
				   throw new Exception();
			  }
			  if(i==1)
			  {
				  
				  Scenario1Test.driver.findElement(By.xpath("//*[@id='"+SliderType.get(j)+"']/div[1]/div/div["+i+"]/li/div[1]")).click();
				  
				  if(SliderType.get(j).equals("cementSlide"))
				  {
					  Scenario1Test.driver.findElement(By.xpath("//*[@id='popzip']")).sendKeys("560064");
					  Scenario1Test.driver.findElement(By.xpath("//*[@id='go']")).click();
					  Thread.sleep(1000);
				  }
				  
				  WebElement offerPrice=Scenario1Test.driver.findElement(By.xpath("//*[@id='product-price-3753']/span[1]"));
				  int Price_Poductdetails=(int) getNumber(offerPrice.getText());
				  if(Price_Poductdetails<Price)
				  {
					  Scenario1Test.log.info("Prices are Diffrent from Home Page and Product Details page");
					  throw new Exception();
				  }
				 
				  Thread.sleep(500);
				  Scenario1Test.driver.navigate().back();
			  }
			  
		   }
		   Thread.sleep(1000);
	   }	
	}
	
	
	
	public void ClickonClosePOPup() throws Exception
	{
	   closeIcon.click();
	   log.info("............Clicked on Close Button.........");
	}

	public void HeaderImageVerification() throws Exception 
	{
		//WhatsApp number verification
		Scenario1Test.wdcf.mouseOverOperation(Scenario1Test.driver.findElement(By.xpath("//*[@id='bang']")));
		Thread.sleep(3000);
		long BangaloreNumber=(long) getLongNumber(Scenario1Test.driver.findElement(By.xpath("//div[@class='phoneBlock']/ul/li[1]")).getText());
		long MysoreNumber=(long) getLongNumber(Scenario1Test.driver.findElement(By.xpath("//div[@class='phoneBlock']/ul/li[2]")).getText());
		long BangaloreNumber_Expected=7899777078L;
		long MysoreNumber_Expected=7899901142L;
		Assert.assertEquals(BangaloreNumber , BangaloreNumber_Expected);
		Assert.assertEquals(MysoreNumber_Expected , MysoreNumber);
		
		//Verify Service Provider
		Scenario1Test.driver.findElement(By.xpath("//b[text()='Service Provider']")).click();
		Thread.sleep(3000);
		Scenario1Test.wdcf.select(ServiceProvider,1);
		String ServiceProvidervalue=ServiceProvidertext.getCssValue("style");
		System.out.println(ServiceProvidervalue);
		//Assert.assertEquals(ServiceProvidervalue,"Some of our Service Providers");
		
		
		
		
	}
	
//	public LoginPage SelectProductsforKartVerification() throws InterruptedException
//	{
//		Scenario1Test.wdcf.waitForPageToLoad();
//		closeIcon.click();
//		log.info("............Clicked on Close Button.........");
//		
//		log.info("............Selecting Product from Search Box.........");
//		SearchBox_electrical.sendKeys("electrical");
//		log.info("Moved to : SearchBox and entering value Electrical");
//		Thread.sleep(6000);
//		SearchBox_Button.click();
//		SearchBox_electrical_wire_black.click();
//		log.info("Moved to : Click on a Product");
//		Buildingmaterial_Blocks_ConcreteCover_15mm_zipcode_popup.sendKeys("560064");
//		Buildingmaterial_Blocks_ConcreteCover_15mm_zipcode_popup_Go.click();
//		Add_to_List.click();			
//
//		ShoppingCartPage.cart();
//		
//		return PageFactory.initElements(Scenario1Test.driver, LoginPage.class);
//		
//	}

	
}
