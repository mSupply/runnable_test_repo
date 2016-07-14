package POM;

import java.text.ParseException;
import java.text.SimpleDateFormat;

import org.apache.log4j.Logger;
import org.openqa.selenium.By;
import org.openqa.selenium.WebElement;
import org.testng.Reporter;

import GenericLibrary.CommonFunctions;
import GenericLibrary.LoadLocators;
import GenericLibrary.LogReports;
import Scenarios.Scenario1Test;

public class ReviewsPage extends LoadLocators
{
	static Logger log = LogReports.writeLog(ProductDetailsPage.class);
	
	public static String ConstructDate(String name) throws Throwable
	{
		String NewDate = null;
		String month[]={"January","February","March","April","May","June","July","August","September","October","November","December"};
		StringBuffer sb = new StringBuffer();
		sb.append(name.substring(0, 2));
		sb.append(name.substring(3, 7).toUpperCase());

		
		for(int i=0;i<month.length;i++)
		{
		   if(sb.toString().contains(month[i].toUpperCase()))
		   {			
			 NewDate=name.charAt(0)+""+name.charAt(1)+"-"+month[i]+"-"+name.charAt(name.length()-4)+""+name.charAt(name.length()-3)+""+name.charAt(name.length()-2)+""+name.charAt(name.length()-1);
			 break;
		   }
		}
		return NewDate;	
			
	}
	
	public static void SortedReviews(String strDate1,int CurrentReview) throws Throwable
	{
		
		int noOfReviews = 1;		
		while(checkifRowExistsinTable("(//div[@class='col-lg-9 customer_reviews pull-right']/div)["+noOfReviews+"]"))
		{
			   if(CurrentReview==noOfReviews)
			   {
				   //System.out.println("Same date");
			   }
			   else
			   {   
			     WebElement Reviews_Date=Scenario1Test.driver.findElement(By.xpath("((//li[@class='rvw_title block clear']/div[2]))["+noOfReviews+"]"));
			     String strDate2=ConstructDate(Reviews_Date.getText());
			     SortedDate(strDate1,strDate2);
			   }
			   noOfReviews=noOfReviews+1;
		}
         
	}
	
	public static void SortedDate(String strDate1, String strDate2) throws Throwable
	{
		//System.out.println(strDate1+""+strDate2);
		SimpleDateFormat sdf = new SimpleDateFormat("dd-MMMM-yyyy");
		java.util.Date d1 = sdf.parse( strDate1 );
		java.util.Date d2 = sdf.parse( strDate2 );
		  
		sdf.format( d1 ).toUpperCase();
		sdf.format( d2 ).toUpperCase();
		  
		if (compareTo( d1, d2 ) < 0 )
		{
		   //System.out.println( "d1 is before d2" );
		}
		
		if (compareTo( d1, d2 ) > 0 )
		{
			log.info("Dates not Sorted");
			Reporter.log("Dates not Sorted",false);		
			throw new Exception();
			
		}
		
		else
		{
			//System.out.println("d1 is equal to d2");
		}
		
	}
	public static long compareTo( java.util.Date date1, java.util.Date date2 )
	{
	  //returns negative value if date1 is before date2
	  //returns 0 if dates are even
	  //returns positive value if date1 is after date2
	    return date1.getTime() - date2.getTime();
	}
	private static boolean checkifRowExistsinTable(String Xpath)
	{
	    	int size=Scenario1Test.driver.findElements(By.xpath(Xpath)).size();
	    	if(size>0) return true;
	    	else return false;
	}
}
