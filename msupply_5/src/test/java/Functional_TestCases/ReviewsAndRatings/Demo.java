package Functional_TestCases.ReviewsAndRatings;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
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
	
	public static void main(String args[]) throws Throwable
	{
		String Arr="IPConfig";
		run(Arr);
		
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
