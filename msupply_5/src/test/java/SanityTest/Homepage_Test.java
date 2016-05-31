package SanityTest;

import org.openqa.selenium.support.PageFactory;
import org.testng.Assert;
import org.testng.annotations.Parameters;
import org.testng.annotations.Test;

import GenericLibrary.BrowserSelection;
import GenericLibrary.Credentials;
import POM.HomePage;
import POM.ShoppingCartPage;
import Scenarios.Scenario1Test;

/*
 * Home page
 */
public class Homepage_Test extends Scenario1Test
{
	@Test
	@Parameters({"Production_URL"})
	public void HomePage_verification(String Production_URL) throws Throwable
	{
		Credentials.url=Production_URL;
		Scenario1Test.driver.get(Credentials.url);
		Scenario1Test.log.info("Sanity TestCase - HomePage verification");
		Scenario1Test.homePageObj = PageFactory.initElements(BrowserSelection.driver, HomePage.class);
		Scenario1Test.homePageObj.ClickonClosePOPup();
		Scenario1Test.homePageObj.HeaderImageVerification();	
		Scenario1Test.homePageObj.SlidersVerification();
		Scenario1Test.homePageObj.VerifyMarketingPromos();
		Scenario1Test.homePageObj.validateLeftStaticLinks(Scenario1Test.driver);
		Scenario1Test.homePageObj.validateRightStaticLinks(Scenario1Test.driver);
		Scenario1Test.homePageObj.validateContactDetails();
		Scenario1Test.homePageObj.validateQuickLinks(Scenario1Test.driver);
		
		/*  ==============  Navigate to Shopping List page ==============  */
		Scenario1Test.homePageObj.navigateToShoppingListPage();		
		/* ================= Verify Shopping List page ============ */
		Scenario1Test.homePageObj.verifyEmptyCartPage();		
		/* ============== Verify count of cart items =========== */
		int initialCount=Scenario1Test.homePageObj.getCartItemsCount(Scenario1Test.driver);
		Assert.assertEquals(initialCount,0);		
		/* ======== Add cement to cart =====*/
		Scenario1Test.homePageObj.addCementProductToCart();		
		/* ========= Verify the item added success msg ======= */
		Assert.assertEquals(Scenario1Test.homePageObj.validateSuccessMsgInShoppingList(), "Nagarjuna OPC 53 grade cement was added to your shopping list.");		
		/* ===============  Verify the count of cart items ============ */
		int count=Scenario1Test.homePageObj.getCartItemsCount(Scenario1Test.driver);
		Assert.assertEquals(count,initialCount+1);	
		/* ================ Login to msupply ========== */
		Scenario1Test.homePageObj.navigatetoLoginPage().navigateToInsideLoginPage();
		System.out.println("Logged in");		
		/* ================ Add electrical product to cart ========== */
		Scenario1Test.homePageObj.addElectricalProductToCart();		
		/* ========= Verify the item added success msg ======= */
		Assert.assertEquals(Scenario1Test.homePageObj.validateSuccessMsgInShoppingList(), "Anchor Telephone Cable 0.4 mm-1 pair, 90 Mtr pack was added to your shopping list.");		
		/* =============== Verify the count of cart items ======== */
		int finalCount=Scenario1Test.homePageObj.getCartItemsCount(Scenario1Test.driver);
		Assert.assertEquals(finalCount,count+1);		
		/* ============ Remove an item from shopping list ========= */
		Scenario1Test.homePageObj.removeProductFromShoppingList();		
		/* =============== Verify the count of cart items ======== */
		Assert.assertEquals(Scenario1Test.homePageObj.getCartItemsCount(Scenario1Test.driver),finalCount-1);		
		//Logout of mSupply 		
		Scenario1Test.homePageObj.logoutOfMsupply();
		//Thread.sleep(1000);		
		/* =============== Verify the count of cart items after logout======== */
		Assert.assertEquals(Scenario1Test.homePageObj.getCartItemsCount(Scenario1Test.driver),0);		

       Scenario1Test.homePageObj.navigatetoLoginPage().validateLogin();
       
       Scenario1Test.homePageObj.navigatetoLoginPage().validateRegistration();
	
       Scenario1Test.homePageObj.navigatetoLoginPage().navigateToInsideLoginPage();
       ShoppingCartPage.removeCartProducts();
	}

}
