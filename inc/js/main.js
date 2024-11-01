(function($) {

$(document).ready(function() {
$(".dfu-notice-quit").on("click", function () {
   $(this).parent('div').fadeOut();
});


$('.expand-data-table').on('click', function(){

  if($('#post-body').hasClass('columns-2')){
    $('#post-body').removeClass('columns-2');
    $(this).html('Contract <span class="dashicons dashicons-editor-contract"></span>');
  }else{
   $('#post-body').addClass('columns-2');
    $(this).html('Expand <span class="dashicons dashicons-editor-expand"></span>');
  }

});



$('.dfu-table-option').on('click', function(event) {
   event.preventDefault();
   var getStats = $('.dfu-table-hidden-content').css('display');
   if(getStats == 'none'){
   	$('.dfu-table-hidden-content').css('display', 'block');
   	$('.dfu-table-hidden-content-inner').fadeIn();
   	$('body').css('overflow', 'hidden');	
   }else{
   	$('.dfu-table-hidden-content-inner').fadeOut();
   	$('.dfu-table-hidden-content').css('display', 'none');  
   	$('body').css('overflow', '');	
   }
});


var tableModalClose = function(evt){
	evt.stopPropagation();
$('.dfu-table-hidden-content-inner').fadeOut();
$('.dfu-table-hidden-content').css('display', 'none');
$('body').css('overflow', '');	

}
$('.dfu-table-hidden-content-inner').on('click',function(event) {
	event.preventDefault();
	event.stopPropagation();
});
$('.dfu-table-hidden-content').on('click', tableModalClose);
$('.dfu-table-hidden-content-close').on('click', tableModalClose);


$('.dfu-cell-append').on('click', '.change-table-info', function(event) {
	event.preventDefault();
	var checkInput = $(this).closest('tr').find('.cell-2');
	var tableName = $(this).closest('tr').find('.cell-2').text();
	if (!checkInput.find('input').length) {
	$(this).closest('tr').find('.cell-2').html('');
	$(this).closest('tr').find('.cell-2').append('<input type="text" class="table-updated-name" name="dfuTableName" value="'+$.trim(tableName)+'">');	
	$(this).closest('tr').find('.cell-3').prepend('<button type="button" class="close-table-info" data-oldname="'+$.trim(tableName)+'"> <span class="dashicons dashicons-no-alt"></span> Close </button>');
	$(this).remove();
	}
});



$('.dfu-cell-append').on('click', '.change-column-info', function(event) {
	event.preventDefault();
	var checkInput = $(this).closest('tr').find('.cell-2');
	var tableName = $(this).closest('tr').find('.cell-2').text();
	if (!checkInput.find('input').length) {
	$(this).closest('tr').find('.cell-2').html('');
	$(this).closest('tr').find('.cell-2').append('<input type="text" class="column-updated-name" data-name="'+$.trim(tableName)+'" value="'+$.trim(tableName)+'">');	
	$(this).closest('tr').find('.cell-3').prepend('<button type="button" class="close-column-info" data-oldname="'+$.trim(tableName)+'"> <span class="dashicons dashicons-no-alt"></span> Close </button>');
	$(this).remove();
	}
});


$('.dfu-cell-append').on('click', '.close-table-info',  function(evt){
	var oldName = $(this).data('oldname');
	var checkInput = $(this).closest('tr').find('.cell-2');
	if (checkInput.find('input').length) {
	$(this).closest('tr').find('.cell-2').html('');
	$(this).closest('tr').find('.cell-2').html(oldName);
	$(this).closest('tr').find('.cell-3').prepend('<button type="button" class="change-table-info"> <span class="dashicons dashicons-edit"></span> Edit </button>');
	$(this).remove();
	}
});
$('.dfu-cell-append').on('click', '.close-column-info',  function(event){
	var oldName = $(this).data('oldname');
	var checkInput = $(this).closest('tr').find('.cell-2');
	if (checkInput.find('input').length) {
	$(this).closest('tr').find('.cell-2').html('');
	$(this).closest('tr').find('.cell-2').html(oldName);
	$(this).closest('tr').find('.cell-3').prepend('<button type="button" class="change-column-info"> <span class="dashicons dashicons-edit"></span> Edit </button>');
	$(this).remove();
	}
});

$('.delete-table-info').on('click', function(event) {
	event.preventDefault();
	var getId = $(this).data('table');
	var getnonce = $(this).data('wpnonce');
    if(confirm("Are your to delete this table?")){
    $.ajax({
    type: "POST",
    url: deletetable.admin_ajax,
    dataType: "json",
    data: {action: 'difu_delete_auto_created_table', id: getId, wpnonce: getnonce},
    success: function(deleteresponse) {
     if (deleteresponse['value'] == 1) {
      window.location.href = "admin.php?page=tiger-forms-all-inserted-data";
     }else{
      alert('Security token verification failed ! Please reaload the current page.');
     }
    }
    });
   }
});


$('.delete-column-info').on('click', function(event) {
	event.preventDefault();
	var getId = $(this).data('table');
	var getIndex = $(this).data('columnindex');
	var getnonce = $(this).data('wpnonce');
    if(confirm("Are your to delete this column?")){
    $.ajax({
    type: "POST",
    url: deletecolumn.admin_ajax,
    dataType: "json",
    data: {action: 'difu_delete_auto_table_columns', id: getId, index: getIndex, wpnonce: getnonce},
    success: function(columndeleteresponse) {
     if (columndeleteresponse['value'] == 1) {
      window.location.href = "admin.php?page=tiger-forms-all-inserted-data&datatable="+columndeleteresponse['id'];
     }else{
      alert('Security token verification failed ! Please reaload the current page.');
     }
    }
    });
   }
});


$('.save-column-name').on('click', function(event) {
	event.preventDefault();
  var formAllData = [];
  if($(this).parents('form').find('.table-updated-name').length > 0){
    var tableUpdatedName = $(this).parents('form').find('.table-updated-name').val();
    var tableOldName = $(this).parents('form').find('.table-updated-name').attr('name');
    formAllData.push({name : tableOldName, value : tableUpdatedName});
  }
  var indexcount = 1;
  if($(this).parents('form').find('.column-updated-name').length > 0){
   
   $(this).parents('form').find('.column-updated-name').each(function() {
     var columnUpdatedName = $(this).data('name')+"1971difu2020"+$(this).val();
     var columnOldName = "column-"+indexcount++;
     formAllData.push({name : columnOldName, value : columnUpdatedName});
   });
  }
   formAllData.push({name : 'totalEditedColumn', value : indexcount-1});
	if (formAllData.length) {
	var getId = $(this).data('table');
	var getnonce = $(this).data('wpnonce');
    formAllData.push({name :'action', value :'difu_columns_update'}, {name: 'id', value: getId}, {name: 'wpnonce', value: getnonce});
    $.ajax({
    type: "POST",
    url: updatecolumn.admin_ajax,
    dataType: "json",
    data: formAllData,
    success: function(columnupdateresponse) {
    if (columnupdateresponse['value'] == 1) {
      window.location.href = "admin.php?page=tiger-forms-all-inserted-data&datatable="+columnupdateresponse['id'];
     }else{
      alert('Security token verification failed ! Please reaload the current page.');
     }
    }
    });
    }else{
    	alert('No data was found to change!');
    }

});

$('.export-xls').on('click', function(ex) {
  ex.preventDefault();
  var getId = $(this).data('table');
  var getnonce = $(this).data('wpnonce');

  $('.dfu-hidden-export-operation').css('display', 'block');
  $('.dfu-export-table-append').load('admin.php?page=tiger-forms-export-table&dfutable='+getId+'&wpnonce='+getnonce+' .excel_report', function () {

  var data = "";
    var tableData = [];
    var rows = $('.dfu-export-table-append').find(".excel_report");
    rows.find('tr').each(function(index, row) {
      var rowData = [];
      $(row).find("th, td").each(function(index, column) {
        rowData.push(column.innerText);
      });
      tableData.push(rowData.join(","));
    });
    data += tableData.join("\n");
    var downloadURL= 'data:application/csv;charset=UTF-8,' + encodeURIComponent(data);
    $(document.body).append('<a id="download-link" download="tiger-form-'+getId+'.csv" href=' + downloadURL + '>');
    $('#download-link')[0].click();
    $('#download-link').remove();
    $('.dfu-hidden-export-operation').css('display', 'none');
    });

});


$('.difu-table-refresh').on('click', function(e) {
  e.preventDefault();
  if($(this).data('table') == ''){
  location.reload(); 
  }else{
  var tableName =   $(this).data('table');
  $.ajax({
    type: "POST",
    url: tablereset.admin_ajax,
    dataType: "json",
    data: {action: 'difu_data_table_reset', table: tableName},
    success: function(tablereset) {
    if(tablereset['value'] == 'success'){
     location.reload();  
   }else{
    location.reload();
   }
    }
    });
    
  }

});

});

})(jQuery);