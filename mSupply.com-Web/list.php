<?php
ob_start();
include_once 'app/Mage.php';
Mage::app();
$productSku = $_POST['brand'];
$zip = $_POST['dia'];
// print_r($zip);

$array = json_decode($zip, true);
$daiameter = array();
foreach ($array as $key => $value) {
	$daiameter[] = $key;
}
//print_r($daiameter);
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
 
 $array_idsNew = explode(", ", $qtyNew);
 foreach($array_idsNew as $pro_idNew)
 {
	$wordsNew = explode('-', $pro_idNew);
	$qtyselectedNew = trim($wordsNew[0]);
	$pro_idNew = trim($wordsNew[1]);
	 
	$pidNew[$qtyselectedNew] = $pro_idNew; 
 }
 
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
 ->addAttributeToFilter('manufacturer', array('eq' =>$productSku));
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
<span class="dropdown  pull-right">
								    <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">MT<span class="caret"></span></button>
								    <ul class="dropdown-menu cstldd" role="menu" aria-labelledby="menu1">
								      <li role="presentation" id="MT" class="active">MT</li>
									  <li role="presentation" id="bundle">Bundle</li>
									  <li role="presentation" id="Kg">Kg</li>
								    </ul>
</span>
</div>
<div class="table-responsive clear">

