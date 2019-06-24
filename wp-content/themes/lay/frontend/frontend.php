<?php
class Frontend{

	public static $topframe_mu;
	public static $bottomframe_mu;
	public static $current_type_id_slug_catid;

	public function __construct(){
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_styles' ) );
		add_action( 'wp_head', array( $this, 'frontend_media_query_styles' ) );
		add_action( 'rest_api_init', array( $this, 'include_griddermeta_in_term') );
		add_action( 'rest_api_init', array( $this, 'include_griddermeta_in_post') );
		add_action( 'rest_api_init', array( $this, 'include_griddermeta_in_page') );

		add_action( 'wp_head', array($this, 'set_current_data') );
	}

	public static function set_current_data(){
		Frontend::$current_type_id_slug_catid = Frontend::get_current_type_id_slug_catid();
	}

	public static function get_current_type_id_slug_catid(){
		$type = '';
		$id = '';
		$projectcatid = '';
		$slug = '';

		global $post;

		// post is null if page doesnt exist. then just show frontpage
		if(is_category()){
			$category = get_category( get_query_var( 'cat' ) );
			$cat_id = $category->cat_ID;

			$slug = $category->slug;
			$type = 'category';
			$id = $cat_id;
		}
		else if(is_front_page() || is_null($post)){

			$type = get_theme_mod('frontpage_type', 'category');
			switch ($type) {
				case 'category':
					$id = get_theme_mod('frontpage_select_category', 1);
					$category = get_category( $id );
					$slug = $category->slug;
				break;
				case 'project':
					$id = get_theme_mod('frontpage_select_project');
					$cats = get_the_category( $id );
					$projectcatid = $cats[0]->term_id;
					$post = get_post($id);
					$slug = $post->post_name;
				break;
				case 'page':
					$id = get_theme_mod('frontpage_select_page');
					$post = get_post($id);
					$slug = $post->post_name;
				break;
			}

		}
		else if(is_single()){
			$type = 'project';
			$id = $post->ID;
			$slug = $post->post_name;
			$cats = get_the_category( $post->ID );
			$projectcatid = $cats[0]->term_id;
		}
		else{
			$type = 'page';
			$id = $post->ID;
			$slug = $post->post_name;
		}

		return array(
			"type" => $type,
			"id" => $id,
			"projectcatid" => $projectcatid,
			"slug" => $slug
		);
	}

	public static function get_body_data($echo = true){

		$data = Frontend::$current_type_id_slug_catid;
		$use_desktop_menu_as_mobile_menu = get_theme_mod('use_desktop_menu_as_mobile_menu') == 1 ? 'use-desktop-menu-as-mobile-menu' : 'use-mobile-menu';

		$return = 'class="type-'.$data["type"].' id-'.$data["id"].' slug-'.$data["slug"].' '.$use_desktop_menu_as_mobile_menu.'" data-type="'.$data["type"].'" data-id="'.$data["id"].'" data-catid="'.$data["projectcatid"].'"';

		if($echo){
			echo $return;
		}
		else{
			return $return;
		}

	}

	public static function get_max_width_option_css(){
		$maxwidth = get_option( 'misc_options_max_width', '0' );

		if($maxwidth != '0'){
			echo '<!-- max width option -->';
			echo
			'<style>@media (min-width: '.(MiscOptions::$phone_breakpoint+1).'px){.row-inner{margin-left:auto;margin-right:auto;max-width:'.$maxwidth.'px;}}</style>';
		}
	}

