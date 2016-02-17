<?php
ob_start();
include_once 'app/Mage.php';
Mage::app();
$brand = $_POST['brand'];
$zip = $_POST['zip'];
$size = $_POST['dia'];
$qtyNew = $_POST['qtyNew'];
$fixedqty = $_POST['fixed'];
$qty = $_POST['selqty'];
$vendor = $_POST['vendor'];
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
	//$pqty[]= $pqty; 
 }
 $array_idsfixed = explode(", ", $fixedqty);
$pidfixed = array();
 foreach($array_idsfixed as $pro_id)
 {
	
	$words = explode('-', $pro_id);
	$qtyselected = $last_word = array_pop($words);
	$pro_id = $first_chunk = implode('-', $words);
	 
	$pidfixed[$pro_id][] = $qtyselected; 
	//$pqty[]= $pqty; 
 }
 
 $array_idsNew = explode(", ", $qtyNew);
 foreach($array_idsNew as $pro_idNew)
 {
	$wordsNew = explode('-', $pro_idNew);
	$qtyselectedNew = trim($wordsNew[0]);
	$pro_idNew = trim($wordsNew[1]);
	 
	$pidNew[$qtyselectedNew] = $pro_idNew; 
 }
 

 

 $productsdaimeter = Mage::getModel('catalog/category')->load(282)
 ->getProductCollection()
 ->addAttributeToSelect('*')
 ->addAttributeToFilter('status', 1)
 ->addAttributeToFilter('visibility', 4)
 // ->addAttributeToFilter('diameter', array('in' =>$dealVisibility))
 //->addAttributeToFilter('special_price', array('neq' => ""))
 ->setOrder('price', 'ASC')
 //->setPageSize(6)
 ;
 $attributeCode1 = 'diameter';
$daimeterdata = array();


 foreach($productsdaimeter as $product)
       {
		    
			//echo  $product->getManufacturer().'dd</br>';
    	   $daimeterdata[$product->getData($attributeCode1)] = $product->getAttributeText($attributeCode1);
		  
     
       }
	    $daimeterdata = array_unique($daimeterdata);
		$daimeterdata = json_encode($daimeterdata);
$todayDate = date('m/d/y');
$tomorrow = mktime(0, 0, 0, date('m'), date('d'), date('y'));
$tomorrowDate = date('m/d/y', $tomorrow);
$products = Mage::getModel('catalog/category')->load(282)
 ->getProductCollection()
 ->addAttributeToSelect('*')
 ->addAttributeToFilter('status', 1)
 ->addAttributeToFilter('visibility', 1)
 //->addAttributeToFilter('diameter', array('in' =>$daiameter))
 ->addAttributeToFilter('manufacturer', array('eq' =>$brand))
 ->addAttributeToFilter('vendor', array('eq' =>$vendor))
 //->addAttributeToFilter('special_price', array('neq' => ""))
 ->setOrder('price', 'ASC')
 //->setPageSize(6)
 ;
 $attributeId = Mage::getResourceModel('eav/entity_attribute')->getIdByCode('catalog_product', 'vendor');
$attribute = Mage::getModel('eav/config')->getAttribute('catalog_product', $attributeId); // get the cities attribute id 548
//print_r($attribute);
// to get the multiple cities in pages(drop down)
$value = array();
foreach ($attribute->getSource()->getAllOptions(true, true) as $option) {
    $value[] = $option['value'];
}
$currentTime = Mage::getModel('core/date')->date('Y-m-d H:i:s');
$arraydatadai = json_decode($daimeterdata, true);
$daiameterlist = array();
foreach ($arraydatadai as $key => $value) {
	$daiameterlist[] = $key;
}
$diameterdata = $daiameterlist;
// The values that will be copied
$daimeterarray = array();
$fulldiameter =array();
foreach($products as $product)
						{
							$diameter1 = $product->getDiameter();
							$prodid = $product->getId();
							$daimeterarray[$diameter1] =$prodid;
							//$fulldiameter[]=$daimeterarray;
						}
						//print_r($daimeterarray);
// The filtered array (based on ArrayA and ArrayB)
$prod_coll = array();

