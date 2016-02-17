<?php 
function getVendorAllSkuDetails($data)
	{
		$sellerCode = $data['sellerCode'];
		if(isset($sellerCode))
		{
			$products = mysql_query("SELECT 1 AS `status`, `e`.`entity_id`, `e`.`name`, `e`.`sku`, `e`.`price`, `e`.`special_price`, `e`.`weight`, `e`.`vendor_value`,`e`.`no_of_units`, `s`.`qty`  FROM `zaybx_catalog_product_flat_1` AS `e` ,`zaybx_cataloginventory_stock_status_idx` as s WHERE (e.vendor_value LIKE '%".$sellerCode."%') and `s`.`product_id` =  `e`.`entity_id`") or die(mysql_error());
			if(mysql_num_rows($products) > 0)
			{
				while($row = mysql_fetch_array($products))
				{
					$proData['Name'] = $row['name'];
					$proData['Sku'] = $row['sku'];
					$proData['Price'] = $row['price'];
					$proData['special_Price'] = $row['special_price'];
					$proData['Weight Unit'] = $row['weight'];
					$proData['Qty'] = $row['qty'];
					$proData['Status'] = $row['status'];
					$proData['No of units'] = $row['no_of_units'];
					$proSku = explode('-',$row['sku']);
					$imageQuery = mysql_query("SELECT `small_image` FROM `zaybx_catalog_product_flat_1` WHERE sku = '".$proSku[0]."'") or die(mysql_error());
					if(mysql_num_rows($imageQuery) > 0)
					{
					$proData['Small Image'] =  'http://www.msupply.com/catalog/product'.mysql_result($imageQuery, 0);
					}
					else{
						$proData['Small Image'] = null;
					}
					
					$proArr[] = $proData;					
				}
			}
			else
			{
				$proData['error_code'] = 1;
				$proData['msg'] = "No products found for the seller";
				$proArr[] = $proData;
			}
		}
		else
		{
			$proData['error_code'] = 1;
			$proData['msg'] = "Seller code is required";
			$proArr[] = $proData;			
		}
		return $proArr;		
	}