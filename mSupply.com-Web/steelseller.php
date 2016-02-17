<?php
ob_start();
include_once 'app/Mage.php';
Mage::app();
$brand = $_POST['brand'];
$zip = $_POST['zip'];
$size = $_POST['size'];
$qty = $_POST['qty'];
$totalqty = $_POST['totalqty'];
$qtyNew = $_POST['qtyNew'];
$prodids = $_POST['prodids'];
function get_web_page( $url )
{
	$user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
	$options = array(
		CURLOPT_CUSTOMREQUEST  =>"GET",        //set request type post or get
		CURLOPT_POST           =>false,        //set to GET
		CURLOPT_USERAGENT      => $user_agent, //set user agent
	//	CURLOPT_COOKIEFILE     =>"cookie.txt", //set cookie file
	//	CURLOPT_COOKIEJAR      =>"cookie.txt", //set cookie jar
		CURLOPT_RETURNTRANSFER => true,     // return web page
		CURLOPT_HEADER         => false,    // don't return headers
		CURLOPT_FOLLOWLOCATION => true,     // follow redirects
		CURLOPT_ENCODING       => "",       // handle all encodings
		CURLOPT_AUTOREFERER    => true,     // set referer on redirect
		CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
		CURLOPT_TIMEOUT        => 120,      // timeout on response
		CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
	);
	$ch      = curl_init( $url );
	curl_setopt_array( $ch, $options );
	$content = curl_exec( $ch );
	$err     = curl_errno( $ch );
	$errmsg  = curl_error( $ch );
	$header  = curl_getinfo( $ch );
	curl_close( $ch );
	$header['errno']   = $err;
	$header['errmsg']  = $errmsg;
	$header['content'] = $content;
	return $header;
}
$session = Mage::getSingleton("core/session",  array("name"=>"frontend"));
$session->setZip($zip);
if($totalqty >= 10)
{
	
	$shippingcharge = 0;
}else{
	$shippingcharge = 3000;
}
$tp = $_POST['tp'];
$array =  explode(',', $size);
//$array = json_decode($zip, true);
$daiameter = array();
foreach ($array as $data) {
	$daiameter[] = $data;
}
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
  $array_idsNew = explode(", ", $qtyNew);
 foreach($array_idsNew as $pro_idNew)
 {
	$wordsNew = explode('-', $pro_idNew);
	$qtyselectedNew = trim($wordsNew[0]);
	$pro_idNew = trim($wordsNew[1]);
	$pidNew[$qtyselectedNew] = $pro_idNew; 
 }
 $array_pidsNew = explode(", ", $prodids);
 foreach($array_pidsNew as $pro_pidNew)
 {
	$wordsNew = explode('-', $pro_pidNew);
	$pqtyselectedNew = trim($wordsNew[0]);
	$pro_pidNew = trim($wordsNew[1]);
	$prodidNew[$pqtyselectedNew] = $pro_pidNew; 
 }
   $diameter_list = $daiameter[0];