// For each ArrayA values (3, 7 and 8), trigger this routine
// setting ArrayKey as each value of ArrayA, one for time
foreach($diameterdata as $DATA) {
    // Basically: $ArrayC [3] = $ArrayB [3]; (...)
    $prod_coll[$DATA] = $daimeterarray [$DATA];
} 
if($tp == 'MT')
{
 ?>
 <div class="col-lg-12 col-xs-12 mb1em resp-drop">
<span class="dropdown  pull-right">
								    <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">MT<span class="caret"></span></button>
								    <ul class="dropdown-menu cstldd" role="menu" aria-labelledby="menu1">
								      <li role="presentation" id="MT" class="active">MT</li>
									  <li role="presentation" id="bundle">Bundle</li>
									  <li role="presentation" id="Kg">Kg</li>
								    </ul>
</span>
</div>
 				<div class="table-responsive clear"><!--select product start-->

<table class="table table-condensed steelmttable clear">
  	<thead>
	
						<tr class="p_table_header cust-trh">
						
							<th>Thickness</th>
							<th>Price per
								<span class="dropdown resp-drop">
								    <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">MT<span class="caret"></span></button>
								    <ul class="dropdown-menu cstldd" role="menu" aria-labelledby="menu1">
								      <li role="presentation" id="MT" class="active">MT</li>
									  <li role="presentation" id="Bundle">Bundle</li>
									  <li role="presentation" id="Kg">Kg</li>
								    </ul>
								</span>
							</th>
							<th>Quantity</th>
							<th>Item Total</th>
						</tr>
						</thead>
						<tbody class="list1">
							<?php 
							
						foreach($prod_coll as $key=>$value)
						{
							if($value != ''){
							$product = Mage::getModel('catalog/product')->load($value);
							$ProductToDate = $product->getResource()->formatDate($product->getspecial_to_date(), false);
							$price = number_format($product->getFinalPrice(), 2, '.', ''); 
							$id = $product->getId();
							$diameter1 = $product->getDiameter();
							$dia = $product->getAttributeText('diameter');
							?>
						<tr id="listdata" class="cust-trb">
						    <td>
						    	<input type="checkbox"  <?php if($price == '0.00' || $price == ' '){ echo 'disabled'; } ?> class="box" name="pid[]" maxlength="12" data-val= "<?php echo $product->getDiameter();?>-<?php if($pid[$product->getDiameter()][0]){ ?> <?php echo $pid[$product->getDiameter()][0]; ?> <?php }else{ ?>0.00 <?php } ?>" control="<?php echo $product->getDiameter();?>-<?php if($pid[$product->getDiameter()][0]){ ?> <?php echo $pid[$product->getDiameter()][0]; ?> <?php }else{ ?>0 <?php } ?>" data="<?php echo $product->getDiameter();?>" id="pid<?php echo $product->getDiameter();?>" <?php if(in_array($diameter1,$daiameter ) ){ ?> checked="checked" <?php } ?> maxlength="12" value="<?php echo $product->getId();?>-<?php if($pid[$product->getDiameter()][0]){ ?> <?php echo $pid[$product->getDiameter()][0]; ?> <?php }else{ ?>0 <?php } ?>"/>
						    	<span class="mbrandname"><?php echo $dia; ?></span>
						    </td>
							
							<td id="price">₹<?php echo $price; ?></td>
							<td>
							<div class="wrap-qty">				
				
				<div class="qty-set">
					<span class="quantity-box">
						<input type="text" name="qty" data-v-max="9999" data-m-dec="2" id="qty<?php echo $product->getDiameter();?>" change-type="<?php echo $product->getDiameter();?>-0"  ppdid="<?php echo $product->getId();?>" diameter ="<?php echo $product->getDiameter();?>" price = "<?php echo $price;?>" <?php if(!in_array($diameter1,$daiameter ) ){ ?> disabled <?php } ?> value="<?php if($pid[$product->getDiameter()][0]){ ?><?php echo trim($pid[$product->getDiameter()][0]); ?><?php }else{ ?>0.00<?php } ?>"  class="quantity-input qty" />
						<input type="button" class="quantity-controls quantity-plus" <?php if(!in_array($diameter1,$daiameter ) ){ ?> style="display:none" <?php } ?> onclick="plus(<?php echo $product->getDiameter();?>,<?php echo $price;?>,<?php echo $product->getId();?>)" value="">	
						<input type="button" class="quantity-controls quantity-minus" <?php if(!in_array($diameter1,$daiameter ) ){ ?> style="display:none" <?php } ?> onclick="minus(<?php echo $product->getDiameter();?>,<?php echo $price;?>,<?php echo $product->getId();?>)" value="">
</span>					
</span>					
				</div>
			</div>								
							</td>
							<td class="total"><span id="total<?php echo $product->getDiameter();?>">
							<?php if($pid[$product->getDiameter()][0]){
								$totalqty += $pid[$product->getDiameter()][0];
								$totalpice += $price * $pid[$product->getDiameter()][0];
								?>
							<?php echo '₹'.number_format($price * $pid[$product->getDiameter()][0], 2, '.', ''); ?> 
							<?php
							}else{
								echo '₹0';
							}
							?>
								
							</td>
						</tr>
						
						 <?php 
							}
                          }
	                     ?>
	                     <tr class="cust-trh respqty">
	                     	<th></th>
       						<th></th>
       						<th>Total Quantity<div class="quantity" id="tquantity"><?php echo number_format($totalqty, 2); ?></div></th>
        					<th>Sub Total<div class="amount"><?php echo '₹'.number_format($totalpice, 2, '.', ''); ?></div></th>
	                     </tr>
						  
						 </tbody>
			
			</table>
			
			
		<div class="total-box-resp">
			<div class="tot-repbox">
				<div class="col-xs-6 qtytotal">Total Quantity</div>
				<div class="col-xs-6 qtytotal">
				<div class="quantity" id="tquantity"><?php
                           if($totalqty == ''){
								echo '0.00'; 
							}else{
								echo $totalqty; 
							}							
							
							?>
					</div>
				</div>
			</div>
			
		<div class="tot-repbox">
				<div class="col-xs-6 qtytotal">Sub Total</div>
				<div class="col-xs-6 qtytotal">
					<div class="amount"><?php echo '₹'.number_format($totalpice, 2, '.', ''); ?></div>
				</div>
			</div>
		</div>
		
		
			</div>



			<?php }else if($tp == 'Bundle'){ ?>
<div class="col-lg-12 col-xs-12 mb1em resp-drop">
<span class="dropdown pull-right">							
<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Bundle<span class="caret"></span></button>
<ul class="dropdown-menu cstldd" role="menu" aria-labelledby="menu1">
<li role="presentation" id="MT">MT</li>
<li role="presentation" id="Bundle" class="active">Bundle</li>
<li role="presentation" id="Kg">Kg</li>
</ul>
</span>
</div>
<div class="table-responsive clear">
							<table class="table table-condensed steelbntable">
				<thead>
						<tr class="cust-trh">
						
							<th><span>Thickness</span></th>
							<th>Price per <span class="dropdown resp-drop">							
								    <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Bundle<span class="caret"></span></button>
								    <ul class="dropdown-menu cstldd" role="menu" aria-labelledby="menu1">
								      <li role="presentation" id="MT">MT</li>
									  <li role="presentation" id="Bundle" class="active">Bundle</li>
									  <li role="presentation" id="Kg">Kg</li>
								    </ul>
								</span></th>
							</th>
							<th>Quantity</th>
							<th>Est. Weight in MT</th>
							<th>Item Total</th>
						</tr>
						</thead>
						<tbody class="list1">
 <?php 
 
							
							foreach($prod_coll as $key=>$value)
						{
							if($value != ''){
							$product = Mage::getModel('catalog/product')->load($value);
							 $offset = number_format($product->getSteelOffset(),3);
							$special = $product->getSpecialPrice();
							  $ProductToDate = $product->getResource()->formatDate($product->getspecial_to_date(), false);
							  
							  $sku = $product->getSku();
							  $productSKU = explode("-",$sku);
							  // $tproduct = Mage::getModel("catalog/product")->loadBySku(trim($productSKU[0]));
							  $tproductId = $product->getIdBySku(trim($productSKU[0]));
							$price = $product->getFinalPrice() * $offset ; 
							$price = number_format($price, 2, '.', '');
		                    $id = $product->getId();
							//$name = $product->getName();
							$diameter1 = $product->getDiameter();
							//$a = explode('-',$name);
							$dia = $product->getAttributeText('diameter');
							$estimatedel = number_format($product->getSteelOffset(),3);
		                ?>
						
						<tr id="listdata" class="cust-trb">
						   	   <td>

							   <input type="checkbox" <?php if($price == '0.00' || $price == ' '){ echo 'disabled'; } ?> class="box" name="pid[]" change-type="<?php echo $product->getDiameter();?>-0" id="pid<?php echo $product->getDiameter();?>" <?php if(in_array($diameter1,$daiameter ) ){ ?> checked="checked" <?php } ?> data-val= "<?php echo $product->getDiameter();?>-<?php if($pid[$product->getDiameter()][0]){ ?> <?php echo number_format($estimatedel * $pidfixed[$product->getDiameter()][0],3); ?> <?php }else{ ?>0 <?php } ?>" control="<?php echo $product->getDiameter();?>-<?php if($pidfixed[$product->getDiameter()][0]){ ?> <?php echo $pidfixed[$product->getDiameter()][0]; ?> <?php }else{ ?>0 <?php } ?>" maxlength="12" data="<?php echo $product->getDiameter();?>" value="<?php echo $product->getId();?>-<?php if($pid[$product->getDiameter()][0]){ ?> <?php echo number_format($estimatedel * $pidfixed[$product->getDiameter()][0],3); ?> <?php }else{ ?>0 <?php } ?>"/>
								<span class="mbrandname"><?php echo $dia; ?></span>
							   </td>

							
							<td id="price">₹<?php echo $price; ?></td>
							<td>
							<div class="wrap-qty">				
				
							<div class="qty-set">
								<span class="quantity-box">
											<input type="text" name="qty" data-v-max="9999" data-m-dec="0" id="qty<?php echo $product->getDiameter();?>" offst="<?php echo number_format($product->getSteelOffset(),3);?>"  ppdid="<?php echo $product->getId();?>" diameter ="<?php echo $product->getDiameter();?>" price = "<?php echo $price;?>" <?php if(!in_array($diameter1,$daiameter ) ){ ?> disabled <?php } ?> value="<?php if($pidfixed[$product->getDiameter()][0]){ ?><?php echo trim($pidfixed[$product->getDiameter()][0]); ?><?php }else{ ?>0<?php } ?>"  class="quantity-input qty" />
									<input type="button" class="quantity-controls quantity-plus" <?php if(!in_array($diameter1,$daiameter ) ){ ?> style="display:none" <?php } ?> onclick="plus(<?php echo $product->getDiameter();?>,<?php echo $price;?>,<?php echo $product->getId();?>,<?php echo number_format($product->getSteelOffset(),3);?>)" value="">	
									<input type="button" class="quantity-controls quantity-minus" <?php if(!in_array($diameter1,$daiameter ) ){ ?> style="display:none" <?php } ?> onclick="minus(<?php echo $product->getDiameter();?>,<?php echo $price;?>,<?php echo $product->getId();?>,<?php echo number_format($product->getSteelOffset(),3);?>)" value="">
								</span>					
							</div>
			                </div>								
							</td>
							<td class="esti" id="mt<?php echo $product->getDiameter();?>"><?php if($pid[$product->getDiameter()][0]){
																?>
							<?php echo number_format($estimatedel * $pidfixed[$product->getDiameter()][0], 3, '.', '').'MT'; ?> 
							<?php
							}else{
								echo '0';
							}
							?></td>
							<td class="total"><span id="total<?php echo $product->getDiameter();?>">
							<?php if($pidfixed[$product->getDiameter()][0]){
								$totalqty += $pidfixed[$product->getDiameter()][0];
								$totalpice += $price * $pidfixed[$product->getDiameter()][0];
								$estimateton += number_format($product->getSteelOffset(),3) * $pidfixed[$product->getDiameter()][0];
								?>
							<?php echo '₹'.number_format($price * $pidfixed[$product->getDiameter()][0], 2, '.', ''); ?> 
							<?php
							}else{
								echo '₹0';
							}
							?>
							
							</td>
						</tr>
						
						 <?php 
							}
                          }
	                     ?>
						  <tr class="cust-trh respqty">
        <th></th>
        <th></th>
		
        <th>Total Quantity<div class="quantity"><?php
                            if($totalqty == ''){
								echo '0'; 
							}else{
								echo $totalqty; 
							}							
							
							?></div></th>
        <th>Est. Total Weight<div class="estimate" id="testimate"><?php echo number_format($estimateton, 3, '.', ''); ?></div></th>
        <th>Sub Total<div class="amount"><?php echo '₹'.number_format($totalpice, 2, '.', ''); ?></div></th>
      </tr>
			</tbody>
		
			</table>
			<div class="total-box-resp">
			<div class="tot-repbox">
				<div class="col-xs-6 qtytotal">Total Quantity</div>
				<div class="col-xs-6 qtytotal">
					<div class="quantity"><?php
								if($totalqty == ''){
									echo '0'; 
								}else{
									echo $totalqty; 
								}							
								
								?>
					</div>
				</div>
			</div>
			
			<div class="tot-repbox">
				<div class="col-xs-6 qtytotal">Est. Total Weight</div>
				<div class="col-xs-6 qtytotal">
					<div class="estimate" id="testimate"><?php echo number_format($estimateton, 3, '.', ''); ?></div>
				</div>
			</div>
			
			<div class="tot-repbox">
				<div class="col-xs-6 qtytotal">Sub Total</div>
				<div class="col-xs-6 qtytotal">
					<div class="amount"><?php echo '₹'.number_format($totalpice, 2, '.', ''); ?></div>
				</div>
			</div>
		</div>
			<?php
			}else{
			?>
			<div class="col-lg-12 col-xs-12 mb1em resp-drop">
<span class="dropdown pull-right">							
<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Kg<span class="caret"></span></button>
<ul class="dropdown-menu cstldd" role="menu" aria-labelledby="menu1">
<li role="presentation" id="MT">MT</li>
<li role="presentation" id="Bundle" >Bundle</li>
<li role="presentation" id="Kg" class="active">Kg</li>
</ul>
</span>
</div>
<div class="table-responsive clear">
							<table class="table table-condensed steelbntable">
				<thead>
						<tr class="cust-trh">
						
							<th><span>Thickness</span></th>
							<th>Price per <span class="dropdown resp-drop">							
								    <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Kg<span class="caret"></span></button>
								    <ul class="dropdown-menu cstldd" role="menu" aria-labelledby="menu1">
								      <li role="presentation" id="MT">MT</li>
									  <li role="presentation" id="Bundle" >Bundle</li>
									  <li role="presentation" id="Kg" class="active">Kg</li>
								    </ul>
								</span></th>
							</th>
							<th>Quantity</th>
							<th>Est. Weight in MT</th>
							<th>Item Total</th>
						</tr>
						</thead>
						<tbody class="list1">
 <?php 
 
							
							foreach($prod_coll as $key=>$value)
						{
							if($value != ''){
							$product = Mage::getModel('catalog/product')->load($value);
							 $offset = number_format($product->getSteelOffset(),3);
							$special = $product->getSpecialPrice();
							  $ProductToDate = $product->getResource()->formatDate($product->getspecial_to_date(), false);
							  
							  $sku = $product->getSku();
							  $productSKU = explode("-",$sku);
							  // $tproduct = Mage::getModel("catalog/product")->loadBySku(trim($productSKU[0]));
							  $tproductId = $product->getIdBySku(trim($productSKU[0]));
							  
							 // $tproduct = Mage::getModel('catalog/product')->loadByAttribute('sku', $productSKU[0]);
                              $price = $product->getFinalPrice() /1000 ; 
							$price = number_format($price, 2, '.', '');
		                    $id = $product->getId();
							//$name = $product->getName();
							$diameter1 = $product->getDiameter();
							//$a = explode('-',$name);
							$dia = $product->getAttributeText('diameter');
							$estimatedel = number_format($product->getSteelOffset(),3);
		                ?>
						
						<tr id="listdata" class="cust-trb">
						   	   <td>

							   <input type="checkbox" <?php if($price == '0.00' || $price == ' '){ echo 'disabled'; } ?> class="box" name="pid[]" change-type="<?php echo $product->getDiameter();?>-0" id="pid<?php echo $product->getDiameter();?>" <?php if(in_array($diameter1,$daiameter ) ){ ?> checked="checked" <?php } ?> data-val= "<?php echo $product->getDiameter();?>-<?php if($pid[$product->getDiameter()][0]){ ?> <?php echo  $pidfixed[$product->getDiameter()][0]/1000; ?> <?php }else{ ?>0 <?php } ?>" control="<?php echo $product->getDiameter();?>-<?php if($pidfixed[$product->getDiameter()][0]){ ?> <?php echo $pidfixed[$product->getDiameter()][0]; ?> <?php }else{ ?>0 <?php } ?>" maxlength="12" data="<?php echo $product->getDiameter();?>" value="<?php echo $product->getId();?>-<?php if($pid[$product->getDiameter()][0]){ ?> <?php echo $pidfixed[$product->getDiameter()][0]/1000; ?> <?php }else{ ?>0 <?php } ?>"/>
								<span class="mbrandname"><?php echo $dia; ?></span>
							   </td>

							
							<td id="price">₹<?php echo $price; ?></td>
							<td>
							<div class="wrap-qty">				
				
							<div class="qty-set">
								<span class="quantity-box">
											<input type="text" name="qty" data-v-max="9999" data-m-dec="0" id="qty<?php echo $product->getDiameter();?>" offst="<?php echo number_format($product->getSteelOffset(),3);?>"  ppdid="<?php echo $product->getId();?>" diameter ="<?php echo $product->getDiameter();?>" price = "<?php echo $price;?>" <?php if(!in_array($diameter1,$daiameter ) ){ ?> disabled <?php } ?> value="<?php if($pidfixed[$product->getDiameter()][0]){ ?><?php echo trim($pidfixed[$product->getDiameter()][0]); ?><?php }else{ ?>0<?php } ?>"  class="quantity-input qty" />
									<input type="button" class="quantity-controls quantity-plus" <?php if(!in_array($diameter1,$daiameter ) ){ ?> style="display:none" <?php } ?> onclick="plus(<?php echo $product->getDiameter();?>,<?php echo $price;?>,<?php echo $product->getId();?>,<?php echo number_format($product->getSteelOffset(),3);?>)" value="">	
									<input type="button" class="quantity-controls quantity-minus" <?php if(!in_array($diameter1,$daiameter ) ){ ?> style="display:none" <?php } ?> onclick="minus(<?php echo $product->getDiameter();?>,<?php echo $price;?>,<?php echo $product->getId();?>,<?php echo number_format($product->getSteelOffset(),3);?>)" value="">
								</span>					
							</div>
			                </div>								
							</td>
							<td class="esti" id="mt<?php echo $product->getDiameter();?>"><?php if($pid[$product->getDiameter()][0]){
																?>
							<?php echo $pidfixed[$product->getDiameter()][0]/1000 .'MT'; ?> 
							<?php
							}else{
								echo '0';
							}
							?></td>
							<td class="total"><span id="total<?php echo $product->getDiameter();?>">
							<?php if($pidfixed[$product->getDiameter()][0]){
								$totalqty += $pidfixed[$product->getDiameter()][0];
								$totalpice += $price * $pidfixed[$product->getDiameter()][0];
								$estimateton += $pidfixed[$product->getDiameter()][0]/1000;
								?>
							<?php echo '₹'.number_format($price * $pidfixed[$product->getDiameter()][0], 2, '.', ''); ?> 
							<?php
							}else{
								echo '₹0';
							}
							?>
							
							</td>
						</tr>
						
						 <?php 
							}
                          }
	                     ?>
						  <tr class="cust-trh respqty">
        <th></th>
        <th></th>
		
        <th>Total Quantity<div class="quantity"><?php
                            if($totalqty == ''){
								echo '0'; 
							}else{
								echo $totalqty; 
							}							
							
							?></div></th>
        <th>Est. Total Weight<div class="estimate" id="testimate"><?php echo number_format($estimateton, 3, '.', ''); ?></div></th>
        <th>Sub Total<div class="amount"><?php echo '₹'.number_format($totalpice, 2, '.', ''); ?></div></th>
      </tr>
			</tbody>
		
			</table>
			<div class="total-box-resp">
			<div class="tot-repbox">
				<div class="col-xs-6 qtytotal">Total Quantity</div>
				<div class="col-xs-6 qtytotal">
					<div class="quantity"><?php
								if($totalqty == ''){
									echo '0'; 
								}else{
									echo $totalqty; 
								}							
								
								?>
					</div>
				</div>
			</div>
			
			<div class="tot-repbox">
				<div class="col-xs-6 qtytotal">Est. Total Weight</div>
				<div class="col-xs-6 qtytotal">
					<div class="estimate" id="testimate"><?php echo number_format($estimateton, 3, '.', ''); ?></div>
				</div>
			</div>
			
			<div class="tot-repbox">
				<div class="col-xs-6 qtytotal">Sub Total</div>
				<div class="col-xs-6 qtytotal">
					<div class="amount"><?php echo '₹'.number_format($totalpice, 2, '.', ''); ?></div>
				</div>
			</div>
		</div>
			<?php } ?>
			</div>
			
			</div>
