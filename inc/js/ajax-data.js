jQuery(document).ready(function($) {
$('.dfu-form-save').on('click', function(evt){
evt.preventDefault();
$(this).attr("disabled", true);
$('.spinner-save').css('visibility', 'visible');
var errCount = [];
if($('.dfu-notification').is(':checked')){

	var getEmailStatus = $.trim($('.notify-email').val());
	if(getEmailStatus.length == ''){
	errCount.push('err1');
	$('.notice').remove();
    $('.error-occured').html('<div class="notice notice-error is-dismissible"><p>Notification email is missing !</p></div>');
    $('.dfu-form-save').attr("disabled", false);
    $('.spinner-save').css('visibility', 'hidden');
	}else{
	var emailRegex =  /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	if(!emailRegex.test(getEmailStatus)){
	errCount.push('err1');
	$('.notice').remove();
    $('.error-occured').html('<div class="notice notice-error is-dismissible"><p>Notification email is invalid !</p></div>');
    $('.dfu-form-save').attr("disabled", false);
    $('.spinner-save').css('visibility', 'hidden');
	}
	}
}


if($('.demo-field-block').length > 0){
	var combineShortcode = '';
	$('.demo-field-block').each(function() {
		combineShortcode += $(this).find('.shortcode-combine').val()+" ";
	});
    
}else{
    errCount.push('err1');
	$('.notice').remove();
    $('.error-occured').html('<div class="notice notice-error is-dismissible"><p>Input field not found ! Create at least one input field.</p></div>');
    $('.dfu-form-save').attr("disabled", false);
    $('.spinner-save').css('visibility', 'hidden');	
}


if(errCount.length == 0){
var formData = $('.dfu-form-main').serializeArray();

formData.push({name :'action', value :'difu_form_insert_action'}, {name: 'form-content', value: combineShortcode});
$.ajax({
type: "POST",
url: dfuInsert.admin_ajax,
dataType: "json",
data: formData,
success: function(res) {

if(res['value'] == 1){

window.location.href = "admin.php?page=tiger-forms&actions=edit&post="+res['id'];

}
if(res['value'] == 2){

$('.error-occured').html('<div class="notice notice-error is-dismissible"><p>Something went wrong, please refresh the current page and try again.</p></div>');
$('.dfu-form-save').attr("disabled", false);
$('.spinner-save').css('visibility', 'hidden');
}
}
});
}
});


$('.dfu-form-delete').on('click', function(evt){
evt.preventDefault();

var getId = $('#formid').val();
var getNonce = $('#wp_nonce').val();

if(getId != '' && getNonce != ''){
if(confirm('Are you sure to delete this form permanently? Remember, any data inserted through this form will remain.')){

$('.dfu-form-delete').attr("disabled", true);
$('.spinner-delete').css('visibility', 'visible');
 
$.ajax({
type: "POST",
url: dfuDeleteUpdate.admin_ajax,
dataType: "json",
data: {action : 'difu_delete_published_form', id : getId, nonce: getNonce},
success: function(resDelete) {
  
  if(resDelete['value'] == 1){
    window.location.href = "admin.php?page=tiger-forms";
  }

  if(resDelete['value'] == 2){
   $('.error-occured').html('<div class="notice notice-error is-dismissible"><p>Something went wrong, please refresh the current page and try again.</p></div>');
   $('.dfu-form-delete').attr("disabled", false);
   $('.spinner-delete').css('visibility', 'hidden');
  }

}
});

}  

}else{

$('.error-occured').html('<div class="notice notice-error is-dismissible"><p>Something went wrong, please refresh the current page and try again.</p></div>');

}

});


$('.dfu-form-update').on('click', function(evt){
evt.preventDefault();
$(this).attr("disabled", true);
$('.spinner-update').css('visibility', 'visible');
var errCount = [];
if($('.dfu-notification').is(':checked')){

	var getEmailStatus = $.trim($('.notify-email').val());
	if(getEmailStatus.length == ''){
	errCount.push('err1');
	$('.notice').remove();
    $('.error-occured').html('<div class="notice notice-error is-dismissible"><p>Notification email is missing !</p></div>');
    $('.dfu-form-update').attr("disabled", false);
    $('.spinner-update').css('visibility', 'hidden');
	}else{
	var emailRegex =  /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	if(!emailRegex.test(getEmailStatus)){
	errCount.push('err1');
	$('.notice').remove();
    $('.error-occured').html('<div class="notice notice-error is-dismissible"><p>Notification email is invalid !</p></div>');
    $('.dfu-form-update').attr("disabled", false);
    $('.spinner-update').css('visibility', 'hidden');
	}
	}
}
if($('.demo-field-block').length > 0){
	var combineShortcode = '';
	$('.demo-field-block').each(function() {
		combineShortcode += $(this).find('.shortcode-combine').val()+" ";
	});
    
}else{
    errCount.push('err1');
	$('.notice').remove();
    $('.error-occured').html('<div class="notice notice-error is-dismissible"><p>Input field not found ! Create at least one input field.</p></div>');
    $('.dfu-form-save').attr("disabled", false);
    $('.spinner-save').css('visibility', 'hidden');	
}

if(errCount.length == 0){
var formData = $('.dfu-form-main-update').serializeArray();

formData.push({name :'action', value :'difu_update_published_form'}, {name: 'form-content-up', value: combineShortcode});
$.ajax({
type: "POST",
url: dfuUpdate.admin_ajax,
dataType: "json",
data: formData,
success: function(returnUpdate) {

if(returnUpdate['value'] == 1){

window.location.href = "admin.php?page=tiger-forms&actions=edit&post="+returnUpdate['id'];

}
if(returnUpdate['value'] == 2){

$('.error-occured').html('<div class="notice notice-error is-dismissible"><p>Something went wrong, please refresh the current page and try again.</p></div>');
$('.dfu-form-update').attr("disabled", false);
$('.spinner-update').css('visibility', 'hidden');
}
}
});
}
});

});