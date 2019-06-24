<?php /* Template Name: CV */ ?>

<?php get_header(); ?>

<div class="the_cv_container containers">
    <dl id="the_cv">
        <br> <dd>Education </dd>
			
			<p>
				<?php
					echo types_render_field( "education", array( "separator" => " <br> ")); 
				 ?>
			</p>	
		
        <br> <dd>Exhibitions</dd>
		
			<p>
				<?php
					echo types_render_field( "exhibtions", array( "separator" => " <br> ")); 
				 ?>
			</p>	
        
        <br> <dd>Other</dd>
		
			<p>
				<?php
					echo types_render_field( "other", array( "separator" => " <br> ")); 
				 ?>
			</p>	
        
    </dl>
</div>

<?php get_footer(); ?>

