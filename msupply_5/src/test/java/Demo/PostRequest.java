package Demo;
import java.io.IOException;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.Scanner;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.entity.StringEntity;
import org.apache.http.impl.client.BasicResponseHandler;
import org.apache.http.impl.client.DefaultHttpClient;
//import org.json.JSONArray;
//import org.json.JSONObject;
import org.testng.Reporter;
import org.testng.annotations.Test;

public class PostRequest
{
   @Test
   public void aptTesting() throws Exception
   {
      
        HttpPost request = new HttpPost("http://nodejs.stg.msupply.com/supplier/api/v1.0/approveReviewsForSellers");
        StringEntity params =new StringEntity("{\"approveReviews\":[{\"sellerId\":\"10000068\",\"customerId\":\"1674\",\"orderId\":\"2016014190\",\"status\":\"approve\"}]}");
        request.addHeader("Content-Type","application/json");
        request.setEntity(params);
        HttpResponse response = (new DefaultHttpClient()).execute(request);
        String entireResponse = new BasicResponseHandler().handleResponse(response);
        System.out.println(entireResponse);       
          

//             JSONObject obj = new JSONObject(entireResponse );
//             String responseCode = obj.getString("status");
//             System.out.println("status :" + responseCode);
//
//             JSONArray arr = obj.getJSONArray("KartChargesConsolidation");
//             for (int i = 0; i < arr.length(); i++)
//             {
//                 String Customer = arr.getJSONObject(i).getString("customer_id");
//                 System.out.println("customer_id: " + Customer);
//                
//             }

     
   }
}  