<script>
jQuery(document).ready(function() {
jQuery( ".qty" ).focus(function() {
	var focusval = jQuery.trim(jQuery(this).val());
	if(focusval == '0' || focusval == '0.00')
	{
	 jQuery(this).val('');
	}
});
jQuery('.qty').bind('paste',function(e) { 
    e.preventDefault(); //disable cut,copy,paste
 });
var getSelected = function()
{
    var t = '';
    if(window.getSelection) {
        t = window.getSelection();
    } else if(document.getSelection) {
        t = document.getSelection();
    } else if(document.selection) {
        t = document.selection.createRange().text;
    }
    return t;
}
jQuery('.qty').keypress(function (event) 
{
	var Of11 = "<?php echo $tp; ?>";
	var selected = getSelected().toString();
	var valuinput =  this.value;
	
	var c = String.fromCharCode(event.which);
	if(selected != ''){
	 return true;  
    }
    if(Of11 != 'MT')
	{
     if(c !='.'  && valuinput.length >=4)
	 { 
		if(valuinput.length == 4)
		{
		// alert('Maximum Quantity should be 9999');	
		 event.preventDefault(); //disable cut,copy,paste
		}
					 
	 }
	}
	var keynum
    var keychar
    var numcheck
    // For Internet Explorer
    if (window.event) {
        keynum = event.keyCode;
    }
    // For Netscape/Firefox/Opera
    else if (event.which) {
        keynum = event.which;
    }
    keychar = String.fromCharCode(keynum);
   
    //List of special characters you want to restrict
    if (keychar == "'" || keychar == "`" || keychar =="!" || keychar =="@" || keychar =="#" || keychar =="$" || keychar =="%" || keychar =="^" || keychar =="&" || keychar =="*" || keychar =="(" || keychar ==")" || keychar =="-" || keychar =="_" || keychar =="+" || keychar =="=" || keychar =="/" || keychar =="~" || keychar =="<" || keychar ==">" || keychar =="," || keychar ==";" || keychar ==":" || keychar =="|" || keychar =="?" || keychar =="{" || keychar =="}" || keychar =="[" || keychar =="]" || keychar =="-" || keychar =="£" || keychar =='"' || keychar =="\\") 
    {
		
		 event.preventDefault();

    } 
    return isNumber(event, this)

});
});

