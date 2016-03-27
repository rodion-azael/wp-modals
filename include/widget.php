<?php 
/*
Plugin Name: Amazing PopUps
Description: Amazing PopUps will help you create the most amazing popups you can imagine.
Version:     1.0
Author:      Gerardo Mendoza Barrera
Author URI:	 wordpress.gameb.com.mx/about-me
Plugin URI:  wordpress.gameb.com.mx/amazing-popups
*/


class gamebAP_widget extends WP_Widget {

	function __construct() {
		parent::__construct('gamebAP_widget', 
			'Amazing PopUps Widget', 
			array( 'description' => 'You can an Amazing PopUP to a footer area to show it on every page.')
		);
	}

	public function widget($args, $instance) {
		gamebAP_render($instance['gamebAP_widgetID']);
	}
		

	public function form( $instance ) {
		$selID = $instance['gamebAP_widgetID'];
		$type = 'gamebamazing_popup';
		$args=array(
		  'post_type' => $type,
		  'post_status' => 'publish'
		);

		$wp_query = new WP_Query($args);?>
		<br><label for="<?php echo $this->get_field_id('gamebAP_widgetID'); ?>">Select an Amazing PopUp:</label>
		<select name="<?php echo $this->get_field_name('gamebAP_widgetID'); ?>" id="<?php echo $this->get_field_id('gamebAP_widgetID'); ?>">
			<?php if($wp_query->have_posts()) :
			  while ($wp_query->have_posts()) : $wp_query->the_post(); $theID = get_the_ID();?>			  	
			    <option value="<?php echo $theID;?>" <?php selected($selID, $theID);?> > <?php the_title();?> </option>			    
			  <?php endwhile;
			endif;?>
		</select>
		<?php wp_reset_query(); 
	}	

	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['gamebAP_widgetID'] = (!empty($new_instance['gamebAP_widgetID'])) ? strip_tags($new_instance['gamebAP_widgetID']) : '';
		return $instance;
	}
}

?>