if($daiameter[0] == ''){
 $products1 = Mage::getModel('catalog/category')->load(282)
 ->getProductCollection()
 ->addAttributeToSelect('*')
 ->addAttributeToFilter('status', 1)
 ->addAttributeToFilter('visibility', 4)
 ->setOrder('price', 'ASC');
 $attributeCode = 'diameter';
 foreach($products1 as $product)
       {
		   $usedAttributeValues[] = $product->getData($attributeCode);
		 
       }  
	   $daiameter = array_unique($usedAttributeValues);
      }else{
	$daiameter = $daiameter; 
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
 ->setOrder('price', 'ASC');
$proddidkey = array_keys($prodidNew);
$uniquepid = $proddidkey[0];
$modelcollection = Mage::getModel('catalog/product');
$productObjectdata = $modelcollection->load($uniquepid);
$prod_selection = $productObjectdata->getSku();
$split = explode('-', $prod_selection);
$proddidkey1 = array_values($split);
$uniquepid1 = $proddidkey1[0];
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
	//$productPrice = $productObject->getPrice();
	$special = $productObject->getSpecialPrice();
	$diame = $productObject->getDiameter();
	$offset = number_format($product->getSteelOffset(),3);	
	$productPrice = number_format($productObject->getFinalPrice(),2,".","");
    $offset = number_format($productPrice,2);					
	$productSku = $productObject->getSku();
	$split = explode('-', $productSku);
	$proddidkey1 = array_values($split);
    $uniquepid1 = $proddidkey1[0];
    $sellerCode = $last_word = array_pop($split);	
	if(isset($sellerArray[$sellerId])){
			if(in_array($diame,  $daiameter)){
				$sellerArray[$sellerId]['diamter'] += 1;
			}
			if($diameter_list == ''){
				$sellerArray[$sellerId]['sub_total'] += $productPrice;
				$sellerArray[$sellerId]['total'] = 0;
				$sellerArray[$sellerId]['total_rest'] = $sellerArray[$sellerId]['sub_total'];
			}else{
				$sellerArray[$sellerId]['sub_total'] += number_format(($pid[$productObject->getDiameter()][0] * $productPrice),2,".","");
				$sellerArray[$sellerId]['total'] = $sellerArray[$sellerId]['sub_total'];
			}		
	    }else{
		if(in_array($sellerCode,  $sellerData)){
			if(in_array($diame,  $daiameter)){
				$sellerArray[$sellerId]['diamter'] = 1;
			}
			if($diameter_list == ''){
		$sellerArray[$sellerId]['sub_total'] = $productPrice;
		$sellerArray[$sellerId]['total'] = 0;
		$sellerArray[$sellerId]['total_rest'] = $sellerArray[$sellerId]['sub_total'];
		$sellerArray[$sellerId]['offers'] = '-';
			}else{
		$sellerArray[$sellerId]['sub_total'] = number_format(($pid[$productObject->getDiameter()][0] * $productPrice),2,".","");
		$sellerArray[$sellerId]['total'] = $sellerArray[$sellerId]['sub_total'];
		$domain = trim(Mage::getModel('core/variable')->loadByCode('java-api-url')->getValue('plain'));
		if(!isset($domain))
		$domain = 'http://52.30.181.28:9000/';
	    //echo  $sellerArray[$sellerId]['sub_total'].'dfgdfg<br>'.$totalqty;
	    $apiprice = $sellerArray[$sellerId]['total']/$totalqty;
	    $apicontent = number_format($apiprice,2);
	    $lastapiprice = str_replace( ',', '',$apicontent);
		$url = $domain.'SellerProject/api/v1.0/sellerMoq?sellerId='.$sellerCode.'&pincode='.$zip.'&productSku='.$uniquepid1.'&unitPrice='.$lastapiprice;	
		//echo '</br>';
		$result = get_web_page( $url );
		if ( $result['http_code'] != 200 ) 
			{
				$moq = $productObject->getData('minqtyforfreeshipping');
				if($moq == 0 || $moq == ''){
					$moq = 1;
				}else{
					$moq = $moq;
				}
				$sellerArray[$sellerId]['offers'] = ceil($moq);
			}
			else{
				$data = json_decode($result['content']);
				$moq = ceil($data->message->sellerMOQEntity->MOQInfo->moq);
				if(is_numeric($moq) && trim($moq) != '' && trim($moq) != 0)
				{
					$sellerArray[$sellerId]['offers'] = $moq;
				}
				else{
					$sellerArray[$sellerId]['offers'] = $moq;					
				}
				//echo $sellerArray[$sellerId]['offers'];
				//echo '</br>';
			}
			 
			}
		$sellerArray[$sellerId]['name'] = $productObject->getAttributeText("vendor");
		$sellerArray[$sellerId]['estimate'] = $productObject->getEstimateddelivery();
		$sellerArray[$sellerId]['rating'] = $productObject->getRating();
		$sellerArray[$sellerId]['id'] = $productObject->getVendor();
		
		
		}
	
	}
 }
$attributeId = Mage::getResourceModel('eav/entity_attribute')->getIdByCode('catalog_product', 'vendor');
$attribute = Mage::getModel('eav/config')->getAttribute('catalog_product', $attributeId); // get the cities attribute id 548
$value = array();
foreach ($attribute->getSource()->getAllOptions(true, true) as $option) {
    $value[] = $option['value'];
}
 ?>


	<div class="table-responsive wid100">				
<table class="table table-condensed steeltable">

