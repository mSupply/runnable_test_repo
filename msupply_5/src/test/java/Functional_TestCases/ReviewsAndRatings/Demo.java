package Functional_TestCases.ReviewsAndRatings;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.List;
import java.util.logging.Level;

import org.apache.commons.io.IOUtils;
import org.apache.log4j.Logger;
import org.openqa.selenium.support.PageFactory;
import org.testng.Reporter;
import org.testng.annotations.Test;

import GenericLibrary.BrowserSelection;
import GenericLibrary.CommonFunctions;
import GenericLibrary.Credentials;
import POM.HomePage;
import POM.ProductDetailsPage;
import Scenarios.Scenario1Test;

public class Demo extends Scenario1Test
{
	
	public static void sort()
	{
		String month[]={"January","February","March","April","May","June","July","August","September","October","November","December"};
		String name=new String("03 June 2016".toUpperCase());
		
		for(int i=0;i<12;i++)
		{
		   if(name.contains(month[i].toUpperCase()))
		   {
			
			 String NewDate=name.charAt(0)+""+name.charAt(1)+"-"+month[i]+"-"+name.charAt(name.length()-4)+""+name.charAt(name.length()-3)+""+name.charAt(name.length()-2)+""+name.charAt(name.length()-1);
			 System.out.println(NewDate);
			
		   }
		}	
			
	}
	
	
	public static void main(String args[]) throws Throwable
	{
		
		//sort();
		
		String strDate1 = "10-JANUARY-1920";
		String strDate2 = "10-APRIL-1950";
		  
		SimpleDateFormat sdf = new SimpleDateFormat( "dd-MMM-yyyy" );
		java.util.Date d1 = sdf.parse( strDate1 );
		java.util.Date d2 = sdf.parse( strDate2 );
		  
		System.out.println( "1. " + sdf.format( d1 ).toUpperCase());
		System.out.println( "2. " + sdf.format( d2 ).toUpperCase());
		  
		if (compareTo( d1, d2 ) < 0 )
		{
		   System.out.println( "d1 is before d2" );
		}
		else if (compareTo( d1, d2 ) > 0 ) 
		{
		   System.out.println( "d1 is after d2" );
		}
		else
		{
		   System.out.println( "d1 is equal to d2" );
		}
//		
//		
//		
//		String Arr="IPConfig";
//		run(Arr);
		
	}
	public static long compareTo( java.util.Date date1, java.util.Date date2 )
	{
	//returns negative value if date1 is before date2
	//returns 0 if dates are even
	//returns positive value if date1 is after date2
	  return date1.getTime() - date2.getTime();
	}
	
	public static void run(String argument) throws IOException 
	{
           List<String> command = new ArrayList<String>();
           command.add("cmd.exe");
           command.add("/c");
           command.add(argument);
           
           InputStream inputStream = null;
           InputStream errorStream = null;
          
           try 
           {
              ProcessBuilder processBuilder = new ProcessBuilder(command);
              Process process = processBuilder.start();
              inputStream = process.getInputStream();
              errorStream = process.getErrorStream();

            System.out.println("Process InputStream: " + IOUtils.toString(inputStream, "utf-8"));
            System.out.println("Process ErrorStream: " + IOUtils.toString(errorStream, "utf-8"));
           }
           catch (IOException e) 
           {
              e.printStackTrace();
           } 
           finally 
           {
            if (inputStream != null) 
                    inputStream .close();
          
            if (errorStream != null) 
                    errorStream.close();
            
           }
    }
	
	
}
