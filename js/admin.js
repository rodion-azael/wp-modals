(function(){
	jQuery('.color-field').wpColorPicker({hide: true, palettes: true});
	jQuery('.bg-color').wpColorPicker({hide: true, palettes: true});
	jQuery('#openMediaLibrary').click(function(e){
		var original_editor = window.send_to_editor;
		e.preventDefault();
		tb_show('', 'media-upload.php?TB_iframe=false');
		window.send_to_editor = function(html) {
	        url = jQuery(html).attr('src');
	        jQuery('#gamebAP_backgroundImage').val(url);
	        tb_remove();
	        window.send_to_editor = original_editor;
	    };
	    return false;
	});
	jQuery('#gamebAP_show').change(function(){
		if(jQuery(this).val() == 'periodically')
			jQuery('.period-selection').removeClass('hidden-field');
		else
			jQuery('.period-selection').addClass('hidden-field');

	});
	jQuery('#gamebAP_addButtonBtn').click(function(e){
		e.preventDefault();
		var table = jQuery('#gamebAP_buttons');
		table.append('<tr class="btnSeparator"><td width="140"><input type="text" name="gamebAP_btnText[]" placeholder="Button Text" style="width:140px;"/></td><td width="500" width="220" colspan="2"><input type="text" class="color-field" name="gamebAP_btnColor[]" style="width:90px;" data-default-color="#effeff" placeholder="Color"/></td></tr><tr><td width="140" style="vertical-align:top;"><select name="gamebAP_btnBehavior[]" style="width:140px"><option value="">Behavior</option><option value="ok">Ok</option><option value="cancel">Cancel</option><option value="redirect">Redirect</option><option value="custom">Custom</option></select><select name="gamebAP_btnPos[]" style="width:140px"><option value="">Button Position</option><option value="topLeft">Top Left</option><option value="topMiddle">Top Middle</option><option value="topRight">Top Right</option><option value="bottomLeft">Bottom Left</option><option value="bottomMiddle">Bottom Middle</option><option value="bottomRight">Bottom Right</option></select></td><td width="120" style="vertical-align:top;"><input type="text" name="gamebAP_buttonUrl[]" placeholder="URL when redirect behavior"></td><td width="120" style="vertical-align:top;"><input type="text" name="gameAP_btnClass[]" placeholder="Custom class"/><input type="text" name="gameAP_btnID[]" placeholder="Custom ID"/></td><td width="100"><a href="#" class="gamebAP_removeBtn button">Remove</a></td></tr>');
		jQuery('.color-field').wpColorPicker({hide: true, palettes: true});
		return false;
	});
	jQuery('#gamebAP_buttons').on('click', '.gamebAP_removeBtn', function(e){
		e.preventDefault();
		var row = jQuery(this).parent().parent();
		row.prev('.btnSeparator').remove();
		row.remove();
		return false;
	});
})();