<?php if(count($sellerArray) != '0'){?>
					
                    <thead>
                        <tr class="zipsearchHeading">
                            <th>Seller</th>
							<th>Rating</th>
                            <th>Dispatch in</th>
                            <th>Min. Order Qty (in MT)</th>
                            <th>Total Price</th>
                            <th></th>

                        </tr>
                    </thead>
					<?php } else { ?>
					<p style="margin-bottom:30px;">Sorry there are no sellers serving this locality right now - please try different zip code in "Check Availability".</p>
					<?php } ?>
                    <tbody class="zipsearchHeadingResult bdseller" id="zipsearchHeadingResult">
					<?php
					if($diameter_list == ''){
					    
						asort($sellerArray,'total_rest');
					}else{
						asort($sellerArray,'total');
					}
						foreach($sellerArray as $sellerInfo){
					$a = explode(' (',$sellerInfo["name"]);
					?>
                    
                    <tr class="clickmetoselect cust-trb">
	                    	<td><?php echo $sellerInfo["name"];?></td>
	                    	<td><div class="rating"><span style="width:100%" class="ratingwidth"><?php echo $sellerInfo["rating"];?></span><span class="ratingblank"></span></div></td>
	                    	<td><?php echo $sellerInfo["estimate"];?></td>
	                    	<td><?php echo $sellerInfo["offers"];?></td>
	                    	<td class="seller_total<?php echo $sellerInfo["id"];?>">₹ <?php echo number_format($sellerInfo["total"], 2, '.', '');?></td>
	                    	<td><input id="button-<?php echo $sellerInfo['id'];?>" type="button" value="select" class="selectvendor" sellerid="<?php echo $sellerInfo["id"];?>" for="radio-1"/><input class="clickmetoselect1" style="display:none;margin:4px 7px 0 0" type="radio" moq="<?php echo $sellerInfo["offers"];?>" seller-name="<?php echo $a[0]; ?>" name="vendor" value="<?php echo $sellerInfo["id"];?>" id="radio-<?php echo $sellerInfo["id"];?>"></td>
							
                    	</tr>
						
                    </tbody>
					 
					<?php
						}
					 ?>



</table>

</div>

 <script type="text/javascript">
jQuery(document).ready( function() {
	jQuery('.listseller-count').show();
	var sellercount = jQuery('.clickmetoselect').length;
	jQuery('.sellercount').text(sellercount);
	jQuery('.ziplist').text('<?php echo $zip; ?>');
	jQuery('#current_pincode').text('<?php echo $zip; ?>');
	//jQuery('.spin-wrapper').css("display", "none"); 
 });
 
