package POM;

import java.util.Iterator;
import java.util.List;
import java.util.Set;

import org.apache.log4j.Logger;
import org.openqa.selenium.By;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.interactions.Actions;
import org.openqa.selenium.support.FindBy;
import org.openqa.selenium.support.PageFactory;

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
	WebElement Buildingmaterial_Blocks_ConcreteCover_15mm_zipcode_popup;
	
	@FindBy(xpath=".//*[@id='go']")
	WebElement Buildingmaterial_Blocks_ConcreteCover_15mm_zipcode_popup_Go;
	
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
	
	public LoginPage navigatetoLoginPage() throws InterruptedException
	{
		closeIcon.click();
		log.info("............Clicked on Close Button.........");	
		Scenario1Test.wdcf.mouseOverOperation(mouseonAccount);
        Thread.sleep(3000);
        LoginButton.click();
		log.info("............Moved to Login Page............");

		return PageFactory.initElements(Scenario1Test.driver, LoginPage.class);
	}
	public LoginPage SelectProducts() throws InterruptedException
	{
		Scenario1Test.wdcf.waitForPageToLoad();
		closeIcon.click();
		log.info("............Clicked on Close Button.........");
		
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
		Buildingmaterial_Blocks_ConcreteCover_15mm_zipcode_popup.sendKeys("560064");
		log.info("Moved to : Buildingmaterial_Blocks_ConcreteCover_15mm_zipcode_popup");
		Buildingmaterial_Blocks_ConcreteCover_15mm_zipcode_popup_Go.click();
		log.info("Moved to : Buildingmaterial_Blocks_ConcreteCover_15mm_zipcode_popup_Go");
		Buildingmaterial_Blocks_ConcreteCover_15mm_AddtoList.click();
		log.info("Moved to : Buildingmaterial_Blocks_ConcreteCover_15mm_AddtoList");
		Thread.sleep(12000);
		Scenario1Test.driver.switchTo().defaultContent();
		
//		log.info("............Selecting Product from Search Box.........");
//		SearchBox_electrical.sendKeys("electrical");
//		log.info("Moved to : SearchBox and entering value Electrical");
//		SearchBox_Button.click();
//		SearchBox_electrical_wire_black.click();
//		log.info("Moved to : Click on a Product");
//		Add_to_List.click();
//			
//		log.info("............Selecting Product from Home page.........");
//		log.info("............Click on Home Page Icon.........");
//		HomepageLogo.click();
//		log.info("............Click on Home Page_Cement product.........");
//		Cement_Product_Slider.click();
//		log.info("............Click on Cement product_Add to List/Cart.........");
//		Cement_Product_AddToList.click();
		
		
		
		return PageFactory.initElements(Scenario1Test.driver, LoginPage.class);
	}
	
}
