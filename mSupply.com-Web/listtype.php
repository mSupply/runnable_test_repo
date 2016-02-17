<?php
ob_start();
include_once 'app/Mage.php';
Mage::app();
$productSku = $_POST['brand'];
$zip = $_POST['dia'];
$array = json_decode($zip, true);
$daiameter = array();
foreach ($array as $key => $value) {
	$daiameter[] = $key;
}
$qtyNew = $_POST['qtyNew'];
$fixedqty = $_POST['fixed'];
$qty = $_POST['selqty'];
$size = $_POST['dia1'];
$arraysel =  explode(',', $size);
//$array = json_decode($zip, true);
$daiametersel = array();
foreach ($arraysel as $data) {
	$daiametersel[] = $data;
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
 //print_r($pidfixed);
 $array_idsNew = explode(", ", $qtyNew);
 foreach($array_idsNew as $pro_idNew)
 {
	$wordsNew = explode('-', $pro_idNew);
	$qtyselectedNew = trim($wordsNew[0]);
	$pro_idNew = trim($wordsNew[1]);
	 
	$pidNew[$qtyselectedNew] = $pro_idNew; 
 }
 
$currentTime = Mage::getModel('core/date')->date('Y-m-d H:i:s');
//$daiameter = array_keys($zip);
$todayDate = date('m/d/y');
$tomorrow = mktime(0, 0, 0, date('m'), date('d'), date('y'));
$tomorrowDate = date('m/d/y', $tomorrow);
$products = Mage::getModel('catalog/category')->load(282)
 ->getProductCollection()
 ->distinct(TRUE)
 ->addAttributeToSelect('*')
 ->addAttributeToFilter('status', 1)
 ->addAttributeToFilter('visibility', 4)
 ->addAttributeToFilter('diameter', array('in' =>$daiameter))
 ->addAttributeToFilter('manufacturer', array('eq' =>$productSku))
  
 //->addAttributeToFilter('special_price', array('neq' => ""))
 //->setOrder('price', 'ASC')
 
// ->setPageSize(7)
 ;
 $diameterdata = $daiameter;
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
    $prod_coll [$DATA] = $daimeterarray [$DATA];
} 
 ?>
<div class="col-lg-12 col-xs-12 mb1em resp-drop">
<span class="dropdown pull-right">							
<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Bundle<span class="caret"></span></button>
<ul class="dropdown-menu cstldd" role="menu" aria-labelledby="menu1">
<li role="presentation" id="MT">MT</li>
<li role="presentation" id="Bundle" class="active">Bundle</li>
<li role="presentation" id="Kg" class="active">Kg</li>
</ul>
</span>
</div>

 <div class="table-responsive clear">
