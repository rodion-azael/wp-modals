<?php 
/*
Plugin Name: Amazing PopUps
Description: Amazing PopUps will help you create the most amazing popups you can imagine.
Version:     1.0
Author:      Gerardo Mendoza Barrera
Author URI:	 wordpress.gameb.com.mx/about-me
Plugin URI:  wordpress.gameb.com.mx/amazing-popups
*/

function gamebAP_render($id = ''){
	if(empty($id)) return false;
	$_post = get_post($id);
	$metaOptions = get_post_custom($id);

	$content = $_post->post_content;
	$title = $_post->post_title;
	$options = unserialize(base64_decode($metaOptions['gamebAP_settings'][0]));

	$width = (isset($options['width']) && !empty($options['width'])) ? $options['width'] : '';
	$height = (isset($options['height']) && !empty($options['height'])) ? $options['height'] : '';
	$position = (isset($options['position']) && !empty($options['position'])) ? $options['position'] : '';
	$layoutColor = (isset($options['bg_layout_color']) && !empty($options['bg_layout_color'])) ? $options['bg_layout_color'] : '#efefef';
	$ModalId = (isset($options['custom_id']) && !empty($options['custom_id'])) ? $options['custom_id'] : 'gamebAP_'.$id;
	$ModalClass = (isset($options['css_class']) && !empty($options['css_class'])) ? $options['css_class'] : '';
	$buttons = (isset($options['buttons']) && !empty($options['buttons'])) ? $options['buttons'] : array();
	$bgImg = (isset($options['bg_img']) && !empty($options['bg_img'])) ? $options['bg_img']: '';
	$bgColor = (isset($options['bg_color']) && !empty($options['bg_color'])) ? $options['bg_color'] : '';
	$closePos = (isset($options['close_position']) && !empty($options['close_position'])) ? $options['close_position'] : 'topRight';
	$template = (isset($options['template']) && !empty($options['template'])) ? $options['template'] : '';
	$delayToPop = (isset($options['delay']) && !empty($options['delay'])) ? $options['delay'] : '0';
	$delayToClose = (isset($options['timeToClose']) && !empty($options['timeToClose'])) ? $options['timeToClose'] : '';
	$show = (isset($options['show']) && !empty($options['show'])) ? $options['show'] : '';
	$showLapse = (isset($options['show_lapse']) && !empty($options['show_lapse'])) ? $options['show_lapse'] : '';
	$lapseType = (isset($options['show_lapse_type']) && !empty($options['show_lapse_type'])) ? $options['show_lapse_type'] : '';
	$effect = (isset($options['effect']) && !empty($options['effect'])) ? $options['effect'] : 'bounce';
	$closeBgCol = (isset($options['closeBgCol']) && !empty($options['closeBgCol'])) ? $options['closeBgCol'] : '';

	$layoutBgColor = hex2rgba($layoutColor, '0.8');
	$horizontals = gameb_getHorizontalMargins($width, $position, false);
	$verticals = gameb_getVerticalMargins($height, $position, false);
	$buttons = gameb_getButtonsOrdered($buttons);

	/*echo $content;
	echo '-----';	
	print_r($buttons);*/
	?>

	<style type="text/css">
		.gamebAPcustom-defaults<?php echo $id;?>{
			left:<?php echo $horizontals[0];?>%;
			right:<?php echo $horizontals[1];?>%;
			top: <?php echo $verticals[0];?>%;
			bottom: <?php echo $verticals[1];?>%;
			<?php if(!empty($bgImg)): ?> 
				background-image:url('<?php echo $bgImg?>');
				background-size: 100% 100%;
			 <?php endif;?>
			<?php if(!empty($bgColor)): ?> background-color:<?php echo $bgColor; ?> !important;<?php endif;?>
		}
	</style>

	<?php if(isset($options['show_layout']) && $options['show_layout'] == 'on'):?>
		<div class="gamebAP-bg-layout bg<?php echo $id;?>" style="background-color:rgba(<?php echo $layoutBgColor?>);"></div>
	<?php endif;?>

	<div class="gamebAP animated gamebAPcustom-defaults<?php echo $id;?> <?php echo $ModalClass. ' ' .$template; ?>" id="<?php echo $ModalId;?>">
		<div class="gamebAPclose-button <?php echo $closePos;?>" style="background-color:<?php echo $closeBgCol?>"><span>X</span></div>
		<div class="gamebAP-Buttons">
			<?php gamebAP_renderButtons('topLeft', $buttons);?>
			<?php gamebAP_renderButtons('topMiddle', $buttons);?>
			<?php gamebAP_renderButtons('topRight', $buttons);?>
		</div>
		<?php if(!isset($options['hideTitle'])):?>
			<div class="gamebAP-title"><?php echo $title;?></div>
		<?php endif;?>
		<div class="gamebAP-content"><?php echo $content;?></div>
		<div class="gamebAP-Buttons bottom-buttons">
			<?php gamebAP_renderButtons('bottomLeft', $buttons);?>
			<?php gamebAP_renderButtons('bottomMiddle', $buttons);?>
			<?php gamebAP_renderButtons('bottomRight', $buttons);?>
		</div>
	</div>

	<script type="text/javascript">
			var <?php echo $ModalId?> = jQuery('#<?php echo $ModalId?>').gamebAP({
				_id: '<?php echo $id?>',
				show : '<?php echo $show;?>',
				timeToOpen : '<?php echo $delayToPop;?>',
				timeToClose : '<?php echo $delayToClose;?>',
				effect : '<?php echo $effect;?>',
				id: '<?php echo $ModalId?>',
				siteName: '<?php echo $_SERVER["HTTP_HOST"];?>',
				lapse: '<?php echo $showLapse?>',
				lapseType: '<?php echo $lapseType;?>'
			});
	</script>

<?php } ?>