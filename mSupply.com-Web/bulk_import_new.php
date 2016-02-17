<?php
set_time_limit(0);
ini_set('memory_limit', '1024M');
include_once "app/Mage.php";
include_once "downloader/Maged/Controller.php";

Mage::init();
$app = Mage::app('default');


$resource = Mage::getSingleton('core/resource');

// Get Csv File Name
$db_read = $resource->getConnection('core_read');
$db_write = $resource->getConnection('core_write');

$table_prefix = Mage::getConfig()->getTablePrefix();
$query = "SELECT file FROM {$table_prefix}productupload WHERE status = 'New' ORDER BY productupload_id ASC LIMIT 1";	
$csvFileName = $db_read->fetchOne($query);

// Get Csv Id 
$id_query = "SELECT productupload_id FROM {$table_prefix}productupload WHERE status = 'New' ORDER BY productupload_id ASC LIMIT 1";	
$csv = $db_read->fetchOne($id_query);

// Get Csv File Name
$image_query = "SELECT image_folder FROM {$table_prefix}productupload WHERE status = 'New' ORDER BY productupload_id ASC LIMIT 1";	
$image_folder = $db_read->fetchOne($image_query);

//Status progress update
$connection = Mage::getSingleton('core/resource')  
->getConnection('core_write');  
$connection->beginTransaction();  
$fields = array();  
$fields['status'] = 'Progress';  
$where = $connection->quoteInto('productupload_id =?', $csv);  
$connection->update('zaybx_productupload', $fields, $where);  
$connection->commit();  

//Start time update
$date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
$startdate = $date->format('d-m-Y H:i:s');

$connection1 = Mage::getSingleton('core/resource')  
->getConnection('core_write');  
$connection1->beginTransaction();  
$fields1 = array();  
$fields1['importstart_time'] = $startdate;  
$where1 = $connection->quoteInto('productupload_id =?', $csv);  
$connection1->update('zaybx_productupload', $fields1, $where1);  
$connection1->commit();


$categories = Mage::getModel('catalog/category')
        ->getCollection()
        ->addAttributeToSelect('*')
        ->addIsActiveFilter();

	foreach ($categories as $category)
	{
		$categoriesArray[$category->getName()] = $category->getId();
	}

	$attribute_code = "color"; 
	$attribute_details = Mage::getSingleton("eav/config")->getAttribute("catalog_product", $attribute_code);
	$options = $attribute_details->getSource()->getAllOptions(false);
	foreach($options as $option){
		$colorArr[trim($option["label"])] = $option["value"]; ; 
	}

 //vendor
	$attribute_code = "vendor"; 
	$attribute_details = Mage::getSingleton("eav/config")->getAttribute("catalog_product", $attribute_code);
	$options = $attribute_details->getSource()->getAllOptions(false);
	foreach($options as $option){
		$vendorArr[trim($option["label"])] = $option["value"]; 
			
	}

 //Manufacturer
	$attribute_code = "manufacturer"; 
	$attribute_details = Mage::getSingleton("eav/config")->getAttribute("catalog_product", $attribute_code);
	$options = $attribute_details->getSource()->getAllOptions(false);
	foreach($options as $option){
		$manufacturerArr[trim($option["label"])] = $option["value"]; ; 
	}
 
 //Menu Type	
	$attribute_code = "product_type"; 
	$attribute_details = Mage::getSingleton("eav/config")->getAttribute("catalog_product", $attribute_code);
	$options = $attribute_details->getSource()->getAllOptions(false);
	foreach($options as $option){
		$menuTypeArr[trim($option["label"])] = $option["value"]; ; 
	}
 	
