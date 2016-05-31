package GenericLibrary;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;

import org.apache.poi.EncryptedDocumentException;
import org.apache.poi.openxml4j.exceptions.InvalidFormatException;
import org.apache.poi.ss.usermodel.Cell;
import org.apache.poi.ss.usermodel.DataFormatter;
import org.apache.poi.ss.usermodel.Row;
import org.apache.poi.ss.usermodel.Sheet;
import org.apache.poi.ss.usermodel.Workbook;
import org.apache.poi.ss.usermodel.WorkbookFactory;
import org.apache.poi.ss.util.WorkbookUtil;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;

public class RetrieveXlsxData 
{
	static XSSFWorkbook wb;
    static String currentPath = System.getProperty("user.dir");
	
	//Location of the xlsx.sheet
	static String filePath = currentPath +"/src/test/resources/TestData.xlsx";
	
	//Retrieving data from xlsx.sheet
		
		/*To get the data from excel sheet*/
		/**
		 * This method is used to fetch the data from excel sheet as per the arguments passed by user
		 * @param sheetName
		 * @param rowNum
		 * @param colNum
		 * @return String
		 * @throws InvalidFormatException
		 * @throws IOException
		 */
	
		public String getExcelData(String sheetName, int rowNum,int colNum) throws IOException, Exception
		{		
		/* Get the file location*/	
		FileInputStream fis=new FileInputStream(filePath);
		
		/* Get the control on the workbook*/
		Workbook wb=WorkbookFactory.create(fis);
		
		/*Get the control of Sheet where data is present*/
		Sheet s1=wb.getSheet(sheetName);
		
		/*Get the control of Row in which data is present*/
		Row r=s1.getRow(rowNum);
		
		String data = null;
		/*Get the data from the cell*/
		if(sheetName.equals("Sheet2"))
		{	
		    if(colNum==2||colNum==6||colNum==7)
		    {
			    DataFormatter formatter = new DataFormatter(); 
		        Cell cell = s1.getRow(rowNum).getCell(colNum);
		        data = formatter.formatCellValue(cell);
		        //System.out.println(data);
		    }
		    else
		    {	
		       data=r.getCell(colNum).getStringCellValue();
		       //System.out.println(data);
		    }						
		}
		else if(sheetName.equals("Sheet3"))
		{
			if(colNum==0)
			{
				DataFormatter formatter = new DataFormatter(); 
		        Cell cell = s1.getRow(rowNum).getCell(colNum);
		        data = formatter.formatCellValue(cell);
		        //System.out.println(data);
			}
			else
			{	
			       data=r.getCell(colNum).getStringCellValue();
			       //System.out.println(data);
			}	
		}
		
		return data;
		}
		
		//Read Data from Excel
		
		public static String[] getExcelData(String sTestID) throws Throwable
		{
			String sData[]=null;				
			File file = new File(filePath);
			FileInputStream fis = new FileInputStream(file);
				
				Workbook wb = WorkbookFactory.create(fis);
				Sheet sht =  wb.getSheet("LoginTestData");
				int LastRowExcel = sht.getLastRowNum();
				int LastCloumnExcel=0;
				for(int i=1;i<=LastRowExcel;i++)
				{
					if(sht.getRow(i).getCell(0).getStringCellValue().equals(sTestID))
					{						
						LastCloumnExcel=sht.getRow(i).getLastCellNum();						
						sData = new String[LastCloumnExcel];
						for(int k=0;k<(LastCloumnExcel);k++)
						{
							sData[k]=sht.getRow(i).getCell(k).getStringCellValue();
						}
					}
				}
			return sData;
			
		}

		//Read the TestCase ID 
		
		public static String getTestCaseID(int RowNumber) throws Throwable
		{
			String sData[]=null;				
			File file = new File(filePath);
			FileInputStream fis = new FileInputStream(file);
				
				Workbook wb = WorkbookFactory.create(fis);
			    Sheet sht =  wb.getSheet("LoginTestData");			
			    return(sht.getRow(RowNumber).getCell(0).getStringCellValue());
			
		}
		
		
		/*To write the data to excel file*/
		/**
		 * This method is used to write any data in the cell provided in excel sheet
		 * @param sheetName
		 * @param rowNum
		 * @param colNum
		 * @param data
		 * @throws InvalidFormatException
		 * @throws IOException
		 * @throws Exception 
		 */
		public static void writeExcelData(String sheetName, int rowNum, int colNum, String data) throws IOException, Exception, InvalidFormatException
		{
		/* Get the file location*/	
		FileInputStream fis=new FileInputStream(filePath);
		
		/* Get the control on the workbook*/
		Workbook wb=WorkbookFactory.create(fis);
		
		/*Get the control of Sheet where we want to write the data*/
		Sheet s1=wb.getSheet(sheetName);
		
		/*Get the control of Row in which we want to write the data*/
		Row r=s1.getRow(rowNum);
		
		/*Create a cell where we want to write the data*/
		Cell c1=r.createCell(colNum);
		
		/*Set the data type of cell what we want to write*/
		c1.setCellType(c1.CELL_TYPE_STRING);
		
		/* Pass the data in the cell*/
		c1.setCellValue(data);
		
		FileOutputStream fos=new FileOutputStream(filePath);
		
		/*Save the workbook*/
		wb.write(fos);
		
		/*Close the workbook*/
		wb.close();
		
		}
		
		
		
		
	     /*To get the last row count of excel sheet*/
		/**
		 * This method is used to count the number of rows used in the excel sheet. It returns the index of used row.
		 * @param sheetName
		 * @return 
		 * @throws InvalidFormatException
		 * @throws IOException
		 * @throws Exception 
		 */
		public static int rowCount(String sheetName) throws IOException, Exception, InvalidFormatException
		{
			/* Get the file location*/	
			FileInputStream fis=new FileInputStream(filePath);
			
			/* Get the control on the workbook*/
			Workbook wb=WorkbookFactory.create(fis);
			
			/*Get the control of Sheet where we want to write the data*/
			Sheet s=wb.getSheet(sheetName);
			
			/*Get the count of used row in excel sheet*/
			int rows=s.getLastRowNum()+1;
			
			return rows;
			
		}
	
}
