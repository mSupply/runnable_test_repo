/**
 * FORM LOGIN
 **/
var LoginPopup = Class.create({
    initialize: function(options) {
        this.options = options;
        this.popup_email 	= $('magestore-sociallogin-popup-email');
		this.email_error 	= $('magestore-email-error');
		this.popup_pass 	= $('magestore-sociallogin-popup-pass');
		this.pass_error 	= $('magestore-pass-error');
		this.image_login	= $('progress_image_login');
		this.invalid_email	= $('magestore-invalid-email');      
		this.email			= this.options.email;
		this.pass			= this.options.pass;
		
		this.login_form_div = $('magestore-login-form');
		this.login_button   = $('magestore-button-sociallogin');
        this.login_form     = $('magestore-sociallogin-form');	
		this.login_form_forgot = $('magestore-sociallogin-form-forgot');
		this.forgot_a 		= $('magestore-forgot-password');
		this.forgot_title	= $('sociallogin-forgot');
		this.forgot_button 	= $('magestore-button-sociallogin-forgot');
		this.forgot_a_back  = $('magestore-forgot-back');
		this.invalid_email_forgot = $('magestore-invalid-email-forgot');
		this.ajax_forgot 	= $('progress_image_login_forgot');
		
		this.create_customer 		= $('magestore-create-user');
		this.create_customer_click 	= $('magestore-sociallogin-create-new-customer');
		this.create_customer_form	= $('magestore-sociallogin-form-create');
		this.create_form_backto_login = $('magestore-create-back');
		this.create_button 			= $('magestore-button-sociallogin-create');
		this.create_ajax 			= $('progress_image_login_create');
		this.create_invalid			= $('magestore-invalid-create');
		
		this.mode			= 'form_login';
		this.bindEventHandlers();
	
    },
	
	login_handler : function(){
		var login_validator = new Validation('magestore-sociallogin-form');		
		if (login_validator.validate()) {
				var parameters = this.login_form.serialize(true);
				var url = this.options.login_url;
				if(window.location.href.slice(0,5)=='https') url= url.replace("http:","https:");
				
				this.showLoginLoading();

				new Ajax.Request(url, {
					method: 'post',
					parameters: parameters,
					onSuccess: function(transport) {
						var result = transport.responseText.evalJSON();
						this.hideLoginLoading();
						if(result.success) {
							if(currentpage == 'checkout/cart' && cartcount != '0'){
							//alert(window.location);
							window.location = window.location;
							
						} else {
							window.location =baseUrl;
						}
						} else {
							this.showLoginError(result.error);
						}
					}.bind(this)
				});
			}
	},	
	sendpass_handler : function(){
		var login_validator_forgot = new Validation('magestore-sociallogin-form-forgot');		
		if (login_validator_forgot.validate()) {
			var parameters = this.login_form_forgot.serialize(true);
			var url = this.options.send_pass_url;
			if(window.location.href.slice(0,5)=='https') url= url.replace("http:","https:");
				
			this.showLoginLoading();

			new Ajax.Request(url, {
				method: 'post',
				parameters: parameters,
				onSuccess: function(transport) {
				var result = transport.responseText.evalJSON();
				this.hideLoginLoading();
				if(result.success) {
						this.hideFormForgot();
						jQuery('#show_forgot_msg').show();
                                        //this.showSendPassError(result.message);
				} else {
					this.showSendPassError(result.error);
					}
				}.bind(this)}
			);
		}
	},
	forgot_handler : function(){	
		this.hideFormLogin();
		this.mode = 'form_forgot';
		this.showFormForgot();	
		jQuery('.magestore-invalid-email').hide();
		jQuery('.validation-advice').hide();	
	},
	showLogin_handler : function(){
		this.hideFormForgot();
		this.hideCreateForm();
		this.mode = 'form_login';
		this.showFormLogin();	
		jQuery('.magestore-invalid-email').hide();	
		jQuery('.validation-advice').hide();
		jQuery('#show_forgot_msg').hide();
	},
	showCreate_handler: function (){
		this.hideFormLogin();
		this.hideFormForgot();
		this.mode = 'form_create';
		this.showCreateForm();
		jQuery('.magestore-invalid-email').hide();
		jQuery('.validation-advice').hide();
		jQuery('#show_forgot_msg').hide();
	},
	createAcc_handler: function (){
		var login_validator_create = new Validation('magestore-sociallogin-form-create');		
		if (login_validator_create.validate()) {
			var parameters = this.create_customer_form.serialize(true);
			var url = this.options.create_url;
			if(window.location.href.slice(0,5)=='https') url= url.replace("http:","https:");				
			this.showLoginLoading();

			new Ajax.Request(url, {
				method: 'post',
				parameters: parameters,
				onSuccess: function(transport) {
				var result = transport.responseText.evalJSON();
				this.hideLoginLoading();
				if(result.success) {
						if(currentpage == 'checkout/cart' && cartcount != '0'){
							//alert(window.location);
						window.location = window.location;
							
						} else {
							window.location =baseUrl;
						}
				} else {
					this.showCreateError(result.error);
					}
				}.bind(this)}
			);
		}
	},
	bindEventHandlers: function() {       
        /* Now bind the submit button for logging in */
		if(this.login_button){
			this.login_button.observe(
				'click', this.login_handler.bind(this));
		}       
		if (this.forgot_a){
			this.forgot_a.observe(
				'click', this.forgot_handler.bind(this));
		}
		if (this.forgot_a_back){
			this.forgot_a_back.observe(
				'click', this.showLogin_handler.bind(this));
		}
		if (this.forgot_button){
			this.forgot_button.observe(
				'click', this.sendpass_handler.bind(this));
		}
		if(this.create_customer_click){
			this.create_customer_click.observe(
				'click', this.showCreate_handler.bind(this));
		}
		if (this.create_form_backto_login){
			this.create_form_backto_login.observe(
				'click', this.showLogin_handler.bind(this));
		}
		if (this.create_button){
			this.create_button.observe(
				'click', this.createAcc_handler.bind(this));
		}
		document.observe('keypress', this.keypress_handler.bind(this));		
    },
	keypress_handler : function (e){
	//alert('sjdgndfhg');
		var code = e.keyCode || e.which;
		if (code == 13){
			if (this.mode == 'form_login'){
				this.login_handler();
			}else if(this.mode == 'form_forgot'){
				this.sendpass_handler();
			}else if (this.mode == 'form_create'){
				this.createAcc_handler();
			}else{}
		}
	},
	showLoginLoading : function(){
		this.image_login.style.display = "block";
		this.ajax_forgot.style.display = "block";
		this.create_ajax.style.display = "block"
	},
	hideLoginLoading : function(){
		this.image_login.style.display = "none";
		this.ajax_forgot.style.display = "none";
		this.create_ajax.style.display = "none"
	},
	showLoginError	: function(error){
		this.invalid_email.show();
		this.invalid_email.update(error);
	},	
	hideFormLogin : function (){
		this.login_form.style.display = "none";	
		
	},
	showFormLogin : function (){		
		this.login_form.style.display = "block";
		jQuery(".main-container").css("-webkit-filter","blur(8px)");
		jQuery(".promise").css("-webkit-filter","blur(8px)");
		jQuery(".footer-block").css("-webkit-filter","blur(8px)");
		jQuery(".seo_section").css("-webkit-filter","blur(8px)");
		jQuery(".magestore-login-form-popup input[type='text']").focus();
	},
	hideFormForgot : function (){
		this.forgot_title.style.display = "none";
		this.login_form_forgot.style.display = "none";		
	},
	showFormForgot : function (){
		this.forgot_title.style.display = "block";
		this.login_form_forgot.style.display = "block";		
	},
	showSendPassError: function (error){
		this.invalid_email_forgot.show();
		this.invalid_email_forgot.update(error);
	},
	showCreateForm : function (){
		this.login_form_div.style.display = "none";
		this.create_customer_click.style.display = "none";
		this.create_customer.style.display = "block";
		jQuery(".main-container").css("-webkit-filter","blur(8px)");
		jQuery(".promise").css("-webkit-filter","blur(8px)");
		jQuery(".footer-block").css("-webkit-filter","blur(8px)");
		jQuery(".seo_section").css("-webkit-filter","blur(8px)");
		jQuery(".magestore-register-form-popup .form-list li:first-child input").focus();	
	},
	hideCreateForm : function (){
		this.create_customer.style.display = "none";		
		this.login_form_div.style.display = "block";
		this.create_customer_click.style.display = "block";
	},
	showCreateError : function (error){
		this.create_invalid.show();
		this.create_invalid.update(error);	
	}
});
        function showOtherButton(){
        	$('social_login_popup').show();
        socialLogin._centerWindow('sociallogin_button');
		socialLogin._centerWindow('magestore-popup_social');
        }
		function hideShownButtons(number){
			i = 0;
			$$('#social_login_popup ul li').each(function(el){
				if(i<number){
					el.hide();
					i++;
				}else el.show();
			});
		}
jQuery(document).ready(function(){
			jQuery("#sociallogin-close-popup").click(function(){
				jQuery(".main-container").css("-webkit-filter","blur(0)");
				jQuery(".promise").css("-webkit-filter","blur(0px)");
				jQuery(".footer-block").css("-webkit-filter","blur(0px)");
				jQuery(".seo_section").css("-webkit-filter","blur(0px)");
			});
			jQuery( "#bg_fade" ).click(function() {
  				jQuery(".main-container").css("-webkit-filter","blur(0)");
  				jQuery(".promise").css("-webkit-filter","blur(0px)");
				jQuery(".footer-block").css("-webkit-filter","blur(0px)");
				jQuery(".seo_section").css("-webkit-filter","blur(0px)");
				jQuery('form#magestore-sociallogin-form-create input[type="text"],input[type="password"],texatrea, select').val(''); 
				jQuery('form#magestore-sociallogin-form-forgot input[type="text"],texatrea, select').val(''); 
				jQuery('form#magestore-sociallogin-form input[type="text"],input[type="password"],texatrea, select').val('');
				jQuery('.removecheckox').removeAttr('checked');
				jQuery('span[id="primary_select"]').remove();
				jQuery('.hida').show();
  			});
	});