$mage_attribute_column_names = array('Class'=>'product_type',											'Product Name'=>'name',		    						'Brand Name'=>'manufacturer',									 'Manufacturer'=>'company_name',
									'SKU'=>'sku',					   								'UPC'=>'upc',											'Vendor Product Id'=>'vendor_product_id',
									'Parent SKU ID'=>'parent_sku_id', 								'Product Type'=>'type_id',								'Color'=>'color',
									'Code'=>'code',													'Size'=>'size',											'Size UOM'=>'size_uom',
									'Length'=>'length',												'Length UoM'=>'length_uom',								'Breadth'=>'breadth',
									'Breadth UoM'=>'breadth_uom',									'Diameter'=>'diameter',									'Diameter UoM'=>'diameter_uom',
									'Thickness'=>'thickness',										'Thickness UoM'=>'thickness_uom',						'Weight'=>'weight',
									'Weight UoM'=>'weightunit',										'Other Size details'=>'other_size_details',				'Is Used'=>'isused',					'Grade'=>'grade',
									'Classification'=>'classification',								'Series'=>'series',										'Spec Model'=>'spec_model',
									
									'Nominal Area of Conductor'=>'nominalareaofconductor',			'Nominal Thickness of Insulation'=>'nominalthicknessofinsulation',
									
									'Current Rating'=>'currentrating',								'Fitting Type'=>'fitting_type',							 
									
									'Model'=>'model',							 		 			'Lamp Type'=>'lamptype',								 
								
									'Lumen Output'=>'lumenoutput',									'Power Consumption'=>'powerconsumption',				'Insulation Material'=>'insulationmaterial',
									'Conductor Resistance'=>'conductorresistance',					'Mutual Capacitance'=>'mutualcapacitance',				'Temperature'=>'temperature',
									'Wattage'=>'wattage',											'Voltage'=>'voltage',									'Body Material'=>'body_material',
									'Design'=>'design',												'No. of Blades'=>'no_of_blades',						'Sweep'=>'sweep',
									'Dimensions'=>'dimensions',										'Blade Size'=>'blade_size',								'Speed'=>'speed',
									'Air Delivery'=>'air_delivery',									'Temperature Controller'=>'temperature_controller',		'Frequency'=>'frequency',
									'Technology'=>'technology',										'Insulation'=>'insulation',								'Initial Heating Time'=>'initial_heating_time',
									'Re-Heating Time'=>'re_heating_time',							'Wall Mounting'=>'wall_mounting',						'Heating Element'=>'heating_element',
									'Pressure'=>'pressure',											'Quality'=>'quality',
									
									'Depth'=>'depth',												'Integrated overlay adjustment'=>'integrated_overlay_adjustment',
									
									'Integrated depth adjustment '=>'integrated_depth_adjustment',  'Material of hinge arm'=>'material_of_hinge_arm',
									
									'Material of hinge cup'=>'material_of_hinge_cup',				'Three-dimensional front adjustment'=>'three_dimen_front_adj',
									
									'Load Capacity'=>'load_capacity',								'Material'=>'material',									'Short Description'=>'short_description',
									'Full Description'=>'description',								'Specifications'=>'specificaitons',						'Seller Price'=>'price',
									'Offer Price'=>'special_price',									'Cost Price'=>'cost',									'Unit Price'=>'unit_price',					'MSRP'=>'msrp',													'Price Validity'=>'price_validity',							
									'Minimum Advertised Price'=>'minimum_advertised_price',			'Discount'=>'msupply_discount',
									
									'Does this item have deal pricing?'=>'does_this_item',
									
									'Marketing Margin'=>'marketing_margin',							'Case Unit Length'=>'case_unit_length',
									'Case Unit Width'=>'case_unit_width',						    'Case Unit Height'=>'case_unit_height',					'Case UoM'=>'case_uom',
									'Case Unit Weight'=>'case_unit_weight',							'Case Weight UoM'=>'case_unit_weight_uom',					'Pallet Hi'=>'paller_hi',
									'Pallet Ti'=>'pallet_ti',										'Minimum Order Quantity'=>'minimum_order_quantity',		'Minimum Order Value'=>'minimum_order_value','Minimum Quantity for free Shipping'=>'minqtyforfreeshipping',	 'Shipping Cost'=>'shippingcost',					 	 'ETA'=>'estimateddelivery',
									'Kit'=>'kit',													'Assortment'=>'assortment',								'Set'=>'set',
									
									'Web Enabled'=>'web_enabled',									'Product Country Of Origin'=>'product_coun_of_ori',			
									
									'Vendor ID'=>'vendor',                                          'License Website'=>'license_website',					
									
									'Vendor Direct to Customer'=>'vendor_direct_to_customer', 	
									
									'Live Date'=>'live_date',										'Decor Type'=>'decor_type',								'Rating'=>'rating',							'small_image_label'=>'small_image_label',						'special_from_date'=>'special_from_date',	 			'special_to_date'=>'special_to_date',		 'status'=>'status',											 'tax_class_id'=>'tax_class_id',						 'thumbnail_label'=>'thumbnail_label',		'visibility'=>'visibility',										'Qty'=>'qty',
								
									'min_qty'=>'min_qty',											'_links_related_sku'=>'links_related_sku',				
									'_links_related_position'=>'links_related_position',			'_links_crosssell_sku'=>'links_crosssell_sku',									
									'_links_crosssell_position'=>'links_crosssell_position',		'_links_upsell_sku'=>'links_upsell_sku',
									'_links_upsell_position'=>'links_upsell_position',				'_associated_sku'=>'associated_sku',
									'_associated_default_qty'=>'associated_default_qty',			'_associated_position'=>'associated_position',		
									'_tier_price_customer_group'=>'tier_price_customer_group',		'_group_price_website'=>'group_price_website',	
									'_group_price_customer_group'=>'group_price_customer_group',	'_group_price_price'=>'group_price',		
									'_media_image'=>'image',										'_media_lable'=>'media_lable',
									
									'_media_position'=>'media_position',							'_media_is_disabled'=>'media_is_disabled',				'Extension'=>'extension',
									'media small image'=>'small_image',								'media thumbnail' => 'thumbnail',						'Media Gallery'=>'gallery',		
									'Meta Description'=>'meta_description',							'Meta Keyword'=>'meta_keyword',
									'Meta Title'=>'meta_title',										'Attribute'=>'attribute_set_id',						'Root Category'=>'root_category',
									'Product Websites'=>'website_ids',								'Created At'=>'created_at',	
									
									'msrp_display_actual_price_type'=>'msrp_display_actual_price_type',
									
									'msrp_enabled'=>'msrp_enabled',									'required_options'=>'required_options',					'use_config_min_qty'=>'use_config_min_qty',
									
									'is_qty_decimal'=>'inventory_is_qty_decimal',				    'backorders'=>'inventory_backorders',					
									'use_config_backorders'=>'use_config_backorders',				'min_sale_qty'=>'min_sale_qty',							
									'use_config_min_sale_qty'=>'use_config_min_sale_qty', 			'max_sale_qty'=>'max_sale_qty',							
									
									'use_config_max_sale_qty'=>'use_config_max_sale_qty',			'is_in_stock'=>'is_in_stock',							'notify_stock_qty'=>'notify_stock_qty',
									
									'use_config_notify_stock_qty'=>'use_config_notify_stock_qty',   'manage_stock'=>'manage_stock',						
									'use_config_manage_stock'=>'use_config_manage_stock',			'stock_status_changed_auto'=>'stock_status_changed_auto',
									'use_config_qty_increments'=>'use_config_qty_increments',		'qty_increments'=>'qty_increments',			
									'use_config_enable_qty_inc'=>'use_config_enable_qty_inc',		'enable_qty_increments'=>'enable_qty_increments',
									
									'is_decimal_divided'=>'is_decimal_divided',						'_tier_price_website'=>'tier_price_website',			'_tier_price_qty'=>'tier_price_qty',	

									'_tier_price_price'=>'tier_price_price',						'_media_attribute_id'=>'media_attribute_id',
									'Motor'=>'motor',												'Motor Power'=>'motor_power',							'Air Flow (m3/h)'=>'air_flow',

									'Noise Level'=>'noise_level',									'Control'=>'control',									'Filter'=>'filter',
									'Finish'=>'finish',												'Timer'=>'timer',										'No.Of Lamps'=>'no_of_lamps',
									'Burner(no)'=>'burner',											'Triple Ring Burner'=>'triple_ring_burner',				'Flat Burner'=>'flat_burner',
									'Warranty'=>'warranty',											'Types'=>'types',										'No.Of Ways'=>'no_of_ways',
									'No.Of Pin'=>'no_of_pin',										'No.Of Modules'=>'no_of_modules',						'Ampere'=>'ampere',
									'Trap Type'=>'trap_type',										'No_of_Poles'=>'No.of Poles',                            'Discount Range'=>'discount_range'
																		);	