<table class="table table-condensed steelbntable">
    <thead>
      <tr class="cust-trh">
        <th>Thickness</th>
        <th>Price per <span class="dropdown resp-drop">							
								    <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Bundle<span class="caret"></span></button>
								    <ul class="dropdown-menu cstldd" role="menu" aria-labelledby="menu1">
								      <li role="presentation" id="MT">MT</li>
									  <li role="presentation" id="Bundle" class="active">Bundle</li>
									  <li role="presentation" id="Kg" class="active">Kg</li>
								    </ul>
								</span></th>
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
                              
		                 if (strtotime($currentTime) < strtotime($ProductToDate . ' ' . $product->getTime())) { 
								  $price = $special * $offset;  
							   }else{
								 $price = $product->getPrice() * $offset ; 
							   }
							   $diameter1 = $product->getDiameter();
							   $price = number_format($price, 2, '.', '');
		                    $id = $product->getId();
							$name = $product->getName();
							$a = explode('-',$name);
							$dia = $product->getAttributeText('diameter');
							$estimatedel = number_format($product->getSteelOffset(),3);
							
		                ?>
      <tr id="listdata" class="cust-trb">
						    <td>
												
												    <input type="checkbox" disabled class="box" name="pid[]" change-type="<?php echo $product->getDiameter();?>-0" id="pid<?php echo $product->getDiameter();?>" <?php if(in_array($diameter1,$daiametersel ) ){ ?> checked="checked" <?php } ?> data-val= "<?php echo $product->getDiameter();?>-<?php if($pid[$product->getDiameter()][0]){ ?> <?php echo number_format($estimatedel * $pidfixed[$product->getDiameter()][0],3); ?> <?php }else{ ?>0 <?php } ?>" control="<?php echo $product->getDiameter();?>-<?php if($pidfixed[$product->getDiameter()][0]){ ?> <?php echo $pidfixed[$product->getDiameter()][0]; ?> <?php }else{ ?>0 <?php } ?>" maxlength="12" data="<?php echo $product->getDiameter();?>" value="<?php echo $product->getId();?>-<?php if($pid[$product->getDiameter()][0]){ ?> <?php echo number_format($estimatedel * $pidfixed[$product->getDiameter()][0],3); ?> <?php }else{ ?>0 <?php } ?>"/>
												<span class="mbrandname"><?php echo $dia; ?></span>
												</td>
							
							<td id="price"><?php echo '-'; ?></td>
							<td>
							<div class="wrap-qty">				
				
				<div class="qty-set">
					<span class="quantity-box">
								<input type="text" name="qty" data-v-max="9999" disabled data-m-dec="0" id="qty<?php echo $product->getDiameter();?>" offst="<?php echo number_format($product->getSteelOffset(),3);?>"  ppdid="<?php echo $product->getId();?>" diameter ="<?php echo $product->getDiameter();?>" price = "<?php echo $price;?>" <?php if(!in_array($diameter1,$daiametersel ) ){ ?> disabled <?php } ?> value="0"  class="quantity-input qty" />
						<input type="button" style="display:none" class="quantity-controls quantity-plus" <?php if(!in_array($diameter1,$daiametersel ) ){ ?> style="display:none" <?php } ?> onclick="plus(<?php echo $product->getDiameter();?>,<?php echo $price;?>,<?php echo $product->getId();?>,<?php echo number_format($product->getSteelOffset(),3);?>)" value="">	
						<input type="button" style="display:none" class="quantity-controls quantity-minus" <?php if(!in_array($diameter1,$daiametersel ) ){ ?> style="display:none" <?php } ?> onclick="minus(<?php echo $product->getDiameter();?>,<?php echo $price;?>,<?php echo $product->getId();?>,<?php echo number_format($product->getSteelOffset(),3);?>)" value="">
