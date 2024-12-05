var chkh;
var domain_res=document.domain;
var link_full;
$(function(){
	
	var dropbox = $('#dropbox'),
		message = $('.message', dropbox);
	
	dropbox.filedrop({
		paramname:'pic',
		maxfiles: 10,
    	maxfilesize: 2,
		url: link_full+'/@dmin/librarys/tt_hinh/xuly.php',
		chkh: chkh,
		
		uploadFinished:function(i,file,response){
			$.data(file).addClass('done');
		},
		
    	error: function(err, file) {
			switch(err) {
				case 'BrowserNotSupported':
					showMessage('Trình duyệt của bạn không hỗ trợ HTML5 vui lòng cài đặt trình duyệt mới hơn..!');
					break;
				case 'TooManyFiles':
					alert('Tối đa chỉ được 10 hình..!');
					break;
				case 'FileTooLarge':
					alert(file.name+' có dung lượng quá lớn, cho phép tối đa 2MB.');
					break;
				default:
					break;
			}
		},
		
		beforeEach: function(file){
			if(!file.type.match(/^image\//)){
				alert('File này không phải hình ảnh ( JPG, JPEG, PNG, GIF )..!');
				return false;
			}
			if(chkh=='0'){
				var answer=confirm("Bạn chưa đăng nhập..! Vui lòng đăng nhập..!"); 
				if(answer)window.location='http://'+domain_res+"/@dmin/";
				return false;	
			}
		},
		
		uploadStarted:function(i, file, len){
			createImage(file);
		},
		
		progressUpdated: function(i, file, progress) {
			$.data(file).find('.progress').width(progress);
		}
    	 
	});
	
	var template = '<div class="preview">'+
						'<span class="imageHolder">'+
							'<img />'+
							'<span class="uploaded"></span>'+
						'</span>'+
						'<div class="progressHolder">'+
							'<div class="progress"></div>'+
						'</div>'+
					'</div>'; 
	
	
	function createImage(file){

		var preview = $(template), 
			image = $('img', preview);
		var reader = new FileReader();
		
		image.width = 100;
		image.height = 100;
		
		reader.onload = function(e){
			image.attr('src',e.target.result);
		};
		
		reader.readAsDataURL(file);
		message.hide();
		preview.appendTo(dropbox);
		$.data(file,preview);
	}

	function showMessage(msg){
		message.html(msg);
	}

});