	public static function get_custom_head_content_and_css(){

		$customHeadContent = get_option( 'misc_options_analytics_code', '' );
		if($customHeadContent != ''){
			echo '<!-- custom head content -->';
			echo $customHeadContent;
		}

		$desktopCSS = get_option( 'misc_options_desktop_css', '' );
		if($desktopCSS != ''){
			echo '<!-- custom css for desktop version -->';
			echo '<style>@media (min-width: '.(MiscOptions::$phone_breakpoint+1).'px){'.$desktopCSS.'}</style>';
		}

		$mobileCSS = get_option( 'misc_options_mobile_css', '' );
		if($mobileCSS != ''){
			echo '<!-- custom css for mobile version -->';
			echo '<style>@media (max-width: '.MiscOptions::$phone_breakpoint.'px){'.$mobileCSS.'}</style>';
		}

		$navigation_transition_duration = Frontend::get_transition_duration();

		echo
		'<!-- navigation transition duration css -->
		<style>
			body{
				-webkit-transition: background-color '.$navigation_transition_duration.'ms ease;
				transition: background-color '.$navigation_transition_duration.'ms ease;
			}
			#main-region, #footer-region{
				-webkit-transition: opacity '.$navigation_transition_duration.'ms ease;
				transition: opacity '.$navigation_transition_duration.'ms ease;
			}
		</style>';
	}

	public static function get_transition_duration(){
		$navigation_transition_duration = get_option( 'misc_options_navigation_transition_duration', '0.6' );
		if(is_numeric($navigation_transition_duration)){
			$navigation_transition_duration = (float)$navigation_transition_duration;
			// to milliseconds
			$navigation_transition_duration *= 1000;
			$navigation_transition_duration /= 2;
		}else{
			$navigation_transition_duration = 300;
		}
		return $navigation_transition_duration;
	}

	public static function get_meta(){

		// https://codex.wordpress.org/Function_Reference/is_plugin_active
		// include needed to use is_plugin_active
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if(is_plugin_active('wordpress-seo/wp-seo.php')){
			// bail out early if yoast seo plugin is active, because it provides all these metatags already
			return;
		}

		$description = get_option( 'misc_options_website_description', '' );
		$fbimage_id = get_option( 'misc_options_fbimage', '' );
		$fbimage = wp_get_attachment_image_src( $fbimage_id, 'full' );

		$title = get_bloginfo('name');

		// for google
		if( is_single() ){
			global $post;
			$project_descr = get_post_meta( $post->ID, 'lay_project_description', true );
			$project_descr = strip_tags($project_descr);

			if($project_descr != ""){
				echo '<meta name="description" content="'.$project_descr.'"/>';
			}
		}else{
			if($description != ''){
				echo '<meta name="description" content="'.$description.'"/>';
			}
		}

		// og tags
		if($fbimage){
			echo
			'<meta property="og:image" content="'.$fbimage[0].'">
			<meta property="og:image:width" content="'.$fbimage[1].'">
			<meta property="og:image:height" content="'.$fbimage[2].'">';
		}
		echo
		'<meta property="og:title" content="'.$title.'">
		<meta property="og:site_name" content="'.get_bloginfo('name').'">';

		if($description != ''){
			echo '<meta property="og:description" content="'.$description.'">';
		}

		if($fbimage){
			echo
			'<meta name="twitter:card" content="summary_large_image">
			<meta name="twitter:title" content="'.$title.'">
			<meta name="twitter:image" content="'.$fbimage[0].'">';
		}
		else{
			echo
			'<meta name="twitter:card" content="summary">
			<meta name="twitter:title" content="'.$title.'">';
		}

		if($description != ''){
			echo '<meta name="twitter:description" content="'.$description.'">';
		}

	}

	public static function get_home_link_data(){
		$type = get_theme_mod('frontpage_type', 'category');
		$id = '';
		$projectcatid = '';

		switch ($type) {
			case 'category':
				$id = get_theme_mod('frontpage_select_category', 1);
			break;
			case 'project':
				$id = get_theme_mod('frontpage_select_project');
				$cats = get_the_category( $id );
				$projectcatid = $cats[0]->term_id;
			break;
			case 'page':
				$id = get_theme_mod('frontpage_select_page');
			break;
		}

		$return = 'data-type="'.$type.'" data-id="'.$id.'" data-catid="'.$projectcatid.'"';

		return $return;
	}

	public static function get_footer(){
		$custom_html_bottom = get_option( 'misc_options_custom_htmlbottom', '' );
		if( $custom_html_bottom != "" ){
			echo $custom_html_bottom;
		}
	}

	public static function get_project_arrows(){
		//project arrows
		$showArrows = get_option('misc_options_show_project_arrows', '');
		if($showArrows == "on"){

			$pa_hide_prev = get_theme_mod('pa_hide_prev', '');
			$pa_type = get_theme_mod('pa_type', 'icon');
			$pa_position = get_theme_mod('pa_position', 'center');
			$prevA = '';
			$nextA = '';

			switch($pa_type){
				case 'icon':
					$icon = get_theme_mod('pa_icon', '&#9654;');
					$prevA = '<a data-type="project" class="pa-prev project-arrow pa-icon pa-mirror '.$pa_position.'">'.$icon.'</a>';
					$nextA = '<a data-type="project" class="pa-next project-arrow pa-icon '.$pa_position.'">'.$icon.'</a>';
				break;
				case 'text':
					$next = get_theme_mod('pa_next_text', 'Next');
					$prev = get_theme_mod('pa_prev_text', 'Previous');
					$prevA = '<a data-type="project" class="pa-prev project-arrow pa-text '.$pa_position.'">'.$prev.'</a>';
					$nextA = '<a data-type="project" class="pa-next project-arrow pa-text '.$pa_position.'">'.$next.'</a>';
				break;
				case 'project-thumbnails':
					$prevA = '<a data-type="project" class="pa-prev project-arrow pa-thumb '.$pa_position.'"></a>';
					$nextA = '<a data-type="project" class="pa-next project-arrow pa-thumb '.$pa_position.'"></a>';
				break;
				case 'custom-image':
					$src = get_theme_mod('pa_image', '');
					$prevA = '<a data-type="project" class="pa-prev project-arrow pa-img pa-mirror '.$pa_position.'"><img src="'.$src.'" alt=""></a>';
					$nextA = '<a data-type="project" class="pa-next project-arrow pa-img '.$pa_position.'"><img src="'.$src.'" alt=""></a>';
				break;
			}

			if($pa_hide_prev == "on"){
				echo $nextA;
			}
			else{
				echo $prevA;
				echo $nextA;
			}

		}
	}

	// top custom html,
	// site title
	// mobile site title
	// mobile menu
	// desktop menu
	// menu bar
	// burger
	public static function get_header(){

		$custom_html_top = get_option( 'misc_options_custom_htmltop', '' );
		if( $custom_html_top != "" ){
			echo $custom_html_top;
		}

		$title = get_bloginfo( 'name');
		$homeurl = get_bloginfo('url');


		$mobiletitle = '';

		$hideTagLine = get_theme_mod('tagline_hide', "1");

		$taglineMarkup = '';
		if($hideTagLine != "1"){
			$tagline = html_entity_decode(get_bloginfo( 'description' ));

			if (strpos($tagline, '<br>') === false) {
				$tagline = nl2br($tagline);
			}

			$tagline_textformat = get_theme_mod('tagline_textformat', 'Default');
			if($tagline_textformat != ""){
				$tagline_textformat = '_'.$tagline_textformat;
			}
			$taglineMarkup = '<div class="tagline '.$tagline_textformat.'">'.$tagline.'</div>';
		}

		$txt_or_img = get_theme_mod('st_txt_or_img', 'text');
		$m_txt_or_img = get_theme_mod( 'm_st_txt_or_img', $txt_or_img );

		$title_with_linebreak = nl2br($title);

		// desktop
		switch ($txt_or_img) {
			case 'text':
				$st_textformat = get_theme_mod('st_textformat', 'Default');
				if($st_textformat != ""){
					$st_textformat = '_'.$st_textformat;
				}
				// we need a span el in here to make site title underline work well with multiline text
				echo
				'<a class="sitetitle txt" href="'.$homeurl.'" '.Frontend::get_home_link_data().' data-title="'.$title.'">
					<div class="sitetitle-txt-inner '.$st_textformat.'"><span>'.$title_with_linebreak.'</span></div>
					'.$taglineMarkup.'
				</a>';
			break;
			case 'image':
				$imgurl = get_theme_mod('st_image');
				echo
				'<a class="sitetitle img" href="'.$homeurl.'" '.Frontend::get_home_link_data().' data-title="'.$title.'">
					<img src="'.$imgurl.'" alt="'.$title.'">
					'.$taglineMarkup.'
				</a>';
			break;
		}

		// mobile
		switch ($m_txt_or_img){
			case 'text':
				$mobiletitle = get_bloginfo('name');
			break;
			case 'image':
				$default = get_theme_mod('st_image');
				$imgurl = get_theme_mod('m_st_image', $default);
				$mobiletitle = '<img src="'.$imgurl.'" alt="'.$title.'">';
			break;
		}

		echo LayMenuManager::get_mobile_menu();
		echo LayMenuManager::get_menu_markup();

		// dont show burger if there is no menu
		$hideburgerCSS = '';
		if(!LayMenuManager::at_least_one_menu_is_filled()){
			$hideburgerCSS = 'style="display:none;"';
		}

		echo
		'<div class="navbar"></div>';
		echo
		'<a class="mobile-title '.$m_txt_or_img.'" href="'.$homeurl.'" '.Frontend::get_home_link_data().' data-title="'.get_bloginfo('name').'"><span>'.$mobiletitle.'</span></a>';
		echo
		'<button class="burger" '.$hideburgerCSS.'>
			<span></span>
			<span></span>
			<span></span>
		</button>';
	}

	public static function frontend_media_query_styles(){
		echo
		'<!-- lay media query styles -->
		<style>
			@media (min-width: '.(MiscOptions::$phone_breakpoint+1).'px){
				'.MediaQueryCSS::$desktop.'
	 		}
	 		@media (max-width: '.(MiscOptions::$phone_breakpoint).'px){
	 			'.MediaQueryCSS::$phone.'
	 		}
 		</style>';
	}

	public function frontend_styles() {
		wp_enqueue_style( 'frontend-style', Setup::$uri."/frontend/assets/css/frontend.style.css", array(), Setup::$ver  );
	}

	// for projects prev/next navigation
	public static function get_projects_meta($prevnext_navigate_through){

		$meta = array();

		switch($prevnext_navigate_through){
			case 'same_category':
				// create an array for each category that includes all projects of this category
				// a project meta only has one category

				$allCategoryIds = get_terms('category', array('fields' => 'ids'));

				foreach ($allCategoryIds as $key => $catid) {

					$args = array(
						'fields' => 'ids',
						'posts_per_page' => -1,
						'orderby' => 'menu_order',
						'post_type' => 'post',
						'cat' => $catid,
						'order' => 'ASC'
					);

					$query = new WP_Query( $args );

					if ( $query->have_posts() ) {
						foreach ($query->posts as $id){

							$meta[$catid] []= Frontend::get_project_meta($id, $catid);

						}
					};

				}
			break;
			case 'all_projects':
				// a project meta only has one category

				$args = array(
					'fields' => 'ids',
					'posts_per_page' => -1,
					'orderby' => 'menu_order',
					'post_type' => 'post',
					'order' => 'ASC'
				);

				$query = new WP_Query( $args );

				if ( $query->have_posts() ) {
					foreach ($query->posts as $id){

						$catids = wp_get_post_categories( $id );
						$meta []= Frontend::get_project_meta($id, $catids[0]);

					}
				};

			break;
		}

		return json_encode($meta);
	}

	public static function get_project_meta($id, $catid){
		$thumb_id = get_post_thumbnail_id($id);

		$_265 = wp_get_attachment_image_src($thumb_id, '_265');
		$_512 = wp_get_attachment_image_src($thumb_id, '_512');
		$_768 = wp_get_attachment_image_src($thumb_id, '_768');
		$_1024 = wp_get_attachment_image_src($thumb_id, '_1024');
		$_1280 = wp_get_attachment_image_src($thumb_id, '_1280');
		$_1920 = wp_get_attachment_image_src($thumb_id, '_1920');
		$_2560 = wp_get_attachment_image_src($thumb_id, '_2560');
		$_3200 = wp_get_attachment_image_src($thumb_id, '_3200');
		$_3840 = wp_get_attachment_image_src($thumb_id, '_3840');
		$_4096 = wp_get_attachment_image_src($thumb_id, '_4096');
		$full = wp_get_attachment_image_src($thumb_id, 'full');

		$thumbar = 0;
		if($full){
			if($full[1] != 0){
				$thumbar = $full[2] / $full[1];
			}
		}

		return array(
			'title' => get_the_title($id),
			'url' => get_permalink($id),
			'id' => $id,
			'catid' => $catid,
			'thumb' => array(
				'_265' => $_265[0],
				'_512' => $_512[0],
				'_768' => $_768[0],
				'_1024' => $_1024[0],
				'_1280' => $_1280[0],
				'_1920' => $_1920[0],
				'_2560' => $_2560[0],
				'_3200' => $_3200[0],
				'_3840' => $_3840[0],
				'_4096' => $_4096[0],
				'full' => $full[0]
			),
			'thumbar' => $thumbar
		);
	}

	public function frontend_scripts(){
		wp_enqueue_script( 'vendor-frontend', Setup::$uri.'/frontend/assets/js/vendor.min.js', array( 'jquery' ), Setup::$ver );

		wp_enqueue_script( 'frontend-app', Setup::$uri."/frontend/assets/js/frontend.app.min.js", array( 'jquery' ), Setup::$ver);
		wp_localize_script( 'frontend-app', 'passedDataHistory', array( 'titleprefix'=>get_bloginfo('name').' &mdash; ', 'title'=>get_bloginfo('name') ) );

		wp_enqueue_script( 'vendor-instagram', 'https://platform.instagram.com/en_US/embeds.js' );

		wp_deregister_script( 'wp-embed' );

		$pt_textformat = get_theme_mod("pt_textformat", "Default");
		if($pt_textformat != ""){
			$pt_textformat = '_'.$pt_textformat;
		}

		$pt_position = get_theme_mod("pt_position", "below-image");
		$pd_position = get_theme_mod("pd_position", "below-image");

		$st_position = get_theme_mod('st_position', 'top-left');
		$st_hide = get_theme_mod('st_hide', 0);
		$navbar_hide = get_theme_mod('navbar_hide', 0);

		$showArrows = get_option('misc_options_show_project_arrows', '');
		$pa_type = get_theme_mod('pa_type', 'icon');
		$simple_parallax = get_option('misc_options_simple_parallax', '');

		$playicon = '';
		$playicon_id = get_option( 'misc_options_html5video_playicon', '' );
		if($playicon_id != ''){
			$playicon = wp_get_attachment_image_src( $playicon_id, 'full' );
			$playicon = $playicon[0];
		}

		$projectsFooterId = '';
		$footer_active_in_projects = get_option('lay_footer_active_in_projects', 'off');
		if($footer_active_in_projects=="all"){
			$projectsFooterId = get_option('lay_projects_footer', '');
		}

		$pagesFooterId = '';
		$footer_active_in_pages = get_option('lay_footer_active_in_pages', 'off');
		if($footer_active_in_pages=="all"){
			$pagesFooterId = get_option('lay_pages_footer', '');
		}

		$categoriesFooterId = '';
		$footer_active_in_categories = get_option('lay_footer_active_in_categories', 'off');
		if($footer_active_in_categories=="all"){
			$categoriesFooterId = get_option('lay_categories_footer', '');
		}

		$individual_project_footers = get_option('lay_individual_project_footers', '');
		$individual_page_footers = get_option('lay_individual_page_footers', '');
		$individual_category_footers = get_option('lay_individual_category_footers', '');

		$prevnext_navigate_through = get_option('misc_options_prevnext_navigate_through', 'same_category');

		$projectsMeta = Frontend::get_projects_meta($prevnext_navigate_through);

		$navigation_transition_duration = Frontend::get_transition_duration();

		$activate_project_description = get_option('misc_options_activate_project_description', '');
		$activate_project_description = $activate_project_description == "on" ? true : false;

		$fi_mo_touchdevice_behaviour = get_theme_mod('fi_mo_touchdevice_behaviour', 'mo_dont_show');

		$image_loading = get_option('misc_options_image_loading', 'instant_load');

		$cover_active_in_projects = get_option( 'cover_active_in_projects', "off" );
		$cover_active_in_pages = get_option( 'cover_active_in_pages', "off" );
		$cover_active_in_categories = get_option( 'cover_active_in_categories', "off" );

		// for an unknown reason in rare cases the arrays are saved as associative arrays, so flatten them here
		$cover_individual_project_ids = CoverOptions::get_individual_project_ids();
		$cover_individual_page_ids = CoverOptions::get_individual_page_ids();
		$cover_individual_category_ids = CoverOptions::get_individual_category_ids();

		$cover_scrolldown_on_click = get_option('cover_scrolldown_on_click', '');
		$cover_darken_when_scrolling = get_option('cover_darken_when_scrolling', '');
		$cover_parallaxmove_when_scrolling = get_option('cover_parallaxmove_when_scrolling', '');

		$misc_options_cover = get_option('misc_options_cover', '');

		$misc_options_max_width_apply_to_logo_and_nav = get_option('misc_options_max_width_apply_to_logo_and_nav', '');
		$maxwidth = get_option( 'misc_options_max_width', '0' );

		$default = get_theme_mod('st_fontfamily', Customizer::$defaults['fontfamily']);
		$m_st_fontfamily = get_theme_mod('m_st_fontfamily', $default);

		$misc_options_showoriginalimages = get_option('misc_options_showoriginalimages', '');
		$cover_disable_for_phone = get_option('cover_disable_for_phone', '');

		$phone_layout_active = get_option('misc_options_extra_gridder_for_phone', '');

		$misc_options_thumbnail_video = get_option('misc_options_thumbnail_video', '');
		$misc_options_thumbnail_mouseover_image = get_option('misc_options_thumbnail_mouseover_image', '');

		$frame_leftright = get_option( 'gridder_defaults_frame', LayConstants::gridder_defaults_frame );

		$bg_color = get_theme_mod('bg_color', '#ffffff');
		if($bg_color == ""){
			$bg_color = "#ffffff";
		}
		$bg_image = get_theme_mod('bg_image', "");

		$use_desktop_menu_as_mobile_menu = get_theme_mod('use_desktop_menu_as_mobile_menu');

		$is_customize = is_customize_preview();
		$is_ssl = is_ssl();
		$has_www = LTUtility::has_www();

		$is_qtranslate_active = is_plugin_active('qtranslate-x/qtranslate.php');

		$intro_text_textformat = get_theme_mod('intro_text_textformat', 'Default');
		if($intro_text_textformat != ""){
			$intro_text_textformat = '_'.$intro_text_textformat;
		}

		wp_localize_script( 'frontend-app', 'frontendPassedData',
			array(
				'wpapiroot' => esc_url_raw( rest_url() ),
				'playicon' => $playicon,
				'simple_parallax' => $simple_parallax,
				'templateDir' => get_template_directory_uri(),
				'pa_type' => $pa_type,
				'show_arrows' => $showArrows,
				'pt_textformat' => $pt_textformat,
				'pt_position' => $pt_position,
				'pd_position' => $pd_position,
				'projectsMeta' => $projectsMeta,
				'siteTitle' => get_bloginfo('name'),
				'rowgutter_mu' => Gridder::$rowgutter_mu,
				'topFrameMu' => Gridder::$topframe_mu,
				'bottomFrameMu' => Gridder::$bottomframe_mu,
				'nav_amount' => intval(get_option('misc_options_menu_amount', 1)),
				'nav_customizer_properties' => LayMenuCustomizerManager::get_customizer_properties_for_js(),
				'st_hidewhenscrollingdown' => CSS_Output::st_get_hide_when_scrolling_down(),
				'st_hide' => $st_hide,
				'navbar_hide' => $navbar_hide,
				'navbar_position' => CSS_Output::get_navbar_position(),
				'navbar_hidewhenscrollingdown' => CSS_Output::navbar_get_hide_when_scrolling_down(),
				'st_position' => $st_position,
				'footer_active_in_projects' => $footer_active_in_projects,
				'footer_active_in_pages' => $footer_active_in_pages,
				'footer_active_in_categories' => $footer_active_in_categories,
				'projectsFooterId' => $projectsFooterId,
				'pagesFooterId' => $pagesFooterId,
				'categoriesFooterId' => $categoriesFooterId,
				'individual_project_footers' => $individual_project_footers,
				'individual_page_footers' => $individual_page_footers,
				'individual_category_footers' => $individual_category_footers,
				'prevnext_navigate_through' => $prevnext_navigate_through,
				'navigation_transition_duration' => $navigation_transition_duration,
				'activate_project_description' => $activate_project_description,
				'fi_mo_touchdevice_behaviour' => $fi_mo_touchdevice_behaviour,
				'image_loading' => $image_loading,
				'cover_active_in_projects' => $cover_active_in_projects,
				'cover_active_in_pages' => $cover_active_in_pages,
				'cover_active_in_categories' => $cover_active_in_categories,
				'cover_individual_project_ids' => $cover_individual_project_ids,
				'cover_individual_page_ids' => $cover_individual_page_ids,
				'cover_individual_category_ids' => $cover_individual_category_ids,
				'cover_scrolldown_on_click' => $cover_scrolldown_on_click,
				'cover_darken_when_scrolling' => $cover_darken_when_scrolling,
				'cover_parallaxmove_when_scrolling' => $cover_parallaxmove_when_scrolling,
				'cover_disable_for_phone' => $cover_disable_for_phone,
				'misc_options_cover' => $misc_options_cover,
				'misc_options_max_width_apply_to_logo_and_nav' => $misc_options_max_width_apply_to_logo_and_nav,
				'maxwidth' => $maxwidth,
				'frame_leftright' => $frame_leftright,
				'm_st_fontfamily' => $m_st_fontfamily,
				'misc_options_showoriginalimages' => $misc_options_showoriginalimages,
				'phone_layout_active' => $phone_layout_active,
				'misc_options_thumbnail_video' => $misc_options_thumbnail_video,
				'misc_options_thumbnail_mouseover_image' => $misc_options_thumbnail_mouseover_image,
				'breakpoint' => MiscOptions::$phone_breakpoint,
				'tabletbreakpoint' => get_option('lay_tablet_breakpoint', 1024),
				'shortcodes' => LayShortcodes::$shortcodes_array,
				'bg_color' => $bg_color,
				'bg_image' => $bg_image,
				'is_customize' => $is_customize,
				'use_desktop_menu_as_mobile_menu' => $use_desktop_menu_as_mobile_menu,
				'mobile_hide_menubar' => get_theme_mod('mobile_hide_menubar', 0),
				'mobile_menubar_height' => get_theme_mod('mobile_menubar_height', 40),
				'siteUrl' => get_site_url(),
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'intro_active' => get_option('misc_options_intro', 'on') == 'on' ? true : false,
				'intro_hide_after' => get_option( 'intro_hide_after', '4000' ),
				// seems to be 0 and 1 instead of 'on' and 'off', maybe because this option is set in the customizer
				'intro_movement' => get_theme_mod( 'intro_movement', 0 ) == 1 ? true : false,
				'intro_landscape' => LayIntro::get_data('landscape'),
				'intro_portrait' => LayIntro::get_data('portrait'),
				'intro_use_svg_overlay' => get_theme_mod('intro_use_svg_overlay', 0) == 1 ? true : false,
				'intro_use_text_overlay' => get_theme_mod('intro_use_text_overlay', 0) == 1 ? true : false,
				'intro_text' => get_theme_mod('intro_text', ''),
				'is_frontpage' => is_front_page(),
				'intro_svg_url' => LayIntro::get_svg_overlay_url(),
				'intro_text_textformat' => $intro_text_textformat,
				'is_ssl' => $is_ssl,
				'has_www' => $has_www,
				'is_qtranslate_active' => $is_qtranslate_active,
				'video_thumbnail_mouseover_behaviour' => get_theme_mod('fi_mo_video_behaviour', 'autoplay'),
			)
		);
	}

	public function include_griddermeta_in_term(){
		register_rest_field( 'category',
		    'grid',
		    array(
		        'get_callback'    => array($this, 'get_term_griddermeta'),
		        'update_callback' => null,
		        'schema'          => null,
		    )
		);

		register_rest_field( 'category',
		    'phonegrid',
		    array(
		        'get_callback'    => array($this, 'get_term_phone_griddermeta'),
		        'update_callback' => null,
		        'schema'          => null,
		    )
		);
	}

	public function get_term_griddermeta( $object, $field_name, $request ){
		return get_option( $object['id'].'_category_gridder_json', '' );
	}

	public function get_term_phone_griddermeta( $object, $field_name, $request ){
		return get_option( $object['id'].'_phone_category_gridder_json', '' );
	}

	public function include_griddermeta_in_page(){
		register_rest_field( 'page',
		    'grid',
		    array(
		        'get_callback'    => array($this, 'get_post_griddermeta'),
		        'update_callback' => null,
		        'schema'          => null,
		    )
		);

		register_rest_field( 'page',
		    'phonegrid',
		    array(
		        'get_callback'    => array($this, 'get_post_phone_griddermeta'),
		        'update_callback' => null,
		        'schema'          => null,
		    )
		);
	}

	public function include_griddermeta_in_post(){
		register_rest_field( 'post',
		    'grid',
		    array(
		        'get_callback'    => array($this, 'get_post_griddermeta'),
		        'update_callback' => null,
		        'schema'          => null,
		    )
		);

		register_rest_field( 'post',
		    'phonegrid',
		    array(
		        'get_callback'    => array($this, 'get_post_phone_griddermeta'),
		        'update_callback' => null,
		        'schema'          => null,
		    )
		);
	}

	public function get_post_phone_griddermeta( $object, $field_name, $request ){
		if ( $this->can_access_password_content( $object, $request ) ) {
			return get_post_meta( $object['id'], '_phone_gridder_json', true );
		} else {
			return '';
		}
	}

	public function get_post_griddermeta( $object, $field_name, $request ){
		if ( $this->can_access_password_content( $object, $request ) ) {
			return get_post_meta( $object['id'], '_gridder_json', true );
		} else {
			return '';
		}
	}

	// modified version, taken from: class-wp-rest-posts-controller.php
	public function can_access_password_content( $post, $request ) {
		$request_params = $request->get_params();

		if ( empty( $post['password'] ) ) {
			// No password required, can access content
			return true;
		}

		// Edit context always gets access to password-protected posts.
		if ( 'edit' === $request_params['context'] ) {
			return true;
		}

		// No password, no auth.
		if ( empty( $request_params['password'] ) ) {
			return false;
		}

		// Double-check the request password.
		return hash_equals( $post['password'], $request_params['password'] );
	}

	public static function get_noscript_content(){
		$noscript = '<noscript>';

		global $post;
		$id = "";
		$string = "";
		$type = "";

		// post is null if page doesnt exist
		if(is_front_page() || is_null($post)){

			$type = get_theme_mod('frontpage_type', 'category');
			switch ($type) {
				case 'category':
					$id = get_theme_mod('frontpage_select_category', 1);
					$string = get_option($id."_category_gridder_json", '');
				break;
				case 'project':
					$id = get_theme_mod('frontpage_select_project');
					$string = get_post_meta( $id, '_gridder_json', true );
				break;
				case 'page':
					$id = get_theme_mod('frontpage_select_page');
					$string = get_post_meta( $id, '_gridder_json', true );
				break;
			}

			$noscript .= '<a href="http://laytheme.com">Frontpage made with Lay Theme</a>';

		}
		else if(is_category()){
			$type = "category";
			$category = get_category( get_query_var( 'cat' ) );
			$cat_id = $category->cat_ID;
			$id = $cat_id;
			$string = get_option($id."_category_gridder_json", '');
		}
		else{
			$type = "post";
			$id = $post->ID;
			$string = get_post_meta( $id, '_gridder_json', true );
		}

		$name = get_bloginfo('name');
		$title = "";
		if($type != 'category'){
			$title = get_the_title($id);
		}

		if($string != ''){
			$json = json_decode($string, true);

			if($json != null){
				if(array_key_exists('cont', $json)){
					$content = $json['cont'];
					foreach ($content as $key => $value) {
						switch( $value['type'] ){
							case 'img':
								$img = '<img src="'.$value['cont'].'" alt="'.$name.' '.$title.'">';
								if( array_key_exists('link', $value) ){
									$noscript .= '<a href="'.$value['link'].'">'.$img.'</a>';
								}
								else{
									$noscript .= $img;
								}
							break;
						case 'postThumbnail':
							$img = '<img src="'.$value['cont'].'" alt="'.$name.' '.$title.'">';
							$noscript .= '<a href="'.$value['link'].'">'.$img.'</a>';
						break;
						case 'text':
								$noscript .= $value['cont'];
							break;
						}
					}
					$noscript .= '<a href="http://laytheme.com">made with Lay Theme</a></noscript>';
					echo $noscript;
				}
			}

		}
	}

}
$frontend = new Frontend();