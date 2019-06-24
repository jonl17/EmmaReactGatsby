<?php /* Template Name: About */ ?>

<?php get_header(); ?>


<div class="the_info_container containers">
	
    <div id="text_container">
		<p>b. 1990 in Reykjavík, Iceland. <br> <?php echo(types_render_field( "currently-based-in", array( 'raw' => true) )); ?> </p>
		<p id="info_text"> 
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				the_content();
			endwhile; ?>
			<?php endif; ?>
		</p>
		<?php the_post_thumbnail( 'large' ); ?>
		
		
		<p> Contact : <?php echo(types_render_field( "e-mail", array( 'raw' => true) )); ?></p>
    </div>
</div>

<?php get_footer(); ?>