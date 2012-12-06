/*(function ($) {
  'use strict';

  // Initialize the jQuery File Upload widget:
  $('#jquery-file-upload-form').fileupload({
    acceptFileTypes: /(\.|\/)(gif|jpe?g|png|tiff|asf|avi|mpe?g|wmv|vob|mov|mp4|flv|txt|doc|docx|xls|xlsx|ppt|pptx)$/i,
    previewMaxWidth: 120
  }
  );

  // Load existing files:
  $('#jquery-file-upload-form').each(function () {
    var that = this;
    $.getJSON(this.action, function (result) {
      if (result && result.length) {
        $(that).fileupload('option', 'done')
        .call(that, null, {
          result: result
        });
      }
    });
  });

})(jQuery);*/
var space_allowed = 0;
function init_fileuploader(vars){
  space_allowed = vars.space_remaining;
  
  var types = vars.filetypes;
  var pattern = new RegExp("(\.|\/)("+types+")$");

  var total_bytes_cal = 0;
  var added_files = new Array();
  //alert(types);
  jQuery('#jquery-file-upload-form').fileupload({//gif|jpe?g|png|tiff|asf|avi|mpe?g|wmv|vob|mov|mp4|flv
    sequentialUploads: true,
    acceptFileTypes: pattern,
    previewMaxWidth: 120,
    maxFileSize: vars.max_file_size,
    change: function (e, data) {
      
      var total_bytes = 0;
      jQuery.each(data.files, function (index, file) {
        //alert(file.name);
        added_files.push(index);
        total_bytes = total_bytes + file.size;   
      });
      if(total_bytes > space_allowed){
        total_bytes_cal = total_bytes;
        var msg = "You have selected to upload a total of " + hsize(total_bytes) + ".\n";
        msg += "However, you only have " + hsize(space_allowed) + " of remaining space.\n";
        alert(msg);
        total_bytes = 0;
      }else{
        total_bytes_cal = 0;
      }
    },
    start: function(e, data){
      //alert(total_bytes_cal);
      if(total_bytes_cal > space_allowed){
        jQuery('button.cancel').trigger('click');
        jQuery('.progress-success').hide();
      }
    },
    added: function(e, data){
      
      if(total_bytes_cal > space_allowed){
        jQuery('button.cancel').trigger('click');
        jQuery('.progress-success').hide();
        //jQuery('.table-striped').hide();
      }
      //total_bytes_cal = 0;
    },
    completed: 
      function(e, data){
      
      jQuery.ajax({
        type: "POST",
        url: base_path+'jquery_file_upload/get_remaining_space',
        success: function(data) {
          space_allowed = data;
        }});
    }
  });
  
   // Load existing files:
        jQuery('#jquery-file-upload-form').each(function () {
          var that = this;
          jQuery.getJSON(this.action, function (result) {
            if (result && result.length) {
              $(that).fileupload('option', 'done')
              .call(that, null, {
                result: result
              });
            }
          });
        });
  
}
function hsize(b){
    if(b >= 1048576) return (Math.round((b / 1048576) * 100) / 100) + " mb";
    else if(b >= 1024) return (Math.round((b / 1024) * 100) / 100) + " kb";
    else return b + " b";
}

