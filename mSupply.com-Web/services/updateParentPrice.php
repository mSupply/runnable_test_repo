<?php
	set_time_limit(0);
	include('../app/Mage.php');
	Mage::init();
	if (file_exists('../app/etc/local.xml')) {
		$xml = simplexml_load_file('../app/etc/local.xml');
		$host = $xml->global->resources->default_setup->connection->host;
		$username = $xml->global->resources->default_setup->connection->username;
		$password = $xml->global->resources->default_setup->connection->password;
		$dbname = $xml->global->resources->default_setup->connection->dbname;
		$msqlConnect = mysql_connect($host,$username,$password);
		mysql_select_db($dbname,$msqlConnect);
    } else {
		exit('Failed to open local.xml.');
	}
	$file = Mage::getBaseDir('log').'/priceUpdate.log';
	if(file_exists($file)) {
		$fopen = fopen($file, r);
		$fread = fread($fopen,filesize($file));
		if(trim($fread) =='')
		{
			$completedSku = array(0,500,0);
			$current = implode('#',$completedSku);
			file_put_contents($file, $current);
		}
		else{
			$remove = "#";
			$completedSku = explode($remove, $fread);
			$countproducts = mysql_query("SELECT `e`.`sku`  FROM `zaybx_catalog_product_flat_1` AS `e` WHERE e.visibility =4");
			if(mysql_num_rows == $completedSku[2])
			{
				file_put_contents($file, '');
				echo 'Processed all SKUs';
				die;
			}
		}
		fclose($fopen);
		
	}
	else{
		$myfile = fopen($file, "w") or die("Unable to open file!");
		$completedSku = array(0,500,0);
		$current = implode('#',$completedSku);
		file_put_contents($file, $current);
	}
	$products = mysql_query("SELECT `e`.`sku`  FROM `zaybx_catalog_product_flat_1` AS `e` WHERE e.visibility =4 limit $completedSku[2],$completedSku[1]") or die(mysql_error());
	mysql_num_rows($products);
	$start = $completedSku[2];
	while($row = mysql_fetch_array($products))
	{
		$childProducts = mysql_query("SELECT 1 AS `status`, `e`.`sku`, `e`.`price`, `e`.`special_price`, `e`.`special_to_date`, `e`.`special_from_date` FROM `zaybx_catalog_product_flat_1` AS `e` WHERE (e.sku LIKE '".$row['sku'].'-%'."')") or die(mysql_error());
		if(mysql_num_rows($childProducts) > 0)
		{
			while($childRow = mysql_fetch_array($childProducts))
			{
				$priceFound = 0;
				$price = $childRow['price'];
				if($childRow['special_price'] !='')
				{
					$price = $childRow['special_price'];
				}
				
				if($price < $priceFound || $priceFound == 0)
				{
					$priceFound = $price;
					$lowPrice = number_format($childRow['price'],2);
					$lowSpecialPrice = number_format($childRow['special_price'],2);
					$lowSpecial_to_datePrice = $childRow['special_from_date'];
					$lowSpecial_to_datePrice = $childRow['special_to_date'];
				}
				$product = Mage::getModel('catalog/product')->loadByAttribute('sku',$row['sku']);
				$product->setPrice($lowPrice);
				$product->setSpecialPrice($lowSpecialPrice);
				$product->setSpecialToDate($lowSpecial_to_datePrice);
				$product->setSpecialToDate($lowSpecial_to_datePrice);
				$product->save();
			}
			$start = $start +1;
			$current = "$completedSku[2]#500#".$start;
			file_put_contents($file, $current);
		}
	}
?>