</span>					
				</div>
			</div>								
							</td>
							<td class="esti" id="mt<?php echo $product->getDiameter();?>"><?php if($pid[$product->getDiameter()][0]){
																?>
							<?php '-'; ?> 
							<?php
							}else{
								echo '0';
							}
							?></td>
							<td class="total"><span id="total<?php echo $product->getDiameter();?>">	<?php if($pidfixed[$product->getDiameter()][0]){
								$totalqty += 0;
								$totalpice += 0;
								$estimateton += 0;
								?>
							<?php echo '₹0'; ?> 
							<?php
							}else{
								echo '₹0';
							}
							?></span></td>
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
        <th>Est. Total Weight<div class="estimate"><?php echo number_format($estimateton, 3, '.', ''); ?></div></th>
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
					<div class="estimate"><?php echo number_format($estimateton, 3, '.', ''); ?></div>
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
<script>
     jQuery(document).ready(function() {
jQuery( ".qty" ).focus(function() {
	var focusval = jQuery.trim(jQuery(this).val());
	if(focusval == '0' || focusval == '0.00'){
	jQuery(this).val('');
	
	}
	});
 jQuery('.qty').bind('paste',function(e) { 
 e.preventDefault(); //disable cut,copy,paste
 //alert('cut,copy & paste options are disabled !!');
 });
	var getSelected = function(){
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
jQuery('input.qty').autoNumeric();
        jQuery('.qty').keypress(function (event) {
            return isNumber(event, this)
        });

    });
	jQuery(document).ready(function() {
repeat = 0;
        jQuery('.qty').keyup(function (event) {
                  var incremat = repeat+=1;
			if(incremat == 5 && jQuery(this).val().split(".")[0].length == 4){
				    if(jQuery(this).val().indexOf('.') ===-1 && event.keyCode != 8 ){
				alert('Maximum Quantity should be 9999');
				
					}
					repeat-=1
			}
				 return calculation(event, this)
        });

    });

	   // THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
    function isNumber(evt, element) {

        var charCode = (evt.which) ? evt.which : event.keyCode
		
        if ((charCode != 46 || jQuery(element).val().indexOf('.') == -1) &&      // “.” CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57)){
				 
				return false;
			}else{
				//alert(kqty+'-'+proid+'-'+pp+''+ab);
				return true;
			}
        
    }
	    function calculation(evt, element) {
 evt = evt||window.event // IE support
    var c = evt.keyCode
    var ctrlDown = evt.ctrlKey||evt.metaKey // Mac support
	 if ((ctrlDown || c==67) &&  (ctrlDown || c==86) &&  (ctrlDown || c==88)){
           
				 
				return false;
	 }
        var charCode = (evt.which) ? evt.which : event.keyCode
		var proid = jQuery(element).attr('ppdid');
		var a = jQuery(element).attr('diameter');
		var p = jQuery(element).attr('price');
		var m = jQuery(element).attr('offst');
        var kqty = jQuery(element).val();
        if(parseInt(kqty) >= 9999){
			 var kqty = kqty;
			  var value = kqty.slice(0, -1);
			 //var totalqty = jQuery('.quantity').text();
			 //jQuery(element).val(value);
			// alert('Maximum Qty should be less than 10000');
			// return false;
		 }else if(kqty == '' ){
			 var kqty = 0;
			 // jQuery(element).val(0);
		 }else{
			  var kqty = kqty;
		 }
	    var price =kqty * parseFloat(p);
				//var quantity =$('qty'+a).value;
               jQuery('#total'+a).html('₹'+price.toFixed(2));
			   
			
					
			   var mt =Number(kqty) * m;
			    jQuery('#mt'+a).html(mt.toFixed(3)+'MT');
				var checkedValue = mt; 
				
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
	   //alert(total);
	          var quanttity = 0;
			   var valcount = 0;
               jQuery('.box:checked').each(function(){
		       var x1 = jQuery(this).parent().parent().find('.quantity-box input').val();
			     if(jQuery.trim( x1 ).length == 0 || x1 == '' ){
				   var x1 = 0;
			   }
			    if(x1 == 0.00 || x1 == 0){
					valcount  += 1;
			   }
               //x = x.replace("₹","");
		       // alert(jQuery(this).parent().parent().find('.total').text());
               quanttity+=parseFloat(x1);
               });
			   if(valcount == 0){
				   
				   	jQuery('.switch_type').hide();
				 jQuery('.errmsg').hide();
								  jQuery('#zip_input').css('border','1px solid #ccc');
			   }else{
				   jQuery('.switch_type').show();
			   }
			   var esti = 0;
               jQuery('.box:checked').each(function(){
		       var x2 = jQuery(this).parent().parent().find('.esti').text();
               esti+=parseFloat(x2);
               });
	var brand = "<?php echo $productSku; ?>";
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
			 if(tp == 'MT')
		   {
			   var zipqty = jQuery('.quantity').text();
		   }else{
			    var zipqty = jQuery('.estimate').text();
		   }
		    
			var qtyNew = favorite2.join(", ");
			 var zip = jQuery('#zip_input').val();
			var noseller1 = jQuery('.black').text();
							sellerprice(brand,zip,size,prodqty,tp,esti,qtyNew);
            jQuery('.amount').text('₹'+total.toFixed(2));
 jQuery('.quantity').text(quanttity);
 jQuery('.estimate').text(esti.toFixed(3)); 	   
    }
  jQuery('.box').change(function(){
	 var isChecked = this.checked;
    
    if(isChecked) {
        jQuery(this).parents("tr:eq(0)").find(".qty").prop("disabled",false);
        jQuery(this).parents("tr:eq(0)").find(".quantity-plus").show();	
        jQuery(this).parents("tr:eq(0)").find(".quantity-minus").show();			 
    } else {
        jQuery(this).parents("tr:eq(0)").find(".qty").prop("disabled",true);
		jQuery(this).parents("tr:eq(0)").find(".quantity-plus").hide();	
        jQuery(this).parents("tr:eq(0)").find(".quantity-minus").hide();	
		 jQuery(this).parents("tr:eq(0)").find(".total span").text('₹0');
        jQuery(this).parents("tr:eq(0)").find(".qty").val('0');	
		 jQuery(this).parents("tr:eq(0)").find(".esti").text('0');	
         //jQuery('.select_seller').hide();
        //jQuery('#zip_input').val('');	
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
			     if(jQuery.trim( x1 ).length == 0 || x1 == '' ){
				   var x1 = 0;
			   }
			    if(x1 == 0.00 || x1 == 0){
					valcount += 1;
			   }
               //x = x.replace("₹","");
		       // alert(jQuery(this).parent().parent().find('.total').text());
               quanttity+=parseFloat(x1);
               });
			   if(valcount == 0){
				   
				   	jQuery('.switch_type').hide();
				 jQuery('.errmsg').hide();
				jQuery('#zip_input').css('border','1px solid #ccc');
			   }else{
				   jQuery('.switch_type').show();
			   }
			   var esti = 0;
               jQuery('.box:checked').each(function(){
		       var x2 = jQuery(this).parent().parent().find('.esti').text();
               esti+=parseFloat(x2);
               });
			   var brand = "<?php echo $productSku; ?>";
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
			 if(tp == 'MT')
		   {
			   var zipqty = jQuery('.quantity').text();
		   }else{
			    var zipqty = jQuery('.estimate').text();
		   }
		    
			var qtyNew = favorite2.join(", ");
			 var zip = jQuery('#zip_input').val();
							var noseller1 = jQuery('.black').text();
			//alert(noseller1);
			if(total == 0){
		   jQuery('.amount').text('₹0');
          jQuery('.quantity').text('0');
          jQuery('.estimate').text('0'); 
		  jQuery('.amount').text('₹0');
		 jQuery('.compare_brand').css("display", "none");
		//jQuery('#zip_input').val('');
		jQuery('.select_seller').hide();
		jQuery('.listseller-count').hide();
		jQuery('.errmsg').hide();
		jQuery('#zip_input').css('border','1px solid #ccc');
		  
	   }else{
		   jQuery('.amount').text('₹'+total.toFixed(2));
		    jQuery('.quantity').text(quanttity);
			jQuery('.estimate').text(esti.toFixed(3));
	   }
			sellerprice(brand,zip,size,prodqty,tp,esti,qtyNew);	  
	   
    });
 jQuery('.dropdown-menu li').click(function() {
var type1 = jQuery(this).attr('id');
//alert(type);
jQuery('#menu1').html(type1);
 var diameter = <?php echo $zip; ?>;
	  var dataString = JSON.stringify(diameter);
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
			//alert(diameter1+"deee"+qty+"qtynw"+qtyNew+"fixedqty"+fixedqty+"My favourite sports are: " + favorite2.join(", "));
if(type1 =='MT'){
	 jQuery.ajax({
							url:'<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'list.php'?>',
							type:'POST',
							data:{'brand':first,'dia':dataString,'dia1':diameter1,'selqty':qty,'tp':tp, 'qtyNew':qtyNew, 'fixed':fixedqty},
							success:function(d){
								//alert(d);
								jQuery('.list').html(d);
								  jQuery('#zip_input').css('border','1px solid #ccc'); 
								  jQuery('#search_by_zip').trigger( "click" );
								  // var zip = jQuery('#zip_input').val();
							//if(zip != ''){
                            //sellerpricebundlelist(zip);	
							//}
							}
						});
	
}else if(type1 =='Bundle'){
		 jQuery.ajax({
							url:'<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'listtype.php'?>',
							type:'POST',
							data:{'brand':first,'dia':dataString,'dia1':diameter1,'selqty':qty,'tp':tp, 'qtyNew':qtyNew, 'fixed':fixedqty},
							success:function(d){
								//alert(d);
								jQuery('.list').html(d);
								  jQuery('#zip_input').css('border','1px solid #ccc');
jQuery('#search_by_zip').trigger( "click" );								  
								 // var zip = jQuery('#zip_input').val();
							//if(zip != ''){
                            //sellerpricebundlelist(zip);	
							//}
							}
						});
	
}else{
	 jQuery.ajax({
							url:'<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'listkg.php'?>',
							type:'POST',
							data:{'brand':first,'dia':dataString,'dia1':diameter1,'selqty':qty,'tp':tp, 'qtyNew':qtyNew, 'fixed':fixedqty},
							success:function(d){
								//alert(d);
								jQuery('.list').html(d);
								  jQuery('#zip_input').css('border','1px solid #ccc'); 
								  jQuery('#search_by_zip').trigger( "click" );
								 // var zip = jQuery('#zip_input').val();
							//if(zip != ''){
                            //sellerpricebundlelist(zip);	
							//}
							}
						});
}
})
function sellerpricebundlelist(zip){
		var brand = jQuery('input:radio[name=brand]:checked').val();
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
	  	    var size = favorite.join(", ");
		    var fixedqty = favorite3.join(", ");
			var prodqty = favorite1.join(", ");
			var qtyNew = favorite2.join(", ");
			 var tp = jQuery('#menu1').text();
		   if(tp == 'MT')
		   {
			   var zipqty = jQuery('.quantity').text();
		   }else{
			    var zipqty = jQuery('.estimate').text();
		   }
			//alert(diameter1+"deee"+qty+"qtynw"+qtyNew+"fixedqty"+fixedqty+"My favourite sports sdfsdfsd: " + favorite2.join(", "));
				jQuery.ajax({
							url:'<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'steelseller.php'?>',
							type:'POST',
							data:{'brand':brand,'zip':zip,'size':size,'qty':prodqty,'tp':tp,'totalqty':zipqty,'qtyNew':qtyNew},
							success:function(d){
								var vendorrr = jQuery('input:radio[name=vendor]:checked').val();
								//alert(vendorrr);
								jQuery('#deal'+brand).prop('checked', true);
								jQuery('.select_seller').show();
						jQuery('.select_seller').html(d);
						jQuery.each(jQuery(".clickmetoselect1"), function(){  
var vendor_list = 	jQuery(this).val();
if(vendor_list == vendorrr){
	if(typeof(vendorrr)  != "undefined") {
						jQuery.ajax({
										url:'<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'selectseller.php'?>',
										type:'POST',
										data:{'brand':brand,'dia':size,'vendor':vendorrr,'selqty':prodqty,'tp':tp, 'qtyNew':qtyNew, 'fixed':fixedqty},
										success:function(d){
											
											jQuery('.list').html(d);
											
										}
									});
									 setTimeout(function(){
					  jQuery('#radio-'+vendorrr).prop('checked', true);
					}, 3000);
					}
}				
            });
						
				 
				 
				
						
							}
						}); 
			}
			function plus(a,p,proid,m){
				if($('qty'+a).value == '')
				{
					var add =0+1;
					
				}else{
					var add =parseFloat($('qty'+a).value)+1;
				}
				if($('qty'+a).value >= 9999)
				{
					var add = 9999;
				}
				$('qty'+a).value=add;
				var price =$('qty'+a).value * parseFloat(p);
               jQuery('#total'+a).html('₹'+price.toFixed(2));
			   var mt =Number($('qty'+a).value) * m;
			    jQuery('#mt'+a).html(mt.toFixed(3)+'MT');				
		     	var checkedValue = mt.toFixed(3); 
				var checkedValue1 = $('qty'+a).value; 
				 
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
	   //alert(total);
	          var quanttity = 0;
			  var valcount = 0;
               jQuery('.box:checked').each(function(){
		       var x1 = jQuery(this).parent().parent().find('.quantity-box input').val();
			   if(x1 == ''){
				   var x1 = 0;
			   }
			    if(x1 == 0.00 || x1 == 0){
					valcount += 1;
			   }
               //x = x.replace("₹","");
		       // alert(jQuery(this).parent().parent().find('.total').text());
               quanttity+=parseFloat(x1);
               });
			   if(valcount == 0){
				   
				   	jQuery('.switch_type').hide();
				 jQuery('.errmsg').hide();
								  jQuery('#zip_input').css('border','1px solid #ccc');
			   }else{
				   jQuery('.switch_type').show();
			   }
			   var esti = 0;
               jQuery('.box:checked').each(function(){
		       var x2 = jQuery(this).parent().parent().find('.esti').text();
               esti+=parseFloat(x2);
               });
			   var brand = "<?php echo $productSku; ?>";
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
			 if(tp == 'MT')
		   {
			   var zipqty = jQuery('.quantity').text();
		   }else{
			    var zipqty = jQuery('.estimate').text();
		   }
		    
			var qtyNew = favorite2.join(", ");
			 var zip = jQuery('#zip_input').val();
							 var noseller1 = jQuery('.black').text();
			//alert(noseller1);
			sellerprice(brand,zip,size,prodqty,tp,esti,qtyNew);
            jQuery('.amount').text('₹'+total.toFixed(2));
 jQuery('.quantity').text(quanttity);
 jQuery('.estimate').text(esti.toFixed(3)); 
			}
			function minus(a,p,proid,m){
				//alert(a+''+p);
				if(Number($('qty'+a).value)>=1){
					$('qty'+a).value=Number($('qty'+a).value)-1;
					}
				var price =$('qty'+a).value * parseFloat(p);
				 var mt =Number($('qty'+a).value) * m;
			    jQuery('#mt'+a).html(mt.toFixed(3)+'MT');	
               jQuery('#total'+a).html('₹'+price.toFixed(2));
			   //jQuery('#mt'+a).html(mt+'MT');
			
			   
				var checkedValue = mt; 
				var checkedValue1 = $('qty'+a).value; 
				 
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
			   if(x1 == ''){
				   var x1 = 0;
			   }
			    if(x1 == 0.00 || x1 == 0){
					valcount += 1;
			   }
               //x = x.replace("₹","");
		       // alert(jQuery(this).parent().parent().find('.total').text());
               quanttity+=parseFloat(x1);
               });
			   if(valcount == 0){
				   
				   	jQuery('.switch_type').hide();
				 jQuery('.errmsg').hide();
								  jQuery('#zip_input').css('border','1px solid #ccc');
			   }else{
				   jQuery('.switch_type').show();
			   }
			   var esti = 0;
               jQuery('.box:checked').each(function(){
		       var x2 = jQuery(this).parent().parent().find('.esti').text();
               esti+=parseFloat(x2);
               });
			   var brand = "<?php echo $productSku; ?>";
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
			 if(tp == 'MT')
		   {
			   var zipqty = jQuery('.quantity').text();
		   }else{
			    var zipqty = jQuery('.estimate').text();
		   }
		    
			var qtyNew = favorite2.join(", ");
			var zip = jQuery('#zip_input').val();
			var noseller1 = jQuery('.black').text();
			//alert(noseller1);
			sellerprice(brand,zip,size,prodqty,tp,esti,qtyNew);
	    if(isNaN(quanttity))
				{
					var quanttity =0;
					
				}
            jQuery('.amount').text('₹'+total.toFixed(2));
            jQuery('.quantity').text(quanttity);
            jQuery('.estimate').text(esti.toFixed(3)); 
			}
		function sellerprice(brand,zip,size,prodqty,tp,zipqty,qtyNew){
		 if(size != '')
		   {
			 jQuery('.spin-wrapper').css("display", "block"); 
				jQuery.ajax({
							url:'<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'steelseller.php'?>',
							type:'POST',
							data:{'brand':brand,'zip':zip,'size':size,'qty':prodqty,'tp':tp,'totalqty':zipqty,'qtyNew':qtyNew},
							success:function(d){
								
								jQuery('.select_seller').show();
						jQuery('.select_seller').html(d);
						 jQuery('.spin-wrapper').css("display", "none"); 
							}
						}); 
		   }
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