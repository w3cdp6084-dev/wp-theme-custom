<?php get_header(); ?>

<!-- FEATURED BOXES SECTION -->
<?php include("includes/front-featured-boxes-section.php"); ?>

<!-- AWESOME PARALLAX SECTION -->
<?php include("includes/front-parallax-section.php"); ?>

<?php if ( 'page' == get_option( 'show_on_front' ) ) {  ?>
<!-- PAGE EDITER CONTENT -->
<?php if(have_posts()) : ?>
	<?php while(have_posts()) : the_post(); ?>
		<div id="front-page-content" class="skt-section">
			<div class="container">
				<?php the_content(); ?>
			</div>
		</div>
	<?php endwhile; ?>
<?php endif; ?>
<?php } ?>

<?php  if( get_theme_mod('home_blog_sec', 'on') == 'on' ) { ?>
<div id="front-content-box" class="skt-section">
	<div class="container">
		<div class="row-fluid">
			<h3 class="inline-border"><?php echo wp_kses_post( get_theme_mod('home_blog_title', __('Latest News', 'advertica-lite') ) ); ?></h3>
			<span class="border_left"></span></br>
		</div>
		<div id="front-blog-wrap" class="row-fluid">
		<?php $advertica_blogno = esc_attr( get_theme_mod('home_blog_num', '6') );
		if( !empty($advertica_blogno) && ($advertica_blogno > 0) ) {
				$advertica_lite_latest_loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => $advertica_blogno,'ignore_sticky_posts' => true ) );
		}else{
			   $advertica_lite_latest_loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => -1,'ignore_sticky_posts' => true ) );			
		} ?>
			<?php if ( $advertica_lite_latest_loop->have_posts() ) : ?>

			<!-- pagination here -->

				<!-- the loop -->
				<?php while ( $advertica_lite_latest_loop->have_posts() ) : $advertica_lite_latest_loop->the_post(); ?>
					<div class="span4">
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						<?php the_excerpt(); ?>
						<div class="continue"><a href="<?php the_permalink(); ?>"><?php _e('Read More &rarr;','advertica-lite');?></a></div>		  
					</div>
				<?php endwhile; ?>
				<!-- end of the loop -->

				<!-- pagination here -->

				<?php wp_reset_postdata(); ?>

			<?php else : ?>
				<p><?php _e( 'Sorry, no posts matched your criteria.', 'advertica-lite' ); ?></p>
			<?php endif; ?>
		</div>
 	</div>
</div>
<?php } ?>

<!-- CLIENTS-LOGO SECTION -->
<?php include("includes/front-client-logo-section.php"); ?>

<?php get_footer(); ?>