<?php
get_header();
global $imic_options;
$this_term = get_query_var('term');
$pageSidebar = $imic_options['event_term_sidebar'];
$facebook = $imic_options['share_icon'][1];
$twitter = $imic_options['share_icon'][2];
$google = $imic_options['share_icon'][3];
$tumblr = $imic_options['share_icon'][4];
$pinterest = $imic_options['share_icon'][5];
$reddit = $imic_options['share_icon'][6];
$linkedin = $imic_options['share_icon'][7];
$email_share = $imic_options['share_icon'][8];
wp_enqueue_script('event_ajax', IMIC_THEME_PATH . '/js/event_ajax.js', '', '', true);
wp_localize_script('event_ajax', 'urlajax', array('ajaxurl' => admin_url('admin-ajax.php'),'facebook'=>$facebook,'twitter'=>$twitter,'google'=>$google,'tumblr'=>$tumblr,'pinterest'=>$pinterest,'reddit'=>$reddit,'linkedin'=>$linkedin,'email'=>$email_share));
$currentEventTime = date('Y-m');
$prev_month = date('Y-m', strtotime('-1 month', strtotime($currentEventTime)));
$next_month = date('Y-m', strtotime('+1 month', strtotime($currentEventTime)));
wp_enqueue_script( 'flexslider' );
$term_taxonomy=get_query_var('taxonomy');
$cat_id = get_queried_object()->term_id;
		$cat_image = get_option($term_taxonomy . $cat_id . "_image_term_id");
		$event_image = ($cat_image!='')?$cat_image:$imic_options['header_image']['url'];
?>
<div class="page-header parallax clearfix" style="background-image:url(<?php echo esc_url($event_image); ?>)">
    	<div class="title-subtitle-holder">
        	<div class="title-subtitle-holder-inner">
    				<h2><?php _e('Event Listing','framework'); ?></h2>
                </div>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Breadcrumbs -->
    <div class="lgray-bg breadcrumb-cont">
    	<div class="container">
        <?php if(function_exists('bcn_display'))
    { ?>
          	<ol class="breadcrumb">
            	<?php bcn_display(); ?>
          	</ol>
		<?php } ?>
        </div>
    </div>
