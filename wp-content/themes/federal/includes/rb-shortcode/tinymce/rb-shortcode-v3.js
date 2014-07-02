(function () {
    tinymce.create("tinymce.plugins.RbShortcode", {
        init: function (d, e) {
            d.addCommand("OpenRbDialog", function (a, c) {
				
				var dialogHelper = new rbDialogHelper(e, c.editorid, c.identifier);

                })
				
            d.onNodeChange.add(function (a, c) {
                c.setDisabled("scn_button", a.selection.getContent().length > 0)
            })
        },
		addToMenu: function(mapname, mapvalue, b, a, c, ref){
			var thisobj = this;
			if(typeof mapvalue == 'object'){
				if(mapvalue.type=='category'){
					c =  b.addMenu({ title: mapname });
					
					jQuery.each(mapvalue.items, function(itemname, itemvalue){
						thisobj.addToMenu(itemname, itemvalue, c, a, c, 'sub');
					});
					
				}else if(mapvalue.type=='rb-dialog'){
						a.addWithDialog(b, mapvalue.label, mapvalue.code);
				}else{
					a.addImmediate(b, mapname, mapvalue);
				}
			}else{
				a.addImmediate(b, mapname, mapvalue);
			}
		},
        createControl: function (d, e) {
            if (d == "rbshortcode_button") {
                d = e.createMenuButton("rbshortcode_button", {
                    title: "RB Shortcode Generator",
                    image: rb_globals.plugins+"tinymce/img/icon.png",
                    icons: false
                });
                var a = this;
                d.onRenderMenu.add(function (c, b) {
					var shMap = jQuery.parseJSON( rb_globals.shortcodeMap );
					for (var map in shMap){
						a.addToMenu(map, shMap[map], b, a, c);
					}                     
                });
                return d
            }
            return null
        },
        addImmediate: function (d, e, a) {
            d.add({
                title: e,
                onclick: function () {
                    tinyMCE.activeEditor.execCommand("mceInsertContent", false, a)
                }
            })
        },
        addWithDialog: function (d, e, a) {
            d.add({
                title: e,
                onclick: function () {
                    tinyMCE.activeEditor.execCommand("OpenRbDialog", false, {
						editorid: tinyMCE.activeEditor.id,
                        title: e,
                        identifier: a
                    })
                }
            })
        },
		getInfo: function () {
            return {
                longname: "RenkliBeyaz Shortcode Plugin",
                author: "RenkliBeyaz - Salih Ozovali",
                authorurl: "http://themeforest.net/user/RenkliBeyaz",
                infourl: "http://themeforest.net/user/RenkliBeyaz",
                version: "1.0"
            }
        }
    });
    tinymce.PluginManager.add("RbShortcode", tinymce.plugins.RbShortcode)
})();
