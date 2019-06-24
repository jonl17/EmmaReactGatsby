<?php
/*
Template Name: Works
Template Post Type: work
*/
?>
<?php get_header(); ?>

    <div class="the_exhibition_container">
		
		<?php
			$args = array('post_type' => 'work');
			$query = new WP_Query($args);
		?>
		
		<h6 id="exhibition_title"><?php the_title(); ?>, <?php echo(types_render_field( "year", array( 'raw' => true) )); ?> </h6>
		<p class="exhibition-text"> 
			<?php echo(types_render_field( "material", array( 'raw' => true) )); ?>
		</p>
		<p class="exhibition-text">
			<?php echo(types_render_field( "description", array( 'raw' => true) )); ?>
			
			
		</p>
		
		<div class="exhibition-img-container">
			<?php if ( get_post_meta($post->ID, 'wpcf-video-work', true)  ) : ?>
		
				<br>
		
			<?php endif; ?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				the_content();
				endwhile; ?>
			<?php endif; ?>
		</div>
		
		
	<?php if(get_field('for_sale') ) : ?>	  
		<div id="enquire-btn"><p id="enquire-click-p">Enquire</p></div>
		</div>
	<?php endif; ?>
	<?php if(get_field('for_sale') ) : ?>
		<div class="enquire-form-container">
			<?php echo do_shortcode('[wpforms id="422" title="false" description="false"]'); ?>
			<h1 id="enquire-form-close-btn">X</h1>
		</div>
	<?php endif; ?>

	

<?php get_sidebar(); ?>

<?php get_footer(); ?>

