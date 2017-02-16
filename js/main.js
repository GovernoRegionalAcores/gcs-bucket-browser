$(function() {

    var metadata_xhr = null;

$('#jstree-container').jstree({
'core' : {
  'themes' : {
	'dots':false
  },
  'data' : {
    'url' : function (node) {
        return node.id === '#' ?
          '/api.php?listObjects=true&items=true' : '/api.php?listObjects=true&items=true&prefix='+encodeURIComponent(node.id);
      },
    'dataType' : 'json',
    'data' : function (node) {
			return { "id" : node.id };
		}
  }
}
});

$('#jstree-container').on("select_node.jstree", function (e, data) { 
    var node, id, metadata_url;
    if (metadata_xhr !== null) {
      metadata_xhr.abort();
    }
    $('#file-props').empty();
    $('#file-contents').empty();
    $('#file-props').html('Loading...');
    id = data.node.li_attr.gcs_id;
    if (id.substr(id.length - 1) == '/') {
      $('#file-props').html('Folders don\'t have metadata.');
    }else{
      metadata_url = '/api.php?getObject=true&object='+id;

      metadata_xhr = $.ajax({
        url: metadata_url,
        dataType: 'json',
        success: function(data, textStatus, xhr) {
          fill_metadata(data);
        }
      });
    }
});

function fill_metadata(data) {
    var dlstr;
    if (typeof data.error !== 'undefined') {
	dlstr = '<dl  class="dl-horizontal">Error code '+data.error.code+' - '+data.error.message+'</dl>';
    }else{
        dlstr = '<dl  class="dl-horizontal">';
        dlstr += '<dt>Content-Type</dt><dd>' + data.contentType + '</dd>';
    	dlstr += '<dt>MD5</dt><dd>' + data.md5Hash + '</dd>';
    	dlstr += '<dt>Size</dt><dd>' + bytesToSize(data.size, 2) + '</dd>';
    	dlstr += '<dt>Created</dt><dd>' + data.timeCreated + '</dd>';
    	dlstr += '<dt><a class="download" id="'+data.name+'"href="#">Download File</a></dt><dd></dd>';
    	dlstr += '</dl><br/>';
    }
    $('#file-props').html(dlstr);


    $( ".download" ).click(function() {
	window.location.href = '/api.php?downloadObject=true&object='+$(this).attr('id');
    });
}



function bytesToSize(bytes, precision){  
    var kilobyte = 1024;
    var megabyte = kilobyte * 1024;
    var gigabyte = megabyte * 1024;
    var terabyte = gigabyte * 1024;
   
    if ((bytes >= 0) && (bytes < kilobyte)) {
        return bytes + ' B';
 
    } else if ((bytes >= kilobyte) && (bytes < megabyte)) {
        return (bytes / kilobyte).toFixed(precision) + ' KB';
 
    } else if ((bytes >= megabyte) && (bytes < gigabyte)) {
        return (bytes / megabyte).toFixed(precision) + ' MB';
 
    } else if ((bytes >= gigabyte) && (bytes < terabyte)) {
        return (bytes / gigabyte).toFixed(precision) + ' GB';
 
    } else if (bytes >= terabyte) {
        return (bytes / terabyte).toFixed(precision) + ' TB';
 
    } else {
        return bytes + ' B';
    }
}
});
