function rbDialogHelper(baseurl, editorid, identifier, shortCodeContent){
	var thisobj = this;
	var dialogid = +Math.floor(Math.random() * 10000);
	var content = (typeof shortCodeContent!='undefined')?shortCodeContent:'';
	var title = '';
	jQuery.post(baseurl + "/rb-dialog.php", {code: identifier, dialogID:dialogid, content:content}, function (loadedpage) {
		$htmlLoaded = jQuery("<div/>").html(loadedpage);
		thisobj.codeparams = $htmlLoaded.find('#rb-dialog').data('codeparams');
		title = $htmlLoaded.find('title').text();
		if(identifier == null)
			identifier = $htmlLoaded.find('#rb-dialog').data('code');
		
		thisobj.identifier = identifier;
		thisobj.title = title;
		
		var dialogName = 'shModal_'+dialogid;
		var modalContent = '<div class="modal modal-wide fade shModal" id="'+dialogName+'">\
							  <div class="modal-dialog">\
								<div class="modal-content">\
								  <div class="modal-header">\
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>\
									<h2 class="modal-title">Insert Shortcode: '+title+'</h2>\
								  </div>\
								  <div class="modal-body">'+loadedpage+'</div>\
								  <div class="modal-footer">\
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
		if(editorid!='function')
		modalContent += '			<button type="button" class="btn btn-primary insertShortCode">Insert</button>';
		else
		modalContent += '			<button type="button" class="btn btn-primary saveShortCode">Save</button>';
		modalContent += '		  </div>\
								</div><!-- /.modal-content -->\
							  </div><!-- /.modal-dialog -->\
							</div><!-- /.modal -->';
		jQuery("body").append(modalContent);
		jQuery('#'+dialogName).modal();
		jQuery('#'+dialogName).on('hidden.bs.modal', function (e) {
			jQuery('#'+dialogName).remove();
		});
	});

	//this.dialogid = modalid;
	this.dialogid = dialogid;
	this.identifier = identifier;
	this.opernerid = editorid;
	this.baseurl = baseurl;
	this.title = title;
	
	
	
	this.additionalValidationClasses = function(){
		jQuery.formUtils.addValidator({
			name : 'cssvalue',
			validatorFunction : function(value, $el, config, language, $form) {
				if(value=='auto') return true;
				var retArr = value.match(/^([\d]*\.?[\d]+)([^\d]*)$/);
				if(retArr)
				{
					retArr[1] = (retArr[1].indexOf('.') >= 0)?parseFloat(retArr[1]):parseInt(retArr[1]);
					if(retArr[2]=='px' || retArr[2]=='em' || retArr[2]=='%')
						return true;
				}else
					return false;
			},
			errorMessage : 'You have to give a number with % or px',
			errorMessageKey: 'badCssValue'
		});
		
		jQuery.formUtils.addValidator({
			name : 'hexcolor',
			validatorFunction : function(value, $el, config, language, $form) {
				return value.match(/^#[a-f0-9]{6}$/i) !== null
			},
			errorMessage : 'You have to give a hex color value',
			errorMessageKey: 'badHexColorValue'
		});
	}
	
	this.setTinyMCE = function(){
		jQuery('#shModal_'+this.dialogid+' .rb-tinymce').each(function()
		{
			var el_id		= this.id,
				current 	= this, 
				parent		= jQuery(current).parents('.wp-editor-wrap:eq(0)'),
				textarea	= parent.find('textarea.rb-tinymce'),
				switch_btn	= parent.find('.wp-switch-editor').removeAttr("onclick"),
				settings	= {id: this.id , buttons: "strong,em,link,block,del,ins,img,ul,ol,li,code,spell,close"};
			
			var tinyVersion = window.tinyMCE.majorVersion,
			executeAdd  = "mceAddControl",
			executeRem	= "mceRemoveControl";
			
			if(tinyVersion >= 4)
			{
				executeAdd = "mceAddEditor";
				executeRem = "mceRemoveEditor";
			}
			
			quicktags(settings);
			QTags._buttonsInit();
			
			switch_btn.bind('click', function()
			{
				var button = this;
				
				if(jQuery(button).is('.switch-tmce'))
				{
					parent.removeClass('html-active').addClass('tmce-active');
					window.tinyMCE.execCommand(executeAdd, true, el_id);
					window.tinyMCE.get(el_id).setContent(window.switchEditors.wpautop(textarea.val()), {format:'raw'});
				}
				else
				{
					parent.removeClass('tmce-active').addClass('html-active');
					window.tinyMCE.execCommand(executeRem, true, el_id);
				}
			}).trigger('click');
			
		});
		
	}
	
	this.getParamValue = function(type, paramname){
		var dialogid = this.dialogid;
		if(type == 'text' || type == 'singleimage' || type=='color' || type=='iconname')
			uservalue = jQuery('#shModal_'+dialogid+' input[name='+paramname+']').val();
		else if(type=='select' || type=='gallerylist' || type=='pagelist')
			uservalue = jQuery('#shModal_'+dialogid+' select[name='+paramname+'] option:selected').val();
		else if(type=='group')
			uservalue = jQuery('#shModal_'+dialogid+' input:radio[name='+paramname+']:checked').val();
		else if(type=='listcreator'){
			uservalue = '';
			jQuery('#shModal_'+dialogid+' select[name='+paramname+'] option').each(function(){
				uservalue += jQuery(this).val()+', ';
			});
			uservalue = uservalue.substr(0,uservalue.length-2);
		}
		return uservalue;
	}
	
	this.makeShortcode = function(){
		var dialogid = this.dialogid;
		var codeparams = this.codeparams;
		var thisobj = this;
		var re = '';
		re += '['+this.identifier;
		if(typeof codeparams.params != 'undefined'){
			jQuery.each(codeparams.params, function(paramname, paramvalue) {
				var uservalue = thisobj.getParamValue(paramvalue.type, paramname);
				re  +=' '+paramname+'="'+uservalue+'"';
			});
		}
		re += ']';
		if(codeparams.content=='html')
			re += tinymce.editors['shcontent_'+this.dialogid].getContent()+'[/'+this.identifier+']';
		else if(codeparams.content=='shortcode'){
			if(codeparams.contentType=='orderlist'){
				jQuery('#shModal_'+dialogid+' .orderListWrapper .list-group li').each(function(){
					re += jQuery(this).find('.orderItemShortCode').html();
				});
				re +='[/'+this.identifier+']';
			}
		}else if(codeparams.content=='text'){
			re += jQuery('#shModal_'+dialogid+' .shcontentText').val();
			re += '[/'+this.identifier+']';
		}else if(codeparams.content=='textarea'){
			re += jQuery('#shModal_'+dialogid+' .shcontentTextarea').val();
			re += '[/'+this.identifier+']';
		}
		return re;
	}
	
	
	this.getDefaultTitle = function(){
		var codeparams = this.codeparams;
		if(typeof codeparams.defaultTitle != 'undefined'){
			var paramType = codeparams.params[codeparams.defaultTitle].type;
			var paramName = codeparams.defaultTitle;
			return this.getParamValue(paramType, paramName);
		}else
		 return '';
	}
	
	this.closeDialog = function(){
		jQuery('#shModal_'+this.dialogid).modal('hide');
	}
	
	this.insertAction = function () {
        if (typeof this.identifier != 'undefined') {
            var shortcodeContent = this.makeShortcode();
            tinymce.editors[this.opernerid].execCommand("mceInsertContent", false, shortcodeContent);
            this.closeDialog();
        }
    }
	this.saveAction = function () {
        if (typeof this.identifier != 'undefined') {
            var shortcodeContent = this.makeShortcode();
			var defaultTitle = this.getDefaultTitle();
			this.oncomplete(shortcodeContent, defaultTitle);
            this.closeDialog();
        }
    }
	
	this.setOrderListBehaviors = function(){
		var thisobj = this;
		var dialogid = this.dialogid;
		
		jQuery('#shModal_'+dialogid+' .orderListWrapper .list-group').sortable({
			 handle: ".orderListDrag"
		});
		
		jQuery('#shModal_'+dialogid+' .orderListWrapper .orderItemRemove').unbind('click').click(function(){
			if(window.confirm('Are you sure to delete this item?')){
				jQuery(this).parent().remove();
				thisobj.setOrderListBehaviors();
			}
		});
		
		jQuery('#shModal_'+dialogid+' .orderListWrapper .orderItemEdit').unbind('click').click(function(){
			var currentItem = jQuery(this).parents('.list-group-item')
			var itemData = currentItem.find('.orderItemShortCode').html();
			var subDialog = new rbDialogHelper(thisobj.baseurl, 'function', null, itemData);
			subDialog.oncomplete = function(subsortcode, title){
				currentItem.find('.orderItemShortCode').html(subsortcode);
				currentItem.find('.orderItemTitle').text(title);
				thisobj.setOrderListBehaviors();
			}
		});
	}
	
	this.setIconListBehaviors = function(){
		var thisobj = this;
		var dialogid = this.dialogid;
		
		jQuery('#shModal_'+dialogid+' .iconlistwrapper .iconlist span').click(function(){
			var type = jQuery(this).parents('.iconlist').data('type');
			jQuery(this).parent().find('span').removeClass('selected');
			jQuery(this).addClass('selected');
			var selectedValue = '';
			if(type=='name')
				selectedValue = jQuery(this).data('name');
			else if(type=='code')
				selectedValue = jQuery(this).data('code');
			jQuery(this).parents('.iconlistwrapper').find('input').val(selectedValue);
		});
	}
	
	this.setOrderListAddButton = function(){
		var thisobj = this;
		var dialogid = this.dialogid;
		var orderList = jQuery('#shModal_'+dialogid+' .orderListWrapper ul.list-group');
		jQuery('#shModal_'+dialogid+' .addOrderListItem').click(function(){
			var subDialog = new rbDialogHelper(thisobj.baseurl, 'function', jQuery(this).data('shortcode'));
			subDialog.oncomplete = function(subsortcode, title){
				var newOrderItem = jQuery('<li class="list-group-item">\
				<a href="#" role="button" class="btn btn-default orderListDrag"><i class="fa fa-arrows-v"></i></a> \
				<span class="orderItemTitle">'+title+'</span>\
				<span class="orderItemShortCode">'+subsortcode+'</span> \
				<button type="button" class="btn btn-warning btn-sm orderItemEdit pull-right"><i class="fa fa-pencil-square-o"></i></button>\
				<button type="button" class="btn btn-danger btn-sm pull-right orderItemRemove"><i class="fa fa-times"></i></button>\
				</li>');
				orderList.append(newOrderItem);
				thisobj.setOrderListBehaviors();
			}
		});
	}
	
	this.setColorPicker = function(){
		var dialogid = this.dialogid;
		jQuery('#shModal_'+dialogid+' .colorPickerField').each(function(){
			jQuery(this).ColorPicker({
				onSubmit: function(hsb, hex, rgb, el) {
					jQuery(el).val('#'+hex);
					jQuery(el).ColorPickerHide();
				},
				onBeforeShow: function () {
					jQuery(this).ColorPickerSetColor(this.value);
				}
			})
			.bind('keyup', function(){
				jQuery(this).ColorPickerSetColor(this.value);
			});
		});
	}
	
	this.setListCreator = function(){
		var dialogid = this.dialogid;
		jQuery('#shModal_'+dialogid+' .listcreator .addlistcreator').click(function(){
			var lc = jQuery(this).parents('.listcreator');
			var selectedEl = lc.find('.sourcebox option:selected').clone();
			var exitsValue = false;
			lc.find('.targetbox option').each(function(){
				if(jQuery(this).val()==selectedEl.val())
					exitsValue = true;
			});
			if(!exitsValue)
				lc.find('.targetbox').append(selectedEl);
			else
				alert('This item already added');
		}); 
		
		jQuery('#shModal_'+dialogid+' .listcreator .removelistcreator').click(function(){
			var lc = jQuery(this).parents('.listcreator');
			selectedEl = lc.find('.targetbox option:selected').remove();
		}); 
		
		jQuery('#shModal_'+dialogid+' .listcreator .removealllistcreator').click(function(){
			if(window.confirm('Are you sure to remove all items?')){
				var lc = jQuery(this).parents('.listcreator');
				selectedEl = lc.find('.targetbox option').remove();
			}
		}); 
	}
	
	setTimeout(function(){
		thisobj.setTinyMCE();
		
		thisobj.additionalValidationClasses();
		thisobj.setOrderListAddButton();
		thisobj.setIconListBehaviors();
		thisobj.setColorPicker();
		thisobj.setListCreator();
		
		jQuery.validate({
			 form : '#shModal_'+thisobj.dialogid+' .insertcode',
			 onSuccess : function() {
			  if(editorid!='function')
				thisobj.insertAction();
			  else
				thisobj.saveAction();
			  return false; // Will stop the submission of the form
			},
		});
		
		jQuery('#shModal_'+thisobj.dialogid+' .singleimagechoose').click(function(){
			var $thisEl = jQuery(this);
			
			var file_manager;
			if (file_manager) {
				file_manager.open();
				return;
			}
		 
			file_manager = wp.media.frames.file_frame = wp.media({
				multiple: false,
				library: {
				  type: 'image'
				},
				title: 'Choose an Image',
				button: {
					text: 'Choose an Image'
				}
			});
	 
			file_manager.on('select', function() {
				attachment = file_manager.state().get('selection').first().toJSON();
				$thisEl.parents('.singleimage').find('input').val(attachment.url).addBack().find('img').attr('src', attachment.url);
			});
			file_manager.open();
		});
		
		
		jQuery('#shModal_'+dialogid+' .insertShortCode, #shModal_'+dialogid+' .saveShortCode').click(function () {
			jQuery('#shModal_'+dialogid+' .insertcode').submit();
		});
	
		}, 1000);
	
    
}