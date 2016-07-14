package Demo;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;
import java.util.List;
import org.apache.commons.collections.bag.SynchronizedSortedBag;
import org.apache.commons.lang3.StringUtils;
import org.apache.log4j.Logger;
import org.apache.poi.openxml4j.exceptions.InvalidFormatException;
import org.apache.poi.ss.usermodel.Row;
import org.apache.poi.ss.usermodel.Sheet;
import org.apache.poi.ss.usermodel.Workbook;
import org.apache.poi.ss.usermodel.WorkbookFactory;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;
import org.openqa.selenium.By;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.io.TemporaryFilesystem;

public class Demo3
{
 static FirefoxDriver driver;
 
 static String currentPath = System.getProperty("user.dir");
 static String BrokenFilePath = currentPath +"/src/test/resources/BrokenLinksHomePage.xlsx";
 static String AllUrlFilePath = currentPath +"/src/test/resources/AllURL.xlsx";
 static String Tempfilepath = currentPath +"/src/test/resources/Tempfilepath.xlsx";
 
 
 private static Logger logger=Logger.getLogger("Testng_Brokenlinks_6_withoutDynamic");
  

 public static void main(String args[]) throws Throwable
    {
  
     //change the Temp directory to required location and perform deletion when required
     TemporaryFilesystem.setTemporaryDirectory(new File(Tempfilepath));
          
     //Intial process done for home page
     findlinksHomePage();
     findbrokenlinks(1);
          

    }
 public static void findbrokenlinks(int brokenlinktobeverifiedfrom)
 {  
  String linkname = null;
  FileInputStream fis=null,Bfis=null;
  Workbook wb=null,Bwb=null;
  Sheet s1 = null,Bs1=null;
  
  try
  {
     fis=new FileInputStream(AllUrlFilePath);
           wb=WorkbookFactory.create(fis);
           s1=wb.getSheet("Sheet1");
     
           Bfis=new FileInputStream(BrokenFilePath);
           Bwb=WorkbookFactory.create(Bfis);
           Bs1=Bwb.getSheet("Sheet1");
  
       
          int rc=s1.getLastRowNum();
          System.out.println(brokenlinktobeverifiedfrom+" "+rc);
         
          for(int j=brokenlinktobeverifiedfrom;j<=rc;j++)
          {
            try
            {
                linkname=s1.getRow(j).getCell(0).getStringCellValue();
                      
             URL u = new URL(linkname);
             HttpURLConnection huc = (HttpURLConnection) u.openConnection();
             huc.connect();
             int status= huc.getResponseCode();
          
             if(status==404)
             {
              int Brc=Bs1.getLastRowNum();
              Bs1.createRow(Brc+1).createCell(0).setCellValue(linkname);
              logger.info("Broken link"+linkname);
             }         
          }
         catch(Exception e)
         {
          logger.info("Error in getting link from : Broken links"+linkname);
         }
       }
          FileOutputStream Bfos = new FileOutputStream(BrokenFilePath);
          Bwb.write(Bfos);
          Bfos.close();
  }
  catch(Exception e)
  {
   System.out.println("Error");
   e.printStackTrace();
  }   
  }
 public static void findlinksHomePage() throws Throwable
     {
           
      driver = new FirefoxDriver();
      driver.get("http://www.msupply.com");     
      List<WebElement> temp=driver.findElements(By.tagName("a"));
     
      for (int k = 0; k < temp.size(); k++)
      {
       String link=temp.get(k).getAttribute("href");
       
       boolean valid = false;
       boolean presentinexcel = true;
       try
       {
             valid=checkforvalidurl(link);
             presentinexcel=checkexcel(link);
       }
       catch(Exception e)
       {
        //System.out.println(link);
       }
       
          if(valid==true&&presentinexcel==false)
          {
           addtoexcel(link);
          }
     
        }
      logger.info("Home page links are added to Excel");
      driver.close();
     }
 
 
 
 
  public static void addtoexcel(String link)
  {
  try
  {
   FileInputStream fis=new FileInputStream(AllUrlFilePath);
         Workbook wb=WorkbookFactory.create(fis);
         Sheet s1=wb.getSheet("Sheet1");
       
         int rc=s1.getLastRowNum();
         logger.info(rc+2 +"inserted: "+link);
         s1.createRow(rc+1).createCell(0).setCellValue(link);
        
         FileOutputStream fos = new FileOutputStream(AllUrlFilePath);
         wb.write(fos);
         fos.close();
  }
  catch(Exception e)
  {
   e.printStackTrace();
  }
  
  }
  public static boolean checkexcel(String link) throws Throwable
  {
       FileInputStream fis=new FileInputStream(AllUrlFilePath);
          Workbook wb=WorkbookFactory.create(fis);
          Sheet s1=wb.getSheet("Sheet1");
          int rc=s1.getLastRowNum();
      
          for(int j=0;j<=rc;j++)
          {          
                  String excellink=s1.getRow(j).getCell(0).getStringCellValue();
                  boolean status=link.equals(excellink);
                  if(status==true) 
                   return true;      
             }
       return false;
      }
 static boolean checkforvalidurl(String link) throws Throwable
  {
         List<String> unused=new ArrayList<String>();
         unused.add("http://www.msupply.com/#");
         unused.add("http://blog.msupply.com/");
         unused.add("http://www.msupply.com/#msupplySlide");
         unused.add("https://twitter.com/mSupplydotcom/");
         unused.add("http://www.msupply.com/#myCarousel");
         unused.add("http://www.msupply.com/#myCarouse2");
         unused.add("mailto:support@msupply.com");
         unused.add("http://www.msupply.com/#myCarousel3");
         unused.add("http://www.msupply.com/#cementSlide");
         unused.add("http://www.msupply.com/#plumbingSlide");
         unused.add("javascript:void(0);");
         unused.add("javascript:void(0)");
         unused.add("http://www.msupply.com/");
         unused.add("http://the-internet.herokuapp.com/basic_auth");
         unused.add("https://github.com/tourdedave/the-internet/issues/12");
         unused.add("download/some-file.txt");
         unused.add("download/At.txt");
         unused.add("https://github.com/tourdedave/the-internet");
         unused.add("http://api.jqueryui.com/menu/");
         unused.add("/download_secure");
         unused.add("https://plus.google.com/+mSupplydotcom/posts");
         unused.add("https://www.facebook.com/mSupplydotcom/");
         unused.add("javascript:klevu_landingFilters.showAll(%20'kuFilterBox-sizeofoneunit'%20)");
         unused.add("javascript:klevu_landingFilters.showAll(%20'kuFilterBox-product_type'%20)");
         unused.add("http://52.18.252.197/msupply.in/table-moulded-bricks-class-a-srinivas-reddy.html");
         unused.add("https://www.linkedin.com/company/msupply-com");
         unused.add("https://www.msupply.com");
         unused.add("http://www.msupply.com/#electricalsSlide");
         unused.add("https://www.google.com");
         boolean otherUrl1=false;
         boolean otherUrl2=false;
         if(link==null)
         {
        
         }
         else
         {
      otherUrl1=link.startsWith("http://www.msupply.com");
            otherUrl2=link.endsWith(".html");
         } 
         if(unused.contains(link)||
                 (link==null)||
                 link.equals(null)||
                 StringUtils.contains(link,"javascript")||
                 StringUtils.contains(link,"pinterest")||
                 StringUtils.contains(link,"http://www.msupply.com/catalog/product_compare")||
                 StringUtils.contains(link,"tab")||
                 StringUtils.contains(link,"play.google")||
                 StringUtils.contains(link,"facebook")||
                 StringUtils.contains(link,"linkedin")||
                 StringUtils.contains(link,"twitter")||
                 StringUtils.contains(link,"artiman")||
                 StringUtils.contains(link,"tgcblogs")||
                 StringUtils.contains(link,"blog")||
                 StringUtils.contains(link,"wordpress")||
                 StringUtils.contains(link,"themehybrid")||
                 StringUtils.contains(link,"product_compare")||
                 StringUtils.contains(link,"plus.google.com")||
                 StringUtils.contains(link,".pdf")||
                 StringUtils.contains(link,"google")||
                 StringUtils.contains(link,"google.com")||
                 link.startsWith("http://www.msupply.com/#")||
                 link.equals("http://www.msupply.com/#")||
                 StringUtils.contains(link,".html#collapse")||
                 StringUtils.contains(link,".jpg")||
                 StringUtils.contains(link,".html#zipsearchresult")||
                 StringUtils.contains(link,"#myCarousel")||
                 otherUrl1==false||
                 otherUrl2==false
                )
         {  
            return false;        
         }
         else
         {    
           return true;
         
         }  
  }
 public static void deleteFolder(File folder)
 {
      File[] files = folder.listFiles();
      if(files!=null)
      { //some JVMs return null for empty dirs
         for(File f: files)
         {
              if(f.isDirectory())
              {
                  deleteFolder(f);
              } else
              {
                  f.delete();
              }
          }
      }
      //folder.delete();
 }

} 