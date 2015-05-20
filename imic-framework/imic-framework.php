<?php
if (!defined('ABSPATH'))
exit; // Exit if accessed directly
define('ImicFrameworkPath', dirname(__FILE__));
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
/*
* Here you include files which is required by theme
*/
require_once(ImicFrameworkPath . '/imic-theme-functions.php');
/* Taxonomy Fields
==================================================*/
require_once(ImicFrameworkPath . '/term_color_picker.php');
require_once(ImicFrameworkPath . '/extra_category_field.php');
/* META BOX FRAMEWORK
================================================== */
require_once(ImicFrameworkPath . '/meta-box/meta-box.php');
require_once(ImicFrameworkPath . '/meta-boxes.php');
/* Meta Boxes Field
==================================================*/
require_once(ImicFrameworkPath . '/clone_fields.php');
require_once(ImicFrameworkPath . '/post_meta.php');
require_once(ImicFrameworkPath . '/event_clone.php');
/* SHORTCODES
 ================================================== */
require_once (ImicFrameworkPath . '/shortcodes.php');
/* MEGA MENU
	================================================== */  
require_once(ImicFrameworkPath . '/imic-megamenu/imic-megamenu.php');
/* CUSTOM POST TYPES
================================================== */
require_once(ImicFrameworkPath . '/custom-post-types/gallery-type.php');
require_once(ImicFrameworkPath . '/custom-post-types/speaker-type.php');
require_once(ImicFrameworkPath . '/custom-post-types/sermon-type.php');
require_once(ImicFrameworkPath . '/custom-post-types/event-type.php');
/* PLUGIN INCLUDES
================================================== */
require_once(ImicFrameworkPath . '/plugin-includes.php');
/* WIDGETS INCLUDES
================================================== */
require_once(ImicFrameworkPath . '/widgets/upcoming_events.php');
require_once(ImicFrameworkPath . '/widgets/selected_post.php');
require_once(ImicFrameworkPath . '/widgets/custom_category.php');
require_once(ImicFrameworkPath . '/widgets/twitter_feeds/twitter_feeds.php');
require_once(ImicFrameworkPath . '/widgets/Newsletter/newsletter.php');
require_once(ImicFrameworkPath . '/widgets/speaker_widget.php');
require_once(ImicFrameworkPath . '/widgets/sermon_widget.php');
require_once(ImicFrameworkPath . '/widgets/event_counter.php');
/* LOAD STYLESHEETS
================================================== */
if (!function_exists('imic_enqueue_styles')) {
function imic_enqueue_styles() {
global $imic_options;
			wp_register_style('imic_bootstrap', IMIC_THEME_PATH . '/css/bootstrap.css', array(), NULL, 'all');
			wp_register_style('imic_bootstrap_theme', IMIC_THEME_PATH . '/css/bootstrap-theme.css', array(), NULL, 'all');
			wp_register_style('imic_main', get_stylesheet_uri(), array(), NULL, 'all');
			wp_register_style('imic_prettyPhoto', IMIC_THEME_PATH . '/vendor/prettyphoto/css/prettyPhoto.css', array(), NULL, 'all');
			wp_register_style('imic_mediaelement', IMIC_THEME_PATH . '/vendor/mediaelement/mediaelementplayer.css', array(), NULL, 'all');
			wp_register_style('imic_nivo_default', IMIC_THEME_PATH . '/vendor/nivoslider/themes/default/default.css', array(), NULL, 'all');
			wp_register_style('imic_nivo_slider', IMIC_THEME_PATH . '/vendor/nivoslider/nivo-slider.css', array(), NULL, 'all');
			wp_register_style('imic_custom_css', IMIC_THEME_PATH . '/css/custom.php', array(), NULL, 'all');
			wp_register_style('imic_colors', IMIC_THEME_PATH . '/colors/' . $imic_options['theme_color_scheme'], array(), NULL, 'all');
			wp_register_style('imic_fullcalendar_css', IMIC_THEME_PATH . '/vendor/fullcalendar/fullcalendar.css', array(), NULL, 'all');
			wp_register_style('imic_fullcalendar_print', IMIC_THEME_PATH . '/vendor/fullcalendar/fullcalendar.print.css', array(), NULL, 'print');
			//**Enqueue STYLESHEETPATH**//
			wp_enqueue_style('imic_bootstrap');
			wp_enqueue_style('imic_bootstrap_theme');
			wp_enqueue_style('imic_main');
			wp_enqueue_style('imic_prettyPhoto');
			wp_enqueue_style('imic_mediaelement');
			if ($imic_options['theme_color_type'][0] == 0) {
			wp_enqueue_style('imic_colors');
			}
			//**End Enqueue STYLESHEETPATH**//
		}
		add_action('wp_enqueue_scripts', 'imic_enqueue_styles', 99);
}
if (!function_exists('imic_enqueue_scripts')) {
    function imic_enqueue_scripts() {
        global $imic_options;
        $monthNamesValue = $imic_options['calendar_month_name'];
        $monthNames = (empty($monthNamesValue)) ? array() : explode(',', trim($monthNamesValue));
        $monthNamesShortValue = $imic_options['calendar_month_name_short'];
        $monthNamesShort = (empty($monthNamesShortValue)) ? array() : explode(',', trim($monthNamesShortValue));
        $dayNamesValue = $imic_options['calendar_day_name'];
        $dayNames = (empty($dayNamesValue)) ? array() : explode(',', trim($dayNamesValue));
        $dayNamesShortValue = $imic_options['calendar_day_name_short'];
        $dayNamesShort = (empty($dayNamesShortValue)) ? array() : explode(',', trim($dayNamesShortValue));
		$facebook = $imic_options['share_icon'][1];
		$twitter = $imic_options['share_icon'][2];
		$google = $imic_options['share_icon'][3];
		$tumblr = $imic_options['share_icon'][4];
		$pinterest = $imic_options['share_icon'][5];
		$reddit = $imic_options['share_icon'][6];
		$linkedin = $imic_options['share_icon'][7];
		$email_share = $imic_options['share_icon'][8];
        //**register script**//
		wp_register_script('imic_jquery_modernizr', IMIC_THEME_PATH . '/js/modernizr.js', array(), '', true);
		wp_register_script('imic_jquery_prettyphoto', IMIC_THEME_PATH . '/vendor/prettyphoto/js/prettyphoto.js', array(), '', true);
		wp_register_script('imic_jquery_helper_plugins', IMIC_THEME_PATH . '/js/helper-plugins.js', array(), '', true);
		wp_register_script('imic_jquery_bootstrap', IMIC_THEME_PATH . '/js/bootstrap.js', array(), '', true);
		wp_register_script('imic_jquery_init', IMIC_THEME_PATH . '/js/init.js', array('imic_jquery_flexslider'), '', true);
		wp_register_script('imic_jquery_home', IMIC_THEME_PATH . '/js/home.js', array(), '', true);
		wp_register_script('imic_header', IMIC_THEME_PATH . '/js/header.js', array(), '', true);
		wp_register_script('imic_google_map','http://maps.google.com/maps/api/js?sensor=false',array(),'',true);
		wp_register_script('imic_gmap',IMIC_THEME_PATH . '/js/googleMap.js',array(),'',true);
		wp_register_script('imic_jquery_flexslider', IMIC_THEME_PATH . '/vendor/flexslider/js/jquery.flexslider.js', array(), '', true);
		wp_register_script('imic_jquery_countdown', IMIC_THEME_PATH . '/vendor/countdown/js/jquery.countdown.min.js', array(), '', true);
		wp_register_script('imic_jquery_mediaelement_and_player', IMIC_THEME_PATH . '/vendor/mediaelement/mediaelement-and-player.min.js', array(), '', true);
		wp_register_script('imic_fullcalendar', IMIC_THEME_PATH . '/vendor/fullcalendar/fullcalendar.min.js', array(), '', true);
		wp_register_script('imic_gcal', IMIC_THEME_PATH . '/vendor/fullcalendar/gcal.js', array(), '', true);
		wp_register_script('imic_calender_events', IMIC_THEME_PATH . '/js/calender_events.js', array(), '', true);
		wp_register_script('imic_nivo_slider', IMIC_THEME_PATH . '/vendor/nivoslider/jquery.nivo.slider.js', array(), '', true);
		wp_register_script('imic_contact_event_manager', IMIC_THEME_PATH . '/js/event.js', array(), '', true);
		wp_register_script('imic_contact_map', IMIC_THEME_PATH . '/js/contact-map.js', array(), '', true);
		wp_register_script('imic_counter_init', IMIC_THEME_PATH . '/js/counter_init.js', array(), '', true);
		wp_register_script('imic_calender_updated', IMIC_THEME_PATH . '/vendor/fullcalendar/lib/moment.min.js', array(), '', false);
        //**End register script**//
        //**Enqueue script**//
		wp_enqueue_script('imic_calender_updated');
		wp_enqueue_script('imic_jquery_modernizr');
		wp_enqueue_script('jquery');
		wp_enqueue_script('imic_jquery_prettyphoto');
		wp_enqueue_script('imic_jquery_helper_plugins');
		wp_enqueue_script('imic_jquery_bootstrap');
		wp_enqueue_script('imic_jquery_init');
		wp_enqueue_script('imic_header');
		wp_enqueue_script('imic_jquery_mediaelement_and_player');
		wp_enqueue_script('imic_google_map');
       	wp_localize_script('imic_jquery_init','urlajax_gaea', array('facebook'=>$facebook,'twitter'=>$twitter,'google'=>$google,'tumblr'=>$tumblr,'pinterest'=>$pinterest,'reddit'=>$reddit,'linkedin'=>$linkedin,'email'=>$email_share));
		wp_enqueue_script('imic_contact_event_manager');
		wp_localize_script('imic_contact_event_manager', 'ajax', array('url' => admin_url('admin-ajax.php')));
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
        //**End Enqueue script**//
    }
    add_action('wp_enqueue_scripts', 'imic_enqueue_scripts');
}
/* LOAD BACKEND SCRIPTS
  ================================================== */
function imic_admin_scripts() {
     wp_register_script('imic-admin-functions', IMIC_THEME_PATH . '/js/imic_admin.js', 'jquery', NULL, TRUE);
     wp_enqueue_script('imic-admin-functions');
     if(isset($_REQUEST['taxonomy'])){
      wp_register_script('imic-upload', IMIC_THEME_PATH . '/js/imic-upload.js', 'jquery', NULL, TRUE);
      wp_enqueue_media();
      wp_enqueue_script('imic-upload');
  }}
add_action('admin_init', 'imic_admin_scripts');
/* LOAD BACKEND STYLE
  ================================================== */
function imic_admin_styles() {
    add_editor_style(IMIC_THEME_PATH . '/css/editor-style.css');
	add_editor_style(IMIC_THEME_PATH . '/css/font-awesome.min.css');
    echo '<style>.imic-image-select-repeatable-bg-image{width:50px;}#upload_category_button,#upload_category_button_remove{width:auto !important;}</style>';
}
add_action('admin_head', 'imic_admin_styles');
?>