<!-- Start Body Content -->
  	<div class="main" role="main">
    	<div id="content" class="content full">
        	<div class="container">
            	<div class="row">
                    <div class="col-md-3 col-sm-3 events-list-sidebar"  id="ajax_events">
                    	<div class="event-page-cal listing-header">
                        	<span class="month"><?php echo esc_attr(date_i18n('M')); ?></span>
                            <span class="year"><?php echo esc_attr(date_i18n('Y')); ?></span>
                            <a href="javascript:void(0)" rel="<?php echo $this_term; ?>" class="upcomingEvents actions left" id="<?php echo esc_attr($prev_month); ?>"><i class="fa fa-angle-left"></i></a>
                            <a href="javascript:void(0)" rel="<?php echo $this_term; ?>" class="upcomingEvents actions right" id="<?php echo esc_attr($next_month); ?>"><i class="fa fa-angle-right"></i></a>
                            <div id="load-next-events" class="load-events" style="display:none;"><img src="<?php echo IMIC_THEME_PATH; ?>/images/loader.gif"></div>
                        </div>
                        <!--<h5>Select Location</h5>
                        <select class="form-control">
                            <option>Toronto</option>
                            <option>Texas, USA</option>
                            <option>London, UK</option>
                        </select>-->
                        <?php if(is_active_sidebar($pageSidebar)) { ?>
                    <!-- Sidebar -->
                    	<?php dynamic_sidebar($pageSidebar); ?>
                    <?php } ?>
                   	</div>
                    <div class="col-md-9 col-sm-9">
                        <div class="element-block events-listing">
                            <ul id="monthly-events" class="events-listing-content sort-destination isotope-events" data-sort-id="events">
                            <?php $events = imic_recur_events('','',$this_term,$currentEventTime);
								ksort($events);
								if(!empty($events)) { 
								foreach($events as $key=>$value):
								$date_converted=date('Y-m-d',$key );
                				$custom_event_url= imic_query_arg($date_converted,$value);
								$start_time = '23:59';
								$start_time_meta = get_post_meta($value,'imic_event_start_dt',true);
								if($start_time_meta!='') {
								$start_time_meta = strtotime($start_time_meta);
								$start_time = date('G:i',$start_time_meta); }
								$st_time = '';
								$st_time = date('Y-m-d',$key);
								$st_time = strtotime($st_time.' '.$start_time);
								$event_address = get_post_meta($value,'imic_event_address2',true);
								$term_slug = get_the_terms(get_the_ID(), 'event-category');
								echo '<li class=" event-list-item event-dynamic grid-item';
								if (!empty($term_slug)) {
								foreach ($term_slug as $term) {
								  echo ' '.$term->slug;
								}
								} ?>">
                                	<div class="event-list-item-date">
                                    	<span class="event-date">
                                        	<span class="event-day"><?php echo esc_attr(date_i18n('d',$key)); ?></span>
                                        	<span class="event-month"><?php echo esc_attr(date_i18n('M',$key)).', ';  echo esc_attr(date_i18n('y',$key)); ?></span>
                                        </span>
                                    </div>
                                    <div class="event-list-item-info">
                                    	<div class="lined-info">
                                        	<h4><a href="<?php echo esc_url($custom_event_url); ?>" class="event-title"><?php echo esc_attr(get_the_title($value)); ?></a></h4>
                                        </div>
                                    	<div class="lined-info">
                                        	<span class="meta-data"><i class="fa fa-clock-o"></i> <?php echo esc_attr(date_i18n('l', $key)); ?>, <span class="event-time"><?php echo date_i18n(get_option('time_format'), $st_time); if($start_time_meta!='') { echo ' - '.date_i18n(get_option('time_format'), $key); } ?></span> <?php if($key<date('U')) { echo '<span class="label label-default">'.__('Passed','framework').'</span>'; } elseif(date('U')>$st_time&&date('U')<$key) { echo '<span class="label label-success">'.__('Going On','framework').'</span>'; } else { echo '<span class="label label-primary">'.__('Upcoming','framework').'</span>'; } ?></span>
                                        </div>
                                    	<div class="lined-info event-location">
                                        	<span class="meta-data"><i class="fa fa-map-marker"></i> <span class="event-location-address"><?php echo esc_attr($event_address); ?></span></span>
                                        </div>
                                    </div>
                                    <div class="event-list-item-actions"><?php if($key>date('U')) { $event_registration = get_post_meta($value,'imic_event_registration',true); if($event_registration==1) { ?>
                                    	<a id="register-<?php echo ($value+2648).'|'.$key; ?>" href="#" class="btn btn-default btn-transparent event-tickets event-register-button"><?php _e('Register','framework'); ?></a><?php } } ?>
                                    	<ul class="action-buttons"><?php if ($imic_options['switch_sharing'] == 1 && $imic_options['share_post_types']['3'] == '1') { ?>
                                        	<li title="Share event"><a href="#" data-trigger="focus" data-placement="top" data-content="" data-toggle="popover" data-original-title="Share Event" class="event-share-link"><i class="icon-share"></i></a></li><?php } $event_map = get_post_meta($value,'imic_event_address2',true); if($event_map!='') { ?>
                                        	<li title="Get directions" class="hidden-xs"><a href="#" class="cover-overlay-trigger event-direction-link"><i class="icon-compass"></i></a></li><?php } $event_contact_info = get_post_meta($value,'imic_event_manager',true); if($event_contact_info!='') { ?>
                                        	<li title="Contact event manager"><a id="contact-<?php echo ($value+2648).'|'.$key; ?>" href="#" data-toggle="modal" data-target="#Econtact" class="event-contact-link"><i class="icon-mail"></i></a></li><?php } ?>
                                        </ul>
                                    </div>
                                </li>
                                <?php endforeach; } ?>
                            </ul>
                        </div>
                    </div>
              	</div>
           	</div>
        </div>
   	</div>
<?php get_footer(); ?>