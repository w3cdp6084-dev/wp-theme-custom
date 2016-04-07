<?php 

add_action( 'wp_ajax_advertica_lite_migrate_option', 'advertica_lite_migrate_options' );
add_action( 'wp_ajax_nopriv_advertica_lite_migrate_option', 'advertica_lite_migrate_options' );
function advertica_lite_migrate_options() {

	$advertica_lite_pre_options = get_option( 'advertica_lite' );

	set_theme_mod( 'advertica_lite_pri_color', $advertica_lite_pre_options['advertica_colorpicker'] );
	set_theme_mod( 'advertica_lite_logo_img', $advertica_lite_pre_options['advertica_logo_img'] );
	
	set_theme_mod( 'first_feature_heading', $advertica_lite_pre_options['advertica_fb1_first_part_heading'] );
	set_theme_mod( 'first_feature_image', $advertica_lite_pre_options['advertica_fb1_first_part_image'] );
	set_theme_mod( 'first_feature_content', $advertica_lite_pre_options['advertica_fb1_first_part_content'] );
	set_theme_mod( 'first_feature_link', $advertica_lite_pre_options['advertica_fb1_first_part_link'] );

	set_theme_mod( 'second_feature_heading', $advertica_lite_pre_options['advertica_fb2_second_part_heading'] );
	set_theme_mod( 'second_feature_image', $advertica_lite_pre_options['advertica_fb2_second_part_image'] );
	set_theme_mod( 'second_feature_content', $advertica_lite_pre_options['advertica_fb2_second_part_content'] );
	set_theme_mod( 'second_feature_link', $advertica_lite_pre_options['advertica_fb2_second_part_link'] );

	set_theme_mod( 'third_feature_heading', $advertica_lite_pre_options['advertica_fb3_third_part_heading'] );
	set_theme_mod( 'third_feature_image', $advertica_lite_pre_options['advertica_fb3_third_part_image'] );
	set_theme_mod( 'third_feature_content', $advertica_lite_pre_options['advertica_fb3_third_part_content'] );
	set_theme_mod( 'third_feature_link', $advertica_lite_pre_options['advertica_fb3_third_part_link'] );

	set_theme_mod( 'parallax_image', $advertica_lite_pre_options['advertica_fullparallax_image'] );
	set_theme_mod( 'parallax_content', $advertica_lite_pre_options['advertica_para_content_left']);

	if( $advertica_lite_pre_options['advertica_hide_home_blog'] == 'true' )
		set_theme_mod( 'home_blog_sec', 'on' );
	else
		set_theme_mod( 'home_blog_sec', 'off' );

	set_theme_mod( 'home_blog_title', $advertica_lite_pre_options['advertica_blogsec_title'] );
	set_theme_mod( 'home_blog_num', $advertica_lite_pre_options['advertica_blog_no'] );

	set_theme_mod( 'home_brand_sec_title', $advertica_lite_pre_options['advertica_clientsec_title'] );
	set_theme_mod( 'brand1_alt', $advertica_lite_pre_options['advertica_img1_title'] );
	set_theme_mod( 'brand1_img', $advertica_lite_pre_options['advertica_img1_icon'] );
	set_theme_mod( 'brand1_url', $advertica_lite_pre_options['advertica_img1_link'] );

	set_theme_mod( 'brand2_alt', $advertica_lite_pre_options['advertica_img2_title'] );
	set_theme_mod( 'brand2_img', $advertica_lite_pre_options['advertica_img2_icon'] );
	set_theme_mod( 'brand2_url', $advertica_lite_pre_options['advertica_img2_link'] );

	set_theme_mod( 'brand3_alt', $advertica_lite_pre_options['advertica_img3_title'] );
	set_theme_mod( 'brand2_img', $advertica_lite_pre_options['advertica_img3_icon'] );
	set_theme_mod( 'brand3_url', $advertica_lite_pre_options['advertica_img3_link'] );

	set_theme_mod( 'brand4_alt', $advertica_lite_pre_options['advertica_img4_title'] );
	set_theme_mod( 'brand4_img', $advertica_lite_pre_options['advertica_img4_icon'] );
	set_theme_mod( 'brand4_url', $advertica_lite_pre_options['advertica_img4_link'] );

	set_theme_mod( 'brand5_alt', $advertica_lite_pre_options['advertica_img5_title'] );
	set_theme_mod( 'brand5_img', $advertica_lite_pre_options['advertica_img5_icon'] );
	set_theme_mod( 'brand5_url', $advertica_lite_pre_options['advertica_img5_link'] );

	set_theme_mod( 'blogpage_heading', $advertica_lite_pre_options['advertica_blogpage_heading'] );
	
	set_theme_mod( 'breadcrumbbg_color', $advertica_lite_pre_options['advertica_bread_color'] );
	set_theme_mod( 'breadcrumbbg_image', $advertica_lite_pre_options['advertica_bread_image'] );
	set_theme_mod( 'breadcrumbtxt_color', $advertica_lite_pre_options['advertica_bread_title_color'] );

	set_theme_mod( 'copyright', $advertica_lite_pre_options['advertica_copyright'] );
	
	
	echo __('All the settings migrated successfully.', 'advertica-lite');

	delete_option( 'advertica_lite' );

	die();
}

add_action('admin_menu', 'advertica_lite_migrate_menu');
function advertica_lite_migrate_menu() {
	add_theme_page( __('Migrate Options', 'advertica-lite'), __('Migrate Options', 'advertica-lite'), 'administrator', 'sktmigrate', 'advertica_lite_migrate_menu_options' );
}

function advertica_lite_migrate_menu_options() { ?>
	<h1><?php _e('Migrate Settings to Customizer', 'advertica-lite') ?></h1>
	<p><?php _e('As per the new WordPress guidelines it is required to use the Customizer for implementing theme options.', 'advertica-lite'); ?></p>
	<p><?php _e('So, click on this button to migrate all data from previous version.', 'advertica-lite'); ?></p>
	<p><strong><?php _e('Note: only click this option once immidiatly after upgrade. Do not press back or refresh button while migrating...', 'advertica-lite'); ?></strong></p>
	<button id="advertica-migrate-btn" class="button button-primary"><?php _e( 'Migrate to Customizer', 'advertica-lite' ); ?></button>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		'use strict';
		jQuery('#advertica-migrate-btn').click(function() {
			jQuery('body').append('<div id="migrate-div" style="position:absolute;left:0;top:0;bottom:0;right:0;background-color:rgba(255,255,255,0.7);"><img style="position:absolute;top:50%;left:50%;" class="migrate-loader" src="<?php echo get_template_directory_uri()."/images/loader.gif"; ?>" alt="<?php _e("Loading", "advertica-lite"); ?>"></div>');
		    jQuery.ajax({
		        url: "<?php echo home_url('/');?>wp-admin/admin-ajax.php",
		        type: 'POST',
		        data: { action: 'advertica_lite_migrate_option' },
		        success: function( response ) {
		        	jQuery('#migrate-div').remove();
		            alert( response );
		            var wp_adminurl = "<?php echo esc_url( home_url('/') ).'wp-admin/customize.php'; ?>";
  					jQuery(location).attr("href", wp_adminurl);
		        }
		    });
			return false;

		});
	});
	</script>
<?php }