
<?php
		$args = array(
		  'numberposts' => 50,
		  'post_type'   => 'work',
		  'order'	    => 'DESC',
		  'meta_key'	=> 'wpcf-year',
		  'orderby'		=> 'meta_value'
		);

		$all_works = get_posts( $args );
		
?>

<?php 
$previous = get_permalink( get_adjacent_post(false,'',false)->ID );
$next = get_permalink( get_adjacent_post(false,'',true)->ID );
$current = get_permalink();
	if($previous == $current ) {
		$previous = get_permalink( $all_works[sizeof($all_works) - 1]);
	}
	if($next == $current ) {
		$next = get_permalink( $all_works[0]);
	}
?>

<a id="prev" href="<?php echo $previous ?>">
<img src="<?php echo bloginfo( 'stylesheet_directory' ); ?>/assets/prev.png"
>
	
</a>

<a id="next" href="<?php echo $next ?>">
<img src="<?php echo bloginfo( 'stylesheet_directory' ); ?>/assets/next.png"
>
</a>