jQuery('input.qty').autoNumeric();
jQuery(document).ready(function() {
repeat = 0
jQuery('.qty').keyup(function (event) {
	var Of11 = "<?php echo $tp; ?>";
	var c = String.fromCharCode(event.which);
	var valuinput =  this.value;
	var keylenght =  valuinput.split(".")[0].length;
	if( keylenght == 4){
		repeat++;
		
	}
	if(keylenght == 4 && repeat == 2){
		
		//alert('Maximum Quantity should be 9999');
		repeat=0;
	}
 	if(Of11 == 'MT')
	{
   /*if( keylenght == 4){
		repeat++;
		
	}
	if(keylenght == 4 && repeat == 2){
		alert('Maximum Quantity should be 9999');
		repeat=0;
	}*/
    }else{
    if(c !='.'  && valuinput.length >=4)
	{
    if(valuinput.length == 4)
	{
      event.preventDefault(); //disable cut,copy,paste
    }
    } 
    }
    var keynum
    var keychar
    var numcheck
    // For Internet Explorer
    if (window.event) {
        keynum = event.keyCode;
    }
    // For Netscape/Firefox/Opera
    else if (event.which) {
        keynum = event.which;
    }
    keychar = String.fromCharCode(keynum);
   
    //List of special characters you want to restrict
    if (keychar == "'" || keychar == "`" || keychar =="!" || keychar =="@" || keychar =="#" || keychar =="$" || keychar =="%" || keychar =="^" || keychar =="&" || keychar =="*" || keychar =="(" || keychar ==")" || keychar =="-" || keychar =="_" || keychar =="+" || keychar =="=" || keychar =="/" || keychar =="~" || keychar =="<" || keychar ==">" || keychar =="," || keychar ==";" || keychar ==":" || keychar =="|" || keychar =="?" || keychar =="{" || keychar =="}" || keychar =="[" || keychar =="]" || keychar =="-" || keychar =="£" || keychar =='"' || keychar =="\\") 
    {
		
		 event.preventDefault();
    } 
  return calculation(event, this)
});
});
// THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
function isNumber(evt, element) {
    var charCode = (evt.which) ? evt.which : event.keyCode
	var Of1 = "<?php echo $tp; ?>";
	
    if(Of1 == 'MT'){
	if ((charCode != 45 || $(element).val().indexOf('-') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
            (charCode != 46 || jQuery(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57))
	{
    	return false;
	}else{
		return true;
	}
	}else{
	if ((charCode != 45 || $(element).val().indexOf('-') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
            (charCode != 46 || jQuery(element).val().indexOf('.') == -1) &&      // “.” CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57)){
			return false;
	}else{
			return true;
	}
    }  
}
var typeOf = "<?php echo $tp; ?>";
function calculation(evt, element) {
	var Of1 = "<?php echo $tp; ?>";
	var charCode = (evt.which) ? evt.which : event.keyCode
	var proid = jQuery(element).attr('ppdid');
	var a = jQuery(element).attr('diameter');
	var p = jQuery(element).attr('price');
	var kqty = jQuery(element).val();
	var m = jQuery(element).attr('offst');
	if(parseInt(kqty) >= 9999){
		//var kqty = kqty;
		//var value = kqty.slice(0, -1);
		//jQuery(element).val(value);
		//alert('Maximum Qty should be less than 10000');
		//return false;
	}else if(kqty == '' ){
		var kqty = 0;
	}else{
		var kqty = kqty;
	}
	var price =kqty * parseFloat(p);
	//var quantity =$('qty'+a).value;
	jQuery('#total'+a).html('₹'+price.toFixed(2));
	if(typeOf == 'Bundle')
	{ 
		var mt =Number(kqty) * m;
		jQuery('#mt'+a).html(mt.toFixed(3)+'MT');
		var checkedValue = mt.toFixed(3); 
	}else if(typeOf == 'Kg'){
		var m = 1000;
		var mt =Number(kqty)/ m;
		jQuery('#mt'+a).html(mt+'MT');
		var checkedValue = mt; 
	}else{
		var checkedValue = kqty; 
	}
    var checkedValue1 = kqty;
	jQuery('#pid'+a).val(proid+'-'+checkedValue);
	jQuery('#pid'+a).attr('data-val',a+'-'+checkedValue);
	jQuery('#pid'+a).attr('control',a+'-'+checkedValue1);
	var total = 0;
	jQuery('.box:checked').each(function(){
	var x = jQuery(this).parent().parent().find('.total span').text();
	x = x.replace("₹","");
	// alert(jQuery(this).parent().parent().find('.total').text());
	total+=parseFloat(x);
	});
	var quanttity = 0;
	var valcount = 0;
	jQuery('.box:checked').each(function(){
		var x1 = jQuery(this).parent().parent().find('.quantity-box input').val();
		if(jQuery.trim( x1 ).length == 0 || x1 == '' ){
			var x1 = 0.00;
		}
		if(x1 == 0.00 || x1 == 0){
			valcount +=1;
		}
		quanttity+=parseFloat(x1);
	});
	if(valcount == 0){
		jQuery('.compare_brand').show();
		jQuery('.switch_type').hide();
		jQuery('.errmsg').hide();
		jQuery('#zip_input').css('border','1px solid #ccc');
	}else{
		jQuery('.switch_type').show();
		//jQuery('.compare_brand').hide();
	}
	var esti = 0;
	jQuery('.box:checked').each(function(){
		var x2 = jQuery(this).parent().parent().find('.esti').text();
		esti+=parseFloat(x2);
	});
	if(typeOf == 'MT'){
		var quanttity11 = quanttity;

	}else{
		var quanttity11 = esti;
	}
	jQuery('.amount').text('₹'+total.toFixed(2));
	if(Of1 == 'MT')
	{
		jQuery('.quantity').text(quanttity.toFixed(2));
	}else{
	jQuery('.quantity').text(quanttity.toFixed(0));
	}
	jQuery('.estimate').text(esti.toFixed(3)); 
	var brand = "<?php echo $brand; ?>";
	var zip = jQuery('#zip_input').val();
	var tp = jQuery('#menu1').text();
	var favorite = [];
	jQuery.each(jQuery("input[name='pid[]']:checked"), function(){            
		favorite.push(jQuery(this).attr('data'));
	});
	var favorite1 = [];
	jQuery.each(jQuery("input[name='pid[]']:checked"), function(){            
		favorite1.push(jQuery(this).attr('data-val'));
	});  
	var size = favorite.join(", ");
	var prodqty = favorite1.join(", ");	
	var favorite2 = [];
	jQuery.each(jQuery("input[name='pid[]']:checked"), function(){            
		favorite2.push(jQuery(this).attr('control'));
	});
	var zipqty =quanttity11;
	var qtyNew = favorite2.join(", ");
	var dataloader = '1';
	sellerprice1(brand,zip,size,prodqty,tp,zipqty,qtyNew,dataloader);
}
jQuery('.box').change(function(){
	var isChecked = this.checked;
	if(isChecked) {
		jQuery(this).parents("tr:eq(0)").find(".qty").prop("disabled",false);
		jQuery(this).parents("tr:eq(0)").find(".quantity-plus").show();	
		jQuery(this).parents("tr:eq(0)").find(".quantity-minus").show();			 
	} else {
		var valueloaded = jQuery(this).parents("tr:eq(0)").find(".qty").val();
		if(valueloaded != '0.00' || valueloaded != '0'){
	    var dataloader = '0';
		}
		jQuery(this).parents("tr:eq(0)").find(".qty").prop("disabled",true);
		jQuery(this).parents("tr:eq(0)").find(".quantity-plus").hide();	
		jQuery(this).parents("tr:eq(0)").find(".quantity-minus").hide();
		jQuery(this).parents("tr:eq(0)").find(".total span").text('₹0');
		jQuery(this).parents("tr:eq(0)").find(".esti").text('0');	
		if(typeOf == 'MT'){
			jQuery(this).parents("tr:eq(0)").find(".qty").val('0.00');	
		}else{
			jQuery(this).parents("tr:eq(0)").find(".qty").val('0');	
		}
		
	}
	var total = 0;
	jQuery('.box:checked').each(function(){
		var x = jQuery(this).parent().parent().find('.total span').text();
		x = x.replace("₹","");
		// alert(jQuery(this).parent().parent().find('.total').text());
		total+=parseFloat(x);
	});
	var quanttity = 0;
	var valcount = 0;
	jQuery('.box:checked').each(function(){
		var x1 = jQuery(this).parent().parent().find('.quantity-box input').val();
		if(x1 == '' ){
		 var x1 = 0.00;
		}
		if(x1 == 0.00 || x1 == 0 || x1 == ''){
		 valcount +=1;
		}
		quanttity+=parseFloat(x1);
	});
	if(valcount == 0){
		jQuery('.compare_brand').show();
		jQuery('.switch_type').hide();
		jQuery('.errmsg').hide();
		jQuery('#zip_input').css('border','1px solid #ccc');
	}else{
		jQuery('.switch_type').show();
		//jQuery('.compare_brand').hide();
	}
	var esti = 0;
	jQuery('.box:checked').each(function(){
		var x2 = jQuery(this).parent().parent().find('.esti').text();
		esti+=parseFloat(x2);
	});
	if(typeOf == 'MT'){
		var quanttity11 = quanttity;
	}else{
		var quanttity11 = esti;
	}
	if(total == 0){
		jQuery('.amount').text('₹0');
		jQuery('.quantity').text('0');
		jQuery('.estimate').text('0'); 
		jQuery('.amount').text('₹0');
		//jQuery('.compare_brand').css("display", "none");
		//jQuery('#zip_input').val('');
		jQuery('.errmsg').hide();
		jQuery('.listseller-count').hide();
		jQuery('#zip_input').css('border','1px solid #ccc');
	}else{
	    jQuery('.amount').text('₹'+total.toFixed(2));
	if(typeOf == 'MT')
	{
		jQuery('.quantity').text(quanttity.toFixed(2));
	}else{
		jQuery('.quantity').text(quanttity.toFixed(0));
		jQuery('.estimate').text(esti.toFixed(3));
	}
		
	}
	var zip = jQuery('#zip_input').val();
	if(zip != ''){
	var brand = "<?php echo $brand; ?>";
	var tp = jQuery('#menu1').text();
	var favorite = [];
	jQuery.each(jQuery("input[name='pid[]']:checked"), function(){            
		favorite.push(jQuery(this).attr('data'));
	});
	var favorite1 = [];
	jQuery.each(jQuery("input[name='pid[]']:checked"), function(){            
		favorite1.push(jQuery(this).attr('data-val'));
	});  
	var size = favorite.join(", ");
	var prodqty = favorite1.join(", ");	
	var favorite2 = [];
	jQuery.each(jQuery("input[name='pid[]']:checked"), function(){            
		favorite2.push(jQuery(this).attr('control'));
	});
	var zipqty = quanttity11;
	var qtyNew = favorite2.join(", ");
	if(dataloader == '0'){
	sellerprice1(brand,zip,size,prodqty,tp,zipqty,qtyNew,dataloader);
      }
	}
});
	
function plus(a,p,proid,m){
	if(typeOf == 'MT'){
	if(isNaN(parseFloat($('qty'+a).value)))
	{
		var add =0+1.00;
	}else{
		var add =parseFloat($('qty'+a).value)+1.00;
	}
	if(parseInt(add) > 9999.99)
	{
		//alert('Maximum Quantity should be 9999');
		return false;
	}
		$('qty'+a).value=add.toFixed(2);
		var price =$('qty'+a).value * parseFloat(p);
		var quantity =$('qty'+a).value;
		jQuery('#total'+a).html('₹'+price.toFixed(2));
	}else if(typeOf == 'Bundle'){
	if(isNaN(parseFloat($('qty'+a).value)))
	{
		var add =0+1;
	}else{
		var add =parseFloat($('qty'+a).value)+1;
	}
	if(parseInt(add) > 9999.99)
	{
		//alert('Maximum Quantity should be 9999');
		return false;
	}
	$('qty'+a).value=add;
	var price =$('qty'+a).value * parseFloat(p);
	jQuery('#total'+a).html('₹'+price.toFixed(2));
	var mt =Number($('qty'+a).value) * m;
	jQuery('#mt'+a).html(mt.toFixed(3)+'MT');	
	}else{
	if(isNaN(parseFloat($('qty'+a).value)))
	{
		var add =0+1;
	}else{
		var add =parseFloat($('qty'+a).value)+1;
	}
	$('qty'+a).value=add;
	var price =$('qty'+a).value * parseFloat(p);
	jQuery('#total'+a).html('₹'+price.toFixed(2));
	var m = 1000;
	var mt =Number($('qty'+a).value) / m;
	jQuery('#mt'+a).html(mt+'MT');
	}
	if(typeOf == 'Bundle')
	{
		var checkedValue = mt.toFixed(3); 
	}else if(typeOf == 'Kg'){
		var checkedValue = mt;	
	}
	else
	{
		var checkedValue = $('qty'+a).value; 
	}
	var checkedValue1 = $('qty'+a).value;
	jQuery('#pid'+a).val(proid+'-'+checkedValue);
	jQuery('qty'+a).val(checkedValue1);
	jQuery('#pid'+a).attr('control',a+'-'+checkedValue1);
	jQuery('#pid'+a).attr('data-val',a+'-'+checkedValue);
	var total = 0;
	jQuery('.box:checked').each(function(){
		var x = jQuery(this).parent().parent().find('.total span').text();
		x = x.replace("₹","");
		// alert(jQuery(this).parent().parent().find('.total').text());
		total+=parseFloat(x);
	});
	var quanttity = 0;
	var valcount = 0;
	jQuery('.box:checked').each(function(){
		var x1 = jQuery(this).parent().parent().find('.quantity-box input').val();
		if(x1 == ''){
			var x1 = 0;
		}
		if(x1 == 0.00 || x1 == 0 || x1 == ''){
			valcount +=1;
		}
		quanttity+=parseFloat(x1);
	});
	if(valcount == 0){
		jQuery('.compare_brand').show();
		jQuery('.switch_type').hide();
		jQuery('.errmsg').hide();
		jQuery('#zip_input').css('border','1px solid #ccc');
	}else{
		jQuery('.switch_type').show();
		//jQuery('.compare_brand').hide();
	}
	var esti = 0;
	jQuery('.box:checked').each(function(){
		var x2 = jQuery(this).parent().parent().find('.esti').text();
		esti+=parseFloat(x2);
	});
	if(typeOf == 'MT'){
		var quanttity11 = quanttity;
    }else{
		var quanttity11 = esti;
	}
	if(isNaN(quanttity))
	{
	if(typeOf == 'MT'){
		var quanttity = 0.00;
	}else{
		var quanttity = 0;
	}
	}
	jQuery('.amount').text('₹'+total.toFixed(2));
	if(typeOf == 'MT')
	{
		jQuery('.quantity').text(quanttity.toFixed(2));
	}else if(typeOf == 'Bundle'){
		jQuery('.quantity').text(quanttity.toFixed(0));
		jQuery('.estimate').text(esti.toFixed(3)); 	
	}else{
		jQuery('.quantity').text(quanttity.toFixed(0));
		jQuery('.estimate').text(esti.toFixed(3));
	}
	var brand = "<?php echo $brand; ?>";
	var zip = jQuery('#zip_input').val();
	var tp = jQuery('#menu1').text();
	var favorite = [];
	jQuery.each(jQuery("input[name='pid[]']:checked"), function(){            
		favorite.push(jQuery(this).attr('data'));
	});
	var favorite1 = [];
	jQuery.each(jQuery("input[name='pid[]']:checked"), function(){            
		favorite1.push(jQuery(this).attr('data-val'));
	});  
	var size = favorite.join(", ");
	var prodqty = favorite1.join(", ");	
	var favorite2 = [];
	jQuery.each(jQuery("input[name='pid[]']:checked"), function(){            
		favorite2.push(jQuery(this).attr('control'));
	});
	var zipqty =quanttity11;
	var qtyNew = favorite2.join(", ");
	var dataloader = '1';
	sellerprice1(brand,zip,size,prodqty,tp,zipqty,qtyNew,dataloader);
}
function minus(a,p,proid,m){
	if(typeOf == 'MT'){
	if(Number($('qty'+a).value)>=1){
		var add = parseFloat($('qty'+a).value)-1.00;
		$('qty'+a).value=add.toFixed(2);
	}
	var price =$('qty'+a).value * parseFloat(p);
	jQuery('#total'+a).html('₹'+price.toFixed(2));
	}else if(typeOf == 'Bundle'){
	if(Number($('qty'+a).value)>=1){
		var add = parseFloat($('qty'+a).value)-1;
		$('qty'+a).value=add;
	}
	var price =$('qty'+a).value * parseFloat(p);
	jQuery('#total'+a).html('₹'+price.toFixed(2));
	var mt =Number($('qty'+a).value) * m;
	jQuery('#mt'+a).html(mt.toFixed(3)+'MT');	
	}else{
	if(Number($('qty'+a).value)>=1){
		var add = parseFloat($('qty'+a).value)-1;
		$('qty'+a).value=add;
	}
	var price =$('qty'+a).value * parseFloat(p);
	jQuery('#total'+a).html('₹'+price.toFixed(2));
	var m = 1000;
	var mt =Number($('qty'+a).value) / m;
	jQuery('#mt'+a).html(mt+'MT');
	}
	if(typeOf == 'Bundle')
	{
		var checkedValue = mt.toFixed(3); 
	}else if(typeOf == 'Kg'){
		var checkedValue = mt;	
	}
	else
	{
		var checkedValue = $('qty'+a).value; 
	}
	var checkedValue1 = $('qty'+a).value;
	jQuery('#pid'+a).val(proid+'-'+checkedValue);
	jQuery('qty'+a).val(checkedValue1);
	jQuery('#pid'+a).attr('control',a+'-'+checkedValue1);
	jQuery('#pid'+a).attr('data-val',a+'-'+checkedValue);
	var total = 0;
	jQuery('.box:checked').each(function(){
		var x = jQuery(this).parent().parent().find('.total span').text();
		x = x.replace("₹","");
		// alert(jQuery(this).parent().parent().find('.total').text());
		total+=parseFloat(x);
	});
	var quanttity = 0;
	var valcount = 0;
	jQuery('.box:checked').each(function(){
		var x1 = jQuery(this).parent().parent().find('.quantity-box input').val();
		if(x1 == ''){
		var x1 = 0;
		}
		if(x1 == 0.00 || x1 == 0 || x1 == ''){
		valcount += 1;
		}
		quanttity+=parseFloat(x1);
	});
	if(valcount == 0){
		jQuery('.compare_brand').show();
		jQuery('.switch_type').hide();
		jQuery('.errmsg').hide();
		jQuery('#zip_input').css('border','1px solid #ccc');
	}else{
		jQuery('.switch_type').show();
		//jQuery('.compare_brand').hide();
	}
	var esti = 0;
	jQuery('.box:checked').each(function(){
		var x2 = jQuery(this).parent().parent().find('.esti').text();
		esti+=parseFloat(x2);
	});
	if(typeOf == 'MT'){
		var quanttity11 = quanttity;
	}else{
		var quanttity11 = esti;
	}
	if(isNaN(quanttity))
	{
	if(typeOf == 'MT'){
		var quanttity = 0.00;
	}else{
		var quanttity = 0;
	}
	}
	jQuery('.amount').text('₹'+total.toFixed(2));
	if(typeOf == 'MT')
	{
		jQuery('.quantity').text(quanttity.toFixed(2));
	}else{
		jQuery('.quantity').text(quanttity.toFixed(0));
	}
	jQuery('.estimate').text(esti.toFixed(3)); 			
	var brand = "<?php echo $brand; ?>";
	var zip = jQuery('#zip_input').val();
	var tp = jQuery('#menu1').text();
	var favorite = [];
	jQuery.each(jQuery("input[name='pid[]']:checked"), function(){            
		favorite.push(jQuery(this).attr('data'));
	});
	var favorite1 = [];
	jQuery.each(jQuery("input[name='pid[]']:checked"), function(){            
		favorite1.push(jQuery(this).attr('data-val'));
	});  
	var size = favorite.join(", ");
	var prodqty = favorite1.join(", ");	
	var favorite2 = [];
	jQuery.each(jQuery("input[name='pid[]']:checked"), function(){            
		favorite2.push(jQuery(this).attr('control'));
	});
	var zipqty = quanttity11;
	var qtyNew = favorite2.join(", ");
	var dataloader = '1';
	sellerprice1(brand,zip,size,prodqty,tp,zipqty,qtyNew,dataloader);
}
		
jQuery('.dropdown-menu li').click(function() {
	var typeOf = jQuery(this).attr('id');
	var diameter = <?php echo $daimeterdata ?>;
	var dataString = JSON.stringify(diameter);
	var brand = jQuery('input:radio[name=brand]:checked').val();
	var first = jQuery('input:radio[name=brand]:checked').val();
	var favorite = [];
	jQuery.each(jQuery("input[name='pid[]']:checked"), function(){            
		favorite.push(jQuery(this).attr('data'));
	});
	var favorite1 = [];
	jQuery.each(jQuery("input[name='pid[]']:checked"), function(){            
		favorite1.push(jQuery(this).attr('change-type'));
	});
	var favorite2 = [];
	jQuery.each(jQuery("input[name='pid[]']:checked"), function(){            
		favorite2.push(jQuery(this).val());
	});
	var favorite3 = [];
	jQuery.each(jQuery("input[name='pid[]']:checked"), function(){            
		favorite3.push(jQuery(this).attr('change-type'));
	});
	var diameter1 = favorite.join(", ");
	var fixedqty = favorite3.join(", ");
	var qty = favorite1.join(", ");
	var qtyNew = favorite2.join(", ");
	if(typeOf =='MT'){
		jQuery.ajax({
			url:'<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'list.php'?>',
			type:'POST',
			data:{'brand':brand,'dia':dataString,'dia1':diameter1,'selqty':qty,'tp':tp, 'qtyNew':qtyNew, 'fixed':fixedqty},
			success:function(d){ 
			jQuery('.compare_brand').css("display", "none");
			//jQuery('#zip_input').val('');
			jQuery('.list').html(d);
			if(fixedqty != ''){
			   jQuery('.switch_type').show();
		    }
			jQuery('.moq-qty-msg').hide();

			jQuery('#zip_input').css('border','1px solid #ccc'); 
			jQuery('#search_by_zip').trigger( "click" );
			//sellerprice1(brand,zip,diameter1,qty,tp,zipqty,qtyNew,fixedqty);	
			}
		});
	}else if(typeOf =='Bundle'){
		jQuery.ajax({
			url:'<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'listtype.php'?>',
			type:'POST',
			data:{'brand':brand,'dia':dataString,'dia1':diameter1,'selqty':qty,'tp':tp, 'qtyNew':qtyNew, 'fixed':fixedqty},
			success:function(d){ 
			jQuery('.compare_brand').css("display", "none");
			//jQuery('#zip_input').val('');
			jQuery('.list').html(d);
			if(fixedqty != ''){
			   jQuery('.switch_type').show();
		    }
			jQuery('.moq-qty-msg').hide();
			jQuery('#search_by_zip').trigger( "click" );
			jQuery('#zip_input').css('border','1px solid #ccc'); 
			//sellerprice1(brand,zip,diameter1,qty,tp,zipqty,qtyNew,fixedqty);	
			}
		});
	}else{
		jQuery.ajax({
			url:'<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'listkg.php'?>',
			type:'POST',
			data:{'brand':brand,'dia':dataString,'dia1':diameter1,'selqty':qty,'tp':tp, 'qtyNew':qtyNew, 'fixed':fixedqty},
			success:function(d){ 
			jQuery('.compare_brand').css("display", "none");
			//jQuery('#zip_input').val('');
			jQuery('.list').html(d);
			if(fixedqty != ''){
			   jQuery('.switch_type').show();
		    }
			jQuery('.moq-qty-msg').hide();
			jQuery('#zip_input').css('border','1px solid #ccc'); 
			jQuery('#search_by_zip').trigger( "click" );
			//sellerprice1(brand,zip,diameter1,qty,tp,zipqty,qtyNew,fixedqty);	
			}
		});
	}
})
function sellerprice1(brand,zip,size,prodqty,tp,zipqty,qtyNew,dataloader){
	var popupSellerId = "<?php echo $vendor; ?>";
	if(dataloader == 1){
		jQuery('.spin-wrapper').css("display", "block"); 
	}
	var favorite3 = [];
	jQuery.each(jQuery("input[name='pid[]']:checked"), function(){            
		favorite3.push(jQuery(this).val());
	});
	var moqapi = jQuery('input[name=vendor]:checked').attr('moq');
		if(tp == 'MT'){
		var zipqty = jQuery('#tquantity').text();
	}else{
		var zipqty = jQuery('#testimate').text();
	}
	if(zipqty > moqapi ){
		jQuery('.moq-qty-msg').hide();
	}
	var prodNew = favorite3.join(", ");
	jQuery.ajax({
		url:'<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'steelseller.php'?>',
		type:'POST',
		data:{'brand':brand,'zip':zip,'size':size,'qty':prodqty,'tp':tp,'totalqty':zipqty,'qtyNew':qtyNew, 'prodids':prodNew},
		success:function(d){
		//alert(d);
		jQuery('.select_seller').show();
		jQuery('.select_seller').html(d);
		var sellername = jQuery('input[name=vendor]:checked').attr('seller-name');
								jQuery('.top-selname h4').text(sellername);
								jQuery('#current_pincode').text(zip);
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
		setTimeout(function(){
		jQuery('.selectvendor').removeClass('tick');
		jQuery('#button-'+popupSellerId).addClass('tick');
		jQuery('#button-'+popupSellerId).attr('disable','disable');
		jQuery('#radio-'+popupSellerId).attr('checked','checked');
		//jQuery('#radio-'+popupSellerId).trigger( "click" );
		jQuery('.spin-wrapper').css("display", "none"); 
		}, 3000);
		}
	}); 
}
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
 .steelmttable table,.steelmttable thead,.steelmttable tbody,.steelmttable th,.steelmttable td,.steelmttable tr { 
    display: block; 
  }

  /* Hide table headers (but not display: none;, for accessibility) */
 .steelmttable thead tr { 
    position: absolute;
    top: -9999px;
    left: -9999px;
  }


 .steelmttable tr { border: 1px solid #ccc; margin-bottom: 10px; }

 .steelmttable tr { border: 1px solid #ccc; margin-bottom: 10px; }
  
 .steelmttable td { 
    /* Behave  like a "row" */
    border: none;
    border-bottom: 1px solid #eee; 
    position: relative;
    padding-left: 50%; 
	text-align:right;
  }
  .steelmttable .table > tbody > tr > td{
  	text-align: right !important;
}

 .steelmttable td:before { 
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
.steelmttable td:nth-of-type(1):before { content: "Thickness"; }
.steelmttable td:nth-of-type(2):before { content: "Price Per"; }
.steelmttable td:nth-of-type(3):before { content: "Quantity"; }
.steelmttable td:nth-of-type(4):before { content: "Item Total"; }
}

@media 
only screen and (max-width: 480px)
 {

  /* Force table to not be like tables anymore */
  .steelbntable table,.steelbntable thead,.steelbntable tbody,.steelbntable th,.steelbntable td,.steelbntable tr { 
    display: block; 
  }

  /* Hide table headers (but not display: none;, for accessibility) */
 .steelbntable thead tr { 
    position: absolute;
    top: -9999px;
    left: -9999px;
  }


 .steelbntable tr { border: 1px solid #ccc; margin-bottom: 10px; }

 .steelbntable tr { border: 1px solid #ccc; margin-bottom: 10px; }
  
 .steelbntable td { 
    /* Behave  like a "row" */
    border: none;
    border-bottom: 1px solid #eee; 
    position: relative;
    padding-left: 50%; 
	text-align:right;
  }
  .steelbntable .table > tbody > tr > td{
  	text-align: right !important;
}

 .steelbntable td:before { 
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
.steelbntable td:nth-of-type(1):before { content: "Thickness"; }
.steelbntable td:nth-of-type(2):before { content: "Price Per"; }
.steelbntable td:nth-of-type(3):before { content: "Quantity"; }
.steelbntable td:nth-of-type(4):before { content: "Est. Weight in MT"; }
.steelbntable td:nth-of-type(5):before { content: "Item Total"; }
}


</style>
