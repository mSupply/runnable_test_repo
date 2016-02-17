<?php
	function getVendorSku($data)
	{
		$sellerCode = trim($data['sellerCode']);
		if(isset($sellerCode) && $sellerCode!='')
		{
			$products = mysql_query("SELECT 1 AS `status`, `e`.`sku`  FROM `zaybx_catalog_product_flat_1` AS `e` WHERE (e.vendor_value LIKE '%".$sellerCode."%')") or die(mysql_error());
			if(mysql_num_rows($products) > 0)
			{
				while($row = mysql_fetch_array($products))
				{
					$proData['Sku'] = str_replace('-'.$sellerCode,'',$row['sku']);
					$proArr['data'][] = $proData;					
				}
				
				$proArr['message'] = 'Success';
			}
			else
			{
				$proArr['data'] = null; 					
				$proArr['message'] = "No products found for the seller";
				
			}
		}
		else
		{
			$proArr['data'] = null;					
			$proArr['message'] = "Seller code is required";
			
		}
		return $proArr;		
	}	
	
	function getSkuDetails($data)
	{
		$sku = trim($data['sku']);
		$sellerCode = trim($data['sellerCode']);
		if(isset($sellerCode) && isset($sku) && $sellerCode!='' && $sku !='')
		{
			include('../app/Mage.php');
			Mage::init();
			$product = Mage::getModel('catalog/product');
			$product->load($product->getIdBySku($sku.'-'.$sellerCode));
			if($product->getId())
			{
				$proData['Name'] = $product->getName();
				$proData['Sku'] = $sku;
				$price = $product->getPrice();
				if($product->getSpecialPrice() !='')
				{
					$price = $product->getSpecialPrice();
				}
				$proData['Price'] = $price;
				$taxRate = mysql_query("select `r`.`rate` from `zaybx_tax_calculation` as e , `zaybx_tax_calculation_rate` as r where `r`.`tax_calculation_rate_id` = `e`.`tax_calculation_rate_id` and `e`.`product_tax_class_id` = ".$product->getTaxClassId()." limit 0,1") or die(mysql_error());
				if(mysql_num_rows($taxRate) > 0)
				{
					$proData['vat'] = mysql_result($taxRate, 0)	;
				}
				$proData['excise_duty'] = $product->getExciseDuty();
				$proData['Weight Unit'] = $product->getWeightunit();
				$stock = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product);
				$proData['Qty'] = $stock->getQty();
				$proData['Status'] = $product->getStatus();
				$proData['No of units'] = $product->getNoOfUnits();
				$imageQuery = mysql_query("SELECT `small_image` FROM `zaybx_catalog_product_flat_1` WHERE sku = '".$sku."'") or die(mysql_error());
				if(mysql_num_rows($imageQuery) > 0)
				{
				$proData['Small Image'] =  'http://www.msupply.com/catalog/product'.mysql_result($imageQuery, 0);
				}
				else{
					$proData['Small Image'] = null;
				}
				$comData['sellerCode'] = $sellerCode;
				$comData['sku'] = $sku;
				$comData['price'] = $price;
				$proData['competitive_price'] = getCompetitivePrice($comData);
				$proArr['data'] = $proData;					
				$proArr['message'] = 'Success';		
				
			}
			else
			{
				$proArr['data'] = null;	
				$proArr['message'] = "No products found for the seller";
			}
		}
		else
		{
			$proArr['data'] = null;
			$proArr['message'] = "Seller code and sku is required";
		}
		return $proArr;		
	}
	
	function getSkuDetails1($data)
	{
		$sku = trim($data['sku']);
		$sellerCode = trim($data['sellerCode']);
		if(isset($sellerCode) && isset($sku) && $sellerCode!='' && $sku !='')
		{
			$products = mysql_query("SELECT 1 AS `status`, `e`.`entity_id`, `e`.`name`, `e`.`sku`, `e`.`price`, `e`.`special_price`, `e`.`special_to_date`, `e`.`special_from_date`, `e`.`weightunit`, `e`.`tax_class_id`,`e`.`excise_duty`,`e`.`vendor_value`,`e`.`no_of_units`, `s`.`qty`  FROM `zaybx_catalog_product_flat_1` AS `e` ,`zaybx_cataloginventory_stock_status_idx` as s WHERE (e.sku LIKE '".$sku.'-'.$sellerCode."') and `s`.`product_id` =  `e`.`entity_id`") or die(mysql_error());
			if(mysql_num_rows($products) > 0)
			{
				while($row = mysql_fetch_array($products))
				{
					$proData['Name'] = $row['name'];
					$sku =  explode('-', $row['sku']);
					$proData['Sku'] = $sku[0];
					$price = $row['price'];
					if($row['special_price'] !='')
					{
						/* $date = date("Y-m-d");
						if($row['special_from_date'] !='' && $row['special_from_date'] >= $date )
						{
							$date1=date_create($row['special_from_date']);
							$date2=date_create($row['special_to_date']);
							$diff=date_diff($date1,$date2);
							$sign = $diff->format("%R");
							$days = $diff->format("%a");
							if($sign == '+' && $days >= 0)
							{ */
								$price = $row['special_price'];
							/* }
						} */
					}
					$proData['Price'] = $price;
					$taxRate = mysql_query("select `r`.`rate` from `zaybx_tax_calculation` as e , `zaybx_tax_calculation_rate` as r where `r`.`tax_calculation_rate_id` = `e`.`tax_calculation_rate_id` and `e`.`product_tax_class_id` = ".$row['tax_class_id']." limit 0,1") or die(mysql_error());
					if(mysql_num_rows($taxRate) > 0)
					{
						$proData['vat'] = mysql_result($taxRate, 0)	;
					}
					$proData['excise_duty'] = $row['excise_duty'];
					$proData['Weight Unit'] = $row['weightunit'];
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
					$comData['sellerCode'] = $sellerCode;
					$comData['sku'] = $sku[0];
					$comData['price'] = $price;
					$proData['competitive_price'] = getCompetitivePrice($comData);
					$proArr['data'] = $proData;					
					$proArr['message'] = 'Success';				
				}
			}
			else
			{
				$proArr['data'] = null;	
				$proArr['message'] = "No products found for the seller";
			}
		}
		else
		{
			$proArr['data'] = null;
			$proArr['message'] = "Seller code and sku is required";
		}
		return $proArr;		
	}
	
	function getCompetitivePrice($data)
	{
		if(isset($data['sellerCode']) && isset($data['sku']))
		{
			$products = mysql_query("SELECT 1 AS `status`, `e`.`entity_id`,`e`.`name`, `e`.`special_to_date`, `e`.`sku`, `e`.`price`, `e`.`special_price`, `e`.`special_from_date`, `e`.`vendor_value` FROM `zaybx_catalog_product_flat_1` AS `e` WHERE (e.sku LIKE '".$data['sku']."-%')") or die(mysql_error());
			if(mysql_num_rows($products) > 0)
			{
				$foundSku = 0;
				$price = 0;
				$minPrice = $data['price'];
				while($row = mysql_fetch_array($products))
				{
					if($row['sku'] != $data['sku'] && $row['sku'] != $data['sku'].'-'.$data['sellerCode'])
					{
						$foundSku = 1;
						$price = $row['price'];
						if($row['special_price'] !='')
						{
							$price = $row['special_price'];
						}
						/* if($row['special_price'] !='')
						{
							$date = date("Y-m-d");
							if($row['special_from_date'] !='' && $row['special_from_date'] >= $date )
							{
								$date1=date_create($row['special_from_date']);
								$date2=date_create($row['special_to_date']);
								$diff=date_diff($date1,$date2);
								$sign = $diff->format("%R");
								$days = $diff->format("%a");
								if($sign == '+' && $days >= 0)
								{
									$price = $row['special_price'];
								}
							}
						} */
											
					}
					if($minPrice < $price || $minPrice ==0)
					{
						$minPrice = $price;
					}
					$proArr = $price;
				}
				if($foundSku == 0){
					$proArr = "No Competitive found for the seller";
				}
			}
			else
			{
				$proArr = "No Competitive found for the seller";
			}
		}
		else
		{
			$proArr = "Seller code and sku are required";			
		}
		return $proArr;
	}
	
	function updateSeller($data)
	{
		include('../app/Mage.php');
		Mage::init();
		if(isset($data['sku']) && $data['sku'] != '' && isset($data['status']) && $data['status'] != '' && isset($data['price']) && $data['price'] != '' && isset($data['special_price']) && isset($data['sellerCode']) && $data['sellerCode'] != '' && isset($data['inventory']) && $data['inventory'] != '')
		{
			if($data['status'] == 1 || $data['status'] ==2)
			{
				if(is_numeric($data['price']))
				{
					if(is_numeric($data['inventory']))
					{
						$sku = $data['sku'].'-'.$data['sellerCode'];
						$product = Mage::getModel('catalog/product');
						$productId = $product->getIdBySku($sku);
						if(isset($productId) && $productId !='')
						{
							$product = $product->load($productId);
							$product->setStatus($data['status']);
							$product->setPrice($data['price']);
							$product->setSpecialPrice($data['special_price']);
							$product->save();
							
							$stockItem = Mage::getModel('cataloginventory/stock_item')->loadByProduct($productId);
							if($stockItem->getId() > 0 and $stockItem->getManageStock()) {
								$qty = $data['inventory'];
								$stockItem->setQty($qty);
								$stockItem->setIsInStock((int)($qty > 0)); 
								$stockItem->save();
							}
							$proArr['data'] = null;	
							$proArr['message'] = "Update Success";
						}
						else{
							$proArr['data'] = null;	
							$proArr['message'] = "Sku doesnot exist";
						}
					}
					else
					{
						$proArr['data'] = null;	
						$proArr['message'] = "Inventory need be number";
					}
				}
				else{
					$proArr['data'] = null;	
					$proArr['message'] = "price need be in correct format EX: 109.23";
				}
			}
			else{
				$proArr['data'] = null;	
				$proArr['message'] = "status can be either 1 or 2";
			}
		}
		else{
			$proArr['data'] = null;	
			$proArr['message'] = "Seller code, sku, Price, special_price, Inventory and status are required";
		}
		
		return $proArr;
	}
	
	
	function getSkuVATDetails($data)
	{
		if(isset($data['sku']) && count($data['sku']) > 0)
		{
			$total = 0;
			foreach($data['sku'] as $sku)
			{
				if(trim($sku) !='')
				{
					$products = mysql_query("SELECT 1 AS `status`, `e`.`entity_id`,`e`.`tax_class_id`, `e`.`special_to_date`, `e`.`sku`, `e`.`price`, `e`.`special_price`, `e`.`special_from_date`, `e`.`vendor_value` FROM `zaybx_catalog_product_flat_1` AS `e` WHERE e.sku = '".$sku."'") or die(mysql_error());
					if(mysql_num_rows($products) > 0)
					{
						while($row = mysql_fetch_array($products))
						{
							$price = $row['price'];
							if($row['special_price'] !='')
							{
								$price = $row['special_price'];
							}
							/* if($row['special_price'] !='')
							{
								$date = date("Y-m-d");
								if($row['special_from_date'] !='' && $row['special_from_date'] >= $date )
								{
									$date1=date_create($row['special_from_date']);
									$date2=date_create($row['special_to_date']);
									$diff=date_diff($date1,$date2);
									$sign = $diff->format("%R");
									$days = $diff->format("%a");
									if($sign == '+' && $days >= 0)
									{
										$price = $row['special_price'];
									}
								}
							} */
							$taxRate = mysql_query("select `r`.`rate` from `zaybx_tax_calculation` as e , `zaybx_tax_calculation_rate` as r where `r`.`tax_calculation_rate_id` = `e`.`tax_calculation_rate_id` and `e`.`product_tax_class_id` = ".$row['tax_class_id']." limit 0,1") or die(mysql_error());
							if(mysql_num_rows($taxRate) > 0)
							{
								$retrunSku[$sku] = number_format($price + ($price * (mysql_result($taxRate, 0)/100)),2);
								$total = ($total + ($price + ($price * (mysql_result($taxRate, 0)/100))));
							}
							else{
								$retrunSku[$sku] = null;
							}
						}
					}
				}
			}
			if(isset($retrunSku))
			{
				$proArr['data'] = $retrunSku;
				$proArr['consolationInfo']['total'] = number_format($total,2);
				$proArr['message'] = 'Success';
			}
			else
			{
				$proArr['data'] = null;
				$proArr['message'] = "sku doesnot match";
			}
			
			
		}
		else
		{
			$proArr['data'] = null;
			$proArr['message'] = "sku is required";
			
		}
		return $proArr;
	}
?>