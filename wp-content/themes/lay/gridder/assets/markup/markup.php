
	<?php
		do_action('lay_before_projectpage_gridder_modals');
		require get_template_directory().'/gridder/assets/markup/modals_markup.php';
	?>
	<!-- in the future, modals will be views that will be rendered into this region -->
	<div id="lay-modals-region"></div>

	<img id="transparent" src="<?php echo get_template_directory_uri(); ?>/gridder/assets/img/transparent.png" alt="">

	<?php
	$templateDir = get_template_directory_uri();
	// on an older php version i saw that underscore js templates get interpreted as php
	// when in reality its just html outside the php wrap. having it inside the php wrap and echoing it works

	// need wrapping div here so using "spacetop" and "spacebottom" will not move project thumbnail title to a wrong position

	require get_template_directory().'/gridder/assets/markup/contextmenus_markup.php';
	?>
</div>

<script language="javascript">
	<?php if (get_current_screen()->id == 'edit-category') { ?>
		// category
		jQuery('.form-table').first().after(jQuery('#gridder-modals'));
		jQuery('.form-table').first().after('<div id="gridder"></div>');
	<?php } else { ?>
		// post/page
		jQuery('#postbox-container-2').append('<div id="gridder"></div>');
		jQuery('#postbox-container-2').append(jQuery('#gridder-modals'));
	<?php } ?>
	jQuery('#gridder-metabox').remove();
	jQuery('#gridder-modals > *').hide();
</script>
