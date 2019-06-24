<div class="wrap">
    <h2>Fullscreen Slider Addon</h2>

    <?php if(isset( $_GET['settings-updated'])) { ?>
	    <div class="updated">
	        <p>Settings updated successfully</p>
	    </div>
    <?php } ?>
	<div class="lay-explanation">
		<div class="lay-explanation-inner">
			<p>
				For Fullscreen Slider to work it needs to be activated below and you need at least two rows in your layout.
			</p>
			<p>
				Fullscreen Slider will be active in the phone view if each of your rows only contains one element.<br>
				Also Fullscreen Slider can be active on the phone view if you use <a href="http://laytheme.com/documentation.html#custom-phone-layouts" target="_blank">Custom Phone Layouts</a>.
			</p>
			<p>
				If your content overflows a browser height, please try the "Give elements a max-width and max-height and center them" option.
			</p>
		</div>
	</div>
	<form method="POST" action="options.php">
	<?php settings_fields( 'manage-magneticslides' );	//pass slug name of page, also referred
	                                        //to in Settings API as option group name
	do_settings_sections( 'manage-magneticslides' ); 	//pass slug name of page
	submit_button('Save Changes');
	?>
	</form>
</div>