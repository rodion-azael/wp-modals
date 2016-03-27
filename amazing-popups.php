<?php
/*
Plugin Name: Amazing PopUps
Description: Amazing PopUps will help you create the most amazing popups you can imagine.
Version:     1.0
Author:      Gerardo Mendoza Barrera
Author URI:	 wordpress.gameb.com.mx/about-me
Plugin URI:  wordpress.gameb.com.mx/amazing-popups
*/

defined( 'ABSPATH' ) or die( 'Warning! Peeper approaching' );

wp_register_script('gamebAP_admin', plugin_dir_url(__FILE__) .'js/admin.js', array('jquery', 'wp-color-picker'), '1.0', false);
wp_register_script('gamebAPJS', plugin_dir_url(__FILE__) .'js/gamebAP.js', array('jquery', 'jquery-ui-core'), '1.0', false);
wp_register_style( 'gamebAP_admin_css', plugin_dir_url(__FILE__) .'css/amazing-popups-admin.css' );
wp_register_style( 'gamebAP_css', plugin_dir_url(__FILE__) .'css/amazing-popups.css' );
wp_register_style( 'animate.css', plugin_dir_url(__FILE__) .'css/animate.css' );

foreach (glob(plugin_dir_path(__FILE__) . "include/*.php" ) as $file ) {
    include_once $file;
}

/* Hooks */
add_action('init', 'gameb_amazing_popups_init');
add_action('save_post', 'gameb_amazing_popups_save');
add_action('widgets_init', 'gamebAP_widget_init');
add_filter('manage_edit-gamebamazing_popup_columns', 'gameb_amazing_popups_columns');
add_action('manage_gamebamazing_popup_posts_custom_column', 'gameb_amazing_popups_custom_columns', 10, 2);
add_shortcode( 'gamebAP', 'gamebAP_shortcode' );
/* Hooks */

/* Hooks functions */
function gamebAP_shortcode($atts){
    gamebAP_render($atts['id']);
}

function gameb_amazing_popups_columns($columns){
    $cols['cb'] = '<input type="checkbox" />';
    $cols['title'] = __('Name', 'column name');
    $cols['ID'] = __('ID');
    $cols['Shortcode'] = __('Shortcode');
    $cols['date'] = __('Date', 'column name');
    return $cols;
}
function gameb_amazing_popups_custom_columns($column_name, $id){
    global $wpdb;
    switch ($column_name) {
        case 'ID':
            echo $id;
            break;
        case 'Shortcode':
            echo '[gamebAP id="'.$id.'"]';
            break;
        default:
            break;
    }
}

function gameb_amazing_popups_init(){
	$args = array(
        'labels' => array('name' => __('Amazing PopUps'), 'singular_name' => __('Amazing PopUp')),
        'rewrite' => array('slug' => 'amazing-popups'),
        'public' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'menu_position' => 5,
        'register_meta_box_cb' => 'gameb_amazing_popups_metas'
    );
    register_post_type('gamebamazing_popup', $args);
}
function gamebAP_widget_init(){
    register_widget('gamebAP_widget');
    wp_enqueue_script('gamebAPJS');
    wp_enqueue_style('gamebAP_css');
    wp_enqueue_style('animate.css');
}
/* Hooks functions */

function gameb_amazing_popups_metas(){
	add_meta_box($value['ID'], 'Amazing PopUps', 'gamebOptions_amazing_popup', 'gamebamazing_popup', 'normal', 'default'); 
}

