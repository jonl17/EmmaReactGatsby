<?php /* Template Name: Frontpage */ ?>

<?php get_header(); ?>

<table class="containers" id="front_table">
		
		<?php
		$args = array(
		  'numberposts' => -1,
		  'post_type'   => 'work'
		);

		$all_works = get_posts( $args );
		
		?>

		
		<?php

			if ( $all_works ) {
				
				$counter = 0;
				foreach ( $all_works as $post ) :
					setup_postdata( $post ); ?>
					<?php if($counter % 5 == 0) {  ?>
					<tr class="rows">
					<?php } ?>
					
					<?php if(1) {
					?>
					
						<td><a href="<?php the_permalink(); ?>"><p class="front_pic_text"> <?php the_title(); ?> </p> <?php the_post_thumbnail(); ?> </a> </td>
						<?php $counter++; ?>
					
					<?php 
					}
					?>
					
					<?php if($counter % 5 == 0) { ?>
						</tr>
					<?php } ?>
					
	
					
				<?php
				endforeach; 
				wp_reset_postdata();
			}
		?>
		
		
</table>

<?php get_footer(); ?>