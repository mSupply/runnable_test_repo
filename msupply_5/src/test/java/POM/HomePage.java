package POM;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;
import java.util.Set;

import org.apache.log4j.Logger;
import org.openqa.selenium.By;
import org.openqa.selenium.JavascriptExecutor;
import org.openqa.selenium.NoSuchElementException;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.interactions.Actions;
import org.openqa.selenium.support.FindBy;
import org.openqa.selenium.support.PageFactory;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;
import org.testng.Assert;
import org.testng.Reporter;

import GenericLibrary.BrowserSelection;
import GenericLibrary.CommonFunctions;
import GenericLibrary.LoadLocators;
import GenericLibrary.LogReports;
import GenericLibrary.RetrieveXlsxData;
import GenericLibrary.WebDriverCommonFunctions;
import Scenarios.Scenario1Test;



public class HomePage extends LoadLocators
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
	
	@FindBy(xpath="//*[@id='popzip']")
	WebElement zipcode_popup;
	
	@FindBy(xpath="//*[@id='go']")
	WebElement zipcode_popup_Go;
	
	@FindBy(xpath="//div[@id='seller_choosen']/div/div[3]/button[2]")
	WebElement Buildingmaterial_Blocks_ConcreteCover_15mm_AddtoList;
	
	@FindBy(xpath="//form[@id='search_mini_form']/div/input")
	WebElement SearchBox_electrical;
	
	@FindBy(xpath="//*[@id='search_mini_form']/div/button")
	WebElement SearchBox_Button;
		
	@FindBy(xpath="//*[@id='kuResultsView']/ul/li[1]/div[2]/div[1]/a")
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
	
	@FindBy(xpath="//form[@class='form-inline-search ng-pristine ng-valid']/following::h2")
	WebElement ServiceProvidertext;

	@FindBy(xpath="//div[@class='text-right banner-top']/a[2]")
	WebElement DownLoadFromGoogle;

	@FindBy(id="mainLogo")
	WebElement mainPage;
	
	@FindBy(xpath="//div[@class='text-right banner-top']/div[@id='bang']/following::a[3]")
	WebElement BecomeSeller;
	
	@FindBy(id="login_register")
	WebElement VerifyBecomeSeller;
	
	@FindBy(xpath="html/body/div[3]/div[2]/div[3]/div/div/div[3]/a/img")
	WebElement ServiceProviderPromo;
	
	@FindBy(xpath="(//div[@id='produts_nav'])[3]/following::div[1]")
	WebElement CalculatorPromo;
	
	@FindBy(xpath="//div[@class='navbar-header']/h5")
	WebElement CalculatorPageContent;
	
	@FindBy(xpath="(//div[@id='produts_nav'])[4]/following::div[1]")
	WebElement KitchenPagePromo;
	
	@FindBy(xpath="//div[@class='breadcrumbs product-breadcrumb']/ul/li[2]")
	WebElement BreadCrumbContent;
	
	@FindBy(xpath="(//div[@id='produts_nav'])[5]/following::div[1]")
	WebElement PaintsPagePromo;
	
	@FindBy(xpath="(//div[@id='produts_nav'])[6]/following::div[1]")
	WebElement HardwarePagePromo;
	
	@FindBy(xpath="(//div[@id='produts_nav'])[7]/following::div[1]")
	WebElement PlumbingPagePromo;
	
	@FindBy(xpath="(//div[@id='produts_nav'])[8]/following::div[1]")
	WebElement CarpentaryPagePromo;
	
	@FindBy(xpath="//ul[@class='list-address msupply_help']/li/a")
	List<WebElement> leftStaticLinks;
	
	@FindBy(xpath="//ul[@class='list-address']/li/a")
	List<WebElement> rightStaticLinks;
	
	@FindBy(xpath="//ul[@class='list-address  mobile-font-center']/li[3]/span/a")
	WebElement emailId;
	
	@FindBy(xpath="//ul[@class='list-address  mobile-font-center']/li[2]")
	WebElement phoneNo;
	
	@FindBy(xpath="//div[@id='seo_section']/ul")
	List<WebElement> quickLinks;
	
	@FindBy(xpath="//a/span[text()='Shopping List']")
	WebElement shoppingListLink;
	
	@FindBy(xpath="//h2[@class='text-center text-danger shopping_list_header_h']")
	WebElement emptyMsg;
	
	@FindBy(xpath="//span[@class='carcount']")
	WebElement cartCount;
	
	@FindBy(xpath="html/body/div[3]/div[2]/div[2]/div/div/div[2]/div/div[2]/ul/li/ul/li/span")
	WebElement successMsg;
	
	@FindBy(xpath=".//*[@id='menuBLock']/li[3]/a")
	WebElement Electrical;
	
	@FindBy(xpath=".//*[@id='menuBLock']/li[3]/ul/li[1]/a")
	WebElement Electrical_CablesAndWirres;
	
	@FindBy(xpath="//ul[@class='products-grid']/li")
	WebElement Electrical_Cables_Housewires;
	
	@FindBy(xpath=".//*[@id='catalog-listing']/div[2]/div[1]/div/div[1]/div/div[2]/div[1]/a")
	WebElement Electrical_Cables_polycab;
	
	@FindBy(xpath="html/body/div[3]/div[2]/div[2]/div/div/div[2]/div/form/fieldset/div/table/tbody/tr[1]/td[8]/a/i")
	WebElement removeProduct;
	
	

	@FindBy(xpath="//button[@id='btnLogout']")
	WebElement logoutButton;

	public String Penna_OPC_CementProductSlider;

	
	
	public static int offerPrice_Poductdetails;
	public static int Quantity_Poductdetails;
	public static int Estimated_SubTotal_Poductdetails;

	private static int totalprices;
	
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
	
	public void login() throws Throwable
	{
		   WebElement HomePage_Account=loadElementByXpath("HomePage_Account_Xpath");
		   Scenario1Test.wdcf.mouseOverOperation(HomePage_Account);
		 
		   WebElement HomePage_Login=loadElementByXpath("HomePage_Login_Xpath");
		   HomePage_Login.click();
		
		   String ExcelData[]=RetrieveXlsxData.getExcelData("LoginID_4");
		
		   WebElement MobileNumberField=loadElementByXpath("MobileNumberField_Xpath");
		   MobileNumberField.sendKeys(ExcelData[1]);
	       log.info("Mobile Number is"+ExcelData[1]);
	       Reporter.log("Mobile Number is"+ExcelData[1],false);
	       
	       WebElement PasswordField=loadElementByXpath("PasswordField_Xpath");
	       PasswordField.sendKeys(ExcelData[2]);
	       log.info("Mobile Number is"+ExcelData[2]);
	       Reporter.log("Mobile Number is"+ExcelData[2],false);
	       
	       WebElement LoginButton=loadElementByXpath("LoginButton_Xpath");
	       LoginButton.click();
		
	       CommonFunctions.LoadPageExpicitWait();
	    
	}
	
	
	public LoginPage SelectProducts() throws Exception
	{
		closeIcon.click();
		log.info("............Clicked on Close Button on HomePage Popup.........");
		Reporter.log("............Clicked on Close Button on HomePage Popup.........");
		
		log.info("............Selecting Product from Navigation.........");
		Reporter.log("............Selecting Product from Navigation.........");
		
		//addCementProduct();
		addElectricalProduct();
		zipcode_popup.sendKeys("560064");
		log.info("Moved to : zipcode_popup");
		Reporter.log("Moved to : zipcode_popup");
		
		
		zipcode_popup_Go.click();
		log.info("Clicked on zipcode_popup_Go Button");
		Reporter.log("Clicked on zipcode_popup_Go Button");
		
		Buildingmaterial_Blocks_ConcreteCover_15mm_AddtoList.click();
		log.info("Moved to : Buildingmaterial_Blocks_ConcreteCover_15mm_AddtoList");
		Reporter.log("Moved to : Buildingmaterial_Blocks_ConcreteCover_15mm_AddtoList");
		
		Thread.sleep(12000);
		Scenario1Test.driver.switchTo().defaultContent();
		
		addElectricalProduct();	
		Add_to_List.click();		
		
		
		addCementProduct_2();
		Cement_Product_AddToList.click();
		log.info("............Click on Cement product_Add to List/Cart.........");
		
		return PageFactory.initElements(Scenario1Test.driver, LoginPage.class);
	}
	public void SelectProductsforKartVerificationAfterLogin() throws Throwable
	{
		
		log.info("------------------------------------------------");
	
		addRMCProduct();
		ProductDetailsPage.getValuesFromProductDetailspage();		
		Add_to_List.click();
		log.info("Product 3 added and Moved to : Kart Page ");		
		Thread.sleep(12000);
		Scenario1Test.driver.switchTo().defaultContent();		
		ShoppingCartPage.cart("AddProductAfterLogin");
		
		log.info(".................................................");
		
	    addElectricalProduct();
	    ProductDetailsPage.getValuesFromProductDetailspage();
		Add_to_List.click();	
		log.info("Product 4 added and Moved to : Kart Page ");	
	    Thread.sleep(12000);
	    Scenario1Test.driver.switchTo().defaultContent();
	    ShoppingCartPage.cart("AddProductAfterLogin");
		
		log.info(".................................................");
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

	
	public LoginPage SelectProductsforKartVerification() throws Throwable
	{
		Scenario1Test.wdcf.waitForPageToLoad();
		closeIcon.click();
		log.info("Clicked on POPup Close Button");

		log.info("------------------------------------------------");
		
		addRMCProduct();
		zipcode_popup.sendKeys("560064");
		zipcode_popup_Go.click();
		ProductDetailsPage.getValuesFromProductDetailspage();		
		Add_to_List.click();
		log.info("Product 1 added and Moved to : Kart Page ");		
		Thread.sleep(12000);
		Scenario1Test.driver.switchTo().defaultContent();		
		ShoppingCartPage.cart("BeforeLogin");
		
		log.info(".................................................");
		
		addCementProduct();
		ProductDetailsPage.getValuesFromProductDetailspage();
		Add_to_List.click();	
	    log.info("Product 2 added and Moved to : Kart Page ");		
	    Thread.sleep(12000);
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
    	   WebElement Estimated_SubTotal=Scenario1Test.driver.findElement(By.xpath("//*[@id='product_addtocart_form']/div[2]/div[2]/div[1]/div[7]"));
    	
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
		Reporter.log("............Selecting Electrical Product from Search Box.........");
		
		
		SearchBox_electrical.sendKeys("electrical");
		log.info("Moved to : SearchBox and entering value Electrical");
		Reporter.log("Moved to : SearchBox and entering value Electrical");
		
		Thread.sleep(500);
		SearchBox_Button.click();
		SearchBox_electrical_wire_black.click();
		log.info("Moved to : Clicked on a Electrical Product");
		Reporter.log("Moved to : Clicked on a Electrical Product");
		
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
		Reporter.log("............Selecting Product from Home page.........");
		
		
		HomepageLogo.click();
		log.info("............Click on Home Page Icon.........");	
		Reporter.log("............Click on Home Page Icon.........");
		
		Cement_Product_Slider.click();
		log.info("............Click on Home Page_Cement product.........");	
		Reporter.log("............Click on Home Page_Cement product.........");
		
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
	private static double getNumber(String str)
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
		   //System.out.println("StringBuilder"+myNumbers);
		   String Numbers=myNumbers.toString();
		   //System.out.println("String"+Numbers);
		   double a=Double.parseDouble(Numbers);
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
		ArrayList<String> SliderType=new ArrayList<String>();
		SliderType.add("cementSlide");
		SliderType.add("electricalSlide");
		SliderType.add("plumbingSlide");
		SliderType.add("wallSlide");
		SliderType.add("blockSlide");
		SliderType.add("bathSlide");
		SliderType.add("kitchenSlide");
		SliderType.add("finishSlide");
	
    while(totalprices<120)
	{ 	
	   for(int j=0;j<SliderType.size();j++)	
	   {	
		
		    JavascriptExecutor jse2 = (JavascriptExecutor)Scenario1Test.driver;
	        jse2.executeScript("window.scrollBy(0,250)","");
	        
	       int Price = 0;
	     
		   for(int i=1;i<16;i++)
		   {
			  totalprices=totalprices+1;
			  if(i==6||i==11)
			  {  
				  Scenario1Test.driver.findElement(By.xpath("//*[@id='"+SliderType.get(j)+"']/div[2]/div/div[2]/a")).click();
				  Thread.sleep(1000);
			  }
			   
			   if(SliderType.get(j).equals("cementSlide")&&totalprices<=15)
			      Price=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("((//div[@class='price_tag wishlist_price'])["+totalprices+"]/span[3])")).getText());
			   if(SliderType.get(j).equals("electricalSlide")&&totalprices<=30)
			       Price=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("((//div[@class='price_tag wishlist_price'])["+totalprices+"]/span[3])")).getText());
			   if(SliderType.get(j).equals("plumbingSlide")&&totalprices<=45)
			       Price=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("((//div[@class='price_tag wishlist_price'])["+totalprices+"]/span[3])")).getText());
			   if(SliderType.get(j).equals("wallSlide")&&totalprices<=60)
			       Price=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("((//div[@class='price_tag wishlist_price'])["+totalprices+"]/span[3])")).getText());
			   if(SliderType.get(j).equals("blockSlide")&&totalprices<=75)
			       Price=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("((//div[@class='price_tag wishlist_price'])["+totalprices+"]/span[3])")).getText());
			   if(SliderType.get(j).equals("bathSlide")&&totalprices<=90)
			       Price=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("((//div[@class='price_tag wishlist_price'])["+totalprices+"]/span[3])")).getText());
			   if(SliderType.get(j).equals("kitchenSlide")&&totalprices<=105)
			       Price=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("((//div[@class='price_tag wishlist_price'])["+totalprices+"]/span[3])")).getText());
			   if(SliderType.get(j).equals("finishSlide")&&totalprices<=120)
			       Price=(int) getNumber(Scenario1Test.driver.findElement(By.xpath("((//div[@class='price_tag wishlist_price'])["+totalprices+"]/span[3])")).getText());
			
			   
			  if(Price==0)
			  {
				   Scenario1Test.log.info("Price is displaying as Zero in"+SliderType.get(j));
				   throw new Exception();
			  }
			 
			  if(i==1)
			  {
				  Thread.sleep(5000);  
				  
				  if(SliderType.get(j).equals("blockSlide")||SliderType.get(j).equals("cementSlide")||SliderType.get(j).equals("plumbingSlide"))
				     Scenario1Test.driver.findElement(By.xpath("//*[@id='"+SliderType.get(j)+"']/div[1]/div/div["+i+"]/li/div[1]/a")).click();
				  else
					 Scenario1Test.driver.findElement(By.xpath("//*[@id='"+SliderType.get(j)+"']/div[1]/div/div["+i+"]/li/div[1]")).click();
				  
				  
				  if(SliderType.get(j).equals("cementSlide"))
				  {
					  Scenario1Test.driver.findElement(By.xpath("//*[@id='popzip']")).sendKeys("560064");
					  Scenario1Test.driver.findElement(By.xpath("//*[@id='go']")).click();
					  Thread.sleep(5000);
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
	     }
		Thread.sleep(1000);
	   }	
	}
	
	
	
	public void ClickonClosePOPup() throws Throwable
	{
		//Get Locators from Excel and create the WebElement object
	   WebElement closeIcon=loadElementByXpath("closeIcon_xpath");
	   closeIcon.click();
	  
	   log.info("Clicked on Close Button - POPUP");
	   Reporter.log("Clicked on Close Button - POPUP",false);
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
		Thread.sleep(6000);
		Scenario1Test.wdcf.select(ServiceProvider,1);
		Thread.sleep(10000);
		String ServiceProvidervalue=ServiceProvidertext.getText();
		System.out.println("ServiceProvidervalue="+ServiceProvidervalue);
		Assert.assertEquals(ServiceProvidervalue,"Some of our Service Providers");
		mainPage.click();
		
		//DownLoad from Googleplay
		Scenario1Test.driver.findElement(By.xpath("//div[@class='text-right banner-top']/a[2]")).click();
		Thread.sleep(3000);
		Iterator<String> windows=Scenario1Test.driver.getWindowHandles().iterator();
		String HomeWindow=windows.next();
		String GoogleplayWindow=windows.next();
		
		Scenario1Test.driver.switchTo().window(GoogleplayWindow);
		Assert.assertEquals(Scenario1Test.driver.getTitle(),"mSupply – Android Apps on Google Play");
		Scenario1Test.driver.close();
		Scenario1Test.driver.switchTo().window(HomeWindow);
		
		//Verify Become a Seller
		BecomeSeller.click();
		Assert.assertEquals(VerifyBecomeSeller.getText(),"Sell On mSupply");
		HomepageLogo.click();
	}

	public void VerifyMarketingPromos() throws Exception 
	{
	    //Verify GooglePlayStore
		Thread.sleep(6000);
		ServiceProviderPromo.click();
		Iterator<String> windows = Scenario1Test.driver.getWindowHandles().iterator();
		String Parent=windows.next();
		String Child=windows.next();
		Scenario1Test.driver.switchTo().window(Child);
		Assert.assertEquals(Scenario1Test.driver.getTitle(),"Service Provider – Android Apps on Google Play");		
		Scenario1Test.driver.close();		
		Scenario1Test.driver.switchTo().window(Parent);
		
		//Verify Calculator option
		CommonFunctions.scrollDownPage(0,560);
		CalculatorPromo.click();
		Iterator<String> windows_2=Scenario1Test.driver.getWindowHandles().iterator();
		String Parent_2=windows_2.next();
		String Child_2=windows_2.next();
		Scenario1Test.driver.switchTo().window(Child_2);
		Assert.assertEquals(CalculatorPageContent.getText(),"Calculators");
		Scenario1Test.driver.close();
		Scenario1Test.driver.switchTo().window(Parent_2);
		
		//Verify Kitchen Products
		CommonFunctions.scrollDownPage(0,300);
		KitchenPagePromo.click();
		Thread.sleep(5000);
		Assert.assertEquals(BreadCrumbContent.getText(),"Kitchen");
		HomepageLogo.click();
		
		//Verify Paints Products
		CommonFunctions.scrollDownPage(0,300);
		PaintsPagePromo.click();
		Thread.sleep(5000);
		Assert.assertEquals(BreadCrumbContent.getText(),"Paints");	
		HomepageLogo.click();
				
		
		//Verify Hardware Products
		CommonFunctions.scrollDownPage(0,300);
		HardwarePagePromo.click();
		Thread.sleep(5000);
		Assert.assertEquals(BreadCrumbContent.getText(),"Hardware");	
		HomepageLogo.click();
		
		
		//Verify Plumbing Products
	    CommonFunctions.scrollDownPage(0,300);
		PlumbingPagePromo.click();
		Thread.sleep(5000);
		Assert.assertEquals(BreadCrumbContent.getText(),"Plumbing");	
		HomepageLogo.click();
				
		//Verify Carpentry Products
	    CommonFunctions.scrollDownPage(0,300);
		CarpentaryPagePromo.click();
		Thread.sleep(5000);
		Assert.assertEquals(BreadCrumbContent.getText(),"Carpentry");	
		HomepageLogo.click();
		
		
		
		
	}
	
	public void validateLeftStaticLinks(WebDriver driver) throws InterruptedException
	{
		
		
		int size=leftStaticLinks.size();
		for(int i=1;i<=size;i++)
		{
			
			JavascriptExecutor jse = (JavascriptExecutor)driver;
			jse.executeScript("window.scrollTo(0,3000)");
						
			WebElement link=driver.findElement(By.xpath("//ul[@class='list-address msupply_help']/li["+i+"]/a"));
			String linkText=link.getText();
			if(linkText.equals("Our Team"))
			{
				log.info("............Clicked on "+linkText+" link.........");
				link.click();
				String title=driver.findElement(By.xpath("//div[@class='img-desc']/div[text()='Ishwar Subramanian']")).getText();
				Assert.assertEquals(title.toUpperCase(), "ISHWAR SUBRAMANIAN");
		
			}
			else if(!linkText.equals("mSupply Blog"))
			{
				log.info("............Clicked on "+linkText+" link.........");
				
				link.click();
				String title=driver.findElement(By.xpath("//div[@class='page-title']/h1")).getText();
				Assert.assertEquals(title, linkText);
			}
			

			PageFactory.initElements(BrowserSelection.driver, HomePage.class);
		}
		
	}
	
	public void validateRightStaticLinks(WebDriver driver)
	{
		Scenario1Test.wdcf.waitForPageToLoad();
		
		String titles[]={"Returns and Cancellations","Terms and Conditions of Use","FAQs","Sell On mSupply","Contact Us"};
		
		int size=rightStaticLinks.size();
		for(int i=1;i<=size;i++)
		{
			
			JavascriptExecutor jse = (JavascriptExecutor)driver;
			jse.executeScript("window.scrollTo(0,3000)");
				
			WebElement link=driver.findElement(By.xpath("//ul[@class='list-address']/li["+i+"]/a"));
			String linkText=link.getText();
			String actTitle="";
			log.info("............Clicked on "+linkText+" link.........");
			link.click();
			if(linkText.equals("Sell on mSupply"))
			{
				actTitle=driver.findElement(By.xpath("//div[@class='well-block']/h1")).getText();
			}
			else if(linkText.equals("Contact Us"))
			{
				actTitle=driver.findElement(By.xpath("//div[@class='col-md-12 page-title title-c']/h1")).getText();
			}
			else
			{
				
				actTitle=driver.findElement(By.xpath("//div[@class='page-title']/h1")).getText();
			}
			Assert.assertEquals(actTitle,titles[i-1]);

			PageFactory.initElements(BrowserSelection.driver, HomePage.class);
		}
		
	}
	