jQuery('.pin_input').keypress(function () {
	//alert(jQuery(this).val().length);
if(jQuery(this).val().length < 6){
    jQuery('.compare_brand').css("display", "none");
    jQuery('.select_seller').hide();
    jQuery('.errmsg').hide();
    jQuery('.slrmsg').hide();
    jQuery('#zip_input').css('border','1px solid #ccc');
	}
});
jQuery('.pin_input').keyup(function () {
	//alert(jQuery(this).val().length);
	if(jQuery(this).val().length < 6){
		
    jQuery('.compare_brand').css("display", "none");
jQuery('.select_seller').hide();
jQuery('.errmsg').hide();
jQuery('#zip_input').css('border','1px solid #ccc');
	}
});
 jQuery('.clickmetoselect1').click(function (e, data){
	
	
		  var brand = "<?php echo $brand; ?>";	  
		  //var diameter = "<?php echo $size; ?>";
		  var tp = "<?php echo $tp; ?>";
	      if (typeof data == 'undefined') {
			  var vendor = jQuery('input:radio[name=vendor]:checked').val();
			}else{
			  var vendor = data.vendor;
			}
	        
	        var favorite = [];
            jQuery.each(jQuery("input[name='pid[]']:checked"), function(){            
                favorite.push(jQuery(this).attr('data'));
            });
			var favorite1 = [];
            jQuery.each(jQuery("input[name='pid[]']:checked"), function(){            
                favorite1.push(jQuery(this).attr('data-val'));
            });
			
			var favorite2 = [];
            jQuery.each(jQuery("input[name='pid[]']:checked"), function(){            
                favorite2.push(jQuery(this).val());
            });
			var favorite3 = [];
            jQuery.each(jQuery("input[name='pid[]']:checked"), function(){            
                favorite3.push(jQuery(this).attr('control'));
            });
	  	    var diameter = favorite.join(", ");
		    var fixedqty = favorite3.join(", ");
			var qty = favorite1.join(", ");
			var qtyNew = favorite2.join(", ");
			jQuery('.spin-wrapper').css("display", "block");
	        jQuery.ajax({
							url:'<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'selectseller.php'?>',
							type:'POST',
							data:{'brand':brand,'dia':diameter,'vendor':vendor,'selqty':qty,'tp':tp, 'qtyNew':qtyNew, 'fixed':fixedqty},
							success:function(d){
								//var p =jQuery('#addalltocart').position();
								//jQuery(bod).animate({scrollTop:(p.top-100)},400);
								//jQuery("html, body").animate({scrollTop: jQuery('.select_seller').offset().top }, 2000);
								//jQuery('.spin-wrapper').css("display", "none");
								jQuery('.compare_brand').css("display", "block");	
								jQuery('.list').html(d);
								//alert(d);
								var sellername = jQuery('input[name=vendor]:checked').attr('seller-name');
								jQuery('.top-selname h4').text(sellername);
								jQuery('#current_pincode').text(<?php echo $zip; ?>);
								var sellercount = jQuery('.clickmetoselect').length;
		                        totalseller = parseInt(sellercount -1);
								if(totalseller > 0)
								{
									
									if(totalseller == 1)
									{
										jQuery('#totalseller').html(totalseller + ' More Seller');
									}else{
										jQuery('#totalseller').html(totalseller + ' More Sellers');
									}
									
								   
								}else{
									if(sellercount == 1)
									{
										jQuery('.top-selname h4').text(sellername);
										jQuery('#totalseller').html('');
									}else{
										jQuery('#totalseller').html('');
										jQuery('.top-selname h4').text('-');
									}
								}
							jQuery('.spin-wrapper').css("display", "none");	
							/* if (typeof data == 'undefined') {
							return;
							}else{
								jQuery('html, body').animate({
								   scrollTop: jQuery("#cbheading").offset().top
								}, 800);
							}*/
							
							}
						});
	});
	/*********************/
	jQuery(document).on('click','.selectvendor',function(){
		           var popupSellerId= jQuery(this).attr('sellerid');
					jQuery('.selectvendor').removeClass('tick');
					jQuery('#button-'+popupSellerId).addClass('tick');
					jQuery('#button-'+popupSellerId).attr('disable','disable');
					jQuery('#radio-'+popupSellerId).attr('checked','checked');
					jQuery('#radio-'+popupSellerId).trigger( "click" ,{vendor:popupSellerId});
					jQuery('.moq-qty-msg').hide();
					
				});
  </script>
  <style type="text/css">
			table { 
  width: 100%; 
  border-collapse: collapse; 
}
@media 
only screen and (max-width: 480px)
 {
  /* Force table to not be like tables anymore */
  table, thead, tbody, th, td, tr { 
    display: block; 
  }
  /* Hide table headers (but not display: none;, for accessibility) */
 .steeltable thead tr { 
    position: absolute;
    top: -9999px;
    left: -9999px;
  }
 .steeltable tr { border: 1px solid #ccc; margin-bottom: 10px; }
 .steeltable tr { border: 1px solid #ccc; margin-bottom: 10px; }
  
 .steeltable td { 
    /* Behave  like a "row" */
    border: none;
    border-bottom: 1px solid #eee; 
    position: relative;
    padding-left: 50%; 
	text-align:right;
  }
  .steeltable .table > tbody > tr > td{
  	text-align: right !important;
}
 .steeltable td:before { 
    /* Now like a table header */
    position: absolute;
    /* Top/left values mimic padding */
    top: 16px;
    left: 6px;
    width: 45%; 
    padding-right: 10px; 
    text-align: right !important;
    white-space: nowrap;
    float: left;
  }
  .table-responsive{ border:none !important;}
 /*
	Label the data
	*/
.steeltable td:nth-of-type(1):before { content: " "; }
.steeltable td:nth-of-type(2):before { content: "Rating"; }
.steeltable td:nth-of-type(3):before { content: "Dispatch"; }
.steeltable td:nth-of-type(4):before { content: "Free Shipping"; }
.steeltable td:nth-of-type(5):before { content: "Extra Shipping"; }
.steeltable td:nth-of-type(6):before { content: "Offers"; }
.steeltable td:nth-of-type(7):before { content: "Total Price"; }
.steeltable td:nth-of-type(8):before { content: "Select Seller"; }
}
</style>
