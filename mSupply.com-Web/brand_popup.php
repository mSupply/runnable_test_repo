<?php 
error_reporting(1);
ini_set("display_errors","1");
ob_start();
include_once 'app/Mage.php';
Mage::app();
$sellerId = $_POST['seller_id'];
$brandId = $_POST['brand_id'];
$productId = $_POST['prod'];
$productQtys = $_POST['qty'];

$array_ids = explode(", ", $productQtys);
$pid = array();
$pqty =array();		 
 foreach($array_ids as $pro_id)
 {
	
	$words = explode('-', $pro_id);
	$qtyselected = $last_word = array_pop($words);
	$pro_id = $first_chunk = implode('-', $words);
	 
	$pid[$pro_id][] = $qtyselected; 
 }
 $attributeCode = 'diameter';
$manufacturer = 'manufacturer';
$products = Mage::getModel('catalog/category')->load(282)
 ->getProductCollection()
 ->addAttributeToSelect('*')
 ->addAttributeToFilter('status', 1)
 ->addAttributeToFilter('visibility', 1)
 ->addAttributeToFilter('vendor', $sellerId)
 //->setOrder('diameter', 'ASC')
 ;
 
       foreach($products as $product)
       {
		    $usedAttributeValues[$product->getData($attributeCode)] = $product->getAttributeText($attributeCode);
		   $usedAttributeValues1[$product->getData($manufacturer)] = $product->getAttributeText($manufacturer);
       }
	   $diameterlist = array_unique($usedAttributeValues);
		$usedAttributeValues11 = array_unique($usedAttributeValues1);
		
		
	   

?>
           <div class="clearfix"></div>
           <!--select brand start-->
           <!-- <div class="brand" style="margin-bottom:30px;">
			<ul>
                
				<form action="" method="post">
					  <?php  foreach($usedAttributeValues11 as $key => $value)
						   { ?>
					<li class="list_enabled"><input type="radio" class="brand_list_popup" name="brand_popup" id="deal<?php echo $key; ?>" value="<?php echo $key; ?>" <?php if($brandId ==$key) echo ' checked '; ?>><?php echo $value; ?></li>
					<?php } ?>
				</form>	
			</ul>
            </div> --> 
			
			
			        
		<?php 
//print_r($diameterIds);
		 $diameterIds = explode(", ", $productId);
		 $productsCollection = Mage::getModel('catalog/category')->load(282)
		 ->getProductCollection()
		 ->addAttributeToSelect('*')
		 ->addAttributeToFilter('status', 1)
		 ->addAttributeToFilter('visibility', 1)
		 ->addAttributeToFilter('vendor', $sellerId)
		 ->addAttributeToFilter('manufacturer', $brandId)
		 ->addAttributeToFilter('diameter', array('in' => $diameterIds))
		 //->setOrder('diameter', 'ASC')
		 ;
		?>
			
			
			<div class="clearfix"></div>
			
			<div class="product_content">
			<ul class="brandul-head">
			<li class="heading">Size</li>
			<?php 
			$daimeterdata = array();
			
			foreach($productsCollection as $product) { ?>
			<li><?php echo $product->getAttributeText("diameter"); 
			$daimeterdata[$product->getDiameter()] = $product->getDiameter();
			?></li>
			<?php } ?>
			<li class="footer">Total</li>
			</ul>
			
			<?php
		
			asort($usedAttributeValues11);
			$maxCount = 0;
	
			foreach($usedAttributeValues11 as $key => $value) { ?>
			
			<ul class="brand_list_popup <?php if($brandId ==$key) { ?>active<?php }?>" data-val="<?php echo $key; ?>">
			
			<li class="heading"><?php echo $value; ?></li>
			
						 <?php
						 
						 $total=0;
						 
                         $diameterIdsssss = explode(", ", $productId);
						 $productsCollection1 = Mage::getModel('catalog/category')->load(282)
						 ->getProductCollection()
						 ->addAttributeToSelect('*')
						 ->addAttributeToFilter('status', 1)
						 ->addAttributeToFilter('visibility', 1)
						 ->addAttributeToFilter('vendor', $sellerId)
						 ->addAttributeToFilter('manufacturer', $key)
						  //->setOrder('diameter', 'ASC')
                         ->addAttributeToFilter('diameter', array('in' => $diameterIdsssss));
$currentTime = Mage::getModel('core/date')->date('Y-m-d H:i:s');
		
				//if(count($productsCollection1) > $maxCount)
					 $maxCount = count($productsCollection1);
						 ?>
						  <?php	$rowcount = count($diameterIds);					 
						 foreach($productsCollection1 as $product1) { ?>
						 <?php $brand_id = $product1->getManufacturer(); ?>
						 <?php // echo $brand_id; ?>
						 <?php if($brand_id == $key); ?>
						 <?php
						 $ProductToDate = $product1->getResource()->formatDate($product1->getspecial_to_date(), false); 
						 $price = $product1->getFinalPrice();  					  
						 ?>
						  <?php 
						  $proBrand = $product1->getDiameter();	 
						 if(in_array($proBrand,$daimeterdata)){
						  if($pid[$product1->getDiameter()][0]){ ?>
						  	<li><?php echo '₹'. number_format($price * $pid[$product1->getDiameter()][0], 2, '.', ''); ?></li> 
							<?php } else { ?>
							<li><?php echo '₹'. $price; ?></li>
							<?php } ?>
							 <?php }  if(!in_array($proBrand,$daimeterdata)){
							 ?>
							 
							 <?php } ?>
							<?php $total +=  $price * $pid[$product1->getDiameter()][0];?>
						  <?php $rowcount--; } ?>
						  <?php 
						  
						  if($rowcount != 0){
							  for($j = $rowcount; $j>0;$j--)
							  {
								  echo '<li>-</li>';
							  }
						  }?>
						  <?php
							//$diff = $maxCount - count($productsCollection1);
							//for($i=1;$i<=$diff;$i++)
							//{
							?>
						
						<?php
							//}
						  ?>
						 
					     <li class="footer"><?php echo '₹'.number_format($total, 2, '.', ''); ?></li>  
			</ul>
			<?php } ?>
			</div>
			
			

<script type="text/javascript">

var defaultValue = <?php echo $brandId; ?>;
jQuery('#selected_brand').val(defaultValue);

jQuery('.brand_list_popup').click(function(){
	jQuery('.brand_list_popup').removeClass('active');
	jQuery('#selected_brand').val(jQuery(this).attr('data-val'));
	jQuery(this).addClass('active');
});
</script>			
			

				
				