function gameb_amazing_popups_save($post_id){
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;     
    if(!isset($_POST['gamebAP_noncename']) || !wp_verify_nonce($_POST['gamebAP_noncename'], 'save_gamebAP' )) return;
    if(!current_user_can('edit_post')) return;

    $post = get_post($post_id);
    if($post->post_type != 'gamebamazing_popup') return false;

    $modalSettings = array();

    if(isset($_POST['gamebAP_hideTitle']) && !empty($_POST['gamebAP_hideTitle']))
        $modalSettings['hideTitle'] = sanitize_text_field($_POST['gamebAP_hideTitle']);

    if(isset($_POST['gamebAP_delay']) && !empty($_POST['gamebAP_delay']))
        $modalSettings['delay'] = sanitize_text_field($_POST['gamebAP_delay']);

    if(isset($_POST['gamebAP_XPOS']) && !empty($_POST['gamebAP_XPOS']))
        $modalSettings['close_position'] = sanitize_text_field($_POST['gamebAP_XPOS']);

    if(isset($_POST['gamebAP_position']) && !empty($_POST['gamebAP_position']))
        $modalSettings['position'] = sanitize_text_field($_POST['gamebAP_position']);

    if(isset($_POST['gamebAP_effect']) && !empty($_POST['gamebAP_effect']))
        $modalSettings['effect'] = sanitize_text_field($_POST['gamebAP_effect']);


    if(isset($_POST['gamebAP_css']) && !empty($_POST['gamebAP_css']))
        $modalSettings['css_class'] = sanitize_text_field($_POST['gamebAP_css']);

    if(isset($_POST['gamebAP_id']) && !empty($_POST['gamebAP_id']))
        $modalSettings['custom_id'] = sanitize_text_field($_POST['gamebAP_id']);

    if(isset($_POST['gamebAP_template']) && !empty($_POST['gamebAP_template']))
        $modalSettings['template'] = sanitize_text_field($_POST['gamebAP_template']);

    if(isset($_POST['gamebAP_Height']) && !empty($_POST['gamebAP_Height']))
        $modalSettings['height'] = sanitize_text_field($_POST['gamebAP_Height']);

    if(isset($_POST['gamebAP_Width']) && !empty($_POST['gamebAP_Width']))
        $modalSettings['width'] = sanitize_text_field($_POST['gamebAP_Width']);

    if(isset($_POST['gamebAP_backgroundImage']) && !empty($_POST['gamebAP_backgroundImage']))
        $modalSettings['bg_img'] = sanitize_text_field($_POST['gamebAP_backgroundImage']);

    if(isset($_POST['gamebAP_backgroundColor']) && !empty($_POST['gamebAP_backgroundColor']))
        $modalSettings['bg_color'] = sanitize_text_field($_POST['gamebAP_backgroundColor']);

    if(isset($_POST['gamebAP_bgLayout']) && !empty($_POST['gamebAP_bgLayout']))
        $modalSettings['show_layout'] = sanitize_text_field($_POST['gamebAP_bgLayout']);

    if(isset($_POST['gamebAP_layoutBGColor']) && !empty($_POST['gamebAP_layoutBGColor']))
        $modalSettings['bg_layout_color'] = sanitize_text_field($_POST['gamebAP_layoutBGColor']);    

    if(isset($_POST['gamebAP_show']) && !empty($_POST['gamebAP_show']))
        $modalSettings['show'] = sanitize_text_field($_POST['gamebAP_show']);

    if(isset($_POST['gamebAP_every']) && !empty($_POST['gamebAP_every']))
        $modalSettings['show_lapse'] = sanitize_text_field($_POST['gamebAP_every']);

    if(isset($_POST['gamebAP_timeType']) && !empty($_POST['gamebAP_timeType']))
        $modalSettings['show_lapse_type'] = sanitize_text_field($_POST['gamebAP_timeType']);

    if(isset($_POST['gamebAP_timeToClose']) && !empty($_POST['gamebAP_timeToClose']))
        $modalSettings['timeToClose'] = sanitize_text_field($_POST['gamebAP_timeToClose']);

    if(isset($_POST['gamebAP_closeBackgroundColor']) && !empty($_POST['gamebAP_closeBackgroundColor']))
        $modalSettings['closeBgCol'] = sanitize_text_field($_POST['gamebAP_closeBackgroundColor']);


    if(isset($_POST['gamebAP_btnText']) && !empty($_POST['gamebAP_btnText']) && is_array($_POST['gamebAP_btnText'])){
        $modalSettings['buttons'] = array();
        for($i=0;$i<count($_POST['gamebAP_btnText']);$i++){
            $modalSettings['buttons'][$i] = array();

            if(isset($_POST['gamebAP_btnText'][$i]) && !empty($_POST['gamebAP_btnText'][$i]))
                $modalSettings['buttons'][$i]['text'] = sanitize_text_field($_POST['gamebAP_btnText'][$i]);

            if(isset($_POST['gamebAP_btnColor'][$i]) && !empty($_POST['gamebAP_btnColor'][$i]))
                $modalSettings['buttons'][$i]['color'] = sanitize_text_field($_POST['gamebAP_btnColor'][$i]);

            if(isset($_POST['gamebAP_btnBehavior'][$i]) && !empty($_POST['gamebAP_btnBehavior'][$i]))
                $modalSettings['buttons'][$i]['behavior'] = sanitize_text_field($_POST['gamebAP_btnBehavior'][$i]);

            if(isset($_POST['gamebAP_btnPos'][$i]) && !empty($_POST['gamebAP_btnPos'][$i]))
                $modalSettings['buttons'][$i]['position'] = sanitize_text_field($_POST['gamebAP_btnPos'][$i]);

            if(isset($_POST['gamebAP_buttonUrl'][$i]) && !empty($_POST['gamebAP_buttonUrl'][$i]))
                $modalSettings['buttons'][$i]['url'] = sanitize_text_field($_POST['gamebAP_buttonUrl'][$i]);

            if(isset($_POST['gameAP_btnClass'][$i]) && !empty($_POST['gameAP_btnClass'][$i]))
                $modalSettings['buttons'][$i]['class'] = sanitize_text_field($_POST['gameAP_btnClass'][$i]);

            if(isset($_POST['gameAP_btnID'][$i]) && !empty($_POST['gameAP_btnID'][$i]))
                $modalSettings['buttons'][$i]['id'] = sanitize_text_field($_POST['gameAP_btnID'][$i]);
        }
    }

    $modalSettingsSerialized = base64_encode(serialize($modalSettings));
    update_post_meta( $post_id, 'gamebAP_settings', $modalSettingsSerialized);

    return $post;
}
