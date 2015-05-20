<?php 
wp_enqueue_script('imic_jquery_flexslider');
global $imic_options,$id;
$animation = get_post_meta($id,'imic_pages_banner_animation',true);
$overlay = get_post_meta($id,'imic_pages_banner_overlay',true);
$overlay_class = ($overlay==1)?'page-header-overlay':'';
$type = get_post_meta($id,'imic_pages_Choose_slider_display',true);
$pagination = get_post_meta($id,'imic_pages_slider_pagination',true);
$autoplay = get_post_meta($id,'imic_pages_slider_auto_slide',true);
$arrows = get_post_meta($id,'imic_pages_slider_direction_arrows',true);
$effects = get_post_meta($id,'imic_pages_slider_effects',true);
if($type==1 || $type==2 || $type==3) {
	$height = get_post_meta($id,'imic_pages_slider_height',true);
} else {
	$height = '';
}
$images = get_post_meta($id,'imic_pages_slider_image',false);

?><div class="page-header parallax clearfix" style="height:<?php echo esc_attr($height).'px' ?>; display:block;">
<div class="<?php echo $overlay_class; ?>"></div>
<?php if(!empty($images)) { ?>
<div class="hero-slider heroflex flexslider clearfix" style="height:<?php echo esc_attr($height).'px' ?>;" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-pagination="<?php echo esc_attr($pagination); ?>" data-arrows="<?php echo esc_attr($arrows); ?>" data-style="<?php echo esc_attr($effects); ?>" data-speed="7000" data-pause="yes">
      	<ul class="slides">
        <?php foreach($images as $image) {
			$image_src = wp_get_attachment_image_src( $image, 'full', '', array() ); ?>
        	<li class=" parallax" style="background-image:url(<?php echo esc_url($image_src[0]); ?>); height:<?php echo esc_attr($height).'px' ?>;">
            <div class="flex-caption" data-appear-animation="fadeInRight" data-appear-animation-delay="500">
            <?php $image_data = imic_wp_get_attachment($image); ?>
                	<strong><?php echo esc_attr($image_data['caption']); ?></strong>
                	<p><?php echo esc_attr($image_data['description']); ?></p>
               	</div>
            </li>
			<?php } ?>
            </ul>
        <?php if($animation==1) { wp_enqueue_script('imic_jquery_home'); echo '<canvas id="canvas-animation"></canvas>'; } ?>
    </div><?php } ?></div>
    <!-- End Page Header --><?php if(function_exists('bcn_display'))
    { ?>
    <!-- Breadcrumbs -->
    <div class="lgray-bg breadcrumb-cont">
    	<div class="container">
        
          	<ol class="breadcrumb">
            	<?php bcn_display(); ?>
          	</ol>
        </div>
    </div><?php } ?>