//	This method verifies that the static links of second left division opens proper page
	
	public void validateContactDetails()
	{
//		String email="support@msupply.com";
//		//String phone="18001033447";
//		String phone="18005320555";
//		Assert.assertEquals(emailId.getText(), email); 
//		Assert.assertEquals(phoneNo.getText(), phone);
	}
	
	public void validateQuickLinks(WebDriver driver)
	{
//		Scenario1Test.wdcf.waitForPageToLoad();
//		closeIcon.click();
		
		JavascriptExecutor jse = (JavascriptExecutor)driver;
		jse.executeScript("window.scrollTo(0,3000)");
		int k=0;
		int size=quickLinks.size();
		for(int i=1;i<=size;i++)
		{
			
			List<WebElement> innerLinks=driver.findElements(By.xpath("//div[@id='seo_section']/ul["+i+"]/li"));
			int innerLinkSize=innerLinks.size();
			String titles[]={"Blocks",
					"Consumable",
					"Cables and Wires",
					"Home Automation",
					"Consumables","Solvent",
					"Chimneys & Hobs",
					"Modular Kitchen",
					"Plumbing Tools",
					"Gardening Tools",
					"Tools",
					"Solar Products",
					"Bathroom Faucets",
					"Bathroom Accessories",
					"Tiles",
					"Outdoor Flooring",
					"Plywood",
					"Adhesive",
					"Skin Door",
					"Veneer Door",
					"Fittings",
					"Consumables",
					"Wall Putty",
					"Painting Accessories",
					"Pots and Planters",
					"Clay Roofing"
					};
			for(int j=2;j<=innerLinkSize;j++)
			{
				if(j==2 || j==innerLinkSize)
				{
					WebElement link=driver.findElement(By.xpath("//div[@id='seo_section']/ul["+i+"]/li["+j+"]"));
					
					link.click();
					String pageTitle=driver.findElement(By.xpath("//div[@class='current-product']/b")).getText();
					Assert.assertEquals(pageTitle, titles[k]);
					k++;
				}
				
				
			}
			
		}
	}
	
	
	public void navigateToShoppingListPage() throws InterruptedException
	{
		Scenario1Test.wdcf.waitForPageToLoad();
		Thread.sleep(1000);
		shoppingListLink.click();
	}
	
	
	
	public void verifyEmptyCartPage()
	{
		Assert.assertEquals(emptyMsg.getText(), "Your Shopping List is empty !");
	}
	
	
	

	public int getCartItemsCount(WebDriver driver)
	{
		//homeLink.click();
		try
		{
			String count=cartCount.getText();
			System.out.println("Count== "+count);
			return Integer.parseInt(count);
		}
		catch(NoSuchElementException e)
		{
			return 0;
		}
	}
	
	public void addCementProductToCart() throws InterruptedException
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
		
		
		//zipcode_popup.sendKeys("560064");
	    //log.info("Moved to : Buildingmaterial_Blocks_ConcreteCover_15mm_zipcode_popup");
		
		//zipcode_popup_Go.click();
		//log.info("Moved to : Buildingmaterial_Blocks_ConcreteCover_15mm_zipcode_popup_Go");
		
		Buildingmaterial_Blocks_ConcreteCover_15mm_AddtoList.click();
		log.info("Moved to : Buildingmaterial_Blocks_ConcreteCover_15mm_AddtoList");
		Thread.sleep(12000);
		//Scenario1Test.driver.switchTo().defaultContent();
	}
	
	public String validateSuccessMsgInShoppingList()
	{
		//System.out.println("Checking the Succes msg");
		return successMsg.getText();
	}
	
	public void addElectricalProductToCart() throws InterruptedException
	{
		Scenario1Test.wdcf.waitForPageToLoad();
		
		
		log.info("............Selecting Product from Navigation.........");
		System.out.println("Entered into electricals");
		
		Thread.sleep(2000);
		
		Scenario1Test.wdcf.mouseOverOperation(shop);
		System.out.println("Mouse hovered on Shop");
		
		Thread.sleep(500);
		Scenario1Test.wdcf.mouseOverOperation(Electrical);
		System.out.println("Mouse hovered on Electrical");
	
		Thread.sleep(500);
		Scenario1Test.wdcf.mouseOverOperation(Electrical_CablesAndWirres);
		Electrical_CablesAndWirres.click();
		System.out.println("Clicked on Cables & Wires");
		
//		Electrical_Cables_Housewires.click();
//		log.info("Moved to : ElectricalCat_Cables_Housewires");
		//System.out.println("Clicked on house wires");
		
		//Thread.sleep(500);
		
		Electrical_Cables_polycab.click();
		log.info("Moved to : Electrical_Cables_polycab");
		System.out.println("Clicked on polycab product");
		
		Buildingmaterial_Blocks_ConcreteCover_15mm_AddtoList.click();
		log.info("Moved to : Buildingmaterial_Blocks_ConcreteCover_15mm_AddtoList");
		//Thread.sleep(12000);
		//Scenario1Test.driver.switchTo().defaultContent();
	}
		
	public void removeProductFromShoppingList()
	{
		removeProduct.click();
		
	}
	
	public void logoutOfMsupply() throws InterruptedException
	{
		Scenario1Test.wdcf.mouseOverOperation(mouseonAccount);
        Thread.sleep(3000);
        logoutButton.click();
	}

	public ProductDetailsPage SelectProductsForReviewsandRatings(boolean zipCodePopUpEnabled) throws Throwable 
	{
		//Get Locators from Excel and create the WebElement object		
		
		log.info("Selecting Product from Navigation");
		Reporter.log("Selecting Product from Navigation",false);
		
		WebElement Navigation=loadElementByXpath("Navigation_Shop_Xpath");
		Scenario1Test.wdcf.mouseOverOperation(Navigation);
		Thread.sleep(700);
		
		WebElement Buildingmaterial=loadElementByXpath("Navigation_BuildingMaterial_xpath");
		Scenario1Test.wdcf.mouseOverOperation(Buildingmaterial);
		Thread.sleep(700);
		
		WebElement Buildingmaterial_Cement=loadElementByXpath("Navigation_BuildingMaterial_Cement_xpath");
		Scenario1Test.wdcf.mouseOverOperation(Buildingmaterial_Cement);
		Thread.sleep(700);
		
		WebElement Buildingmaterial_Cement_PPC=loadElementByXpath("Navigation_Buildingmaterial_Cement_PPC_Xpath");
		Buildingmaterial_Cement_PPC.click();
		log.info("Clicked on Navigation -> Buildingmaterial ->Cement -> PPC");		
		Reporter.log("Clicked on Navigation -> Buildingmaterial ->Cement -> PPC",false);
		
		WebElement Buildingmaterial_Cement_Product1=loadElementByXpath("Buildingmaterial_Cement_Product1_Xpath");		
		CommonFunctions.scrollPageUpToFindElement(Buildingmaterial_Cement_Product1);		
		Buildingmaterial_Cement_Product1.click();
		log.info("Clicked on : First Cement Product");
		Reporter.log("Clicked on : First Cement Product",false);
		
		
		CommonFunctions.LoadPageExpicitWait();
		CommonFunctions.SwitchtoWebPage();
		
		if(zipCodePopUpEnabled==true)
		{
		   WebElement ZipCode_POPUP=loadElementByXpath("ZipCode_POPUP_xpath");
		   ZipCode_POPUP.sendKeys("560064");
		   log.info("Entered Pincode 560064");
		   Reporter.log("Entered Pincode 560064",false);			
		
		   WebElement ZipCode_POPUP_Go=loadElementByXpath("ZipCode_POPUP_Go_Xpath");
		   ZipCode_POPUP_Go.click();
		   log.info("Clicked on Go Button - Pincode");
		   Reporter.log("Clicked on Go Button - Pincode",false);
		   CommonFunctions.LoadPageExpicitWait();
		}   
		 
		return PageFactory.initElements(Scenario1Test.driver, ProductDetailsPage.class);
		
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
