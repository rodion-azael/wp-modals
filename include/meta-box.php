<?php
/*
This file contains the rendering functions for the meta box
*/

defined( 'ABSPATH' ) or die( 'Warning! Peeper approaching' );

function gamebOptions_amazing_popup($post, $args){
	wp_enqueue_script('gamebAP_admin');
	wp_enqueue_style('wp-color-picker');
	wp_enqueue_style('gamebAP_admin_css');
	$metaOptions = get_post_custom($post->ID);
	$metaOptions = unserialize(base64_decode($metaOptions['gamebAP_settings'][0]));

	//print_r($metaOptions);

	// Defaults or saved values
	$hideTitle 	= (isset($metaOptions['hideTitle'])) ? $metaOptions['hideTitle'] : ''; 
	$delay 		= (isset($metaOptions['delay'])) ? $metaOptions['delay'] : '500';
	$pos 		= (isset($metaOptions['position'])) ? $metaOptions['position'] : 'MiddleMiddle';
	$posX		= (isset($metaOptions['close_position'])) ? $metaOptions['close_position'] : 'topRight';
	$css 		= (isset($metaOptions['css_class'])) ? $metaOptions['css_class'] : '';
	$_id 		= (isset($metaOptions['custom_id'])) ? $metaOptions['custom_id'] : '';
	$template	= (isset($metaOptions['template'])) ? $metaOptions['template'] : '';
	$height 	= (isset($metaOptions['height'])) ? $metaOptions['height'] : '';
	$width 		= (isset($metaOptions['width'])) ? $metaOptions['width'] : '';
	$effect 	= (isset($metaOptions['effect'])) ? $metaOptions['effect'] : 'bounce';
	$bgImage 	= (isset($metaOptions['bg_img'])) ? $metaOptions['bg_img'] : '';
	$bgColor 	= (isset($metaOptions['bg_color'])) ? $metaOptions['bg_color'] : '';
	$closeBgCol	= (isset($metaOptions['closeBgCol'])) ? $metaOptions['closeBgCol'] : '';
	$bgLyColor 	= (isset($metaOptions['bg_layout_color'])) ? $metaOptions['bg_layout_color'] : '';
	$bgLayout 	= (isset($metaOptions['show_layout'])) ? $metaOptions['show_layout'] : '';
	$show 		= (isset($metaOptions['show'])) ? $metaOptions['show'] : 'once';
	$timeType 	= (isset($metaOptions['show_lapse_type'])) ? $metaOptions['show_lapse_type'] : 'minutes';
	$closeTime	= (isset($metaOptions['timeToClose'])) ? $metaOptions['timeToClose'] : '';
	$buttons 	= (isset($metaOptions['buttons']) && is_array($metaOptions['buttons'])) ? $metaOptions['buttons'] : array(array('text' => ''));



	echo '<input type="hidden" name="gamebAP_noncename" id="gamebAP_noncename" value="' .wp_create_nonce( 'save_gamebAP' ) . '" />';
	?>
	<table width="600px" style="border-spacing: 10px; border-collapse: separate;">
	<tr>
		<td width="400px" style="vertical-align:top" colspan="2">
			<input type="checkbox" name="gamebAP_hideTitle" id="gamebAP_hideTitle" <?php checked($hideTitle, 'on');?>/>
			<label for="gamebAP_hideTitle">Hide the title</label>
		</td>
		<td width="200px" style="vertical-align:top"></td>
	</tr>
	<tr>
		<td width="200px" style="vertical-align:top">
			<p>
			<label for="gamebAP_delay">Delay to show Popup:</label></br>
			<input type="text" name="gamebAP_delay" id="gamebAP_delay" value="<?php echo $delay;?>"/></br>
			<small>Enter numbers only, in milliseconds.</small>
			</p>
		</td>
		<td width="200px" style="vertical-align:top">
			<p>
				<label>Delay to autoclose:</label>
				<input type="text" id="gamebAP_timeToClose" name="gamebAP_timeToClose" value="<?php echo $closeTime;?>"/>
				<small>This time will begin to count at the time it popup. Leave empty or 0 to disbale this function. In milliseconds.</small>
			</p>
		</td>
		<td width="200px" style="vertical-align:top">
			<p>
				<label for="gamebAP_XPOS">Close button position:</label>
				<select name="gamebAP_XPOS" id="gamebAP_XPOS">
					<option value="topLeft" <?php selected($posX, 'topLeft')?>>Top Left</option>
					<option value="topRight" <?php selected($posX, 'topRight')?>>Top Right</option>
					<option value="bottomRight" <?php selected($posX, 'bottomRight')?>>Bottom Right</option>
					<option value="bottomLeft" <?php selected($posX, 'bottomLeft')?>>Bottom Left</option>
				</select><br>
				<small>Choose the position where you want to display the cross option on the box</small>
			</p>
		</td>
	</tr>
	<tr>
		<td width="200px" style="vertical-align:top">
			<p>
			<label for="gamebAP_css">Add css custom class:</label></br>
			<input type="text" name="gamebAP_css" id="gamebAP_css" value="<?php echo $css;?>"/></br>
			<small>This class will be added to you PopUp container so you can customize it.</small>
			</p>
		</td>
		<td width="200px" style="vertical-align:top">
			<p>
			<label for="gamebAP_id">Add custom ID:</label></br>
			<input type="text" name="gamebAP_id" id="gamebAP_id" value="<?php echo $_id;?>"/></br>
			<small>You can use this id to set up you own custom actions.</small>
			</p>
		</td>
		<td width="200px" style="vertical-align:top">
			<p>
				<label for="gamebAP_template">Choose a template:</label>
				<select name="gamebAP_template" id="gamebAP_template">
					<option value="none" <?php selected($template, 'none')?>>None. I will use my own style</option>
					<option value="basicWhite" <?php selected($template, 'basicWhite')?>>Basic White</option>
					<option value="basicGray" <?php selected($template, 'basicGray')?>>Basic Gray</option>
					<option value="classicPostal" <?php selected($template, 'classicPostal')?>>Classic Postal</option>
					<option value="winner" <?php selected($template, 'winner')?>>Winner alert</option>
					<option value="softBlue" <?php selected($template, 'softBlue')?>>Soft Blue</option>
					<option value="softGreen" <?php selected($template, 'softGreen')?>>Soft Green</option>
					<option value="softPink" <?php selected($template, 'softPink')?>>Soft Pink</option>
					<option value="classicWindows" <?php selected($template, 'classicWindows')?>>Classic Windows</option>
					<option value="modernWindows" <?php selected($template, 'modernWindows')?>>Modern Windows</option>
					<option value="modernWindowsGreen" <?php selected($template, 'modernWindowsGreen')?>>Modern Windows Green</option>
					<option value="modernWindowsPurple" <?php selected($template, 'modernWindowsPurple')?>>Modern Windows Purple</option>
					<option value="minimalist" <?php selected($template, 'minimalist')?>>Minimalist</option>
					<option value="facebookLook" <?php selected($template, 'facebookLook')?>>Facebook</option>
				</select><br>
				<small>You can choose from one of our amazing templates</small>
			</p>
		</td>
	</tr>
	<tr>
		<td width="200px" style="vertical-align:bottom">
			<p style="margin:0">
				<label for="gamebAP_Height">Height:</label>
				<input type="text" name="gamebAP_Height" id="gamebAP_Height" value="<?php echo $height;?>"/>				
			</p>
		</td>
		<td width="200px" style="vertical-align:bottom">
			<p style="margin:0">
				<label for="gamebAP_Width">Width:</label>
				<input type="text" name="gamebAP_Width" id="gamebAP_Width" value="<?php echo $width;?>"/>				
			</p>
		</td>
		<td width="200px" style="vertical-align:bottom">
			<p style="margin:0">
				<label for="gamebAP_position">Popup Position:</label>
				<select name="gamebAP_position" id="gamebAP_position">
					<option value="TopLeft" <?php selected($pos, 'TopLeft')?>>Top, Left</option>
					<option value="TopMiddle" <?php selected($pos, 'TopMiddle')?>>Top, Middle</option>
					<option value="TopRight" <?php selected($pos, 'TopRight')?>>Top, Right</option>

					<option value="MiddleLeft" <?php selected($pos, 'MiddleLeft')?>>Middle, Left</option>
					<option value="MiddleMiddle" <?php selected($pos, 'MiddleMiddle')?>>Middle, Middle</option>
					<option value="MiddleRight" <?php selected($pos, 'MiddleRight')?>>Middle, Right</option>

					<option value="BottomLeft" <?php selected($pos, 'BottomLeft')?>>Bottom, Left</option>
					<option value="BottomMiddle" <?php selected($pos, 'BottomMiddle')?>>Bottom, Middle</option>
					<option value="BottomRight" <?php selected($pos, 'BottomRight')?>>Bottom, Right</option>
				</select>				
			</p>
		</td>
	</tr>
	<tr>
		<td width="400px" style="vertical-align:top" colspan="2"><small>Set the proportion of the screen to cover. Numeric value only, in percent. This value may be overriden in mobile.</small></td>
		<td width="200px" style="vertical-align:top"><small>Choose in Vertical, Horizontal.</small></td>
	</tr>
	<tr>
		<td width="250px" style="vertical-align:middle" colspan="2"><br>
			<label for="gamebAP_backgroundImage">Bakground Image:</label><br>
			<input type="text" name="gamebAP_backgroundImage" id="gamebAP_backgroundImage" value="<?php echo $bgImage;?>"/>
			&nbsp;&nbsp;&nbsp;<a href="" id="openMediaLibrary"  class="button">Browse</a>
			<br><small>Choose background image from the media library or provide the full url.</small>
		</td>		
	</tr>
	<tr>
		<td width="250px" style="vertical-align:middle" colspan="2">
			<label for="gamebAP_backgroundColor" style="vertical-align:top;">Bakground Color:</label><br>
			<input type="text" name="gamebAP_backgroundColor" id="gamebAP_backgroundColor" class="bg-color" value="<?php echo $bgColor;?>"/>
			<br><small>Choose background color, It wont be visible if you also select a background image.</small>
		</td>		
	</tr>
	<tr>
		<td width="250px" style="vertical-align:middle" colspan="2">
			<label for="gamebAP_closeBackgroundColor" style="vertical-align:top;">Close Bakground Color:</label><br>
			<input type="text" name="gamebAP_closeBackgroundColor" id="gamebAP_closeBackgroundColor" class="bg-color" value="<?php echo $closeBgCol;?>"/>
			<br><small>Choose background color, It wont be visible if you also select a background image.</small>
		</td>		
	</tr>
	<tr>
		<td width="250px" style="vertical-align:middle" colspan="2">
			<input type="checkbox" name="gamebAP_bgLayout" style="vertical-align:super" <?php checked($bgLayout, 'on');?>/>
			<label for="gamebAP_bgLayout" style="vertical-align:top;">Include bakcground panel color:</label><br>
			<input type="text" name="gamebAP_layoutBGColor" id="gamebAP_layoutBGColor" class="bg-color" value="<?php echo $bgLyColor;?>"/>
			<br><small>Ckeck this option if you want to show a background with transparency</small>
		</td>		
	</tr>
	<tr>
		<td width="200px" colspan="1">
			<label for="gamebAP_show">Show:</label>
			<select name="gamebAP_show" id="gamebAP_show">
				<option value="once" <?php selected($show, 'once')?>>Only once</option>
				<option value="always" <?php selected($show, 'always')?>>Always</option>
				<option value="acceptance" <?php selected($show, 'acceptance')?>>Untill Ok</option>
				<option value="periodically" <?php selected($show, 'periodically')?>>Periodically</option>
				<option value="none" <?php selected($show, 'none')?>>Dont show it.</option>
			</select>
		</td>
		<td width="400px" style="vertical-align:bottom" colspan="2">
			<div class="<?php if($show != 'periodically') echo 'hidden-field'?> period-selection">show every: 
			<input type="text" name="gamebAP_every" id="gamebAP_every" style="width:40px; height:27px; vertical-align:middle" value="30"/>
			<select name="gamebAP_timeType" id="gamebAP_timeType" style="vertical-align:middle height:22px;">
				<option value="minutes" <?php selected($timeType, 'minutes')?>>Minutes</option>
				<option value="hours" <?php selected($timeType, 'hours')?>>Hours</option>
				<option value="days" <?php selected($timeType, 'days')?>>Days</option>
			</select><br><small>It will recheck every page reload.</small></div>
		</td>
	</tr>
	<tr>
		<td width="400px" colspan="2">
			<p>
				<label for="gamebAP_effect">Effect:</label>
				<select name="gamebAP_effect">
					<option value="bounce" <?php selected($effect, 'bounce')?>>Bounce</option>
					<option value="flash" <?php selected($effect, 'flash')?>>Flash</option>
					<option value="pulse" <?php selected($effect, 'pulse')?>>Pulse</option>
					<option value="rubberBand" <?php selected($effect, 'rubberBand')?>>Rubber Band</option>
					<option value="shake" <?php selected($effect, 'shake')?>>Shake</option>
					<option value="headShake" <?php selected($effect, 'headShake')?>>Head Shake</option>
					<option value="swing" <?php selected($effect, 'swing')?>>Swing</option>
					<option value="tada" <?php selected($effect, 'tada')?>>Tada</option>
					<option value="wobble" <?php selected($effect, 'wobble')?>>Wobble</option>
					<option value="jello" <?php selected($effect, 'jello')?>>Jello</option>
					<option value="bounceInDown" <?php selected($effect, 'bounceInDown')?>>Bounce In Down</option>
					<option value="bounceInLeft" <?php selected($effect, 'bounceInLeft')?>>Bounce In Left</option>
					<option value="bounceInRight" <?php selected($effect, 'bounceInRight')?>>Bounce In Right</option>
					<option value="bounceInUp" <?php selected($effect, 'bounceInUp')?>>Bounce In Up</option>
					<option value="FadeIn" <?php selected($effect, 'FadeIn')?>>Fade In</option>
					<option value="fadeInDown" <?php selected($effect, 'fadeInDown')?>>Fade In Down</option>
					<option value="fadeInDownBig" <?php selected($effect, 'fadeInDownBig')?>>Fade In Down Big</option>
					<option value="fadeInLeft" <?php selected($effect, 'fadeInLeft')?>>Fade In Left</option>
					<option value="fadeInLeftBig" <?php selected($effect, 'fadeInLeftBig')?>>Fade In Left Big</option>
					<option value="fadeInRight" <?php selected($effect, 'fadeInRight')?>>Fade In Right</option>
					<option value="fadeInRightBig" <?php selected($effect, 'fadeInRightBig')?>>Fade In Right Big</option>
					<option value="fadeInUp" <?php selected($effect, 'fadeInUp')?>>Fade In Up</option>
					<option value="fadeInUpBig" <?php selected($effect, 'fadeInUpBig')?>>Fade In Up Big</option>
					<option value="flipInX" <?php selected($effect, 'flipInX')?>>Fade In X</option>
					<option value="flipInY" <?php selected($effect, 'flipInY')?>>Fade In Y</option>
					<option value="lightSpeedIn" <?php selected($effect, 'lightSpeedIn')?>>Light Speed In</option>
					<option value="rotateIn" <?php selected($effect, 'rotateIn')?>>Rotate In</option>
					<option value="rotateInDownLeft" <?php selected($effect, 'rotateInDownLeft')?>>Rotate In Down Left</option>
					<option value="rotateInDownRight" <?php selected($effect, 'rotateInDownRight')?>>Rotate In Down Right</option>
					<option value="rotateInUpLeft" <?php selected($effect, 'rotateInUpLeft')?>>Rotate In Up Left</option>
					<option value="rotateInUpRight" <?php selected($effect, 'rotateInUpRight')?>>Rotate In Up Right</option>
					<option value="rollIn" <?php selected($effect, 'rollIn')?>>Roll In</option>
					<option value="zoomIn" <?php selected($effect, 'zoomIn')?>>Zoom In</option>
					<option value="zoomInDown" <?php selected($effect, 'zoomInDown')?>>Zoom In Down</option>
					<option value="zoomInLeft" <?php selected($effect, 'zoomInLeft')?>>Zoom In Left</option>
					<option value="zoomInRight" <?php selected($effect, 'zoomInRight')?>>Zoom In Left</option>
					<option value="zoomInUp" <?php selected($effect, 'zoomInUp')?>>Zoom In Up</option>
					<option value="slideInDown" <?php selected($effect, 'slideInDown')?>>Slide In Down</option>
					<option value="slideInLeft" <?php selected($effect, 'slideInLeft')?>>Slide In Left</option>
					<option value="slideInRight" <?php selected($effect, 'slideInRight')?>>Slide In Right</option>
					<option value="slideInUp" <?php selected($effect, 'slideInUp')?>>Slide In Up</option>
				</select><br>
				<small>Animations are pure CSS, powered by animate.css from Daniel Eden</small>
			</p>
		</td>
		<td width="200" ></td>
	</tr>
	<tr>
		<td width="600" colspan="3" height="20"></td>
	</tr>
	<tr>
		<td width="100"><h3>Buttons</h3></td>
		<td width="400"></td>
		<td width="100"><a href="#" id="gamebAP_addButtonBtn" class="button">Add another button</a></td>
	</tr>
	</table>
	<table id="gamebAP_buttons" width="700">
		<?php foreach ($buttons as $button): 
			$btnText 	 = isset($button['text']) ? $button['text'] : '';
			$btnColor 	 = isset($button['color']) ? $button['color'] : '';
			$btnBehavior = isset($button['behavior']) ? $button['behavior'] : '';
			$btnPosition = isset($button['position']) ? $button['position'] : '';
			$btnClass 	 = isset($button['class']) ? $button['class'] : '';
			$btnID 		 = isset($button['id']) ? $button['id'] : '';
			$btnUrl 	 = isset($button['url']) ? $button['url'] : '';
		?>
			<tr class="btnSeparator">
				<td width="140">
					<input type="text" name="gamebAP_btnText[]" placeholder="Button Text" style="width:140px;" value="<?php echo $btnText; ?>"/>
				</td>
				<td width="500" width="220" colspan="2">
					<input type="text" class="color-field" name="gamebAP_btnColor[]" style="width:90px;" value="<?php echo $btnColor; ?>"/>
				</td>
			</tr>
			<tr>
				<td width="140" style="vertical-align:top;">
					<select name="gamebAP_btnBehavior[]" style="width:140px">
						<option value="">Behavior</option>
						<option value="ok" <?php selected($btnBehavior, 'ok')?>>Ok</option>
						<option value="cancel" <?php selected($btnBehavior, 'cancel')?>>Cancel</option>
						<option value="redirect" <?php selected($btnBehavior, 'redirect')?>>Redirect</option>
						<option value="custom" <?php selected($btnBehavior, 'custom')?>>Custom</option>
					</select>
					<select name="gamebAP_btnPos[]" style="width:140px">
						<option value="">Button Position</option>
						<option value="topLeft" <?php selected($btnPosition, 'topLeft')?>>Top Left</option>
						<option value="topMiddle" <?php selected($btnPosition, 'topMiddle')?>>Top Middle</option>
						<option value="topRight" <?php selected($btnPosition, 'topRight')?>>Top Right</option>

						<option value="bottomLeft" <?php selected($btnPosition, 'bottomLeft')?>>Bottom Left</option>
						<option value="bottomMiddle" <?php selected($btnPosition, 'bottomMiddle')?>>Bottom Middle</option>
						<option value="bottomRight" <?php selected($btnPosition, 'bottomRight')?>>Bottom Right</option>
					</select>
				</td>
				<td width="120" style="vertical-align:top;">
					<input type="text" name="gamebAP_buttonUrl[]" placeholder="URL when redirect behavior" value="<?php echo $btnUrl;?>">
				</td>
				<td width="120" style="vertical-align:top;">
					<input type="text" name="gameAP_btnClass[]" placeholder="Custom class" value="<?php echo $btnClass;?>"/>
					<input type="text" name="gameAP_btnID[]" placeholder="Custom ID" value="<?php echo $btnID;?>"/>
				</td>
				<td width="100">
					<a href="#" class="gamebAP_removeBtn button">Remove</a>
				</td>			
			</tr>		
		<?php endforeach; ?>
	</table>
	<?php 	
}
