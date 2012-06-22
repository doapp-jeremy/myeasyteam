/**
 * This will do a jquery form plugin::ajaxForm() submission. 
 * Any errors will be automatically displayed after the input in the form (using a <div class=help-block>).
 * For this to work, the id's of inputs must match the cakePHP model and field name convention (aka ModelNameFieldName)
 * 
 * REQUIRES jquery.form plugin
 * 
 * Usage:
 *  $('#exampleForm').cakeAjaxForm();
 *  
 * @param options
 *   beforeSubmit: override default jquery.form::ajaxForm method. function(formData, jqForm, options) are passed to method.
 *   success: override default jquery.form::ajaxForm method. function(data, statusText, xhr, jqForm) are passed to method.
 *   error: override default jquery.form::ajaxForm method. function() are passed to method.
 *   spinnerHandle: jquery handle to a spinner to show()/hide() when processing;
 */
$.fn.cakeAjaxForm = function(options) {
    var beforeSubmitMethod, successMethod, errorMethod; 
    
    if(undefined == options) options = '';
    
    if(options.beforeSubmit) beforeSubmitMethod = options.beforeSubmit;
    else {
    	beforeSubmitMethod = function(formData, jqForm, options) {
    		if(options.spinnerHandle) options.spinnerHandle.show();
            $('#errorMsg span, #successMsg span').html('');
            $('#errorMsg, #successMsg').hide();
            $('#inputError').remove();
            $('.control-group',jqForm).removeClass('error');
            
            return true; 
        };
    }
    
    if(options.success) successMethod = options.success;
    else {
    	successMethod = function(data, statusText, xhr, jqForm)  { 
    		if(options.spinnerHandle) options.spinnerHandle.hide();

        	if(!data.success){
        		if(data.message){
	        		$('#errorMsg span').html(data.message);
	            	$('#errorMsg').show();
        		}
        		
            	//If there were errors, add input error messages
            	if(data.fieldMessages) {
	            	jQuery.each(data.fieldMessages, function(domId, theMessage) {
	            		var theId = $('#'+domId,jqForm);
	            		theId.parents('.control-group').addClass('error');	            		
	            		theId.after('<div class="help-block inputError">' + theMessage + '</div>');
	            	});
            	}
            }
        	else {
        		if(data.message){
	        		$('#successMsg span').html(data.message);
	            	$('#successMsg').show().fadeOut(10000);
        		}
            	            	
            	//If you want to redirect have a key named redirectURL in json return 
        		if(data.redirectURL) window.location.replace(data.redirectURL);
        		
        		//Optioinally update input values and HTML elements
        		else if(data.domIdValues) {
	            	jQuery.each(data.domIdValues, function(domId, theValue) {	       		
	                	$('#'+domId).val(theValue);
	            	});

	            	jQuery.each(data.domIdHTMLs, function(domId, theHtml) {        		
	                	$('#'+domId).html(theHtml);
	            	});
            	}
            }
        };
    }
    
    if(options.error) errorMethod = options.error;
    else {
    	errorMethod = function() {
    		$('#errorMsg span').html('JSON post failed. See browser console.');
        	$('#errorMsg').show();        	
		};
    }
    
    this.ajaxForm({
        delegation: true,
        dataType:  'json',
        beforeSubmit: beforeSubmitMethod,            
        success: successMethod,
        error: errorMethod
    });    
};