<table class="table table-condensed steelmttable clear">
    <thead>
      <tr class="cust-trh">
        <th>Thickness</th>
        <th>Price per <span class="dropdown resp-drop">
								    <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">MT<span class="caret"></span></button>
								    <ul class="dropdown-menu cstldd" role="menu" aria-labelledby="menu1">
								      <li role="presentation" id="MT" class="active">MT</li>
									  <li role="presentation" id="bundle">Bundle</li>
									  <li role="presentation" id="Kg">Kg</li>
								    </ul>
								</span></th>
        <th>Quantity</th>
       
        <th>Item Total</th>
      </tr>
    </thead>
    <tbody class="list1">
    	<?php 
						$currentTime = Mage::getModel('core/date')->date('Y-m-d H:i:s');
						foreach($prod_coll as $key=>$value)
						{
							if($value != ''){
							$product = Mage::getModel('catalog/product')->load($value);
							$diameter1 = $product->getDiameter();
							$special = $product->getSpecialPrice();  
							$ProductToDate = $product->getResource()->formatDate($product->getspecial_to_date(), false); 
		                    if (strtotime($currentTime) < strtotime($ProductToDate . ' ' . $product->getTime())) { 
		                    $price = number_format($special, 2, '.', '');	 
							}else{
						    $price = number_format($product->getPrice(), 2, '.', ''); 
							}
		                    $id = $product->getId();
							$name = $product->getName();
							$a = explode('-',$name);
							$dia = $product->getAttributeText('diameter');
		                ?>
      <tr class="cust-trb" id="listdata">
        <td>
        	<input type="checkbox"  class="box" name="pid[]" disabled maxlength="12" change-type="<?php echo $product->getDiameter();?>-0" data-val= "<?php echo $product->getDiameter();?>-<?php if($pidfixed[$product->getDiameter()][0]){ ?> <?php echo $pidfixed[$product->getDiameter()][0]; ?> <?php }else{ ?>0.00 <?php } ?>" control="<?php echo $product->getDiameter();?>-<?php if($pidfixed[$product->getDiameter()][0]){ ?> <?php echo $pidfixed[$product->getDiameter()][0]; ?> <?php }else{ ?>0 <?php } ?>" data="<?php echo $product->getDiameter();?>" id="pid<?php echo $product->getDiameter();?>" <?php if(in_array($diameter1,$daiametersel ) ){ ?> checked="checked" <?php } ?> maxlength="12" value="<?php echo $product->getId();?>-<?php if($pidfixed[$product->getDiameter()][0]){ ?> <?php echo $pidfixed[$product->getDiameter()][0]; ?> <?php }else{ ?>0 <?php } ?>"/>
        	<span class="mbrandname"><?php echo $dia; ?></span></td>
        <td id="price"><?php echo '-'; ?></td>
        	<td>
							<div class="wrap-qty">				
				
							<div class="qty-set">
								<span class="quantity-box">
									<input type="text" name="qty" disabled data-v-max="9999.99" data-m-dec="2" id="qty<?php echo $product->getDiameter();?>"  ppdid="<?php echo $product->getId();?>" diameter ="<?php echo $product->getDiameter();?>" price = "<?php echo $price;?>" <?php if(!in_array($diameter1,$daiametersel ) ){ ?> disabled <?php } ?> value="0"  class="quantity-input qty" />
									<input type="button" style="display:none"  class="quantity-controls quantity-plus" <?php if(!in_array($diameter1,$daiametersel ) ){ ?> style="display:none" <?php } ?> onclick="plus(<?php echo $product->getDiameter();?>,<?php echo $price;?>,<?php echo $product->getId();?>)" value="">	
									<input type="button" style="display:none" class="quantity-controls quantity-minus" <?php if(!in_array($diameter1,$daiametersel ) ){ ?> style="display:none" <?php } ?> onclick="minus(<?php echo $product->getDiameter();?>,<?php echo $price;?>,<?php echo $product->getId();?>)" value="">
								</span>					
							</div>
							</div>								
							</td>
							<td class="total"><span id="total<?php echo $product->getDiameter();?>"><?php if($pidfixed[$product->getDiameter()][0]){
								$totalqty +=0;
								$totalpice += 0;
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
								echo '0.00'; 
							}else{
								echo $totalqty; 
							}							
							
							?></div></th>
        
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


<script>
 // JQUERY ".Class" SELECTOR.
    jQuery(document).ready(function() {
jQuery( ".qty" ).focus(function() {
	var focusval = jQuery.trim(jQuery(this).val());
	if(focusval == '0.00'){
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
		
			//alert('keyup'+jQuery(this).val().split(".")[0].length);
				/*if(jQuery(this).val().indexOf('.')!=-1){         
            if(jQuery(this).val().split(".")[1].length >= 2){ 
				 if(jQuery(this).val().split(".")[0].length <= 4 && jQuery(this).val().split(".")[1].length <= 1){
					 alert('keypress'+jQuery(this).val().split(".")[0].length);
	return true;
}else{
	if(jQuery(this).val().split(".")[0].length <= 4){
		if(jQuery(this).val().split(".")[1].length >= 2){
			event.preventDefault(); //disable cut,copy,paste
		}
		return true;
	}else{
	event.preventDefault(); //disable cut,copy,paste
	}
				 //return false;
}	
         }
				}*/
            return isNumber(event, this)
        });

    });
	jQuery(document).ready(function() {
repeat = 0
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
	    function calculation(evt, element) {

        var charCode = (evt.which) ? evt.which : event.keyCode
		var proid = jQuery(element).attr('ppdid');
		var a = jQuery(element).attr('diameter');
		var p = parseFloat(jQuery(element).attr('price'));
        var kqty = jQuery(element).val();
		//alert(kqty);
        if(kqty == '' ){
			 var kqty = 0.00;
			 // jQuery(element).val(0);
		 }else if(kqty == 'NaN' ){
			 var kqty = 0.00;
			  jQuery(element).val(0);
		 }
		 else{
			  var kqty = kqty;
		 }
	    var price =kqty * p;
				//var quantity =$('qty'+a).value;
               jQuery('#total'+a).html('₹'+price.toFixed(2));
			   
			    	 var checkedValue = kqty;
			   jQuery('#pid'+a).val(proid+'-'+checkedValue);
                
			   jQuery('#pid'+a).attr('data-val',a+'-'+checkedValue);
			    jQuery('#pid'+a).attr('control',a+'-'+checkedValue);
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
			    if(x1 == 0.00 ){
				    valcount+= 1;
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
	        var zip = jQuery('#zip_input').val();
			var noseller1 = jQuery('.black').text();
			sellerpricelist(zip,quanttity);
            jQuery('.amount').text('₹'+total.toFixed(2));
            jQuery('.quantity').text(quanttity.toFixed(2));	
			
			
		
            

        
    }
    // THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
    function isNumber(evt, element) {

        var charCode = (evt.which) ? evt.which : event.keyCode
		//alert( event.keyCode);
        if (
            //(charCode != 45 || $(element).val().indexOf('-') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
            (charCode != 46 || jQuery(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57)){
				 
				return false;
			}else{
				return true;
			}
        
    }    
 jQuery('.box').change(function(){
	 var isChecked = this.checked;
    
    if(isChecked) {
        jQuery(this).parents("tr:eq(0)").find(".qty").prop("disabled",false);
        jQuery(this).parents("tr:eq(0)").find(".quantity-plus").show();	
        jQuery(this).parents("tr:eq(0)").find(".quantity-minus").show();
//jQuery(this).parents("tr:eq(0)").find(".total").text('₹0');		
    } else {
        jQuery(this).parents("tr:eq(0)").find(".qty").prop("disabled",true);
		jQuery(this).parents("tr:eq(0)").find(".quantity-plus").hide();	
        jQuery(this).parents("tr:eq(0)").find(".quantity-minus").hide();
        jQuery(this).parents("tr:eq(0)").find(".total span").text('₹0');
        jQuery(this).parents("tr:eq(0)").find(".qty").val('0.00');	
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
				   var x1 = 0.00;
			   }
			    if(x1 == 0.00 ){
				    valcount+= 1;
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
			  var zip = jQuery('#zip_input').val();
			var noseller1 = jQuery('.black').text();
			//alert(noseller1);
			sellerpricelist(zip,quanttity);
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
		    jQuery('.quantity').text(quanttity.toFixed(2));
	   }
      
    });
 jQuery('.dropdown-menu li').click(function() {
var type1 = jQuery(this).attr('id');
//alert(type);
jQuery('#menu1').html(type1);
 var diameter = <?php echo $zip; ?>;
	  var dataString = JSON.stringify(diameter);
	   var first = jQuery('input:radio[name=brand]:checked').val();
	    var brand = jQuery('input:radio[name=brand]:checked').val();
		 var tp = jQuery('#menu1').text();
		   if(tp == 'MT')
		   {
			   var zipqty = jQuery('.quantity').text();
		   }else{
			    var zipqty = jQuery('.estimate').text();
		   }
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
							data:{'brand':first,'dia':dataString,'dia1':diameter1,'selqty':qty,'tp':type1, 'qtyNew':qtyNew, 'fixed':fixedqty},
							success:function(d){
								//alert(d);
								jQuery('.list').html(d);
								// jQuery('#zip_input').val('');
								/*jQuery('.amount').text('₹0');
                                jQuery('.quantity').text('0');*/
								jQuery('.select_seller').hide();
								jQuery('.errmsg').hide();
								//jQuery('.switch_type').show();
								jQuery('#zip_input').css('border','1px solid #ccc'); 
								var zip = jQuery('#zip_input').val();
								jQuery('#search_by_zip').trigger( "click" );
							//if(zip != ''){
                            //sellerpricelist(zip);	
							//}
							}
						});
	
}else if(type1 =='Bundle'){
		 jQuery.ajax({
							url:'<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'listtype.php'?>',
							type:'POST',
							data:{'brand':first,'dia':dataString,'dia1':diameter1,'selqty':qty,'tp':type1, 'qtyNew':qtyNew, 'fixed':fixedqty},
							success:function(d){
							jQuery('.list').html(d);
							jQuery('#zip_input').css('border','1px solid #ccc'); 
							var zip = jQuery('#zip_input').val();
							jQuery('#search_by_zip').trigger( "click" );
							}
						});
	
}else{
	 jQuery.ajax({
							url:'<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'listkg.php'?>',
							type:'POST',
							data:{'brand':first,'dia':dataString,'dia1':diameter1,'selqty':qty,'tp':type1, 'qtyNew':qtyNew, 'fixed':fixedqty},
							success:function(d){
								//alert(d);
								jQuery('.list').html(d);
								  jQuery('#zip_input').css('border','1px solid #ccc'); 
								 var zip = jQuery('#zip_input').val();
								 jQuery('#search_by_zip').trigger( "click" );
							//if(zip != ''){
                            //sellerpricelist(zip);	
							//}
							}
						});
}
})
	
			function plus(a,p,proid){
				if(isNaN(parseFloat($('qty'+a).value)))
				{
					var add =0+1.00;
					
				}else{
					var add =parseFloat($('qty'+a).value)+1.00;
				}
				if($('qty'+a).value >= 9999)
				{
					var add = 9999;
				}
				$('qty'+a).value=add.toFixed(2);
				var price =parseFloat($('qty'+a).value) * parseFloat(p);
				//var quantity =$('qty'+a).value;
               jQuery('#total'+a).html('₹'+price.toFixed(2));
			   
			    	 var checkedValue = $('qty'+a).value;
			   jQuery('#pid'+a).val(proid+'-'+checkedValue);
                
			   jQuery('#pid'+a).attr('data-val',a+'-'+checkedValue);
			   jQuery('#pid'+a).attr('control',a+'-'+checkedValue);
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
				   var x1 = 0.00;
			   }
			    if(x1 == 0.00 ){
				    valcount+= 1;
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
	       var zip = jQuery('#zip_input').val();
			var noseller1 = jQuery('.black').text();
			sellerpricelist(zip,quanttity);
            jQuery('.amount').text('₹'+total.toFixed(2));
            jQuery('.quantity').text(quanttity.toFixed(2));	   
				//jQuery('.listdata').each(function(){
 				 //total(); 
			}
			function minus(a,p,proid){
				//alert(a+''+p);
				
				if(Number($('qty'+a).value)>=1){
					if(isNaN(parseFloat($('qty'+a).value)))
				{
					var add =0-1.00;
					
				}else{
					var add =parseFloat($('qty'+a).value)-1.00;
				}
				
				$('qty'+a).value=add.toFixed(2);
				}
				var price =$('qty'+a).value * parseFloat(p);
				var quantity =$('qty'+a).value;
                jQuery('#total'+a).html('₹'+price.toFixed(2));
			   
			    var checkedValue = $('qty'+a).value;
			    jQuery('#pid'+a).val(proid+'-'+checkedValue);
                jQuery('#pid'+a).attr('data-val',a+'-'+checkedValue);
				jQuery('#pid'+a).attr('control',a+'-'+checkedValue);
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
				   var x1 = 0.00;
			   }
			    if(x1 == 0.00 ){
				    valcount+= 1;
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
	           var zip = jQuery('#zip_input').val();
			var noseller1 = jQuery('.black').text();
							sellerpricelist(zip,quanttity);
	   if(isNaN(quanttity))
				{
					var quanttity =0.00;
					
				}
               jQuery('.amount').text('₹'+total.toFixed(2));	
               jQuery('.quantity').text(quanttity.toFixed(2));		   
				//jQuery('.listdata').each(function(){
 				 //total(); 
			}
			function sellerpricelist(zip,quanttity){
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
		     var zipqty = jQuery('.quantity').text();
		   //alert(zipqty);
		   if(size != '')
		   {
		   jQuery('.spin-wrapper').css("display", "block");
			
			//alert(zipqty+"deee"+prodqty+"qtynw"+qtyNew+"fixedqty"+fixedqty+"My favourite sports sdfsdfsd: " + size);
				jQuery.ajax({
							url:'<?php echo Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'steelseller.php'?>',
							type:'POST',
							data:{'brand':brand,'zip':zip,'size':size,'qty':prodqty,'tp':tp,'totalqty':quanttity,'qtyNew':qtyNew},
							success:function(d){
								var vendorrr = jQuery('input:radio[name=vendor]:checked').val();
								//alert(vendorrr);
								jQuery('#deal'+brand).prop('checked', true);
								jQuery('.select_seller').show();
						jQuery('.select_seller').html(d);
						if(typeof(vendorrr)  == "undefined") {
						jQuery('.spin-wrapper').css("display", "none");
						}
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
					   jQuery('.spin-wrapper').css("display", "none"); 
					}, 3000);
					}
}				
            });
						
				 
				 
				
						
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


</style>