if (($handle = fopen(Mage::getBaseDir('var') . DS . "import" . DS . $csvFileName, "r")) !== FALSE) {
	$headerNotRequired = fgetcsv($handle);
	$header = fgetcsv($handle);
	 for($i=0;$i<6;$i++)
		 array_shift($header);
		//echo'<pre>';print_r($header);
		$ctr=0;
    while (($data = fgetcsv($handle)) !== FALSE) {
		for($i=0;$i<4;$i++)
			array_shift($data);
			$categoryData = $data[0]."/".$data[1]."/".$data[2];
			$categoryId = $categoriesArray[$data[1]];
			//echo $data[2].$categoryId;exit;
			for($i=0;$i<2;$i++)
				array_shift($data);
			if(isset($data[9]))
			{
				$data[9] = $colorArr[trim($data[9])];
			}
			if(isset($data[100]))
			{
				$data[100] = $vendorArr[trim($data[100])];
			}
			if(isset($data[2]))
			{
				$data[2] = $manufacturerArr[trim($data[2])];
			} 
			if(isset($data[0]))
			{
				$data[0] = $menuTypeArr[trim($data[0])];
			}
		
			$finalProductData = array_combine(array_keys($mage_attribute_column_names),$data);
			//echo'<pre>';print_r($finalProductData);
			$product = Mage::getModel('catalog/product');
			foreach($finalProductData as $key => $value){
			if($value !="")
			{
				//echo "<br>".$mage_attribute_column_names[$key]."=====".$value;
				$product->setData($mage_attribute_column_names[$key],$value);
			}	
		}	
	
	 $product->setCategoryIds(array($categoryId));
	 $product->setStoreId(1);
	 $product->setWebsiteIds(array(1));
	try{
		
		// $product->setStockData(array(
                       // 'use_config_manage_stock' => 0, //'Use config settings' checkbox
                       // 'manage_stock'=>1, //manage stock
                       // 'min_sale_qty'=>10, //Minimum Qty Allowed in Shopping Cart
                       // 'max_sale_qty'=>20, //Maximum Qty Allowed in Shopping Cart
                       // 'is_in_stock' => 1, //Stock Availability
                       // 'qty' => 999 //qty
                   // )
    // );
		
		$product->save();
	
	////////////////////////////////////////
	
	
		$fileName = $finalProductData['media small image'];
		
		if($fileName != '')
		{
        $importDir = Mage::getBaseDir('media') . DS . 'import' . DS . $image_folder;


        $productSKU = $finalProductData['SKU'];
	    $ourProduct = Mage::getModel('catalog/product')->loadByAttribute('sku',$productSKU);
	    $filePath = $importDir.$fileName;
		if (file_exists($filePath)){
		$ourProduct->addImageToMediaGallery($filePath, array('image', 'small_image', 'thumbnail'), false, false);
		$myString = $finalProductData['Media Gallery'];
		if($myString != '')
		{
		$myArray = explode(',', $myString);
        foreach($myArray as $my)
		{
	    $fileName_extra = $my;
		$filePath_extra = $importDir.$fileName_extra;
		$ourProduct->addImageToMediaGallery($filePath_extra, array('gallery'), false, false);
		}
		}
		$ourProduct->save();
		}
		}
		
		// Product Qty Upload
		$stockItem = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product->getId());
		$stockItemId = $stockItem->getId();
		if (!$stockItemId) {
		$stockItem->setProductId($product->getId());
		$stockItem->setStockId(1);
		} 
		$stockItem->setManageStock(1);
		$stockItem->setUseConfigManageStock(0);
		$stockItem->setIsInStock(1);
		$stockItem->save();
		$stockItem = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product->getId());
		$stockItemId = $stockItem->getId();
		$stockItem->setQty(9999);
		$stockItem->save();	
      
	  $product->save(); 
	
	}catch(Exception $e){echo $e->getMessage();}
	echo "<br>product id ".$product->getId();
	$ctr++;
	
    }
	
	//End time Upadte
	$date1 = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
	$enddate = $date1->format('d-m-Y H:i:s');
	
	$connection2 = Mage::getSingleton('core/resource')  
	->getConnection('core_write');  
	$connection2->beginTransaction();  
	$fields2 = array();  
	$fields2['importend_time'] = $enddate;  
	$where2 = $connection->quoteInto('productupload_id =?', $csv);  
	$connection2->update('zaybx_productupload', $fields2, $where2);  
	$connection2->commit();
	
	//Final Status Update
	$connection3 = Mage::getSingleton('core/resource')  
	->getConnection('core_write');  
	$connection3->beginTransaction();  
	$fields3 = array();  
	$fields3['status'] = 'Done';  
	$where3 = $connection->quoteInto('productupload_id =?', $csv);  
	$connection3->update('zaybx_productupload', $fields3, $where3);  
	$connection3->commit();
	
	//Email function
	
	$StatusQuery = "SELECT status FROM {$table_prefix}productupload WHERE productupload_id = '$csv' ORDER BY productupload_id ASC LIMIT 1";
	$statusDone = $db_read->fetchOne($StatusQuery);
	
	if($statusDone == 'Done'){
		
		$selectTable = "SELECT * FROM {$table_prefix}productupload WHERE productupload_id = '$csv'";
		$statusDoneAll = $db_read->fetchAll($selectTable);
		$message .='<table cellspacing="0" cellpadding="10" border="1">
					  <tr>
						<th>S.No</th>
						<th>File Name</th>
						<th>Image Folder Name</th>
						<th>Updated Time</th>
						<th>Import Start Tmie</th>
						<th>Import End Time</th>
						<th>Status</th>
					  </tr>';
		foreach($statusDoneAll as $statusAll){
			
		$message .='<tr>
					  <td>'. $statusAll["productupload_id"].'</td>
					  <td>'. $statusAll["file"].'</td>
					  <td>'. $statusAll["image_folder"].'</td>
					  <td>'. $statusAll["updated_time"].'</td>
					  <td>'. $statusAll["importstart_time"].'</td>
					  <td>'. $statusAll["importend_time"].'</td>
					  <td>'. $statusAll["status"].'</td>
				   </tr>';
				}
		$message .='</table>';
		
		$configEmailValue = Mage::getStoreConfig('productupload/productupload_group/productuploademailtosend');
		
		// To send HTML mail, the Content-type header must be set
				
		$emails_arr = explode( ',', $configEmailValue );
		
		if (sizeof($emails_arr))
		{
			$to      = implode(',', $emails_arr);
			$subject = 'Product Upload';
			
			$headers = 'From: support@msupply.com' . "\r\n". 
				'Reply-To: support@msupply.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion() ."\r\n" .
				'MIME-Version: 1.0' . "\r\n" .
				'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			mail($to, $subject, $message, $headers);
		}
		else {
			echo 'email failed';
		}

		print $message;
	}
    fclose($handle);   
}

?>
