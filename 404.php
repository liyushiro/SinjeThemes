<?php
header("HTTP/1.1 404 Not Found");
header("Status: 404 Not Found");
get_header();
$event_image = $imic_options['header_image']['url'];
?>
<div class="page-header parallax clearfix" style="background-image:url(<?php echo esc_url($event_image); ?>);">
<div class="title-subtitle-holder">
        	<div class="title-subtitle-holder-inner">
            <h2><?php _e('Erro 404!','framework'); ?></h2>
        </div>
        </div>
    </div>
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
    <!-- Start Body Content -->
  	<div class="main" role="main">
    	<div id="content" class="content full">
    		<div class="container">
            	<div class="text-align-center error-404">
            		<h1 class="huge"><?php _e('404','framework'); ?></h1>
              		<hr class="sm">
              		<p><strong><?php _e('Desculpa - Página não encontrada!','framework'); ?></strong></p>
					<p><?php _e('A página que você está procurando foi movido, removido, renomeado
ou talvez nunca existiu. Você deparou ao carregar em um link quebrado','framework'); ?></p>
             	</div>
            </div>
        </div>
   	</div>
    <!-- End Body Content -->
<?php get_footer(); ?>
