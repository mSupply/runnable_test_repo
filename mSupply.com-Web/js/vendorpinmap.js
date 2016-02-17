jQuery(document).ready(function(){
	jQuery('#vendor_id').change(function(e){
		var name = jQuery.trim(jQuery(this).find('option:selected').text().split(' (')[0]);
		var code = jQuery.trim(jQuery(this).find('option:selected').text().split(' (')[1].split(')')[0]);
		jQuery('#seller_name').val(name);
		jQuery('#seller_code').val(code);
	});
});