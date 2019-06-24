<?php
/**
 * Plugin Name: Lay Theme Fullscreen Slider
 * Plugin URI: http://laytheme.com/addons/
 * Description: With "Fullscreen Slider" your layout's rows become browser-filling slides. Supports either horizontal or vertical sliding. Only works with Lay Theme!
 * Version: 1.4.3
 * Author: Armin Unruh
 * Author URI: http://arminunruh.com
 */

class LayThemeMagneticSlides{

	public static $url;
	public static $dir;
	public static $ver;

	public function __construct(){
		LayThemeMagneticSlides::$url = plugins_url( 'laytheme-magneticslides' );
		LayThemeMagneticSlides::$dir = plugin_dir_path( __FILE__ );
		LayThemeMagneticSlides::$ver = '1.4.3';

		// backend
		add_action( 'admin_menu', array($this, 'ms_setup_menu'), 20 );
		add_action( 'admin_init', array($this, 'ms_settings_api_init') );
		add_filter( 'plugin_action_links_'.plugin_basename(__FILE__), array($this, 'add_action_links') );
		add_action( 'admin_enqueue_scripts', array($this, 'ms_enqueue_scripts') );

		// frontend
		add_action( 'wp_enqueue_scripts', array( $this, 'slides_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'slides_styles' ) );
	}

	public function ms_enqueue_scripts($hook){
		if($hook == "lay-options_page_manage-magneticslides"){
			wp_enqueue_script( 'ms_settings_showhide', plugin_dir_url( __FILE__ ) . '/backend/assets/js/settings_showhide.js', array(), LayThemeMagneticSlides::$ver );
			wp_enqueue_media();
			wp_enqueue_script( 'ms_settings_image_upload', plugin_dir_url( __FILE__ ) . '/backend/assets/js/image_upload.js', array(), LayThemeMagneticSlides::$ver );
		}
	}

	public function add_action_links( $links ){
		$mylinks = array(
			'<a href="' . admin_url( 'admin.php?page=manage-magneticslides' ) . '">Settings</a>',
		);
		return array_merge( $links, $mylinks );
	}

	public function ms_settings_api_init(){
	 	add_settings_section(
			'magneticslidesoptions_section',
			'',
			'',
			'manage-magneticslides'
		);

	 	add_settings_section(
			'ms_behaviour_section',
			'Behaviour',
			'',
			'manage-magneticslides'
		);

	 	add_settings_section(
			'ms_navigation_section',
			'Navigation',
			'',
			'manage-magneticslides'
		);

	 	add_settings_section(
			'ms_other_section',
			'Other',
			'',
			'manage-magneticslides'
		);

	 	add_settings_field(
			'magneticslides_active_in_projects',
			'Fullscreen Slider for Projects',
			array($this, 'ms_active_in_projects_setting'),
			'manage-magneticslides',
			'magneticslidesoptions_section'
		);
	 	register_setting( 'manage-magneticslides', 'magneticslides_active_in_projects' );

 	 	add_settings_field(
 			'magneticslides_active_in_pages',
 			'Fullscreen Slider for Pages',
 			array($this, 'ms_active_in_pages_setting'),
 			'manage-magneticslides',
 			'magneticslidesoptions_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'magneticslides_active_in_pages' );

 	 	add_settings_field(
 			'magneticslides_active_in_categories',
 			'Fullscreen Slider for Categories',
 			array($this, 'ms_active_in_categories_setting'),
 			'manage-magneticslides',
 			'magneticslidesoptions_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'magneticslides_active_in_categories' );

 	 	// behaviour

 	 	add_settings_field(
 			'ms_direction',
 			'Direction',
 			array($this, 'ms_direction_setting'),
 			'manage-magneticslides',
 			'ms_behaviour_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'ms_direction' );

 	 	add_settings_field(
 			'ms_slideonclick',
 			'Slide on Page Click',
 			array($this, 'ms_slideonclick_setting'),
 			'manage-magneticslides',
 			'ms_behaviour_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'ms_slideonclick' );

 	 	add_settings_field(
 			'ms_arrowleft',
 			'Custom Mouse Cursor Left',
 			array($this, 'ms_arrowleft_setting'),
 			'manage-magneticslides',
 			'ms_behaviour_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'ms_arrowleft' );

 	 	add_settings_field(
 			'ms_arrowright',
 			'Custom Mouse Cursor Right',
 			array($this, 'ms_arrowright_setting'),
 			'manage-magneticslides',
 			'ms_behaviour_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'ms_arrowright' );

 	 	add_settings_field(
 			'ms_arrowup',
 			'Custom Mouse Cursor Up',
 			array($this, 'ms_arrowup_setting'),
 			'manage-magneticslides',
 			'ms_behaviour_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'ms_arrowup' );

 	 	add_settings_field(
 			'ms_arrowdown',
 			'Custom Mouse Cursor Down',
 			array($this, 'ms_arrowdown_setting'),
 			'manage-magneticslides',
 			'ms_behaviour_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'ms_arrowdown' );

 	 	add_settings_field(
 			'ms_autoScrolling',
 			'Auto Scrolling',
 			array($this, 'ms_autoScrolling_setting'),
 			'manage-magneticslides',
 			'ms_behaviour_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'ms_autoScrolling' );

 	 	add_settings_field(
 			'ms_autoScrollingSpeed',
 			'Auto Scrolling Speed',
 			array($this, 'ms_autoScrollingSpeed_setting'),
 			'manage-magneticslides',
 			'ms_behaviour_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'ms_autoScrollingSpeed' );

 	 	add_settings_field(
 			'ms_scrollBar',
 			'Scroll Bar',
 			array($this, 'ms_scrollBar_setting'),
 			'manage-magneticslides',
 			'ms_behaviour_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'ms_scrollBar' );

 	 	add_settings_field(
 			'ms_continuousVertical',
 			'Continuous Vertical',
 			array($this, 'ms_continuousVertical_setting'),
 			'manage-magneticslides',
 			'ms_behaviour_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'ms_continuousVertical' );

 	 	add_settings_field(
 			'ms_continuousHorizontal',
 			'Continuous Horizontal',
 			array($this, 'ms_continuousHorizontal_setting'),
 			'manage-magneticslides',
 			'ms_behaviour_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'ms_continuousHorizontal' );

 	 	add_settings_field(
 			'ms_fadingEffect',
 			'Fading Effect',
 			array($this, 'ms_fadingEffect_setting'),
 			'manage-magneticslides',
 			'ms_behaviour_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'ms_fadingEffect' );

 	 	// navigation
 	 	add_settings_field(
 			'ms_navigation',
 			'Show Navigation',
 			array($this, 'ms_navigation_setting'),
 			'manage-magneticslides',
 			'ms_navigation_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'ms_navigation' );

 	 	add_settings_field(
 			'ms_navigation_position',
 			'Navigation Position',
 			array($this, 'ms_navigation_position_setting'),
 			'manage-magneticslides',
 			'ms_navigation_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'ms_navigation_position' );

 	 	add_settings_field(
 			'ms_navigation_space_around',
 			'Navigation Space Around',
 			array($this, 'ms_navigation_space_around_setting'),
 			'manage-magneticslides',
 			'ms_navigation_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'ms_navigation_space_around' );

 	 	add_settings_field(
 			'ms_navigation_space_around_in',
 			'Navigation Space Around in',
 			array($this, 'ms_navigation_space_around_in_setting'),
 			'manage-magneticslides',
 			'ms_navigation_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'ms_navigation_space_around_in' );

 	 	add_settings_field(
 			'ms_navigation_space_between_circles',
 			'Navigation Space between Circles',
 			array($this, 'ms_navigation_space_between_circles_setting'),
 			'manage-magneticslides',
 			'ms_navigation_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'ms_navigation_space_between_circles' );

 	 	// other

 	 	add_settings_field(
 			'ms_fit_browser',
 			'Give elements a max-width and max-height and center them',
 			array($this, 'ms_fit_browser_setting'),
 			'manage-magneticslides',
 			'ms_other_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'ms_fit_browser' );

 	 	add_settings_field(
 			'ms_fit_browser_maxdim',
 			'Max-width and max-height of elements',
 			array($this, 'ms_fit_browser_maxdim_setting'),
 			'manage-magneticslides',
 			'ms_other_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'ms_fit_browser_maxdim' );

 	 	add_settings_field(
 			'ms_autoplay_videos',
 			'Autoplay videos when arriving on a slide',
 			array($this, 'ms_autoplay_videos_setting'),
 			'manage-magneticslides',
 			'ms_other_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'ms_autoplay_videos' );

 	 	add_settings_field(
 			'ms_disable_for_phone',
 			'Always disable for phone',
 			array($this, 'ms_disable_for_phone_setting'),
 			'manage-magneticslides',
 			'ms_other_section'
 		);
 	 	register_setting( 'manage-magneticslides', 'ms_disable_for_phone' );

	}

	public function ms_disable_for_phone_setting(){
		$val = get_option( 'ms_disable_for_phone', '' );
		$checked = "";
		if( $val == "on" ){
			$checked = "checked";
		}
		echo '<input type="checkbox" name="ms_disable_for_phone" id="ms_disable_for_phone" '.$checked.'>';
	}

	public function ms_autoplay_videos_setting(){
		$val = get_option( 'ms_autoplay_videos', '' );
		$checked = "";
		if( $val == "on" ){
			$checked = "checked";
		}
		echo
		'<input type="checkbox" name="ms_autoplay_videos" id="ms_autoplay_videos" '.$checked.'> <label for="ms_autoplay_videos">(On mobile, autoplay only works for HTML5 videos on newer devices.)</label>';
	}

	public function ms_fit_browser_maxdim_setting(){
		$val = get_option( 'ms_fit_browser_maxdim', "90" );
		echo '<input type="number" value="'.$val.'" min="0" max="100" step="1" name="ms_fit_browser_maxdim" id="ms_fit_browser_maxdim"><label for="ms_fit_browser_maxdim"> %</label>';
	}

	public function ms_fit_browser_setting(){
		$val = get_option( 'ms_fit_browser', '' );
		$checked = "";
		if( $val == "on" ){
			$checked = "checked";
		}
		echo '<input type="checkbox" name="ms_fit_browser" id="ms_fit_browser" '.$checked.'> <label for="ms_fit_browser"> (Only works for rows that contain only one element that is not a "Stack" element.)</label>';
	}

	public function ms_arrowleft_setting(){
		LayThemeMagneticSlides::ms_arrow_setting('ms_arrowleft');
	}

	public function ms_arrowright_setting(){
		LayThemeMagneticSlides::ms_arrow_setting('ms_arrowright');
	}

	public function ms_arrowup_setting(){
		LayThemeMagneticSlides::ms_arrow_setting('ms_arrowup');
	}

	public function ms_arrowdown_setting(){
		LayThemeMagneticSlides::ms_arrow_setting('ms_arrowdown');
	}

	public function ms_arrow_setting($option_name){
		// https://gist.github.com/hlashbrooke/9267467#file-class-php-L324
		$image_thumb_id = get_option( $option_name, '' );
		$image_thumb = "";
		$noimage_image = $image_thumb;
		$hideRemoveButtonCSS = '';
		if($image_thumb_id != ''){
			$image_thumb = wp_get_attachment_image_src( $image_thumb_id, 'full' );
			$image_thumb = $image_thumb[0];
		}
		else{
			$hideRemoveButtonCSS = 'style="display:none;"';
		}
		echo
		'<img id="'.$option_name.'_preview" style="max-width: 100%;" class="image_preview" data-noimagesrc="'.$noimage_image.'" src="'.$image_thumb.'">
		<p style="margin-bottom: 10px;">Max. size: 128 * 128 px</p>
		<input id="'.$option_name.'_button" style="margin-bottom: 5px;" type="button" class="image_upload_button button" value="Set image" /><br>
		<input id="'.$option_name.'_delete" '.$hideRemoveButtonCSS.' type="button" class="image_delete_button button" value="Remove image" /><br>
		<input id="'.$option_name.'" class="image_data_field" type="hidden" name="'.$option_name.'" value="'.$image_thumb_id.'"/>';
	}

	public function ms_slideonclick_setting(){
		$val = get_option( 'ms_slideonclick', '' );
		$checked = "";
		if( $val == "on" ){
			$checked = "checked";
		}
		echo '<input type="checkbox" name="ms_slideonclick" id="ms_slideonclick" '.$checked.'> <label for="ms_slideonclick">(Mouse Cursor will be an arrow indicating the slide direction)</label>';
	}

	public function ms_direction_setting(){
		$val = get_option( 'ms_direction', 'vertical' );

		$selectedHorizontal = '';
		$selectedVertical = 'selected';

		if($val == 'horizontal'){
			$selectedHorizontal = 'selected';
			$selectedVertical = '';
		}

		echo
		'<select name="ms_direction" id="ms_direction">
			<option value="vertical" '.$selectedVertical.'>vertical</option>
			<option value="horizontal" '.$selectedHorizontal.'>horizontal</option>
		</select>';
	}

	public function ms_navigation_space_between_circles_setting(){
		$val = get_option( 'ms_navigation_space_between_circles', "10" );
		echo '<input type="number" value="'.$val.'" min="0" step="1" name="ms_navigation_space_between_circles" id="ms_navigation_space_between_circles"> <label for="ms_navigation_space_between_circles"> (px) Space between circles of navigation</label>';
	}

	public function ms_navigation_space_around_setting(){
		$val = get_option( 'ms_navigation_space_around', "10" );
		echo '<input type="number" value="'.$val.'" min="0" step="1" name="ms_navigation_space_around" id="ms_navigation_space_around"> <label for="ms_navigation_space_around"> Space between navigation and browser edge</label>';
	}

	public function ms_autoScrolling_setting(){
		$val = get_option( 'ms_autoScrolling', 'on' );
		$checked = "";
		if( $val == "on" ){
			$checked = "checked";
		}
		echo '<input type="checkbox" name="ms_autoScrolling" id="ms_autoScrolling" '.$checked.'> <label for="ms_autoScrolling">If this is off, the scroll will be an unrestricted "free scroll" and a scroll bar will appear regardless of the "Scroll Bar" setting below.</label>';
	}

	public function ms_scrollBar_setting(){
		$val = get_option( 'ms_scrollBar', '' );
		$checked = "";
		if( $val == "on" ){
			$checked = "checked";
		}
		echo '<input type="checkbox" name="ms_scrollBar" id="ms_scrollBar" '.$checked.'> <label for="ms_scrollBar">Show a Scroll Bar</label>';
	}

	public function ms_fadingEffect_setting(){
		$val = get_option( 'ms_fadingEffect', "" );
		$checked = "";
		if( $val == "on" ){
			$checked = "checked";
		}
		echo '<input type="checkbox" name="ms_fadingEffect" id="ms_fadingEffect" '.$checked.'> <label for="ms_fadingEffect">Use fading effect instead of sliding effect.</label>';		
	}

	public function ms_continuousHorizontal_setting(){
		$val = get_option( 'ms_continuousHorizontal', "" );
		$checked = "";
		if( $val == "on" ){
			$checked = "checked";
		}
		echo '<input type="checkbox" name="ms_continuousHorizontal" id="ms_continuousHorizontal" '.$checked.'> <label for="ms_continuousHorizontal">Clicking next in the last slide goes right to the first slide. Clicking previous on the first slide goes left to the last slide.</label>';
	}

	public function ms_continuousVertical_setting(){
		$val = get_option( 'ms_continuousVertical', "" );
		$checked = "";
		if( $val == "on" ){
			$checked = "checked";
		}
		echo '<input type="checkbox" name="ms_continuousVertical" id="ms_continuousVertical" '.$checked.'> <label for="ms_continuousVertical">Scrolling down in the last section scrolls down to the first section. And scrolling up in the first section scrolls up to the last one.<br><strong>Only works if "Auto Scrolling" is on and "Scroll Bar" is off.</strong></label>';
	}

	public function ms_navigation_setting(){
		$val = get_option( 'ms_navigation', "" );
		$checked = "";
		if( $val == "on" ){
			$checked = "checked";
		}
		echo '<input type="checkbox" name="ms_navigation" id="ms_navigation" '.$checked.'> <label for="ms_navigation">Show a navigation bar made up of small circles</label>';
	}

	public function ms_navigation_position_setting(){
		$val = get_option( 'ms_navigation_position', "right" );

		$selectedLeft = '';
		$selectedRight = 'selected';

		if($val == 'left'){
			$selectedLeft = 'selected';
			$selectedRight = '';
		}

		echo
		'<select name="ms_navigation_position" id="ms_navigation_position">
			<option value="right" '.$selectedRight.'>right</option>
			<option value="left" '.$selectedLeft.'>left</option>
		</select>';
	}

	public function ms_navigation_space_around_in_setting(){
		$val = get_option( 'ms_navigation_space_around_in', "px" );

		$selectedPixel = 'selected';
		$selectedPercent = '';

		if($val == '%'){
			$selectedPercent = 'selected';
			$selectedPixel = '';
		}

		echo
		'<select name="ms_navigation_space_around_in" id="ms_navigation_space_around_in">
			<option value="px" '.$selectedPixel.'>px</option>
			<option value="%" '.$selectedPercent.'>%</option>
		</select> <label for="ms_navigation_space_around_in">Whether to set "Navigation Space Around" in Pixels or %</label>';
	}

	public function ms_autoScrollingSpeed_setting(){
		$val = get_option( 'ms_autoScrollingSpeed', "700" );
		echo '<input type="number" value="'.$val.'" min="0" step="1" name="ms_autoScrollingSpeed" id="ms_autoScrollingSpeed"> <label for="ms_autoScrollingSpeed"> (milliseconds) Speed of scrolling animation when using "Auto Scrolling". Using a value below 700 may cause double scrolling.</label>';
	}

	public function ms_active_in_projects_setting(){
		$val = get_option( 'magneticslides_active_in_projects', "all" );
		$checkedAll = "";
		$checkedIndividual = "";
		$checkedOff = "";

		if($val == "on" || $val == "all"){
			$checkedAll = "checked";
		}
		else if($val == "individual"){
			$checkedIndividual = "checked";
		}
		else if($val == "off" || $val == ""){
			$checkedOff = "checked";
		}

		echo
		'<input type="radio" name="magneticslides_active_in_projects" value="all" '.$checkedAll.' id="all-projects"><label for="all-projects">Active for all Projects</label><br>
		<input type="radio" name="magneticslides_active_in_projects" value="individual" '.$checkedIndividual.' id="individual-projects"><label for="individual-projects">Show a checkbox in the Project Edit Screen to activate Fullscreen Slider for individual Projects</label><br>
		<input type="radio" name="magneticslides_active_in_projects" value="off" '.$checkedOff.' id="off-projects"><label for="off-projects">Off for all Projects</label>';
	}

	public function ms_active_in_pages_setting(){
		$val = get_option( 'magneticslides_active_in_pages', "" );
		$checkedAll = "";
		$checkedIndividual = "";
		$checkedOff = "";

		if($val == "on" || $val == "all"){
			$checkedAll = "checked";
		}
		else if($val == "individual"){
			$checkedIndividual = "checked";
		}
		else if($val == "off" || $val == ""){
			$checkedOff = "checked";
		}

		echo
		'<input type="radio" name="magneticslides_active_in_pages" value="all" '.$checkedAll.' id="all-pages"><label for="all-pages">Active for all Pages</label><br>
		<input type="radio" name="magneticslides_active_in_pages" value="individual" '.$checkedIndividual.' id="individual-pages"><label for="individual-pages">Show a checkbox in the Page Edit Screen to activate Fullscreen Slider for individual Pages</label><br>
		<input type="radio" name="magneticslides_active_in_pages" value="off" '.$checkedOff.' id="off-pages"><label for="off-pages">Off for all Pages</label>';
	}

	public function ms_active_in_categories_setting(){
		$val = get_option( 'magneticslides_active_in_categories', "" );
		$checkedAll = "";
		$checkedIndividual = "";
		$checkedOff = "";

		if($val == "on" || $val == "all"){
			$checkedAll = "checked";
		}
		else if($val == "individual"){
			$checkedIndividual = "checked";
		}
		else if($val == "off" || $val == ""){
			$checkedOff = "checked";
		}

		echo
		'<input type="radio" name="magneticslides_active_in_categories" value="all" '.$checkedAll.' id="all-categories"><label for="all-categories">Active for all Categories</label><br>
		<input type="radio" name="magneticslides_active_in_categories" value="individual" '.$checkedIndividual.' id="individual-categories"><label for="individual-categories">Show a checkbox in the Category Edit Screen to activate Fullscreen Slider for individual Categories</label><br>
		<input type="radio" name="magneticslides_active_in_categories" value="off" '.$checkedOff.' id="off-categories"><label for="off-categories">Off for all Categories</label>';
	}

	public function ms_setup_menu(){
		add_submenu_page( 'manage-layoptions', 'Fullscreen Slider Addon', 'Fullscreen Slider Addon', 'manage_options', 'manage-magneticslides', array($this, 'ms_options_markup') );
	}

	public function ms_options_markup(){
		require_once( LayThemeMagneticSlides::$dir.'/backend/magneticslides_options_markup.php' );
	}

	public static function slides_styles(){
		wp_enqueue_style( 'magneticslides-style', LayThemeMagneticSlides::$url."/frontend/assets/css/frontend.style.css", array(), LayThemeMagneticSlides::$ver );

		$spaceAround = get_option( 'ms_navigation_space_around', "10" );
		$spaceBetweenCircles = get_option( 'ms_navigation_space_between_circles', "10" );
		$spaceAround_MU = get_option( 'ms_navigation_space_around_in', "px" );

		$cursorMarkup = "";
		$direction = get_option('ms_direction', 'vertical');

		if( get_option( 'ms_slideonclick', '' ) == "on" ){

			if( $direction == "vertical" ){


				$ms_arrowup = get_option('ms_arrowup', '');
				if($ms_arrowup != ''){
					$ms_arrowup = wp_get_attachment_image_src( $ms_arrowup, 'full' );
					if($ms_arrowup){
						$cursorMarkup .= 'html.fp-enabled #main-region.up{cursor:url("'.$ms_arrowup[0].'") '.($ms_arrowup[1]/2).' '.($ms_arrowup[2]/2).', pointer;}';
					}
				}else{
					$cursorMarkup .= 'html.fp-enabled #main-region.up{cursor: n-resize;}';
				}

				$ms_arrowdown = get_option('ms_arrowdown', '');
				if($ms_arrowdown != ''){
					$ms_arrowdown = wp_get_attachment_image_src( $ms_arrowdown, 'full' );
					if($ms_arrowdown){
						$cursorMarkup .= 'html.fp-enabled #main-region.down{cursor:url("'.$ms_arrowdown[0].'") '.($ms_arrowdown[1]/2).' '.($ms_arrowdown[2]/2).', pointer;}';
					}
				}else{
					$cursorMarkup .= 'html.fp-enabled #main-region.down{cursor: s-resize;}';
				}

			}
			else if( $direction == "horizontal" ){

				$ms_arrowleft = get_option('ms_arrowleft', '');
				if($ms_arrowleft != ''){
					$ms_arrowleft = wp_get_attachment_image_src( $ms_arrowleft, 'full' );
					if($ms_arrowleft){
						$cursorMarkup .= 'html.fp-enabled #main-region.left{cursor:url("'.$ms_arrowleft[0].'") '.($ms_arrowleft[1]/2).' '.($ms_arrowleft[2]/2).', pointer;}';
					}
				}else{
					$cursorMarkup .= 'html.fp-enabled #main-region.left{cursor: w-resize;}';
				}

				$ms_arrowright = get_option('ms_arrowright', '');
				if($ms_arrowright != ''){
					$ms_arrowright = wp_get_attachment_image_src( $ms_arrowright, 'full' );
					if($ms_arrowright){
						$cursorMarkup .= 'html.fp-enabled #main-region.right{cursor:url("'.$ms_arrowright[0].'") '.($ms_arrowright[1]/2).' '.($ms_arrowright[2]/2).', pointer;}';
					}
				}else{
					$cursorMarkup .= 'html.fp-enabled #main-region.right{cursor: e-resize;}';
				}
			}

		}

		$breakpoint = get_option('lay_breakpoint', 900);

		wp_add_inline_style( 'magneticslides-style',
			'#main-region.fullpage-wrapper{padding:0;}
			#fp-nav.right {
				right: '.$spaceAround.$spaceAround_MU.';
			}
			#fp-nav.left {
				left: '.$spaceAround.$spaceAround_MU.';
			}
			#fp-nav ul li{
				margin: '.$spaceBetweenCircles.'px 0;
			}
			.fp-slidesNav.bottom{
				bottom: '.$spaceAround.$spaceAround_MU.';
			}
			.fp-slidesNav ul li{
				margin: 0 '.$spaceBetweenCircles.'px 0 0;
			}
			.fp-slidesNav ul li:last-child{
				margin-right: 0;
			}'
			.$cursorMarkup
			.'@media (max-width: '.$breakpoint.'px){
				html.fp-enabled body{
					padding-top: 0!important;
				}
			}'
		);
	}

	public static function flattenArray($arrayIn){
		$arrayOut = array();
		if(is_array($arrayIn)){
			foreach ($arrayIn as $key => $value) {
				$arrayOut []= $arrayIn[$key];
			}
			return $arrayOut;
		}
	}

	public static function slides_scripts(){
		wp_enqueue_script( 'magneticslides-app', LayThemeMagneticSlides::$url."/frontend/assets/js/magneticslides.plugin.min.js", array( 'jquery' ), LayThemeMagneticSlides::$ver, true);

		$activeInProjects = get_option( 'magneticslides_active_in_projects', "all" );
		$activeInPages = get_option( 'magneticslides_active_in_pages', "" );
		$activeInCategories = get_option( 'magneticslides_active_in_categories', "" );

		// for an unknown reason in rare cases the arrays are saved as associative arrays, so flatten them here
		$individualProjectIds = get_option('magnetic_slides_individual_project_ids', '');
		$individualProjectIds = json_decode( $individualProjectIds, true );
		$individualProjectIds = json_encode( LayThemeMagneticSlides::flattenArray($individualProjectIds) );

		$individualPageIds = get_option('magnetic_slides_individual_page_ids', '');
		$individualPageIds = json_decode( $individualPageIds, true );
		$individualPageIds = json_encode( LayThemeMagneticSlides::flattenArray($individualPageIds) );

		$individualCategoryIds = get_option('magnetic_slides_individual_category_ids', '');
		$individualCategoryIds = json_decode( $individualCategoryIds, true );
		$individualCategoryIds = json_encode( LayThemeMagneticSlides::flattenArray($individualCategoryIds) );

		$breakpoint = get_option('lay_breakpoint', 600);

		wp_localize_script( 'magneticslides-app', 'magneticSlidesPassedData',
			array(
				'activeInProjects' => $activeInProjects,
			 	'activeInPages' => $activeInPages,
			  	'activeInCategories' => $activeInCategories,
			  	'individualProjectIds' => $individualProjectIds,
			  	'individualCategoryIds' => $individualCategoryIds,
			  	'individualPageIds' => $individualPageIds,
			  	'ms_slideonclick' => get_option( 'ms_slideonclick', '' ),
			  	'ms_direction' => get_option('ms_direction', 'vertical'),
		  		'ms_autoScrolling' => get_option('ms_autoScrolling', 'on'),
		  		'ms_autoScrollingSpeed' => get_option( 'ms_autoScrollingSpeed', "700" ),
		  		'ms_scrollBar' => get_option('ms_scrollBar', ''),
		  		'ms_continuousVertical' => get_option('ms_continuousVertical', ''),
		  		'ms_continuousHorizontal' => get_option('ms_continuousHorizontal', ''),
		  		'ms_navigation' => get_option('ms_navigation', ''),
		  		'ms_navigation_position' => get_option('ms_navigation_position', 'right'),
		  		'ms_fit_browser' => get_option( 'ms_fit_browser', '' ),
		  		'ms_fit_browser_maxwidth' => get_option( 'ms_fit_browser_maxwidth', "90" ),
		  		'ms_fit_browser_maxdim' => get_option( 'ms_fit_browser_maxdim', "90" ),
		  		'ms_disable_for_phone' => get_option( 'ms_disable_for_phone', '' ),
		  		'ms_autoplay_videos' => get_option("ms_autoplay_videos", ""),
		  		'breakpoint' => $breakpoint,
		  		'ms_fadingEffect' => get_option( 'ms_fadingEffect', "" )
		  	)
		);
	}
}
new LayThemeMagneticSlides();

require_once( plugin_dir_path( __FILE__ ).'/backend/individual_metaboxes.php' );

require 'plugin_update_check.php';
$MyUpdateChecker = new PluginUpdateChecker_2_0 (
    'https://kernl.us/api/v1/updates/56b32245681396fc05d44cf9/',
    __FILE__,
    'laytheme-magneticslides',
    1
);
