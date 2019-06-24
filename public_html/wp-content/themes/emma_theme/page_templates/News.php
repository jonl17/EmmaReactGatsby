<?php /* Template Name: News */ ?>

<?php get_header(); ?>

    <div class="the_news_container containers">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
			the_content();
			endwhile; ?>
		<?php endif; ?>
    </div>

<?php get_footer(); ?>