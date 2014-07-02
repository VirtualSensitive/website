(function () {
    tinymce.create("tinymce.plugins.RbShortcode", {
        init: function (d, e) {
			var $this = this;
			d.addButton( 'rbshortcode_button', {
        		type: 'menubutton',
        		text: "Shortcodes",
                title : "RB Shortcode Generator",
                icon :  "rbshortcode_button",
            	menu: $this.rbMenu(d)
           });
		   
            d.addCommand("OpenRbDialog", function (a, c) {
				var dialogHelper = new rbDialogHelper(e, c.editorid, c.identifier);

			})
				
        },
		rbMenu: function()
        {
			var finalMenu = [];
			var thisobj = this;
			
			var shMap = jQuery.parseJSON( rb_globals.shortcodeMap );
			for (var map in shMap){
				if(typeof shMap[map] == 'object'){
					if(shMap[map].type=='category'){
						var menuCategory = {text: map, menu: []};
						
						jQuery.each(shMap[map].items, function(itemname, itemvalue){
							
							if(typeof itemvalue != 'object')
								menuCategory.menu.push({text: itemname, value: itemvalue, onclick:thisobj.addImmediate});
							else if(itemvalue.type=='rb-dialog')
								menuCategory.menu.push({text: itemvalue.label, code: itemvalue.code, onclick:thisobj.addWithDialog});
						});
						
						finalMenu.push(menuCategory);
					}
				}
			}
			
			return finalMenu;
        },
		addImmediate: function () {
        	tinyMCE.activeEditor.execCommand("mceInsertContent", false, this.settings.value);
        },
		addWithDialog: function () {
		
			tinyMCE.activeEditor.execCommand("OpenRbDialog", false, {
				editorid: tinyMCE.activeEditor.id,
				title: this.settings.text,
				identifier: this.settings.code
			})
              
        },
		getInfo: function () {
            return {
                longname: "RenkliBeyaz Shortcode Plugin",
                author: "RenkliBeyaz - Salih Ozovali",
                authorurl: "http://themeforest.net/user/RenkliBeyaz",
                infourl: "http://themeforest.net/user/RenkliBeyaz",
                version: "1.2"
            }
        }
    });
    tinymce.PluginManager.add("RbShortcode", tinymce.plugins.RbShortcode);
})();
