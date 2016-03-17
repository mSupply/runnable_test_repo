package GenericLibrary;

import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;

import org.apache.poi.openxml4j.exceptions.InvalidFormatException;
import org.apache.poi.ss.usermodel.Cell;
import org.apache.poi.ss.usermodel.DataFormatter;
import org.apache.poi.ss.usermodel.Row;
import org.apache.poi.ss.usermodel.Sheet;
import org.apache.poi.ss.usermodel.Workbook;
import org.apache.poi.ss.usermodel.WorkbookFactory;
import org.apache.poi.xssf.usermodel.XSSFWorkbook;

public class RetrieveXlsxData 
{
	static XSSFWorkbook wb;
    String currentPath = System.getProperty("user.dir");
	
	//Location of the xlsx.sheet
	String filePath = currentPath +"/src/test/resources/TestData.xlsx";
	
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
		        System.out.println(data);
		    }
		    else
		    {	
		       data=r.getCell(colNum).getStringCellValue();
		       System.out.println(data);
		    }						
		}
		else if(sheetName.equals("Sheet3"))
		{
			if(colNum==0)
			{
				DataFormatter formatter = new DataFormatter(); 
		        Cell cell = s1.getRow(rowNum).getCell(colNum);
		        data = formatter.formatCellValue(cell);
		        System.out.println(data);
			}
			else
			{	
			       data=r.getCell(colNum).getStringCellValue();
			       System.out.println(data);
			}	
		}
		
		return data;
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
		 */
		public void writeExcelData(String sheetName, int rowNum, int colNum, String data) throws InvalidFormatException, IOException
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
		 * @throws InvalidFormatException
		 * @throws IOException
		 */
		public void rowCount(String sheetName) throws InvalidFormatException, IOException
		{
			/* Get the file location*/	
			FileInputStream fis=new FileInputStream(filePath);
			
			/* Get the control on the workbook*/
			Workbook wb=WorkbookFactory.create(fis);
			
			/*Get the control of Sheet where we want to write the data*/
			Sheet s=wb.getSheet(sheetName);
			
			/*Get the count of used row in excel sheet*/
			int rows=s.getLastRowNum()+1;
			System.out.println(rows);
		}
	
}
