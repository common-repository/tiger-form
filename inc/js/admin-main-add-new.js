(function($) {
$(document).ready(function() {
  var generateNumber = Math.floor(Math.random() * 1000); 
  var combineTypeNumber = 'email-'+generateNumber;
  var txtToAdd = "[dfu_email* name='email-address' label='Enter your email' unique='yes']";
  $('.difu-add-newform').append('<div class="demo-field-block" oncontextmenu="return false" id="'+combineTypeNumber+'"><div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit" data-id="'+combineTypeNumber+'" style="color: #00b72e;cursor: pointer;" data-type="email"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label data-required="*">Enter your email</label><span style="color:red;">*</span><input style="height: 40px;border-radius: 2px;" class="difu-demo-field" data-class="" type="email" name="email-address" value="" placeholder="example@domain.com" data-unique="yes"><input type="hidden" class="shortcode-combine" value="'+txtToAdd+'" disabled></div>');
	var generateNumber1 = Math.floor(Math.random() * 1000); 
  var combineTypeNumber1 = 'submit-'+generateNumber1;
  var txtToAdd1 = "[dfu_submit name='difu-button' label='Subscribe']";
  $('.difu-add-newform').append('<div class="demo-field-block" oncontextmenu="return false" oncontextmenu="return false" id="'+combineTypeNumber1+'"><div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit-submit" data-id="'+combineTypeNumber1+'" style="color: #00b72e;cursor: pointer;" data-type="submit"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><button type="button" style="margin-left: 10px; border-radius: 2px;padding: 10px 20px;font-size: 15px;cursor: pointer;" class="difu-demo-field" data-class="" name="difu-button">Subscribe</button><input type="hidden" class="shortcode-combine" value="'+txtToAdd1+'" disabled></div>');
  inputNameBlur("text");
  inputNameBlur("email");
  inputNameBlur("url");
  inputNameBlur("date");
  inputNameBlur("number");
  inputNameBlur("textarea");
  inputNameBlur("select");
  inputNameBlur("radio");
  inputNameBlur("submit");

  function shorttab(id){
	$('.hidden-div').css('display', 'none');
	$('body').css('overflow', 'hidden');
	$('#'+id).css('display', '');
   field_reset(id);
   name_field_reset(id);
	$('.hidden-content').fadeIn();
   }
  $('.short-tab-added').on('click',function(){
    shorttab($(this).data('id'));
  });
  
  var hiddenDivClose = function(evt){
  evt.stopPropagation();
  $('.hidden-content').fadeOut();
  $('.hidden-div').css('display', 'none');
  $('body').css('overflow', '');
  if($('.difu-fieldInsertionbtn').attr('data-id') != undefined){
   $('.difu-fieldInsertionbtn').removeAttr('data-id');
  }
 }
 $('.hidden-div').on('click',hiddenDivClose);
 $('.dfu-hidden-content-close').on('click', hiddenDivClose);
 $('.hidden-content').on('click', function(evtt){
   evtt.stopPropagation();
 });

 $('.required-field').on('click',function(){
   var getType = $(this).data('type');
   var getThis = '.required-field';
   chehckOrNot(getType, getThis);
 });

function chehckOrNot(ttype, thisclick){
	var getValue =  $('#'+ttype+'-data-contain1').val();
	if ($(thisclick).is(':checked')) {
  $(thisclick).val('yes');
	var split = getValue.split(' ');
	split.splice(split.indexOf("[dfu_"+ttype), 1, "[dfu_"+ttype+"*");
	var string = split.toString();
	$('#'+ttype+'-data-contain1').val(string.replace(/,/g, ' '));
  var getNewValue = $('#'+ttype+'-data-contain').val();
  var getValue = $('#'+ttype+'-data-contain1').val();
  var splitCurrentValue = getValue.split(" ");
  var splitNewValue = getNewValue.split(',');
    
  $.each(splitNewValue, function(i, val){
    splitCurrentValue.push(val.replace(/-/g, ' '));
  });
  var convertString = splitCurrentValue.toString();
  var finalOutput = convertString.replace(/\[/g, '').replace(/\]/g, '');
  $('.fieldInsertion-'+ttype).val("["+finalOutput.replace(/,/g, ' ')+"]");
	}else{
  $(thisclick).val('');
  var split = getValue.split(' ');
	split.splice(split.indexOf("[dfu_"+ttype+"*"), 1, "[dfu_"+ttype);
	var string = split.toString();
	$('#'+ttype+'-data-contain1').val(string.replace(/,/g, ' '));
  var getNewValue = $('#'+ttype+'-data-contain').val();
  var getValue = $('#'+ttype+'-data-contain1').val();
  var splitCurrentValue = getValue.split(" ");
  var splitNewValue = getNewValue.split(',');
  $.each(splitNewValue, function(i, val){
    splitCurrentValue.push(val.replace(/-/g, ' '));
  });
  var convertString = splitCurrentValue.toString();
  var finalOutput = convertString.replace(/\[/g, '').replace(/\]/g, '');
  $('.fieldInsertion-'+ttype).val("["+finalOutput.replace(/,/g, ' ')+"]");
	}
}

$('.name-field').on('blur',function(){
	var getType = $(this).data('type');
    inputNameBlur(getType);
});

function inputNameBlur(fieldType){
	  fieldArr = fieldType.split(" ");
    $.each(fieldArr, function(i, val){
    if($('.'+val+'-name-field').val() == ''){
	  var generateNumber = Math.floor(Math.random() * 1000); 
    var combineTypeNumber = val+'-'+generateNumber;
    var getValue = $('#'+val+'-data-contain1').val();
    var split = getValue.split(' ');
    if (split[1] == '') {
    split.push("name='"+combineTypeNumber+"'");
    }else{
    split.splice(1, 1, "name='"+combineTypeNumber+"'");
    }
    var string = split.toString();
    $('.'+val+'-name-field').val(combineTypeNumber);
	  $('#'+fieldType+'-data-contain1').val(string.replace(/,/g, ' ').replace(/\]/g, '')+"]");
	  var getNewValue = $('#'+val+'-data-contain').val();
    var getValue = $('#'+val+'-data-contain1').val();
    var splitCurrentValue = getValue.split(" ");
    var splitNewValue = getNewValue.split(',');
    
    $.each(splitNewValue, function(i, val){
     splitCurrentValue.push(val.replace(/-/g, ' '));
    });

    var convertString = splitCurrentValue.toString();
    var finalOutput = convertString.replace(/\[/g, '').replace(/\]/g, '');
    $('.fieldInsertion-'+val).val("["+finalOutput.replace(/,/g, ' ')+"]");
    }else{
    var getFieldValue = $('.'+val+'-name-field').val();
    getFieldValue = $.trim(getFieldValue).replace(/\s+/g, '-').toLowerCase();
    $('.'+val+'-name-field').val(getFieldValue );
    var getValue = $('#'+fieldType+'-data-contain1').val();
    var split = getValue.split(' ');
    if (split[1] == '') {
    split.push("name='"+getFieldValue+"'");
    }else{
    split.splice(1, 1, "name='"+getFieldValue+"'");
    }
    var string = split.toString();
  	$('#'+fieldType+'-data-contain1').val(string.replace(/,/g, ' ').replace(/\]/g, '')+"]");
    var getNewValue = $('#'+fieldType+'-data-contain').val();
    var getValue = $('#'+fieldType+'-data-contain1').val();
    var splitCurrentValue = getValue.split(" ");
    var splitNewValue = getNewValue.split(',');
    
    $.each(splitNewValue, function(i, val){
     splitCurrentValue.push(val.replace(/-/g, ' '));
    });

    var convertString = splitCurrentValue.toString();
    var finalOutput = convertString.replace(/\[/g, '').replace(/\]/g, '');
    $('.fieldInsertion-'+fieldType).val("["+finalOutput.replace(/,/g, ' ')+"]");
    }
    });
}

$('.label-field').on('blur',function(){
  labelplaceholdervalueclass($(this).data('type'));
});

$('.value-field').on('blur',function(){
  labelplaceholdervalueclass($(this).data('type'));
});

$('.placeholder-field').on('blur',function(){
 labelplaceholdervalueclass($(this).data('type'));
});

$('.class-field').on('blur',function(){
 labelplaceholdervalueclass($(this).data('type'));
});

$('.max-field').on('blur',function(){
 labelplaceholdervalueclass($(this).data('type'));
});

$('.min-field').on('blur',function(){
 labelplaceholdervalueclass($(this).data('type'));
});

$('.option-field').on('blur',function(){
 labelplaceholdervalueclass($(this).data('type'));
});

$('.defaultselect-field').on('blur',function(){
 labelplaceholdervalueclass($(this).data('type'));
});

function labelplaceholdervalueclass(fieldTypeAnother){
    
    var arrayData = [];
    $('.'+fieldTypeAnother+'-common-feild').each(function(){
    	if($(this).val() != ''){
    	var fieldName = $(this).data('field'); 
    	var valueNewFormate = fieldName+"='"+$.trim($(this).val())+"'";
    	var valueForamting = valueNewFormate.replace(/\s+/g, '-');
    	arrayData.push(valueForamting);
    }
    });
    $('#'+fieldTypeAnother+'-data-contain').val('');
    $('#'+fieldTypeAnother+'-data-contain').val(arrayData);
    var getNewValue = $('#'+fieldTypeAnother+'-data-contain').val();
    var getValue = $('#'+fieldTypeAnother+'-data-contain1').val();
    var splitCurrentValue = getValue.split(" ");
    var splitNewValue = getNewValue.split(',');
    $.each(splitNewValue, function(i, val){
     splitCurrentValue.push(val.replace(/-/g, ' '));
    });
    var convertString = splitCurrentValue.toString();
    var finalOutput = convertString.replace(/\[/g, '').replace(/\]/g, '');
    $('.fieldInsertion-'+fieldTypeAnother).val("["+finalOutput.replace(/,/g, ' ')+"]");
}

$('.readonly-field').on('click',function(){
  var getType = $(this).data('type');
  if ($(this).is(':checked')) {
   $(this).val('yes');
  }else{
   $(this).val('no');
  }
  readonly(getType);
});

$('.unique-field').on('click',function(){
  var getType = $(this).data('type');
  if ($(this).is(':checked')) {
   $(this).val('yes');
  }else{
   $(this).val('no');
  }
  readonly(getType);
});
/*
$('.multiselect-field').on('click',function(){
  var getType = $(this).data('type');

  if ($(this).is(':checked')) {
   $(this).val('yes');
  }else{
   $(this).val('no');
  }

  readonly(getType);

});
*/

function readonly(tttype){
	var arrayData = [];
    $('.'+tttype+'-common-feild').each(function(){
    	if($(this).val() != ''){
    	var fieldName = $(this).data('field'); 
    	var valueNewFormate = fieldName+"='"+$.trim($(this).val())+"'";
    	var valueForamting = valueNewFormate.replace(/\s+/g, '-');
    	arrayData.push(valueForamting);
    }
    });
    $('#'+tttype+'-data-contain').val('');
    $('#'+tttype+'-data-contain').val(arrayData);
    var getNewValue = $('#'+tttype+'-data-contain').val();
    var getValue = $('#'+tttype+'-data-contain1').val();
    var splitCurrentValue = getValue.split(" ");
    var splitNewValue = getNewValue.split(',');
    $.each(splitNewValue, function(i, val){
     splitCurrentValue.push(val.replace(/-/g, ' '));
    });
    var convertString = splitCurrentValue.toString();
    var finalOutput = convertString.replace(/\[/g, '').replace(/\]/g, '');
    $('.fieldInsertion-'+tttype).val("["+finalOutput.replace(/,/g, ' ')+"]");
}

$( ".hint-icon" )
  .mouseover(function() {
    $( this ).closest('.cel-3').append("<div class='hint-content'>"+$( this ).data('info')+"</div>");
  })
  .mouseout(function() {
    $( '.hint-content' ).remove();
});

 $(".difu-fieldInsertionbtn").on('click', function() {
 	 var getType = $(this).data('type');
   var txtToAdd = $.trim($('.fieldInsertion-'+getType).val());
   if(txtToAdd != ''){
   if(getType == 'text'){
    var getLabel = $('[name='+getType+'-field-label]').val();
    var getRequired = $('[name='+getType+'-field-required]').val();
    var getName = $('[name='+getType+'-field-name]').val();
    var getClass = $('[name='+getType+'-field-class]').val();

    if(getLabel != '' && $('[name='+getType+'-field-required]').is(':checked')){
      getRequired = '*';
    }else{
      getRequired = '';
    }
    var getvalue = $('[name='+getType+'-field-value]').val();
    if($('[name='+getType+'-field-readonly]').is(':checked')){
    var getreadonly = 'readonly';
    }else{
    var getreadonly = '';
    }
    if($('[name='+getType+'-field-unique]').is(':checked')){
    var getUnique = $('[name='+getType+'-field-unique]').val();
    }else{
    var getUnique = '';
    }
    var getplaceholder = $('[name='+getType+'-field-placeholder]').val();
    if($(this).attr('data-id') != undefined){
     $('.difu-form-demo').find('#'+$(this).attr('data-id')).empty();
     $('.difu-form-demo').find('#'+$(this).attr('data-id')).append('<div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit" data-id="'+$(this).attr('data-id')+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label data-required="'+getRequired+'">'+getLabel+'</label><span style="color:red;">'+getRequired+'</span><input style="height: 40px;border-radius: 2px;" class="difu-demo-field" data-class="'+getClass+'" data-unique="'+getUnique+'" type="text" name="'+getName+'" value="'+getvalue+'" placeholder="'+getplaceholder+'" '+getreadonly+'><input type="hidden" class="shortcode-combine" value="'+txtToAdd+'" disabled>');
     $(this).removeAttr('data-id');
    }else{
     var generateNumber = Math.floor(Math.random() * 1000); 
     var combineTypeNumber = getType+'-'+generateNumber;
     $('.difu-form-demo').append('<div class="demo-field-block" oncontextmenu="return false" id="'+combineTypeNumber+'"><div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit" data-id="'+combineTypeNumber+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label data-required="'+getRequired+'">'+getLabel+'</label><span style="color:red;">'+getRequired+'</span><input style="height: 40px;border-radius: 2px;" class="difu-demo-field" data-class="'+getClass+'" data-unique="'+getUnique+'" type="text" name="'+getName+'" value="'+getvalue+'" placeholder="'+getplaceholder+'" '+getreadonly+'><input type="hidden" class="shortcode-combine" value="'+txtToAdd+'" disabled></div>');
    }
   }else if(getType == 'email'){
    var getLabel = $('[name='+getType+'-field-label]').val();
    var getRequired = $('[name='+getType+'-field-required]').val();
    var getName = $('[name='+getType+'-field-name]').val();
    var getClass = $('[name='+getType+'-field-class]').val();
    
    if(getLabel != '' && $('[name='+getType+'-field-required]').is(':checked')){
      getRequired = '*';
    }else{
      getRequired = '';
    }
    var getvalue = $('[name='+getType+'-field-value]').val();
    if($('[name='+getType+'-field-readonly]').is(':checked')){
    var getreadonly = 'readonly';
    }else{
    var getreadonly = '';
    }
    if($('[name='+getType+'-field-unique]').is(':checked')){
    var getUnique = $('[name='+getType+'-field-unique]').val();
    }else{
    var getUnique = '';
    }
    var getplaceholder = $('[name='+getType+'-field-placeholder]').val();
    if($(this).attr('data-id') != undefined){
     $('.difu-form-demo').find('#'+$(this).attr('data-id')).empty();
     $('.difu-form-demo').find('#'+$(this).attr('data-id')).append('<div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit" data-id="'+$(this).attr('data-id')+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label data-required="'+getRequired+'">'+getLabel+'</label><span style="color:red;">'+getRequired+'</span><input style="height: 40px;border-radius: 2px;" class="difu-demo-field" data-class="'+getClass+'" data-unique="'+getUnique+'" type="email" name="'+getName+'" value="'+getvalue+'" placeholder="'+getplaceholder+'" '+getreadonly+'><input type="hidden" class="shortcode-combine" value="'+txtToAdd+'" disabled>');
     $(this).removeAttr('data-id');
    }else{
     var generateNumber = Math.floor(Math.random() * 1000); 
     var combineTypeNumber = getType+'-'+generateNumber;
     $('.difu-form-demo').append('<div class="demo-field-block" oncontextmenu="return false" id="'+combineTypeNumber+'"><div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit" data-id="'+combineTypeNumber+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label data-required="'+getRequired+'">'+getLabel+'</label><span style="color:red;">'+getRequired+'</span><input style="height: 40px;border-radius: 2px;" class="difu-demo-field" data-class="'+getClass+'" data-unique="'+getUnique+'" type="email" name="'+getName+'" value="'+getvalue+'" placeholder="'+getplaceholder+'" '+getreadonly+'><input type="hidden" class="shortcode-combine" value="'+txtToAdd+'" disabled></div>');
    }
   }else if(getType == 'url'){
    var getLabel = $('[name='+getType+'-field-label]').val();
    var getRequired = $('[name='+getType+'-field-required]').val();
    var getName = $('[name='+getType+'-field-name]').val();
    var getClass = $('[name='+getType+'-field-class]').val();
    if(getLabel != '' && $('[name='+getType+'-field-required]').is(':checked')){
      getRequired = '*';
    }else{
      getRequired = '';
    }
    var getvalue = $('[name='+getType+'-field-value]').val();
    if($('[name='+getType+'-field-readonly]').is(':checked')){
    var getreadonly = 'readonly';
    }else{
    var getreadonly = '';
    }
    var getplaceholder = $('[name='+getType+'-field-placeholder]').val();
    if($(this).attr('data-id') != undefined){
     $('.difu-form-demo').find('#'+$(this).attr('data-id')).empty();
     $('.difu-form-demo').find('#'+$(this).attr('data-id')).append('<div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit" data-id="'+$(this).attr('data-id')+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label data-required="'+getRequired+'">'+getLabel+'</label><span style="color:red;">'+getRequired+'</span><input style="height: 40px;border-radius: 2px;" class="difu-demo-field" data-class="'+getClass+'" type="url" name="'+getName+'" value="'+getvalue+'" placeholder="'+getplaceholder+'" '+getreadonly+'><input type="hidden" class="shortcode-combine" value="'+txtToAdd+'" disabled>');
     $(this).removeAttr('data-id');
    }else{
     var generateNumber = Math.floor(Math.random() * 1000); 
     var combineTypeNumber = getType+'-'+generateNumber;
     $('.difu-form-demo').append('<div class="demo-field-block" oncontextmenu="return false" id="'+combineTypeNumber+'"><div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit" data-id="'+combineTypeNumber+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label data-required="'+getRequired+'">'+getLabel+'</label><span style="color:red;">'+getRequired+'</span><input style="height: 40px;border-radius: 2px;" class="difu-demo-field" data-class="'+getClass+'" type="url" name="'+getName+'" value="'+getvalue+'" placeholder="'+getplaceholder+'" '+getreadonly+'><input type="hidden" class="shortcode-combine" value="'+txtToAdd+'" disabled></div>');
    }

   }else if(getType == 'number'){
    var getLabel = $('[name='+getType+'-field-label]').val();
    var getRequired = $('[name='+getType+'-field-required]').val();
    var getName = $('[name='+getType+'-field-name]').val();
    var getClass = $('[name='+getType+'-field-class]').val();
    
    if(getLabel != '' && $('[name='+getType+'-field-required]').is(':checked')){
      getRequired = '*';
    }else{
      getRequired = '';
    }
    var getvalue = $('[name='+getType+'-field-value]').val();
    if($('[name='+getType+'-field-readonly]').is(':checked')){
    var getreadonly = 'readonly';
    }else{
    var getreadonly = '';
    }
    if($('[name='+getType+'-field-unique]').is(':checked')){
    var getUnique = $('[name='+getType+'-field-unique]').val();
    }else{
    var getUnique = '';
    }
    var getplaceholder = $('[name='+getType+'-field-placeholder]').val();
    var maxLength = $('[name='+getType+'-field-max]').val();
    var minLength = $('[name='+getType+'-field-min]').val();
    if($(this).attr('data-id') != undefined){
     $('.difu-form-demo').find('#'+$(this).attr('data-id')).empty();
     $('.difu-form-demo').find('#'+$(this).attr('data-id')).append('<div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit" data-id="'+$(this).attr('data-id')+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label data-required="'+getRequired+'">'+getLabel+'</label><span style="color:red;">'+getRequired+'</span><input style="height: 40px;border-radius: 2px;" class="difu-demo-field" data-class="'+getClass+'" data-unique="'+getUnique+'" type="number" name="'+getName+'" value="'+getvalue+'" maxlength="'+maxLength+'" minlength="'+minLength+'" placeholder="'+getplaceholder+'" '+getreadonly+'><input type="hidden" class="shortcode-combine" value="'+txtToAdd+'" disabled>');
     $(this).removeAttr('data-id');
    }else{
     var generateNumber = Math.floor(Math.random() * 1000); 
     var combineTypeNumber = getType+'-'+generateNumber;
     $('.difu-form-demo').append('<div class="demo-field-block" oncontextmenu="return false" id="'+combineTypeNumber+'"><div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit" data-id="'+combineTypeNumber+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label data-required="'+getRequired+'">'+getLabel+'</label><span style="color:red;">'+getRequired+'</span><input style="height: 40px;border-radius: 2px;" class="difu-demo-field" data-class="'+getClass+'" data-unique="'+getUnique+'" type="number" name="'+getName+'" value="'+getvalue+'" maxlength="'+maxLength+'" minlength="'+minLength+'" placeholder="'+getplaceholder+'" '+getreadonly+'><input type="hidden" class="shortcode-combine" value="'+txtToAdd+'" disabled></div>');
    }
   }else if(getType == 'textarea'){
    var getLabel = $('[name='+getType+'-field-label]').val();
    var getRequired = $('[name='+getType+'-field-required]').val();
    var getName = $('[name='+getType+'-field-name]').val();
    var getClass = $('[name='+getType+'-field-class]').val();
    if(getLabel != '' && $('[name='+getType+'-field-required]').is(':checked')){
      getRequired = '*';
    }else{
      getRequired = '';
    }
    var getvalue = $('[name='+getType+'-field-value]').val();
    if($('[name='+getType+'-field-readonly]').is(':checked')){
    var getreadonly = 'readonly';
    }else{
    var getreadonly = '';
    }
    var getplaceholder = $('[name='+getType+'-field-placeholder]').val();
    if($(this).attr('data-id') != undefined){
     $('.difu-form-demo').find('#'+$(this).attr('data-id')).empty();
     $('.difu-form-demo').find('#'+$(this).attr('data-id')).append('<div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit" data-id="'+$(this).attr('data-id')+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label data-required="'+getRequired+'">'+getLabel+'</label><span style="color:red;">'+getRequired+'</span><textarea style="height: 100px;border-radius: 2px;width: 97%; margin-left: 10px;" class="difu-demo-field" data-class="'+getClass+'" name="'+getName+'" placeholder="'+getplaceholder+'" '+getreadonly+'>'+getvalue+'</textarea><input type="hidden" class="shortcode-combine" value="'+txtToAdd+'" disabled>');
     $(this).removeAttr('data-id');
    }else{
     var generateNumber = Math.floor(Math.random() * 1000); 
     var combineTypeNumber = getType+'-'+generateNumber;
     $('.difu-form-demo').append('<div class="demo-field-block" oncontextmenu="return false" id="'+combineTypeNumber+'"><div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit" data-id="'+combineTypeNumber+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label data-required="'+getRequired+'">'+getLabel+'</label><span style="color:red;">'+getRequired+'</span><textarea style="height: 100px;border-radius: 2px; width: 97%; margin-left: 10px;" class="difu-demo-field" data-class="'+getClass+'" name="'+getName+'" placeholder="'+getplaceholder+'" '+getreadonly+'>'+getvalue+'</textarea><input type="hidden" class="shortcode-combine" value="'+txtToAdd+'" disabled></div>');
    }
   }else if(getType == 'date'){
    var getLabel = $('[name='+getType+'-field-label]').val();
    var getRequired = $('[name='+getType+'-field-required]').val();
    var getName = $('[name='+getType+'-field-name]').val();
    var getClass = $('[name='+getType+'-field-class]').val();
    if(getLabel != '' && $('[name='+getType+'-field-required]').is(':checked')){
      getRequired = '*';
    }else{
      getRequired = '';
    }
    if($(this).attr('data-id') != undefined){
     $('.difu-form-demo').find('#'+$(this).attr('data-id')).empty();
     $('.difu-form-demo').find('#'+$(this).attr('data-id')).append('<div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit" data-id="'+$(this).attr('data-id')+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label data-required="'+getRequired+'">'+getLabel+'</label><span style="color:red;">'+getRequired+'</span><input type="date" style="height: 40px;border-radius: 2px;" class="difu-demo-field" data-class="'+getClass+'" name="'+getName+'" '+getreadonly+' /><input type="hidden" class="shortcode-combine" value="'+txtToAdd+'" disabled>');
     $(this).removeAttr('data-id');
    }else{
     var generateNumber = Math.floor(Math.random() * 1000); 
     var combineTypeNumber = getType+'-'+generateNumber;
     $('.difu-form-demo').append('<div class="demo-field-block" oncontextmenu="return false" id="'+combineTypeNumber+'"><div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit" data-id="'+combineTypeNumber+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label data-required="'+getRequired+'">'+getLabel+'</label><span style="color:red;">'+getRequired+'</span><input type="date" style="height: 40px;border-radius: 2px;" class="difu-demo-field" data-class="'+getClass+'" name="'+getName+'" '+getreadonly+' /><input type="hidden" class="shortcode-combine" value="'+txtToAdd+'" disabled></div>');
    }
   }else if(getType == 'select'){
    var getLabel = $('[name='+getType+'-field-label]').val();
    var getRequired = $('[name='+getType+'-field-required]').val();
    var getName = $('[name='+getType+'-field-name]').val();
    var getClass = $('[name='+getType+'-field-class]').val();
    if(getLabel != '' && $('[name='+getType+'-field-required]').is(':checked')){
      getRequired = '*';
    }else{
      getRequired = '';
    }
    var getOption = $('[name='+getType+'-field-option]').val();
    var getdefault = $('[name='+getType+'-field-default]').val();
    if(getOption == ''){
      var optionout = '<option style="font-size:15px; line-height:20px;" value="">Option is missing ! Add at least one option</option>';
    }else{
      var optionSplit = getOption.split('/');
      var optionout = '';
      if(getdefault == ''){
       optionout += '<option style="font-size:15px; line-height:20px;" value="">Select Option</option>';
      }
      $.each(optionSplit, function(index, val) {
         if(val != ''){
         if($.trim(val) == getdefault){
         optionout += '<option style="font-size:15px; line-height:20px;" value="'+$.trim(val)+'" selected>'+$.trim(val)+'</option>';
         }else{
         optionout += '<option style="font-size:15px; line-height:20px;" value="'+$.trim(val)+'">'+$.trim(val)+'</option>';
         }
       }
      });
    }
    if($(this).attr('data-id') != undefined){
     $('.difu-form-demo').find('#'+$(this).attr('data-id')).empty();
     $('.difu-form-demo').find('#'+$(this).attr('data-id')).append('<div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit-select" data-id="'+$(this).attr('data-id')+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label data-required="'+getRequired+'">'+getLabel+'</label><span style="color:red;">'+getRequired+'</span><br><select style="width:100%; margin-bottom:12px; height: 40px; margin-left:10px; margin-top:5px; border-radius: 2px;" data-option="'+getOption+'" data-default="'+getdefault+'" class="difu-demo-field" data-class="'+getClass+'" name="'+getName+'">'+optionout+'</select><input type="hidden" class="shortcode-combine" value="'+txtToAdd+'" disabled>');
     $(this).removeAttr('data-id');
    }else{
     var generateNumber = Math.floor(Math.random() * 1000); 
     var combineTypeNumber = getType+'-'+generateNumber;
     $('.difu-form-demo').append('<div class="demo-field-block" oncontextmenu="return false" id="'+combineTypeNumber+'"><div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit-select" data-id="'+combineTypeNumber+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label data-required="'+getRequired+'">'+getLabel+'</label><span style="color:red;">'+getRequired+'</span><br><select style="margin-bottom:12px; margin-top:5px; height: 40px; margin-left:10px; margin-top:5px; width:100%;border-radius: 2px;" data-option="'+getOption+'" data-default="'+getdefault+'" class="difu-demo-field" data-class="'+getClass+'" name="'+getName+'">'+optionout+'</select><input type="hidden" class="shortcode-combine" value="'+txtToAdd+'" disabled></div>');
    }
   }else if(getType == 'radio'){
    var getLabel = $('[name='+getType+'-field-label]').val();
    var getName = $('[name='+getType+'-field-name]').val();
    var getClass = $('[name='+getType+'-field-class]').val();
    var getRequired = '';
    var getOption = $('[name='+getType+'-field-option]').val();
    var getdefault = $('[name='+getType+'-field-default]').val();
    if(getOption == ''){
      var optionout = '<span style="font-size:15px; margin-left:10px; margin-top:5px; margin-bottom:10px;">Option is missing ! Add at least one option.</span>';
    }else{
      var optionSplit = getOption.split('/');
      var optionout = '';
      $.each(optionSplit, function(index, val) {
         if(val != ''){
         if($.trim(val) == getdefault){
         optionout += '<div class="demo-radio-field"><input id="'+val.replace(/\s+/g, '-')+'" type="radio" name="'+getName+'" value="'+$.trim(val)+'" checked/><label class="demo-radio" for="'+val.replace(/\s+/g, '-')+'">'+$.trim(val)+'</label></div>';
         }else{
         optionout += '<div class="demo-radio-field"><input id="'+val.replace(/\s+/g, '-')+'" type="radio" name="'+getName+'" value="'+$.trim(val)+'"/><label class="demo-radio" for="'+val.replace(/\s+/g, '-')+'">'+$.trim(val)+'</label></div>';
         }
       }
      });
    }

    if($(this).attr('data-id') != undefined){
     $('.difu-form-demo').find('#'+$(this).attr('data-id')).empty();
     $('.difu-form-demo').find('#'+$(this).attr('data-id')).append('<div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit-radio" data-id="'+$(this).attr('data-id')+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label class="demo-radio-label-main" data-class="'+getClass+'" data-option="'+getOption+'" data-default="'+getdefault+'">'+getLabel+'</label><br>'+optionout+'<input type="hidden" class="shortcode-combine" value="'+txtToAdd+'" disabled><div style="clear: both;"></div>');
     $(this).removeAttr('data-id');
    }else{
     var generateNumber = Math.floor(Math.random() * 1000); 
     var combineTypeNumber = getType+'-'+generateNumber;
     $('.difu-form-demo').append('<div class="demo-field-block" oncontextmenu="return false" id="'+combineTypeNumber+'"><div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit-radio" data-id="'+combineTypeNumber+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label class="demo-radio-label-main" data-class="'+getClass+'" data-option="'+getOption+'" data-default="'+getdefault+'">'+getLabel+'</label><br>'+optionout+'<input type="hidden" class="shortcode-combine" value="'+txtToAdd+'" disabled><div style="clear: both;"></div></div>');
    }
   }else if(getType == 'checkbox'){
    var getLabel = $('[name='+getType+'-field-label]').val();
    var getClass = $('[name='+getType+'-field-class]').val();
    var getOption = $('[name='+getType+'-field-option]').val();
    var getdefault = $('[name='+getType+'-field-default]').val();
    var getValue = $('[name='+getType+'-field-value]').val();
    if(getOption == ''){
      var optionout = '<span style="font-size:15px; margin-left:10px;">Option is missing ! Add at least one option.</span>';
    }else{
      var optionSplit = getOption.split('/');
      var optionout = '';
      $.each(optionSplit, function(index, val) {
         if(val != ''){
         if($.trim(val) == getdefault){
         optionout += '<div class="demo-checkbox-field"><input id="'+val.replace(/\s+/g, '-')+'" type="checkbox" name="'+getLabel.replace(/\s+/g, '-')+'-'+val.replace(/\s+/g, '-')+'" value="this field value will be displayed after saving the form" checked/><label class="demo-radio" for="'+val.replace(/\s+/g, '-')+'">'+$.trim(val)+'</label></div>';
         }else{
         optionout += '<div class="demo-checkbox-field"><input id="'+val.replace(/\s+/g, '-')+'" type="checkbox" name="'+getLabel.replace(/\s+/g, '-')+'-'+val.replace(/\s+/g, '-')+'" value="this field value will be displayed after saving the form"/><label class="demo-radio" for="'+val.replace(/\s+/g, '-')+'">'+$.trim(val)+'</label></div>';
         }
       }
      });
    }

    if($(this).attr('data-id') != undefined){
     $('.difu-form-demo').find('#'+$(this).attr('data-id')).empty();
     $('.difu-form-demo').find('#'+$(this).attr('data-id')).append('<div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit-checkbox" data-id="'+$(this).attr('data-id')+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label class="demo-checkbox-label-main" data-class="'+getClass+'" data-option="'+getOption+'" data-default="'+getdefault+'" data-values="'+getValue+'">'+getLabel+'</label><br>'+optionout+'<input type="hidden" class="shortcode-combine" value="'+txtToAdd+'" disabled><div style="clear: both;"></div>');
     $(this).removeAttr('data-id');
    }else{
     var generateNumber = Math.floor(Math.random() * 1000); 
     var combineTypeNumber = getType+'-'+generateNumber;
     $('.difu-form-demo').append('<div class="demo-field-block" oncontextmenu="return false" id="'+combineTypeNumber+'"><div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit-checkbox" data-id="'+combineTypeNumber+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label class="demo-checkbox-label-main" data-class="'+getClass+'" data-option="'+getOption+'" data-default="'+getdefault+'" data-values="'+getValue+'">'+getLabel+'</label><br>'+optionout+'<input type="hidden" class="shortcode-combine" value="'+txtToAdd+'" disabled><div style="clear: both;"></div></div>');
    }
   }else if(getType == 'submit'){
    var getLabel = $('[name='+getType+'-field-label]').val();
    var getName = $('[name='+getType+'-field-name]').val();
    var getClass = $('[name='+getType+'-field-class]').val();

    if($(this).attr('data-id') != undefined){
     $('.difu-form-demo').find('#'+$(this).attr('data-id')).empty();
     $('.difu-form-demo').find('#'+$(this).attr('data-id')).append('<div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit-submit" data-id="'+$(this).attr('data-id')+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><button type="button" style="margin-left: 10px; border-radius: 2px;padding: 10px 20px;font-size: 15px;cursor: pointer;" class="difu-demo-field" data-class="'+getClass+'" name="'+getName+'">'+getLabel+'</button><input type="hidden" class="shortcode-combine" value="'+txtToAdd+'" disabled>');
     $(this).removeAttr('data-id');
    }else{
     var generateNumber = Math.floor(Math.random() * 1000); 
     var combineTypeNumber = getType+'-'+generateNumber;
     $('.difu-form-demo').append('<div class="demo-field-block" oncontextmenu="return false" id="'+combineTypeNumber+'"><div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit-submit" data-id="'+combineTypeNumber+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><button type="button" style="margin-left: 10px; border-radius: 2px;padding: 10px 20px;font-size: 15px;cursor: pointer;" class="difu-demo-field" data-class="'+getClass+'" name="'+getName+'">'+getLabel+'</button><input type="hidden" class="shortcode-combine" value="'+txtToAdd+'" disabled></div>');
    }
   }
   
   }
   field_reset(getType);
   name_field_reset(getType);
   $('.hidden-content').fadeOut();
	 $('.hidden-div').css('display', 'none');
	 $('body').css('overflow', '');	
 });

$('.difu-form-demo').on('click', '.difu-demo-field-remove', function() {
 $(this).closest('.demo-field-block').remove();
});


$('.difu-form-demo').on('click', '.difu-demo-field-edit', function(event) {
    event.preventDefault();
    var label='', value='', demoreadonly='', placeholder='', classs='', unique='', maxLength='', minLength='';
    var getType = $(this).data('type');
    var dataConrain1 = '[dfu_'+getType+' ';
    shorttab(getType);
    var demoField = $(this).closest('#'+$(this).data('id')).find('.difu-demo-field');
    var labelNameProduce = $(this).closest('#'+$(this).data('id')).find('label');
    $('[name='+getType+'-field-label]').val(labelNameProduce.text());
    if(labelNameProduce.text() != ''){
      var label = "label='"+labelNameProduce.text()+"',";
    }
    if(labelNameProduce.data('required') == '*'){
     $('[name='+getType+'-field-required]').attr('checked', 'checked');
     var dataConrain1 = '[dfu_'+getType+'* ';
    }
    var dataContain = dataConrain1+"name='"+demoField.attr('name')+"']";
    $('[name='+getType+'-field-name]').val(demoField.attr('name'));
    $('[name='+getType+'-field-class]').val(demoField.data('class'));
    if(demoField.data('class') != ''){
      var classs = "class='"+demoField.data('class')+"',";
    }
    if(demoField.data('unique') != undefined){
    if(demoField.data('unique') == 'yes'){
    $('[name='+getType+'-field-unique]').attr('checked', 'checked');
    $('[name='+getType+'-field-unique]').val('yes');
    var unique = "unique='yes',";
    }
    }
    if(demoField.attr('maxlength') != undefined){
    if(demoField.attr('maxlength') != ''){
    $('[name='+getType+'-field-max]').val(demoField.attr('maxlength'));
    var maxLength= "max='"+demoField.attr('maxlength')+"',";
    }
    }
    if(demoField.attr('minlength') != undefined){
    if(demoField.attr('minlength') != ''){
    $('[name='+getType+'-field-min]').val(demoField.attr('minlength'));
    var minLength= "min='"+demoField.attr('minlength')+"',";
    }
    }
    if($('[name='+getType+'-field-value]').length != ''){
    $('[name='+getType+'-field-value]').val(demoField.val());
    if(demoField.val() != ''){
      var value = "value='"+demoField.val()+"',";
    }
    }
    if(demoField.attr('readonly') != undefined){
     $('[name='+getType+'-field-readonly]').attr('checked', 'checked');
     $('[name='+getType+'-field-readonly]').val('yes');
     var demoreadonly = "readonly='yes',";
    }
    if($('[name='+getType+'-field-placeholder]').length != ''){
    $('[name='+getType+'-field-placeholder]').val(demoField.attr('placeholder'));
    if(demoField.attr('placeholder') != ''){
      var placeholder = "placeholder='"+demoField.attr('placeholder')+"',";
    }
    } 
    var allMergeContain = label+value+maxLength+minLength+demoreadonly+placeholder+classs+unique;
    allMergeContain = $.trim(allMergeContain.replace(/,\s*$/, "")).replace(/\s+/g, '-');
    $('.fieldInsertion-'+getType).val($(this).closest('#'+$(this).data('id')).find('.shortcode-combine').val());
    $('#'+getType+'-data-contain').val(allMergeContain);
    $('#'+getType+'-data-contain1').val(dataContain);
    $('.'+getType+'-fieldInsertion').attr('data-id', $(this).data('id'));
});

$('.difu-form-demo').on('click', '.difu-demo-field-edit-select', function(event) {
    event.preventDefault();
    var label='', classs='', optionValue ='', defaultselect= '';
    var getType = $(this).data('type');
    var dataConrain1 = '[dfu_'+getType+' ';
    shorttab(getType);
    var demoField = $(this).closest('#'+$(this).data('id')).find('.difu-demo-field');
    var labelNameProduce = $(this).closest('#'+$(this).data('id')).find('label');
    $('[name='+getType+'-field-label]').val(labelNameProduce.text());
    if(labelNameProduce.text() != ''){
      var label = "label='"+labelNameProduce.text()+"',";
    }
    if(labelNameProduce.data('required') == '*'){
     $('[name='+getType+'-field-required]').attr('checked', 'checked');
     var dataConrain1 = '[dfu_'+getType+'* ';
    }
    var dataContain = dataConrain1+"name='"+demoField.attr('name')+"']";
    $('[name='+getType+'-field-name]').val(demoField.attr('name'));
    $('[name='+getType+'-field-class]').val(demoField.data('class'));
    if(demoField.data('class') != ''){
      var classs = "class='"+demoField.data('class')+"',";
    }
    
    $('[name='+getType+'-field-option]').val(demoField.data('option'));
    if(demoField.data('option') != ''){
    optionValue = "options='"+demoField.data('option')+"',";
    }

    $('[name='+getType+'-field-default]').val(demoField.data('default'));
    if(demoField.data('default') != ''){
    defaultselect = "selected='"+demoField.data('default')+"',";
    }
 
    var allMergeContain = label+optionValue+defaultselect+classs;
    allMergeContain = $.trim(allMergeContain.replace(/,\s*$/, "")).replace(/\s+/g, '-');
    $('.fieldInsertion-'+getType).val($(this).closest('#'+$(this).data('id')).find('.shortcode-combine').val());
    $('#'+getType+'-data-contain').val(allMergeContain);
    $('#'+getType+'-data-contain1').val(dataContain);
    $('.'+getType+'-fieldInsertion').attr('data-id', $(this).data('id'));
});

$('.difu-form-demo').on('click', '.difu-demo-field-edit-radio', function(event) {
    event.preventDefault();
    var label='', classs='', optionValue ='', defaultselect= '';
    var getType = $(this).data('type');
    var dataConrain1 = '[dfu_'+getType+' ';
    shorttab(getType);
    var demoField = $(this).closest('#'+$(this).data('id')).find('.demo-radio-label-main');
    var labelNameProduce = $(this).closest('#'+$(this).data('id')).find('.demo-radio-label-main');
    $('[name='+getType+'-field-label]').val(labelNameProduce.text());
    if(labelNameProduce.text() != ''){
      var label = "label='"+labelNameProduce.text()+"',";
    }
    var dataContain = dataConrain1+"name='"+$(this).closest('#'+$(this).data('id')).find('.demo-radio-field input').attr('name')+"']";
    $('[name='+getType+'-field-name]').val($(this).closest('#'+$(this).data('id')).find('.demo-radio-field input').attr('name'));
    $('[name='+getType+'-field-class]').val(demoField.data('class'));
    if(demoField.data('class') != ''){
      var classs = "class='"+demoField.data('class')+"',";
    }
    
    $('[name='+getType+'-field-option]').val(demoField.data('option'));
    if(demoField.data('option') != ''){
    optionValue = "options='"+demoField.data('option')+"',";
    }

    $('[name='+getType+'-field-default]').val(demoField.data('default'));
    if(demoField.data('default') != ''){
    defaultselect = "cheaked='"+demoField.data('default')+"',";
    }
 
    var allMergeContain = label+optionValue+defaultselect+classs;
    allMergeContain = $.trim(allMergeContain.replace(/,\s*$/, "")).replace(/\s+/g, '-');
    $('.fieldInsertion-'+getType).val($(this).closest('#'+$(this).data('id')).find('.shortcode-combine').val());
    $('#'+getType+'-data-contain').val(allMergeContain);
    $('#'+getType+'-data-contain1').val(dataContain);
    $('.'+getType+'-fieldInsertion').attr('data-id', $(this).data('id'));
});
$('.content-type').on('click', function(){
   var getid = $(this).data('id');

   $('.form-content-common').css('display', 'none');
   $('.content-type').css({'background': '', 'border-bottom' : ''});
   $(this).css({'background': '#fff', 'border-bottom' : '1px solid #fff'});
   $('#'+getid).css('display', '');
});

$('.difu-form-demo').on('click', '.difu-demo-field-edit-checkbox', function(event) {
    event.preventDefault();
    var label='', classs='', optionValue ='', defaultselect= '', deafultvalues='';
    var getType = $(this).data('type');
    var dataConrain1 = '[dfu_'+getType+']';
    shorttab(getType);
    var demoField = $(this).closest('#'+$(this).data('id')).find('.demo-checkbox-label-main');
    var labelNameProduce = $(this).closest('#'+$(this).data('id')).find('.demo-checkbox-label-main');
    $('[name='+getType+'-field-label]').val(labelNameProduce.text());
    if(labelNameProduce.text() != ''){
      var label = "label='"+labelNameProduce.text()+"',";
    }
    var dataContain = dataConrain1;
    
    $('[name='+getType+'-field-class]').val(demoField.data('class'));
    if(demoField.data('class') != ''){
      var classs = "class='"+demoField.data('class')+"',";
    }

    $('[name='+getType+'-field-value]').val(demoField.data('values'));
    if(demoField.data('values') != ''){
      var classs = "value='"+demoField.data('values')+"',";
    }
    
    $('[name='+getType+'-field-option]').val(demoField.data('option'));
    if(demoField.data('option') != ''){
    optionValue = "options='"+demoField.data('option')+"',";
    }

    $('[name='+getType+'-field-default]').val(demoField.data('default'));
    if(demoField.data('default') != ''){
    defaultselect = "cheaked='"+demoField.data('default')+"',";
    }
 
    var allMergeContain = label+optionValue+deafultvalues+defaultselect+classs;
    allMergeContain = $.trim(allMergeContain.replace(/,\s*$/, "")).replace(/\s+/g, '-');
    $('.fieldInsertion-'+getType).val($(this).closest('#'+$(this).data('id')).find('.shortcode-combine').val());
    $('#'+getType+'-data-contain').val(allMergeContain);
    $('#'+getType+'-data-contain1').val(dataContain);
    $('.'+getType+'-fieldInsertion').attr('data-id', $(this).data('id'));
});

$('.difu-form-demo').on('click', '.difu-demo-field-edit-submit', function(event) {
    event.preventDefault();
    var label='', classs='';
    var getType = $(this).data('type');
    var dataConrain1 = '[dfu_'+getType+' ';
    shorttab(getType);
    var demoField = $(this).closest('#'+$(this).data('id')).find('.difu-demo-field');
    $('[name='+getType+'-field-label]').val(demoField.text());
    if(demoField.text() != ''){
      var label = "label='"+demoField.text()+"',";
    }

    var dataContain = dataConrain1+"name='"+demoField.attr('name')+"']";
    $('[name='+getType+'-field-name]').val(demoField.attr('name'));
    $('[name='+getType+'-field-class]').val(demoField.data('class'));
    if(demoField.data('class') != ''){
      var classs = "class='"+demoField.data('class')+"',";
    }
     
    var allMergeContain = label+classs;
    allMergeContain = $.trim(allMergeContain.replace(/,\s*$/, "")).replace(/\s+/g, '-');
    $('.fieldInsertion-'+getType).val($(this).closest('#'+$(this).data('id')).find('.shortcode-combine').val());
    $('#'+getType+'-data-contain').val(allMergeContain);
    $('#'+getType+'-data-contain1').val(dataContain);
    $('.'+getType+'-fieldInsertion').attr('data-id', $(this).data('id'));
});

$('.content-type').on('click', function(){
   var getid = $(this).data('id');

   $('.form-content-common').css('display', 'none');
   $('.content-type').css({'background': '', 'border-bottom' : ''});
   $(this).css({'background': '#fff', 'border-bottom' : '1px solid #fff'});
   $('#'+getid).css('display', '');
});

$('.msg').on('blur', function(){
  var getId = $(this).attr('id');
  if($(this).val() == ''){

    if(getId == 'success-msg'){
      $(this).val('Your data has been sent successfully.');
    }else if(getId == 'failed-msg'){
      $(this).val('There was an error trying to send your data. Please try again later.');
    }else if(getId == 'error-msg'){
      $(this).val('One or more fields have an error. Please check and try again.');
    }else if(getId == 'required-msg'){
      $(this).val('*Required field.');
    }else if(getId == 'email-msg'){
      $(this).val('Invalid email address.');
    }else if(getId == 'url-msg'){
      $(this).val('URL is Invalid.');
    }else if(getId == 'number-msg-1'){
      $(this).val('Number is larger than the maximum allowed.');
    }else if(getId == 'number-msg-2'){
      $(this).val('Number is smaller than the minimum allowed.');
    }else{
      $(this).val();
    }

  }
});

$(".shortcode-content").on("click", function () {
   $(this).find('.shortcode-input-row').select();
});


$('.dfu-notification').on('click', function(){ if($(this).is(':checked')){ $('.notify-hidden').css('display', 'block');}else{ $('.notify-hidden').css('display', 'none'); $('.notify-email').val('');  } });


function field_reset(type) {
  if($('.difu-field-reset-check').is(':checked')){
    $('.difu-field-reset-check').removeAttr('checked');
    $('.difu-field-reset-check').val('');
  }
  $('.difu-field-reset').val('');
  $('.field-reset-shortcode').val('[dfu_'+type);
}


function name_field_reset(val) {
    if($('.'+val+'-name-field').val() == ''){
    var generateNumber = Math.floor(Math.random() * 1000); 
    var combineTypeNumber = val+'-'+generateNumber;
    var getValue = $('#'+val+'-data-contain1').val();
    var split = getValue.split(' ');
    if (split[1] == '') {
    split.push("name='"+combineTypeNumber+"'");
    }else{
    split.splice(1, 1, "name='"+combineTypeNumber+"'");
    }
    var string = split.toString();
    $('.'+val+'-name-field').val(combineTypeNumber);
    $('#'+val+'-data-contain1').val(string.replace(/,/g, ' ').replace(/\]/g, '')+"]");
    var getNewValue = $('#'+val+'-data-contain').val();
    var getValue = $('#'+val+'-data-contain1').val();
    var splitCurrentValue = getValue.split(" ");
    var splitNewValue = getNewValue.split(',');
    $.each(splitNewValue, function(i, val){
     splitCurrentValue.push(val.replace(/-/g, ' '));
    });
    var convertString = splitCurrentValue.toString();
    var finalOutput = convertString.replace(/\[/g, '').replace(/\]/g, '');
    $('.fieldInsertion-'+val).val("["+finalOutput.replace(/,/g, ' ')+"]");
  }
}
$('.edit-demo-form').find('.demo-field-block').each(function() {
  var getType = $(this).attr('id').split('-');
  if(getType[0] == 'email'){
    var getLabel = $(this).find('.dfu-input-div .dfu-label').text().slice(0, -1);
    var getName = $(this).find('.dfu-input-div .dfu-input').attr('name');
    var getClass = '';
    if($(this).find('.dfu-input-div').hasClass('dfu-required')){
     getRequired = '*';
     var getClasses = $.trim($(this).find('.dfu-input-div').attr('class'));
     var getClassSplit = getClasses.split(' ');
     if(getClassSplit.length > 2){
     getClassSplit.shift();
     getClassSplit.shift();
     getClass = getClassSplit.join(" ");
     }
    }else{
     getRequired = '';
     var getClasses = $.trim($(this).find('.dfu-input-div').attr('class'));
     var getClassSplit = getClasses.split(' ');
     if(getClassSplit.length > 1){
     getClassSplit.shift();
     getClass = getClassSplit.join(" ");
     }
    }
    var getUnique = '';
    if($(this).find('.dfu-input-div .dfu-input').attr('data-unique') != undefined){
    getUnique = $(this).find('.dfu-input-div .dfu-input').attr('data-unique');
    }
    var getvalue = $(this).find('.dfu-input-div .dfu-input').val();
    var getreadonly = '';
    if($(this).find('.dfu-input-div .dfu-input').attr('readonly') != undefined){
     getreadonly = 'readonly'; 
    }
    var getplaceholder = $(this).find('.dfu-input-div .dfu-input').attr('placeholder');
     $(this).find('.dfu-input-div').remove();
     $(this).append('<div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit" data-id="'+$(this).attr('id')+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType[0]+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label data-required="'+getRequired+'">'+getLabel+'</label><span style="color:red;">'+getRequired+'</span><input style="height: 40px;border-radius: 2px;" class="difu-demo-field" data-class="'+getClass+'" data-unique="'+getUnique+'" type="email" name="'+getName+'" value="'+getvalue+'" placeholder="'+getplaceholder+'" '+getreadonly+'>');
  }
    if(getType[0] == 'text'){
    var getLabel = $(this).find('.dfu-input-div .dfu-label').text().slice(0, -1);
    var getName = $(this).find('.dfu-input-div .dfu-input').attr('name');
    var getClass = '';
    if($(this).find('.dfu-input-div').hasClass('dfu-required')){
     getRequired = '*';
     var getClasses = $.trim($(this).find('.dfu-input-div').attr('class'));
     var getClassSplit = getClasses.split(' ');
     if(getClassSplit.length > 2){
     getClassSplit.shift();
     getClassSplit.shift();
     getClass = getClassSplit.join(" ");
     }
    }else{
     getRequired = '';
     var getClasses = $.trim($(this).find('.dfu-input-div').attr('class'));
     var getClassSplit = getClasses.split(' ');
     if(getClassSplit.length > 1){
     getClassSplit.shift();
     getClass = getClassSplit.join(" ");
     }
    }
    var getUnique = '';
    if($(this).find('.dfu-input-div .dfu-input').attr('data-unique') != undefined){
    getUnique = $(this).find('.dfu-input-div .dfu-input').attr('data-unique');
    }
    var getvalue = $(this).find('.dfu-input-div .dfu-input').val();
    var getreadonly = '';
    if($(this).find('.dfu-input-div .dfu-input').attr('readonly') != undefined){
     getreadonly = 'readonly'; 
    }
    var getplaceholder = $(this).find('.dfu-input-div .dfu-input').attr('placeholder');
     $(this).find('.dfu-input-div').remove();
     $(this).append('<div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit" data-id="'+$(this).attr('id')+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType[0]+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label data-required="'+getRequired+'">'+getLabel+'</label><span style="color:red;">'+getRequired+'</span><input style="height: 40px;border-radius: 2px;" class="difu-demo-field" data-class="'+getClass+'" data-unique="'+getUnique+'" type="text" name="'+getName+'" value="'+getvalue+'" placeholder="'+getplaceholder+'" '+getreadonly+'>');
  }
   if(getType[0] == 'number'){
    var getLabel = $(this).find('.dfu-input-div .dfu-label').text().slice(0, -1);
    var getName = $(this).find('.dfu-input-div .dfu-input').attr('name');
    var getClass = '';
    if($(this).find('.dfu-input-div').hasClass('dfu-required')){
     getRequired = '*';
     var getClasses = $.trim($(this).find('.dfu-input-div').attr('class'));
     var getClassSplit = getClasses.split(' ');
     if(getClassSplit.length > 2){
     getClassSplit.shift();
     getClassSplit.shift();
     getClass = getClassSplit.join(" ");
     }
    }else{
     getRequired = '';
     var getClasses = $.trim($(this).find('.dfu-input-div').attr('class'));
     var getClassSplit = getClasses.split(' ');
     if(getClassSplit.length > 1){
     getClassSplit.shift();
     getClass = getClassSplit.join(" ");
     }
    }
    var getUnique = '';
    if($(this).find('.dfu-input-div .dfu-input').attr('data-unique') != undefined){
    getUnique = $(this).find('.dfu-input-div .dfu-input').attr('data-unique');
    }
    var maxLength = '';
    if($(this).find('.dfu-input-div .dfu-input').attr('maxlength') != undefined){
    maxLength = $(this).find('.dfu-input-div .dfu-input').attr('maxlength');
    }
    var minLength = '';
    if($(this).find('.dfu-input-div .dfu-input').attr('minlength') != undefined){
    minLength = $(this).find('.dfu-input-div .dfu-input').attr('minlength');
    }
    var getvalue = $(this).find('.dfu-input-div .dfu-input').val();
    var getreadonly = '';
    if($(this).find('.dfu-input-div .dfu-input').attr('readonly') != undefined){
     getreadonly = 'readonly'; 
    }
    var getplaceholder = $(this).find('.dfu-input-div .dfu-input').attr('placeholder');
     $(this).find('.dfu-input-div').remove();
     $(this).append('<div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit" data-id="'+$(this).attr('id')+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType[0]+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label data-required="'+getRequired+'">'+getLabel+'</label><span style="color:red;">'+getRequired+'</span><input style="height: 40px;border-radius: 2px;" class="difu-demo-field" data-class="'+getClass+'" data-unique="'+getUnique+'" type="number" name="'+getName+'" value="'+getvalue+'" maxlength="'+maxLength+'" minlength="'+minLength+'" placeholder="'+getplaceholder+'" '+getreadonly+'>');
  }
  
  if(getType[0] == 'url'){
    var getLabel = $(this).find('.dfu-input-div .dfu-label').text().slice(0, -1);
    var getName = $(this).find('.dfu-input-div .dfu-input').attr('name');
    var getClass = '';
    if($(this).find('.dfu-input-div').hasClass('dfu-required')){
     getRequired = '*';
     var getClasses = $.trim($(this).find('.dfu-input-div').attr('class'));
     var getClassSplit = getClasses.split(' ');
     if(getClassSplit.length > 2){
     getClassSplit.shift();
     getClassSplit.shift();
     getClass = getClassSplit.join(" ");
     }
    }else{
     getRequired = '';
     var getClasses = $.trim($(this).find('.dfu-input-div').attr('class'));
     var getClassSplit = getClasses.split(' ');
     if(getClassSplit.length > 1){
     getClassSplit.shift();
     getClass = getClassSplit.join(" ");
     }
    }
    var getvalue = $(this).find('.dfu-input-div .dfu-input').val();
    var getreadonly = '';
    if($(this).find('.dfu-input-div .dfu-input').attr('readonly') != undefined){
     getreadonly = 'readonly'; 
    }
    var getplaceholder = $(this).find('.dfu-input-div .dfu-input').attr('placeholder');
     $(this).find('.dfu-input-div').remove();
     $(this).append('<div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit" data-id="'+$(this).attr('id')+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType[0]+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label data-required="'+getRequired+'">'+getLabel+'</label><span style="color:red;">'+getRequired+'</span><input style="height: 40px;border-radius: 2px;" class="difu-demo-field" data-class="'+getClass+'" type="url" name="'+getName+'" value="'+getvalue+'" placeholder="'+getplaceholder+'" '+getreadonly+'>');
    }
    if(getType[0] == 'date'){
    var getLabel = $(this).find('.dfu-input-div .dfu-label').text().slice(0, -1);
    var getName = $(this).find('.dfu-input-div .dfu-input').attr('name');
    var getClass = '';
    if($(this).find('.dfu-input-div').hasClass('dfu-required')){
     getRequired = '*';
     var getClasses = $.trim($(this).find('.dfu-input-div').attr('class'));
     var getClassSplit = getClasses.split(' ');
     if(getClassSplit.length > 2){
     getClassSplit.shift();
     getClassSplit.shift();
     getClass = getClassSplit.join(" ");
     }
    }else{
     getRequired = '';
     var getClasses = $.trim($(this).find('.dfu-input-div').attr('class'));
     var getClassSplit = getClasses.split(' ');
     if(getClassSplit.length > 1){
     getClassSplit.shift();
     getClass = getClassSplit.join(" ");
     }
    }
    var getvalue = $(this).find('.dfu-input-div .dfu-input').val();
    $(this).find('.dfu-input-div').remove();
    $(this).append('<div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit" data-id="'+$(this).attr('id')+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType[0]+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label data-required="'+getRequired+'">'+getLabel+'</label><span style="color:red;">'+getRequired+'</span><input style="height: 40px;border-radius: 2px;" class="difu-demo-field" data-class="'+getClass+'" type="date" name="'+getName+'" value="">');
  }
    if(getType[0] == 'textarea'){
    var getLabel = $(this).find('.dfu-input-div .dfu-label').text().slice(0, -1);
    var getName = $(this).find('.dfu-input-div .dfu-input').attr('name');
    var getClass = '';
    if($(this).find('.dfu-input-div').hasClass('dfu-required')){
     getRequired = '*';
     var getClasses = $.trim($(this).find('.dfu-input-div').attr('class'));
     var getClassSplit = getClasses.split(' ');
     if(getClassSplit.length > 2){
     getClassSplit.shift();
     getClassSplit.shift();
     getClass = getClassSplit.join(" ");
     }
    }else{
     getRequired = '';
     var getClasses = $.trim($(this).find('.dfu-input-div').attr('class'));
     var getClassSplit = getClasses.split(' ');
     if(getClassSplit.length > 1){
     getClassSplit.shift();
     getClass = getClassSplit.join(" ");
     }
    }
    var getvalue = $(this).find('.dfu-input-div .dfu-input').val();
    var getreadonly = '';
    if($(this).find('.dfu-input-div .dfu-input').attr('readonly') != undefined){
     getreadonly = 'readonly'; 
    }
    var getplaceholder = $(this).find('.dfu-input-div .dfu-input').attr('placeholder');
     $(this).find('.dfu-input-div').remove();
     $(this).append('<div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit" data-id="'+$(this).attr('id')+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType[0]+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label data-required="'+getRequired+'">'+getLabel+'</label><span style="color:red;">'+getRequired+'</span><textarea style="height: 100px;border-radius: 2px;width: 97%; margin-left: 10px;" class="difu-demo-field" data-class="'+getClass+'" name="'+getName+'" placeholder="'+getplaceholder+'" '+getreadonly+'>'+getvalue+'</textarea>');
    }

    if(getType[0] == 'select'){

    var getLabel = $(this).find('.dfu-input-div .dfu-label').text().slice(0, -1);
    var getName = $(this).find('.dfu-input-div .dfu-input').attr('name');
    var getClass = '';
    if($(this).find('.dfu-input-div').hasClass('dfu-required')){
     getRequired = '*';
     var getClasses = $.trim($(this).find('.dfu-input-div').attr('class'));
     var getClassSplit = getClasses.split(' ');
     if(getClassSplit.length > 2){
     getClassSplit.shift();
     getClassSplit.shift();
     getClass = getClassSplit.join(" ");
     }
    }else{
     getRequired = '';
     var getClasses = $.trim($(this).find('.dfu-input-div').attr('class'));
     var getClassSplit = getClasses.split(' ');
     if(getClassSplit.length > 1){
     getClassSplit.shift();
     getClass = getClassSplit.join(" ");
     }
    }
    
    var getOption = [];
    var getDefault = [];
    $(this).find('.dfu-input-div').find('option').each(function(){
      if($(this).text() != 'Select Option'){
      if($(this).attr('selected') != undefined){
        getOption.push($(this).text());
        getDefault.push($(this).text());
      }else{
        getOption.push($(this).text());
      }

     }
    });
    
    getOptions = getOption.join("/");
    getDefault = getDefault.join("/");
    
    var optionout = '';
    if(getDefault.length == ''){
      optionout += '<option style="font-size:15px; line-height:20px;" value="">Select Option</option>';
    }
    $.each(getOption, function(index, val) {
         if(val != ''){
         if($.trim(val) == getDefault){
         optionout += '<option style="font-size:15px; line-height:20px;" value="'+$.trim(val)+'" selected>'+$.trim(val)+'</option>';
         }else{
         optionout += '<option style="font-size:15px; line-height:20px;" value="'+$.trim(val)+'">'+$.trim(val)+'</option>';
         }
       }
      });
    $(this).find('.dfu-input-div').remove();
    $(this).append('<div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit-select" data-id="'+$(this).attr('id')+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType[0]+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label data-required="'+getRequired+'">'+getLabel+'</label><span style="color:red;">'+getRequired+'</span><br><select style="margin-bottom:12px; margin-top:5px; height: 40px; margin-left:10px; margin-top:5px; width:100%;border-radius: 2px;" data-option="'+getOptions+'" data-default="'+getDefault+'" class="difu-demo-field" data-class="'+getClass+'" name="'+getName+'">'+optionout+'</select>');

    }

  if(getType[0] == 'radio'){

    var getLabel = $(this).find('.dfu-input-div .dfu-label').text();
    var getName = $(this).find('.dfu-input-div .dfu-input').attr('name');
    var getClass = '';
    
     var getClasses = $.trim($(this).find('.dfu-input-div').attr('class'));
     var getClassSplit = getClasses.split(' ');
     if(getClassSplit.length > 1){
     getClassSplit.shift();
     getClass = getClassSplit.join(" ");
     }
        
    var getOption = [];
    var getDefault = [];
    $(this).find('.dfu-input-div').find('.dfu-radio-button').each(function(){
  
      if($(this).attr('checked') != undefined){
        getOption.push($(this).val());
        getDefault.push($(this).val());
      }else{
        getOption.push($(this).val());
      }

    });
    
    getOptions = getOption.join("/");
    getDefault = getDefault.join("/");
    
    var optionout = '';

    $.each(getOption, function(index, val) {
         if(val != ''){
         if($.trim(val) == getDefault){
         optionout += '<div class="demo-radio-field"><input id="'+val.replace(/\s+/g, '-')+'" type="radio" name="'+getName+'" value="'+$.trim(val)+'" checked/><label class="demo-radio" for="'+val.replace(/\s+/g, '-')+'">'+$.trim(val)+'</label></div>';
         }else{
         optionout += '<div class="demo-radio-field"><input id="'+val.replace(/\s+/g, '-')+'" type="radio" name="'+getName+'" value="'+$.trim(val)+'"/><label class="demo-radio" for="'+val.replace(/\s+/g, '-')+'">'+$.trim(val)+'</label></div>';
         }
       }
      });
    $(this).find('.dfu-input-div').remove();
    $(this).append('<div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit-radio" data-id="'+$(this).attr('id')+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType[0]+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label class="demo-radio-label-main" data-class="'+getClass+'" data-option="'+getOptions+'" data-default="'+getDefault+'">'+getLabel+'</label><br>'+optionout+'<div style="clear: both;"></div>');

    }

    if(getType[0] == 'checkbox'){

    var getLabel = $(this).find('.dfu-input-div .dfu-label').text();
    var getClass = '';
    
     var getClasses = $.trim($(this).find('.dfu-input-div').attr('class'));
     var getClassSplit = getClasses.split(' ');
     if(getClassSplit.length > 1){
     getClassSplit.shift();
     getClass = getClassSplit.join(" ");
     }
        
    var getOption = [];
    var getDefault = [];
    var getDefaultVal = [];
    $(this).find('.dfu-input-div').find('.dfu-checkbox').each(function(){
      if($(this).attr('checked') != undefined){
        getDefaultVal.push($(this).val());
        getDefault.push($(this).val());
      }else{
        getDefaultVal.push($(this).val());
      }

    });
     $(this).find('.dfu-input-div').find('.dfu-span').each(function(){
      getOption.push($(this).text());
    });
    
    getOptions = getOption.join("/");
    getDefault = getDefault.join("/");
    getDefaultVals = getDefaultVal.join("/");
    
    var optionout = '';

    $.each(getOption, function(index, val) {
       if(val != ''){
         if($.trim(val) == getDefault){
         optionout += '<div class="demo-checkbox-field"><input id="'+val.replace(/\s+/g, '-')+'" type="checkbox" name="'+getLabel.replace(/\s+/g, '-')+'-'+val.replace(/\s+/g, '-')+'" value="this field value will be displayed after saving the form" checked/><label class="demo-radio" for="'+val.replace(/\s+/g, '-')+'">'+$.trim(val)+'</label></div>';
         }else{
         optionout += '<div class="demo-checkbox-field"><input id="'+val.replace(/\s+/g, '-')+'" type="checkbox" name="'+getLabel.replace(/\s+/g, '-')+'-'+val.replace(/\s+/g, '-')+'" value="this field value will be displayed after saving the form"/><label class="demo-radio" for="'+val.replace(/\s+/g, '-')+'">'+$.trim(val)+'</label></div>';
         }
       }
      });
    $(this).find('.dfu-input-div').remove();
    $(this).append('<div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit-checkbox" data-id="'+$(this).attr('id')+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType[0]+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><label class="demo-checkbox-label-main" data-class="'+getClass+'" data-option="'+getOption+'" data-default="'+getDefault+'" data-values="'+getDefaultVals+'">'+getLabel+'</label><br>'+optionout+'<div style="clear: both;"></div>');
    }

    if(getType[0] == 'submit'){

    var getLabel = $(this).find('.dfu-input-div .dfu-btn').text();
    var getName = $(this).find('.dfu-input-div .dfu-btn').attr('name');
    var getClass = '';
    
     var getClasses = $.trim($(this).find('.dfu-input-div').attr('class'));
     var getClassSplit = getClasses.split(' ');
     if(getClassSplit.length > 1){
     getClassSplit.shift();
     getClass = getClassSplit.join(" ");
     }
    $(this).find('.dfu-input-div').remove();
    $(this).append('<div class="operation-btn"><span class="dashicons dashicons-edit difu-demo-field-edit-submit" data-id="'+$(this).attr('id')+'" style="color: #00b72e;cursor: pointer;" data-type="'+getType[0]+'"></span>  <span class="dashicons dashicons-no-alt difu-demo-field-remove" style="color: #df0101;cursor: pointer;"></span></div><button type="button" style="margin-left: 10px; border-radius: 2px;padding: 10px 20px;font-size: 15px;cursor: pointer;" class="difu-demo-field" data-class="'+getClass+'" name="'+getName+'">'+getLabel+'</button>');
    }
});
$(".difu-form-demo").sortable({
    placeholder: 'slide-placeholder',
    axis: "y",
    revert: 150,
    start: function(e, ui){
        placeholderHeight = ui.item.outerHeight();
        ui.placeholder.height(placeholderHeight + 15);
        $('<div class="slide-placeholder-animator" data-height="' + placeholderHeight + '"></div>').insertAfter(ui.placeholder);
    
    },
    change: function(event, ui) {
        ui.placeholder.stop().height(0).animate({
            height: ui.item.outerHeight() + 15
        }, 300);
        
        placeholderAnimatorHeight = parseInt($(".slide-placeholder-animator").attr("data-height"));    
        $(".slide-placeholder-animator").stop().height(placeholderAnimatorHeight + 15).animate({
            height: 0
        }, 300, function() {
            $(this).remove();
            placeholderHeight = ui.item.outerHeight();
            $('<div class="slide-placeholder-animator" data-height="' + placeholderHeight + '"></div>').insertAfter(ui.placeholder);
        });
        
    },
    stop: function(e, ui) {  
        $(".slide-placeholder-animator").remove();
    },
});

});

})(jQuery);