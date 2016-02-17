<?php
ob_start();
include_once 'app/Mage.php';
Mage::app();
$brand = $_POST['brand'];
$zip = $_POST['zip'];
$size = $_POST['size'];
$qty = $_POST['qty'];

$fixedQty = $_POST['fixed'];

$selectedSeller = $_POST['selected_seller'];
$array =  explode(',', $size);
//$array = json_decode($zip, true);
$daiameter = array();
foreach ($array as $data) {
	$daiameter[] = $data;
}
$diameter_list = $daiameter[0];
$array_ids = explode(", ", $qty);
$pid = array();
$pqty =array();		 
 foreach($array_ids as $pro_id)
 {
	
	$words = explode('-', $pro_id);
	$qtyselected = $last_word = array_pop($words);
	$pro_id = $first_chunk = implode('-', $words);
	 
	$pid[$pro_id][] = $qtyselected; 
	
 }
$currentTime = Mage::getModel('core/date')->date('Y-m-d H:i:s');

$todayDate = date('m/d/y');
$tomorrow = mktime(0, 0, 0, date('m'), date('d'), date('y'));
$tomorrowDate = date('m/d/y', $tomorrow);
$products = Mage::getModel('catalog/category')->load(282)
 ->getProductCollection()
 ->addAttributeToSelect('*')
 ->addAttributeToFilter('status', 1)
 ->addAttributeToFilter('visibility', 1)
 ->addAttributeToFilter('diameter', array('in' =>$daiameter))
 ->addAttributeToFilter('manufacturer', array('eq' =>$brand))
 //->addAttributeToFilter('special_price', array('neq' => ""))
 ->setOrder('price', 'ASC')
 //->setPageSize(6)
 ;
$resource = Mage::getSingleton('core/resource');
$readConnection = $resource->getConnection('core_read');
$writeConnection = $resource->getConnection('core_write');
$vendorpinmaptableName = $resource->getTableName('vendorpinmap/vendorpinmap');
$query = 'SELECT seller_code FROM '.$vendorpinmaptableName.' WHERE status=1 AND pincode='.$zip;
$sellerData = $readConnection->fetchAll($query);
$finalSellerData = array();
foreach($sellerData as $sellerInfo){
	$finalSellerData[] = $sellerInfo["seller_code"];
}
$sellerData = $finalSellerData;
  $daicount = count($daiameter);
 $sellerArray = array();
 foreach($products as $product){
	 
	$model = Mage::getModel('catalog/product');
	$productObject = $model->load($product->getId());
	$sellerId = $productObject->getVendor();
	$productPrice = $productObject->getPrice();
	$special = $productObject->getSpecialPrice();
	$diame = $productObject->getDiameter();
	if($tp == 'MT'){
		   $ProductToDate = $productObject->getResource()->formatDate($productObject->getspecial_to_date(), false);
                              
		   if (strtotime($currentTime) < strtotime($ProductToDate . ' ' . $productObject->getTime())) { 
		   $productPrice = number_format($special, 2, '.', '');
								 
							   }else{
								   $productPrice = number_format($productObject->getPrice(), 2, '.', ''); 
							   }
							
	}else{
		 $offset = $productObject->getSteelOffset();
							  $ProductToDate = $productObject->getResource()->formatDate($productObject->getspecial_to_date(), false);
                              
		                 if (strtotime($currentTime) < strtotime($ProductToDate . ' ' . $productObject->getTime())) { 
								  $productPrice = number_format($special, 2, '.', '') *  number_format($offset, 2, '.', '');  
							   }else{
								 $productPrice =  number_format($productObject->getPrice(), 2, '.', '') *  number_format($offset, 2, '.', ''); 
							   }
							   $productPrice = number_format($productPrice, 2, '.', '');
	}
							
	$productSku = $productObject->getSku();
	$split = explode('-', $productSku);
    $sellerCode = $last_word = array_pop($split);

		
	if(isset($sellerArray[$sellerId])){
		if(in_array($diame,  $daiameter)){
				$sellerArray[$sellerId]['diamter'] += 1;
			}
		$sellerArray[$sellerId]['sub_total'] += $pid[$productObject->getDiameter()][0] * $productPrice;
		$sellerArray[$sellerId]['total'] = $sellerArray[$sellerId]['sub_total'] + $sellerArray[$sellerId]['shipping'];
		
	}else{
		if(in_array($sellerCode,  $sellerData)){
				if(in_array($diame,  $daiameter)){
				$sellerArray[$sellerId]['diamter'] = 1;
			}
		$sellerArray[$sellerId]['sub_total'] = $pid[$productObject->getDiameter()][0] * $productPrice;
		$sellerArray[$sellerId]['shipping'] = $shippingcharge;
		$sellerArray[$sellerId]['total'] = $sellerArray[$sellerId]['sub_total'] + $sellerArray[$sellerId]['shipping'];
		$sellerArray[$sellerId]['name'] = $productObject->getAttributeText("vendor");
		$sellerArray[$sellerId]['id'] = $productObject->getVendor();
		$sellerArray[$sellerId]['price'] = $productPrice;
		}
	
	}
	 
 }
 
 
 ?>
  
                  
				  
				        <h3>Compare Brands</h3>
						
						<div class="clearfix"></div>
				        
						<!-- All Section start-->
						
						<div class="all_section" onchange="getBrand();" id="sellerSelect">
				      
					    </div> 
                        <!-- All Section end-->
						<!--<h3>Select Seller</h3>
                        <select type="text" onchange="getBrand();" id="sellerSelect">
						<?php foreach($sellerArray as $sellerInfo){	
						if($daicount == $sellerInfo["diamter"]){
						?>
						<option value="<?php echo $sellerInfo["id"];?>" <?php if($selectedSeller == $sellerInfo["id"]) echo ' selected ';?>><?php echo $sellerInfo["name"];?></option>
						<?php 
						}
						} ?>
						</select>-->
						<div class="clearfix"></div>
                 <input type="hidden" name="selected_brand" id="selected_brand" value="" />	
				<?php if($daiameter[0] != ''){ ?>
				<input type="button" value="Confirm" name="Confirm" class="add_cart confirmbtn" id="popup_confirm" />		 
				<?php }else{
					echo '<span style="color:red;">Please choose thickness and quantity<spa>';
				}	 
	?>
<script type="text/javascript">
function getBrand()
{
	  var sellerId = <?php echo $selectedSeller; ?>;
	  var brandId = <?php echo $brand; ?>;
	  var proId = "<?php echo $size; ?>";
	  var selectedQty = "<?php echo $qty; ?>";
	  jQuery.ajax({
	  url:'<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'brand_popup.php'?>',
	  type:'POST',
	  data:{'seller_id':sellerId, 'brand_id':brandId,'prod':proId, 'qty':selectedQty},
	  success:function(d){
		  jQuery('.all_section').html(d);
	  }
	 });
}
getBrand();



jQuery('#popup_confirm').click(function(){
	var selectedSellerId = <?php echo $selectedSeller; ?>;
	var selectedBrandId  = jQuery('#selected_brand').val();
	
	var proId = "<?php echo $size; ?>";
	var selectedQty = "<?php echo $qty; ?>";
	var fixedQty = "<?php echo $fixedQty; ?>"
	processConfirmData(selectedSellerId,selectedBrandId,proId,selectedQty,fixedQty);
	jQuery("#dialog").dialog('close');
});	
</script>