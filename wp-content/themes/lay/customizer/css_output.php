<?php
class CSS_Output{

	public function __construct(){
        add_action( 'wp_head', array($this, 'echo_lay_customize_css'));
    }

    public static function lay_customize_css(){
		// $textformats_for_tablet = get_option( 'misc_options_textformats_for_tablet', "" ) == "on" ? true : false;
		//
		// $formatsJsonString = get_option( 'formatsmanager_json', json_encode(array(FormatsManager::$defaultFormat)) );
		// $formatsJsonArr = json_decode($formatsJsonString, true);

		// $sharedStyles apply to desktop, tablet and mobile
        $sharedStyles = "";
		// $desktopAndTabletStyles applies to desktop and tablet size
        $desktopAndTabletStyles = "";
		$desktopStyles = "";
		$tabletStyles = "";
        $mobileStyles = "";
        
        // project title
        $sharedStyles .= CSS_Output::generate_mouseover_animate_visibility_css( '.thumb .title', 'pt_animate_visibility' );

        $sharedStyles .= CSS_Output::generate_visibility_css('.title', 'pt_visibility');
        $ptVisibility = get_theme_mod('pt_visibility', 'always-show');
        if($ptVisibility == 'show-on-mouseover'){
            $sharedStyles .= CSS_Output::generate_opacity_css('.no-touchdevice .thumb:hover .title, .touchdevice .thumb.hover .title', 'pt_opacity', 100);
        }else{
            $sharedStyles .= CSS_Output::generate_opacity_css('.title', 'pt_opacity', 100);
        }

        if( get_theme_mod("pt_textformat", "_Default") == "" ){
            $sharedStyles .= CSS_Output::generate_css('.title', 'font-weight', 'pt_fontweight', Customizer::$defaults['fontweight'], '', '');
            $sharedStyles .= CSS_Output::generate_css('.title', 'letter-spacing', 'pt_letterspacing', Customizer::$defaults['letterspacing'],'', 'em');
            $pt_fontsize_mu = CSS_Output::get_mu('pt_fontsize_mu', 'px');
            $sharedStyles .= CSS_Output::generate_css('.title', 'font-size', 'pt_fontsize', Customizer::$defaults['fontsize'],'', $pt_fontsize_mu);
            $sharedStyles .= CSS_Output::generate_css('.title', 'color', 'pt_color', Customizer::$defaults['color']);
            $sharedStyles .= CSS_Output::generate_css('.title', 'font-family', 'pt_fontfamily', Customizer::$defaults['fontfamily']);
        }
        $sharedStyles .= CSS_Output::generate_css('.title', 'text-align', 'pt_align', 'left');

        $sharedStyles .= CSS_Output::generate_css('.below-image .title', 'margin-top', 'pt_spacetop', '5','', 'px');
        $sharedStyles .= CSS_Output::generate_css('.above-image .title', 'margin-bottom', 'pt_spacetop', '5','', 'px');

        $sharedStyles .= CSS_Output::generate_css('.title', 'line-height', 'pt_lineheight', Customizer::$defaults['lineheight'],'', '');
        $sharedStyles .= CSS_Output::pt_generate_position_css('.titlewrap-on-image');


        //project description
        $sharedStyles .= CSS_Output::generate_mouseover_animate_visibility_css( '.thumb .descr', 'pd_animate_visibility' );

        $sharedStyles .= CSS_Output::generate_visibility_css('.descr', 'pd_visibility');
        $pdVisibility = get_theme_mod('pd_visibility', 'always-show');
        if($pdVisibility == 'show-on-mouseover'){
            $sharedStyles .= CSS_Output::generate_opacity_css('.no-touchdevice .thumb:hover .descr, .touchdevice .thumb.hover .descr', 'pd_opacity', 100);
        }else{
            $sharedStyles .= CSS_Output::generate_opacity_css('.descr', 'pd_opacity', 100);
        }

        $sharedStyles .= CSS_Output::generate_css('.descr', 'margin-top', 'pd_spacetop', '0','', 'px');
        // pd position
        $pd_position = get_theme_mod('pd_position', 'below-image');
        $pt_position = get_theme_mod('pt_position', 'below-image');
        // when pt position is below or above and pd pos is on-image, do center css
        // otherwise, the pt alignment defines where pt and pd are (can be on-image-top-left, or on-image-top-right, on-image-bottom-left etc)
        if( $pd_position == 'on-image' && strpos($pt_position, 'on-image') === false ){
            $sharedStyles .= 
            '.titlewrap-on-image{
                top: 50%;
                left: 50%;
                -webkit-transform: translate(-50%,-50%);
                -moz-transform: translate(-50%,-50%);
                -ms-transform: translate(-50%,-50%);
                -o-transform: translate(-50%,-50%);
                transform: translate(-50%,-50%);
            }';
        }

        // project thumbnail mouseover
        $mod = get_theme_mod('fi_mo_show_color', '');
        if($mod == "1"){
            $sharedStyles .= CSS_Output::generate_css('.thumb .ph span', 'background-color', 'fi_mo_background_color', '#fff', '', '');
            $sharedStyles .= CSS_Output::generate_featured_image_opacity_css('.no-touchdevice .thumb:hover .ph span, .touchdevice .thumb.hover .ph span', 'fi_mo_color_opacity', 50);
            $sharedStyles .= CSS_Output::generate_fi_mouseover_animate_bgcolor_css();
        }

        $mod = get_theme_mod('fi_mo_change_brightness', '');
        if($mod == "1"){
            $sharedStyles .= CSS_Output::generate_featured_image_brightness_css('.no-touchdevice .thumb:hover .ph, .touchdevice .thumb.hover .ph', 'fi_mo_brightness', 50);
            $sharedStyles .= CSS_Output::generate_fi_mouseover_animate_brightness_css();
        }

        $sharedStyles .= CSS_Output::generate_fi_mouseover_blur();
        $sharedStyles .= CSS_Output::generate_fi_mouseover_animate_blur();
        $sharedStyles .= CSS_Output::generate_fi_mouseover_zoom_css();

        // project arrows
        $pa_active = get_option('misc_options_show_project_arrows', '');

        if($pa_active == "on"){

            $pa_type = get_theme_mod('pa_type', 'icon');
            switch($pa_type){
                case 'icon':
                    $sharedStyles .= CSS_Output::generate_css('.project-arrow', 'color', 'pa_icon_color', '#000000', '', '');
                    $sharedStyles .= CSS_Output::generate_css('.project-arrow', 'font-size', 'pa_icon_size', '20', '', 'px');
                break;
                case 'text':
                    $sharedStyles .= CSS_Output::generate_css('.project-arrow', 'font-family', 'pa_fontfamily', Customizer::$defaults['fontfamily']);
                    $pa_fontsize_mu = CSS_Output::get_mu('pa_fontsize_mu', 'px');
                    $sharedStyles .= CSS_Output::generate_css('.project-arrow', 'font-size', 'pa_fontsize', Customizer::$defaults['fontsize'],'', $pa_fontsize_mu);
                    $sharedStyles .= CSS_Output::generate_css('.project-arrow', 'font-weight', 'pa_fontweight', Customizer::$defaults['fontweight']);
                    $sharedStyles .= CSS_Output::generate_css('.project-arrow', 'letter-spacing', 'pa_letterspacing', Customizer::$defaults['letterspacing'], '', 'em');
                    $sharedStyles .= CSS_Output::generate_css('.project-arrow', 'color', 'pa_color', Customizer::$defaults['color'], '', '');
                break;
                case 'project-thumbnails':
                case 'custom-image':
                    $pa_width_mu = CSS_Output::get_mu('pa_width_mu', '%');
                    $sharedStyles .= CSS_Output::generate_css('.project-arrow', 'width', 'pa_width', '10', '', $pa_width_mu);
                break;
            }

            $sharedStyles .= CSS_Output::generate_opacity_css('.project-arrow', 'pa_opacity', 100);
            $sharedStyles .= CSS_Output::generate_opacity_css('.project-arrow:hover', 'pa_mouseover_opacity', 100);

            $pa_spacetopbottom_mu = CSS_Output::get_mu('pa_spacetopbottom_mu', 'px');
            $sharedStyles .= CSS_Output::generate_css('.project-arrow.top', 'top', 'pa_spacetopbottom', '20', '', $pa_spacetopbottom_mu);
            $sharedStyles .= CSS_Output::generate_css('.project-arrow.bottom', 'bottom', 'pa_spacetopbottom', '20', '', $pa_spacetopbottom_mu);

            $pa_spaceleftright_mu = CSS_Output::get_mu('pa_spaceleftright_mu', 'px');
            $sharedStyles .= CSS_Output::generate_css('.project-arrow.pa-prev', 'left', 'pa_spaceleftright', '20', '', $pa_spaceleftright_mu);
            $sharedStyles .= CSS_Output::generate_css('.project-arrow.pa-next', 'right', 'pa_spaceleftright', '20', '', $pa_spaceleftright_mu);

            $sharedStyles .= CSS_Output::generate_css('.project-arrow:hover', 'color', 'pa_mouseover_color', '#000000', '', '');

            $sharedStyles .= CSS_Output::generate_css('.project-arrow', 'padding', 'pa_padding', '10', '', 'px');

            $mobileStyles .= CSS_Output::generate_hide_css('.project-arrow', 'pa_hide_on_phone');
        }

        // intro in intro.php

        // site title

		// if a textformat is selected, the html class is used by the dom element, so i don't need to create extra styles
		$st_textformat = get_theme_mod('st_textformat', 'Default');
		if($st_textformat == ""){
			// if no textformat was selected for st, generate css based on the individual customizer controls
			$st_fontsize_mu = CSS_Output::get_mu('st_fontsize_mu', 'px');
			$desktopAndTabletStyles .= CSS_Output::generate_css('.sitetitle-txt-inner', 'font-size', 'st_fontsize', Customizer::$defaults['fontsize'],'', $st_fontsize_mu);
			$desktopAndTabletStyles .= CSS_Output::generate_css('.sitetitle-txt-inner', 'font-weight', 'st_fontweight', Customizer::$defaults['fontweight']);
			$desktopAndTabletStyles .= CSS_Output::generate_css('.sitetitle-txt-inner', 'letter-spacing', 'st_letterspacing', Customizer::$defaults['letterspacing'], '', 'em');
			$desktopAndTabletStyles .= CSS_Output::generate_css('.sitetitle-txt-inner', 'color', 'st_color', Customizer::$defaults['color']);
			$desktopAndTabletStyles .= CSS_Output::generate_css('.sitetitle-txt-inner', 'font-family', 'st_fontfamily', Customizer::$defaults['fontfamily']);
			$desktopAndTabletStyles .= CSS_Output::generate_css('.sitetitle-txt-inner', 'text-align', 'st_align', 'left');
		}

        $st_spacetop_mu = CSS_Output::get_mu('st_spacetop_mu', 'px');
        $desktopAndTabletStyles .= CSS_Output::generate_css('.sitetitle', 'top', 'st_spacetop', Customizer::$defaults['st_spacetop'], '', $st_spacetop_mu);

        $spaceleft_mu = CSS_Output::get_mu('st_spaceleft_mu', '%');
        $desktopAndTabletStyles .= CSS_Output::generate_css('.sitetitle', 'left', 'st_spaceleft', Customizer::$defaults['st_spaceleft'],'', $spaceleft_mu);

        $spaceright_mu = CSS_Output::get_mu('st_spaceright_mu', '%');
        $desktopAndTabletStyles .= CSS_Output::generate_css('.sitetitle', 'right', 'st_spaceright', Customizer::$defaults['st_spaceright'],'', $spaceright_mu);

        $spacebottom_mu = CSS_Output::get_mu('st_spacebottom_mu', 'px');
        $desktopAndTabletStyles .= CSS_Output::generate_css('.sitetitle', 'bottom', 'st_spacebottom', Customizer::$defaults['st_spacebottom'], '', $spacebottom_mu);

        $st_img_width_mu = CSS_Output::get_mu('st_img_width_mu', 'vw');
        if($st_img_width_mu == "%"){
            $st_img_width_mu = "vw";
        }
        $desktopAndTabletStyles .= CSS_Output::generate_css('.sitetitle img', 'width', 'st_img_width', '20', '', $st_img_width_mu);

        $desktopAndTabletStyles .= CSS_Output::generate_opacity_css('.sitetitle', 'st_opacity', 100);
        $desktopAndTabletStyles .= CSS_Output::generate_position_css('.sitetitle', 'st_position', 'top-left');
        $desktopAndTabletStyles .= CSS_Output::generate_is_fixed_css('.sitetitle', 'st_isfixed');

        $desktopAndTabletStyles .= CSS_Output::generate_hide_css('.sitetitle', 'st_hide');
        $desktopAndTabletStyles .= CSS_Output::generate_css('.sitetitle.txt .sitetitle-txt-inner span', 'border-bottom-width', 'st_underline_strokewidth', Customizer::$defaults['underline_width'],'', 'px');

		// need to apply image alignment to .sitetitle wrapper, because img is display inline, this will not affect text-align of possible multiline tagline
		$desktopAndTabletStyles .= CSS_Output::generate_css('.sitetitle.img', 'text-align', 'st_image_alignment_in_relation_to_tagline', 'left', '', '');


        // site title mouseover
        $desktopAndTabletStyles .= CSS_Output::generate_css('.sitetitle.txt:hover .sitetitle-txt-inner span, .sitetitle:hover .tagline', 'color', 'stmouseover_color', Customizer::$defaults['color']);
        $desktopAndTabletStyles .= CSS_Output::generate_opacity_css('.sitetitle:hover', 'stmouseover_opacity', 100);
        $desktopAndTabletStyles .= CSS_Output::generate_css('.sitetitle.txt:hover .sitetitle-txt-inner span', 'border-bottom-width', 'stmouseover_underline_strokewidth', Customizer::$defaults['underline_width'],'', 'px');

        // tagline
		$tagline_textformat = get_theme_mod('tagline_textformat', 'Default');
		if($tagline_textformat == ""){
			$desktopAndTabletStyles .= CSS_Output::generate_css('.tagline', 'color', 'tagline_color', Customizer::$defaults['color']);
			$desktopAndTabletStyles .= CSS_Output::generate_css('.tagline', 'font-family', 'tagline_fontfamily', Customizer::$defaults['fontfamily']);

			$tagline_fontsize_mu = CSS_Output::get_mu('tagline_fontsize_mu', 'px');
			$desktopAndTabletStyles .= CSS_Output::generate_css('.tagline', 'font-size', 'tagline_fontsize', Customizer::$defaults['fontsize'],'', $tagline_fontsize_mu);

			$desktopAndTabletStyles .= CSS_Output::generate_css('.tagline', 'font-weight', 'tagline_fontweight', Customizer::$defaults['fontweight']);
			$desktopAndTabletStyles .= CSS_Output::generate_css('.tagline', 'letter-spacing', 'tagline_letterspacing', Customizer::$defaults['letterspacing'], '', 'em');

			$desktopAndTabletStyles .= CSS_Output::generate_css('.tagline', 'text-align', 'tagline_align', 'left');
		}

        $desktopAndTabletStyles .= CSS_Output::generate_css('.tagline', 'margin-top', 'tagline_spacetop', 5, '', 'px');

        $desktopAndTabletStyles .= CSS_Output::generate_opacity_css('.tagline', 'tagline_opacity', 100);

        // navigation / menu
        $menuStyles = &$desktopAndTabletStyles;
        // this setting now doesn't show the desktop menu "primary menu" but it shows the "mobile-nav" in a desktop menu style
        $use_desktop_menu_as_mobile_menu = get_theme_mod('use_desktop_menu_as_mobile_menu');
        if($use_desktop_menu_as_mobile_menu == 1){
            $menuStyles = &$sharedStyles;
        }

        // get css of menus
        foreach( LayMenuCustomizerManager::$menu_customizer_instances as $menu ){
            $menu->get_css($desktopAndTabletStyles, $mobileStyles, $menuStyles, $sharedStyles, $use_desktop_menu_as_mobile_menu);
        }

        // navigation active
        $menuStyles .= CSS_Output::generate_css('nav.laynav .current-menu-item>a', 'color', 'navactive_color', Customizer::$defaults['color']);
        $menuStyles .= CSS_Output::generate_css('nav.laynav .current-menu-item>a', 'font-weight', 'navactive_fontweight', Customizer::$defaults['fontweight']);
        $menuStyles .= CSS_Output::generate_css('nav.laynav .current-menu-item>a span', 'border-bottom-color', 'navactive_color', Customizer::$defaults['color'],'', '');
        $menuStyles .= CSS_Output::generate_css('nav.laynav .current-menu-item>a span', 'border-bottom-width', 'navactive_underline_strokewidth', Customizer::$defaults['underline_width'],'', 'px');
        $menuStyles .= CSS_Output::generate_opacity_css('nav.laynav .current-menu-item>a', 'navactive_opacity', 100);

        // navigation mouseover
        $menuStyles .= CSS_Output::generate_css('nav.laynav a:hover', 'color', 'navmouseover_color', Customizer::$defaults['color']);
        $menuStyles .= CSS_Output::generate_css('nav.laynav a:hover span', 'border-bottom-color', 'navmouseover_color', Customizer::$defaults['color']);
        
        $navmouseover_underline_strokewidth = get_theme_mod('navmouseover_underline_strokewidth', Customizer::$defaults['underline_width']);
        
        // just setting border-bottom-color to transparent instead of setting border-bottom-width to 0, prevents flickering when hovering over border only
        if($navmouseover_underline_strokewidth == 0){
            $menuStyles .= 'nav.laynav a:hover span{border-bottom-color: transparent;}';
        }else{
            $menuStyles .= CSS_Output::generate_css('nav.laynav a:hover span', 'border-bottom-width', 'navmouseover_underline_strokewidth', Customizer::$defaults['underline_width'],'', 'px');
        }
        
        $menuStyles .= CSS_Output::generate_opacity_css('nav.laynav a:hover', 'navmouseover_opacity', 100);

        // background
        // need to set bg color and bg image also for footer-region, rows-region and cover-region to make cover feature work right
        $sharedStyles .= CSS_Output::generate_css('body, #footer-region, #rows-region, #cover-region', 'background-color', 'bg_color', '#ffffff');

        $bg_image = get_theme_mod('bg_image', "");
        if($bg_image != ""){
            $desktopAndTabletStyles .= 'body, #footer-region, #rows-region, #cover-region{ background-image:url('.$bg_image.'); }';
        }

        $bg_position = get_theme_mod('bg_position', 'standard');
        if($bg_position != 'standard'){
            switch ($bg_position) {
                case 'stretch':
                    $desktopAndTabletStyles .= 'body, #footer-region, #rows-region, #cover-region{ background-size:cover; background-attachment:fixed; background-repeat:no-repeat; background-position:center center;}';
                break;
                case 'center':
                    $desktopAndTabletStyles .= 'body, #footer-region, #rows-region, #cover-region{ background-repeat:no-repeat; background-attachment:fixed; background-position:center;}';
                break;
            }
        }

		// mobile background image
		$mobile_bg_image = get_theme_mod('mobile_bg_image', "");
        if($mobile_bg_image != ""){
            $mobileStyles .= 'body, #footer-region, #rows-region, #cover-region{ background-image:url('.$mobile_bg_image.'); }';
        }

        $mobile_bg_position = get_theme_mod('mobile_bg_position', 'standard');
        if($mobile_bg_position != 'standard'){
            switch ($mobile_bg_position) {
                case 'stretch':
                    $mobileStyles .= 'body, #footer-region, #rows-region, #cover-region{ background-size:cover; background-attachment:fixed; background-repeat:no-repeat; background-position:center center;}';
                break;
                case 'center':
                    $mobileStyles .= 'body, #footer-region, #rows-region, #cover-region{ background-repeat:no-repeat; background-attachment:fixed; background-position:center;}';
                break;
            }
        }

        // navigation bar
        $desktopAndTabletStyles .= CSS_Output::generate_navbar_position();
        $desktopAndTabletStyles .= CSS_Output::generate_opacity_css('.navbar', 'navbar_opacity', 90);

        $navbar_height_mu = CSS_Output::get_mu('navbar_height_mu', 'px');
        $desktopAndTabletStyles .= CSS_Output::generate_css('.navbar', 'height', 'navbar_height', '60', '', $navbar_height_mu);
        $desktopAndTabletStyles .= CSS_Output::generate_hide_css('.navbar', 'navbar_hide');
        
        if(CSS_Output::navbar_get_hide_when_scrolling_down() == 1){
            $desktopAndTabletStyles .=
            '.navbar{
                -webkit-transition: top 350ms ease, bottom 350ms ease;
                -moz-transition: top 350ms ease, bottom 350ms ease;
                transition: top 350ms ease, bottom 350ms ease;
            }';            
        }
        
        if(CSS_Output::nav_get_hide_when_scrolling_down('primary') == 1){
            $desktopAndTabletStyles .=
            'nav.primary{
                -webkit-transition: top 350ms ease, bottom 350ms ease;
                -moz-transition: top 350ms ease, bottom 350ms ease;
                transition: top 350ms ease, bottom 350ms ease;
            }';
        }
        if(CSS_Output::nav_get_hide_when_scrolling_down('second_menu') == 1){
            $desktopAndTabletStyles .=
            'nav.second_menu{
                -webkit-transition: top 350ms ease, bottom 350ms ease;
                -moz-transition: top 350ms ease, bottom 350ms ease;
                transition: top 350ms ease, bottom 350ms ease;
            }';
        }
        if(CSS_Output::nav_get_hide_when_scrolling_down('third_menu') == 1){
            $desktopAndTabletStyles .=
            'nav.third_menu{
                -webkit-transition: top 350ms ease, bottom 350ms ease;
                -moz-transition: top 350ms ease, bottom 350ms ease;
                transition: top 350ms ease, bottom 350ms ease;
            }';
        }
        if(CSS_Output::nav_get_hide_when_scrolling_down('fourth_menu') == 1){
            $desktopAndTabletStyles .=
            'nav.fourth_menu{
                -webkit-transition: top 350ms ease, bottom 350ms ease;
                -moz-transition: top 350ms ease, bottom 350ms ease;
                transition: top 350ms ease, bottom 350ms ease;
            }';
        }

        $st_hidewhenscroll = CSS_Output::st_get_hide_when_scrolling_down();
        if($st_hidewhenscroll == 1){
            $desktopAndTabletStyles .=
            '.sitetitle{
                -webkit-transition: top 350ms ease, bottom 350ms ease;
                -moz-transition: top 350ms ease, bottom 350ms ease;
                transition: top 350ms ease, bottom 350ms ease;
            }';
        }

        $desktopAndTabletStyles .= CSS_Output::generate_css('.navbar', 'background-color', 'navbar_color', '#ffffff');
        $desktopAndTabletStyles .= CSS_Output::generate_navbar_border_color_css();
        $desktopAndTabletStyles .= CSS_Output::generate_css('.navbar', 'border-color', 'navbar_border_color', '#cccccc');

        // links in texts and next project / prev project links
        $sharedStyles .= CSS_Output::generate_css('.lay-textformat-parent a, a.projectlink .lay-textformat-parent>*', 'color', 'link_color', '#00f');
        $sharedStyles .= CSS_Output::generate_css('.lay-textformat-parent a, a.projectlink .lay-textformat-parent>*', 'border-bottom-width', 'link_underline_strokewidth', '0', '', 'px');

        // links in texts mouseover / prev project links mouseover
        $desktopAndTabletStyles .= CSS_Output::generate_css('.lay-textformat-parent a:hover, a.projectlink .lay-textformat-parent>*:hover', 'color', 'link_hover_color', '#00f');
        $desktopAndTabletStyles .= CSS_Output::generate_css('.lay-textformat-parent a:hover, a.projectlink .lay-textformat-parent>*:hover', 'border-bottom-width', 'link_hover_underline_strokewidth', '0', '', 'px');
        $desktopAndTabletStyles .= CSS_Output::generate_opacity_css('.lay-textformat-parent a:hover, a.projectlink .lay-textformat-parent>*:hover', 'link_hover_opacity', 100);

        // mobile
        // all of this just applies to automatically generated phone layouts (.nocustomphonegrid), not custom phone layouts (.hascustomphonegrid)

        // on mobile, I just have margin between elements(cols), not between rows
        $mobileStyles .= CSS_Output::generate_css('.nocustomphonegrid .col', 'margin-bottom', 'mobile_space_between_elements', 5, '', '%');
        // when a row is empty and height of browserheight (probably with a row bg) then it should have a margin-bottom like a col
        $mobileStyles .= CSS_Output::generate_css('.nocustomphonegrid .row.empty._100vh', 'margin-bottom', 'mobile_space_between_elements', 5, '', '%');
        // when a row has a background image, it should have a margin-bottom like a col 
        $mobileStyles .= CSS_Output::generate_css('.nocustomphonegrid .row.has-background', 'margin-bottom', 'mobile_space_between_elements', 5, '', '%');
				
        // space between when cover - this gives a "space between" to the top of the content region after the cover
        $mobileStyles .= CSS_Output::generate_css('body.hascover #main-region.nocustomphonegrid #rows-region #grid', 'padding-top', 'mobile_space_between_elements', 5, '', '%');

        // left and right space
        $mobileStyles .= CSS_Output::generate_css('.nocustomphonegrid .row', 'padding-left', 'mobile_space_leftright', 5, '', 'vw');
        $mobileStyles .= CSS_Output::generate_css('.nocustomphonegrid .row', 'padding-right', 'mobile_space_leftright', 5, '', 'vw');

        // space top - when hascover and no custom phone grid
        $mobileStyles .= CSS_Output::generate_css('body.hascover #main-region.nocustomphonegrid #cover-region .row-inner', 'padding-top', 'mobile_space_top', 5, '', '%');

        // space top - no cover and main region no custom phone grid
        $mobileStyles .= CSS_Output::generate_css('body.nocover #main-region.nocustomphonegrid .row:first-child .row-inner', 'padding-top', 'mobile_space_top', 5, '', '%');

        // footer - first row of footer should have padding top of space between
        $mobileStyles .= CSS_Output::generate_css('body.hasfooter #footer-region.nocustomphonegrid .row:first-child', 'padding-top', 'mobile_space_between_elements', 5, '', '%');

        // space bottom - no footer, no main region custom phone grid
        $mobileStyles .= CSS_Output::generate_css('body.nofooter.mainregion-nocustomphonegrid #footer-region', 'padding-bottom', 'mobile_space_bottom', 5, '', '%');

        // space bottom - has footer, main region custom phone grid, no footer region custom phone grid
        $mobileStyles .= CSS_Output::generate_css('body.hasfooter.mainregion-hascustomphonegrid.footerregion-nocustomphonegrid #footer-region', 'padding-bottom', 'mobile_space_bottom', 5, '', '%');

        // space bottom - has footer, no main region custom phone grid, no footer region custom phone grid
        $mobileStyles .= CSS_Output::generate_css('body.hasfooter.mainregion-nocustomphonegrid.footerregion-nocustomphonegrid #footer-region', 'padding-bottom', 'mobile_space_bottom', 5, '', '%');

        // mobile menu
        $txtColor = Customizer::$defaults['mobile_menu_txt_color'];
        $lighterBgColor = Customizer::$defaults['mobile_menu_light_color'];
        $darker = Customizer::$defaults['mobile_menu_dark_color'];

        $mobileStyles .= CSS_Output::generate_hide_mobile_menu();

        if(get_theme_mod('use_desktop_menu_as_mobile_menu') == 1){
            $spacetop_mu = CSS_Output::get_mu('mobile_menu_spacetop_mu', 'px');
            $mobileStyles .= CSS_Output::generate_css('nav.mobile-nav', 'top', 'mobile_menu_spacetop', '12', '', $spacetop_mu);

            switch(get_theme_mod('mobile_menu_position', 'right')){
                case 'left':
                    $spaceleft_mu = CSS_Output::get_mu('mobile_menu_spaceleft_mu', '%');
                    $mobileStyles .= CSS_Output::generate_css('nav.mobile-nav', 'left', 'mobile_menu_spaceleft', '5', '', $spaceleft_mu);
                break;
                case 'right':
                    $spaceright_mu = CSS_Output::get_mu('mobile_menu_spaceright_mu', '%');
                    $mobileStyles .= CSS_Output::generate_css('nav.mobile-nav', 'right', 'mobile_menu_spaceright', '5', '', $spaceright_mu);
                break;
                case 'center':
                    $mobileStyles .=
                    'nav.mobile-nav{right: auto; left: 50%;
                    -webkit-transform: translateX(-50%);
                    -moz-transform: translateX(-50%);
                    -ms-transform: translateX(-50%);
                    -o-transform: translateX(-50%);
                    transform: translateX(-50%);}';
                break;
            }

            $mobileStyles .= CSS_Output::nav_generate_menupoints_arrangement('nav.mobile-nav li', 'mobile_menu_arrangement');
                                                                                // $selector, $mod_name, $default, $prefix='', $postfix='', $arrangement_mod_name
            $mobileStyles .= CSS_Output::nav_generate_menupoints_spacebetween_css('nav.mobile-nav li', 'mobile_menu_spacebetween', '5', '', 'px', 'mobile_menu_arrangement');
        }

		// mobile menu fixed?
		$mobileStyles .= CSS_Output::generate_is_fixed_css('nav.mobile-nav, .navbar, .burger', 'mobile_menu_isfixed');


        // mobile site title

        // mobile site title hide, not using "generate_hide_css" here because shown state is display flex, not display block
        $default = get_theme_mod('st_hide', 0);
        $m_st_hide = get_theme_mod('m_st_hide', $default);
        if($m_st_hide == "1"){
            $mobileStyles .= ".mobile-title.text, .mobile-title.image{display:none;}";
        }

        $mobileStyles .= CSS_Output::generate_css('.mobile-title.image img', 'height', 'm_st_img_height', 30, '', 'px');

        $default = get_theme_mod('st_fontfamily', Customizer::$defaults['fontfamily']);
        $mobileStyles .= CSS_Output::generate_css('.mobile-title.text', 'font-family', 'm_st_fontfamily', $default, '', '');

        $m_st_fontsize_mu = CSS_Output::get_mu('m_st_fontsize_mu', 'px');
        $mobileStyles .= CSS_Output::generate_css('.mobile-title.text', 'font-size', 'mobile_menu_sitetitle_fontsize', Customizer::$defaults['mobile_menu_fontsize'], '', $m_st_fontsize_mu);

        $default = get_theme_mod('st_fontweight', Customizer::$defaults['fontweight']);
        $mobileStyles .= CSS_Output::generate_css('.mobile-title.text', 'font-weight', 'm_st_fontweight', $default, '', '');

        $default = get_theme_mod('st_color', Customizer::$defaults['color']);
        $mobileStyles .= CSS_Output::generate_css('.mobile-title.text', 'color', 'm_st_color', $default, '', '');

        $default = get_theme_mod('st_letterspacing' , Customizer::$defaults['letterspacing']);
        $mobileStyles .= CSS_Output::generate_css('.mobile-title.text', 'letter-spacing', 'm_st_letterspacing', $default, '', 'em');

        // mobile site title position
        $m_st_position = get_theme_mod('m_st_position', 'center');
        $mobile_hide_menu = get_theme_mod('mobile_hide_menu', 0);

        $m_st_isfixed = get_theme_mod('m_st_isfixed', 1);
        if($m_st_isfixed == "0"){
            $mobileStyles .= '.mobile-title{position:absolute;}';
        }else{
            $mobileStyles .= '.mobile-title{position:fixed;}';
        }

        if($m_st_position == "center"){
            // use top space
            $m_st_spacetop_mu = CSS_Output::get_mu('m_st_spacetop_mu', 'px');
            $mobileStyles .= CSS_Output::generate_css('.mobile-title', 'top', 'm_st_spacetop', 12, '', $m_st_spacetop_mu);
            $mobileStyles .= '.mobile-title{width: 100%}';
        }else if($m_st_position == "left"){
            // use top space and left space
            $m_st_spacetop_mu = CSS_Output::get_mu('m_st_spacetop_mu', 'px');
            $mobileStyles .= CSS_Output::generate_css('.mobile-title', 'top', 'm_st_spacetop', 12, '', $m_st_spacetop_mu);
            $m_st_spaceleft_mu = CSS_Output::get_mu('m_st_spaceleft_mu', '%');
            $mobileStyles .= CSS_Output::generate_css('.mobile-title', 'left', 'm_st_spaceleft', 5,'', $m_st_spaceleft_mu);
        }else if($m_st_position == "right"){
            $m_st_spacetop_mu = CSS_Output::get_mu('m_st_spacetop_mu', 'px');
            $mobileStyles .= CSS_Output::generate_css('.mobile-title', 'top', 'm_st_spacetop', 12, '', $m_st_spacetop_mu);
            $m_st_spaceright_mu = CSS_Output::get_mu('m_st_spaceright_mu', '%');
            $mobileStyles .= CSS_Output::generate_css('.mobile-title', 'right', 'm_st_spaceright', 5,'', $m_st_spaceright_mu);
        }

        // mobile site title position
        $txt_or_img = get_theme_mod('st_txt_or_img', 'text');
        $m_txt_or_img = get_theme_mod( 'm_st_txt_or_img', $txt_or_img );

        $m_st_position = get_theme_mod('m_st_position', 'center');
        if($m_st_position == "center"){
            $mobileStyles .=
            '.navbar{
                text-align: center;
            }
            .mobile-title{
                text-align:center; padding: 0 44px;
            }
            .mobile-title.text > span{
                margin: 0 auto;
            }';
        }else if($m_st_position == "left"){
            $mobileStyles .=
            '.navbar{
                text-align: left;
            }
            .mobile-title{
                text-align:left; padding: 0 44px 0 0;
            }';
        }

        // mobile navbar background color with rgba
        $mobile_hide_menubar = get_theme_mod('mobile_hide_menubar');
        if($mobile_hide_menubar == 1){
            $mobileStyles .= '.navbar{display:none;}';
        }else{
            $mobile_menubar_height = get_theme_mod('mobile_menubar_height', 40);
            // burger top position
            $mobileStyles .= '.burger{top:'.(($mobile_menubar_height-20)/2).'px;}';
            // body padding top
            $mobileStyles .= 'body{padding-top:'.$mobile_menubar_height.'px}';
        }

        $mobileStyles .= CSS_Output::generate_css('.navbar', 'height', 'mobile_menubar_height', 40, '', 'px');

        $mobile_menu_bar_background_color = get_theme_mod('mobile_menu_bar_color', $lighterBgColor);
        $rgb = CSS_Output::hex2rgb($mobile_menu_bar_background_color);
        $alpha = (int)get_theme_mod('mobile_menu_bar_opacity', 100);
        $alpha /= 100;
        if($alpha < 0){ $alpha = 0; }
        else if($alpha > 1){ $alpha = 1; }
        $mobileStyles .= '.navbar{background-color:rgba('.$rgb['red'].','.$rgb['green'].','.$rgb['blue'].','.$alpha.')}';

        $mobileStyles .= CSS_Output::generate_css('.navbar', 'border-bottom-color', 'mobile_menu_bar_border_color', $darker);
        $mobileStyles .= CSS_Output::generate_css('.burger span, .burger span:before, .burger span:after', 'background-color', 'mobile_menu_burger_icon_color', $txtColor);

        $mobile_menu_bar_show_border = get_theme_mod('mobile_menu_bar_show_border', "1");
        if($mobile_menu_bar_show_border == "0"){
            $mobileStyles .= '.navbar{border-bottom-width: 0;}';
        }

        if($use_desktop_menu_as_mobile_menu != 1){
            // mobile menu points color
            $mobileStyles .= CSS_Output::generate_css('nav.mobile-nav li a', 'border-bottom-color', 'mobile_menu_points_underline_color', $darker);
            $mobileStyles .= CSS_Output::generate_css('nav.mobile-nav a', 'color', 'mobile_menu_text_color', $txtColor);
    
            // mobile menu background color with rgba
            $mobile_menu_background_color = get_theme_mod('mobile_menu_background_color', $lighterBgColor);
            $rgb = CSS_Output::hex2rgb($mobile_menu_background_color);
            $alpha = (int)get_theme_mod('mobile_menu_background_opacity', 100);
            $alpha /= 100;
            if($alpha < 0){ $alpha = 0; }
            else if($alpha > 1){ $alpha = 1; }
            $mobileStyles .= 'nav.mobile-nav li>a{background-color:rgba('.$rgb['red'].','.$rgb['green'].','.$rgb['blue'].','.$alpha.')}';

            // mobile background color of current-menu-item with rgba
            $mobile_menu_current_menu_item_background_color = get_theme_mod('mobile_menu_current_menu_item_background_color', $darker);
            $rgb = CSS_Output::hex2rgb($mobile_menu_current_menu_item_background_color);
            $mobileStyles .= 'nav.mobile-nav li.current-menu-item>a{background-color:rgba('.$rgb['red'].','.$rgb['green'].','.$rgb['blue'].','.$alpha.')}';
        }
        // mobile menu fontsizes
        $mobileStyles .= CSS_Output::generate_css('nav.mobile-nav li a', 'font-size', 'mobile_menu_fontsize', Customizer::$defaults['mobile_menu_fontsize'], '', 'px');

        $breakpoint = get_option('lay_breakpoint', 600);
        $breakpoint = (int)$breakpoint;

		$tablet_breakpoint = get_option( 'misc_options_textformats_tablet_breakpoint', 1024 );
		$tablet_breakpoint = (int)$tablet_breakpoint;

        return
        '<!-- customizer css -->
        <style>
            '.$sharedStyles.'
            @media (min-width: '.($breakpoint+1).'px){'
                .$desktopAndTabletStyles.
            '}
            @media (max-width: '.($breakpoint).'px){'
                .$mobileStyles.
            '}
        </style>';
    }

    public static function get_mu( $theme_mod_name, $defaultmu ){
        // example: it's a fresh Lay Theme install. "px" is the default. but when a user never actually selects "px" and saves the customizer, a value of "" is saved
        $mu = get_theme_mod($theme_mod_name, $defaultmu);
        if($mu == ""){
            $mu = $defaultmu;
        }
        return $mu;
    }

    public static function navbar_get_hide_when_scrolling_down(){
		// get_theme_mod('nav_hidewhenscrolling', "") is default for backwards compatibility
		$navbar_hidewhenscrolling_default = get_theme_mod('nav_hidewhenscrolling', "");
		return get_theme_mod('navbar_hidewhenscrolling', $navbar_hidewhenscrolling_default);
	}

    public static function st_get_hide_when_scrolling_down(){
        $mod = get_theme_mod('st_hidewhenscrolling', "");

        if($mod == 1){
            $stisFixed = get_theme_mod('st_isfixed', '1');

            if($stisFixed == 1){
                return 1;
            }
        }

        return "";
    }

    public static function nav_get_hide_when_scrolling_down($identifier){

        $suffix = LayMenuManager::get_suffix_based_on_identifier($identifier);
        $mod = get_theme_mod('nav_hidewhenscrolling'.$suffix, "");

        if($mod == 1){
            $navisFixed = get_theme_mod('nav_isfixed'.$suffix, '1');

            if($navisFixed == 1){
                return 1;
            }
        }

        return "";
    }

    public static function generate_fi_mouseover_blur(){
        $return = "";
        $mod = get_theme_mod('fi_mo_do_blur', '');
        if($mod == '1'){
            $return =
            '.no-touchdevice .thumb:hover .ph, .touchdevice .thumb.hover .ph{
                -webkit-filter: blur(2px);
                -moz-filter: blur(2px);
                -ms-filter: blur(2px);
                -o-filter: blur(2px);
                filter: blur(2px);
            }';
            return $return;
        }
    }

    public static function generate_fi_mouseover_animate_blur(){
        $return = "";
        $mod = get_theme_mod('fi_animate_blur', '1');
        if($mod == '1'){
            $return =
            '.thumb .ph{
                transition: -webkit-filter 400ms ease-out;
            }';
            return $return;
        }
    }

    public static function generate_fi_mouseover_animate_bgcolor_css(){
        $return = "";
        $mod = get_theme_mod('fi_animate_color', '1');
        if($mod == '1'){
            $return =
            '.thumb .ph span{
                -webkit-transition: all 400ms ease-out;
                -moz-transition: all 400ms ease-out;
                transition: all 400ms ease-out;
            }';
            return $return;
        }
    }

    public static function generate_fi_mouseover_animate_brightness_css(){
        $return = "";
        $mod = get_theme_mod('fi_mo_animate_brightness', '1');
        if($mod == '1'){
            $return =
            '.thumb .ph{
                -webkit-transition: all 400ms ease-out;
                -moz-transition: all 400ms ease-out;
                transition: all 400ms ease-out;
            }';
            return $return;
        }
    }

    public static function generate_mouseover_animate_visibility_css( $selector, $mod_name ){
        $return = "";
        $mod = get_theme_mod($mod_name, '1');
        if($mod == '1'){
            $return =
            $selector.'{
                -webkit-transition: all 400ms ease-out;
                -moz-transition: all 400ms ease-out;
                transition: all 400ms ease-out;
            }';
            return $return;
        }
    }

    public static function generate_fi_mouseover_zoom_css(){
        $return = '';
        $mod = get_theme_mod('fi_mo_do_zoom', 'none');
        // case '1': zoom in
        switch ($mod) {
            case '1':
                $return =
                '.no-touchdevice .thumb:hover img, .touchdevice .thumb.hover img,
                .no-touchdevice .thumb:hover video, .touchdevice .thumb.hover video{
                    -webkit-transform: translateZ(0) scale(1.05);
                    -moz-transform: translateZ(0) scale(1.05);
                    -ms-transform: translateZ(0) scale(1.05);
                    -o-transform: translateZ(0) scale(1.05);
                    transform: translateZ(0) scale(1.05);
                }';
            break;
            case 'zoom-out':
                // zoom out image and background color
                $return =
                '.no-touchdevice .thumb:hover img, .touchdevice .thumb.hover img,
                .no-touchdevice .thumb:hover video, .touchdevice .thumb.hover video{
                    -webkit-transform: translateZ(0) scale(0.97);
                    -moz-transform: translateZ(0) scale(0.97);
                    -ms-transform: translateZ(0) scale(0.97);
                    -o-transform: translateZ(0) scale(0.97);
                    transform: translateZ(0) scale(0.97);
                }
                .no-touchdevice .thumb:hover .ph span, .touchdevice .thumb.hover .ph span{
                    -webkit-transform: translateZ(0) scale(0.97);
                    -moz-transform: translateZ(0) scale(0.97);
                    -ms-transform: translateZ(0) scale(0.97);
                    -o-transform: translateZ(0) scale(0.97);
                    transform: translateZ(0) scale(0.97);
                }';
            break;
        }
        return $return;
    }

    public static function nav_generate_menupoints_spacebetween_css( $selector, $mod_name, $default, $prefix='', $postfix='', $arrangement_mod_name ) {
        $return = '';
        $mod = get_theme_mod($mod_name, $default);
        $arrangement = get_theme_mod($arrangement_mod_name, 'horizontal');
        if($arrangement == "horizontal"){
            $style = "margin-right";
        }
        else if($arrangement == "vertical"){
            $style = "margin-bottom";
        }
        if ( ! empty( $mod ) ) {
                $return = sprintf('%s { %s:%s; }',
                $selector,
                $style,
                $prefix.$mod.$postfix
            );
        }
        return $return;
    }

    public static function nav_generate_menupoints_arrangement($selector, $mod_name){
        $return = $selector;
        $arrangement = get_theme_mod($mod_name, 'horizontal');
        if($arrangement == 'vertical'){
            $return .= '{display: block;}';
        }
        else if($arrangement == 'horizontal'){
            $return .= '{display: inline-block;}';
        }
        return $return;
    }

    public static function get_navbar_position(){
        $nav_position = get_theme_mod('nav_position', 'top-right');
        if (strpos($nav_position,'bottom') !== false){
            return 'bottom';
        }
        else if (strpos($nav_position,'top') !== false){
            return 'top';
        }       
    }

    public static function generate_navbar_position(){
        $nav_position = get_theme_mod('nav_position', 'top-right');
        if (strpos($nav_position,'bottom') !== false){
            return '.navbar{ bottom:0; top: auto; }';
        }
        else if (strpos($nav_position,'top') !== false){
            return '.navbar{ top:0; bottom: auto; }';
        }
    }

    public static function generate_navbar_border_color_css(){
        $nav_position = get_theme_mod('nav_position', 'top-right');
        $navbar_show_border = get_theme_mod('navbar_show_border', '');

        if($navbar_show_border == "1"){
            if (strpos($nav_position,'bottom') !== false){
                return '.navbar{ border-top-style: solid; border-top-width: 1px; }';
            }
            else if (strpos($nav_position,'top') !== false){
                return '.navbar{ border-bottom-style: solid; border-bottom-width: 1px; }';
            }
        }
    }

    public static function generate_featured_image_brightness_css($selector, $mod_name, $default){
        $return = $selector;
        $mod = (int)get_theme_mod($mod_name, $default);
        $mod /= 100;

        if($mod < 0){ $mod = 0; }
        else if($mod > 2){ $mod = 2; }
        $return .= '{filter: brightness('.$mod.'); -webkit-filter: brightness('.$mod.');}';

        return $return;
    }

    public static function generate_featured_image_opacity_css($selector, $mod_name, $default){
        $return = $selector;
        $mod = (int)get_theme_mod($mod_name, $default);
        $mod /= 100;

        if($mod < 0){ $mod = 0; }
        else if($mod > 1){ $mod = 1; }
        $return .= '{opacity: '.$mod.';}';

        return $return;
    }

    public static function generate_brightness_css($selector, $mod_name, $default){
        $return = $selector;
        $mod = (int)get_theme_mod($mod_name, $default);
        $mod /= 100;

        if($mod < 0){ $mod = 0; }

        $return .= '{filter: brightness('.$mod.'); -webkit-filter: brightness('.$mod.');}';

        return $return;
    }

    public static function generate_opacity_css($selector, $mod_name, $default){
        $return = $selector;
        $mod = (int)get_theme_mod($mod_name, $default);
        $mod /= 100;

        if($mod < 0){ $mod = 0; }
        else if($mod > 1){ $mod = 1; }

        $return .= '{opacity: '.$mod.';}';

        return $return;
    }

    public static function generate_opacity_css_from_option($selector, $option_name, $default){
        $return = $selector;
        $val = (int)get_option($option_name, $default);
        $val /= 100;

        if($val < 0){ $val = 0; }
        else if($val > 1){ $val = 1; }

        $return .= '{opacity: '.$val.';}';

        return $return;
    }

    public static function generate_hide_mobile_menu(){
        $mod = get_theme_mod('mobile_hide_menu', 0);
        if($mod == '1'){
            return
            '.navbar{
                background-color: transparent!important;
                border-bottom: none!important;
                height: 0!important;
                min-height: 0!important;
            }
            .mobile-title.text{
                min-height: 0!important;
            }
            .burger{
                display: none;
            }
            body{
                padding-top: 0!important;
            }
            nav.mobile-nav{
                display: none;
            }';
        }
    }

    public static function generate_hide_css($selector, $mod_name){
        $return = $selector;
        $mod = get_theme_mod($mod_name, 0);

        if($mod == '1'){
            $return .= '{display: none;}';
        }
        else{
            $return .= '{display: block;}';
        }
        return $return;
    }

    public static function pt_generate_position_css($selector){
        $return = $selector;
        $mod = get_theme_mod('pt_position', 'below-image');

        switch($mod){
            case 'on-image-top-left':
                $return .= '{
                    top: '.get_theme_mod('pt_onimage_spacetop', 10).'px;
                    left: '.get_theme_mod('pt_onimage_spaceleft', 10).'px;
                }';
            break;
            case 'on-image-top-right':
                $return .= '{
                    top: '.get_theme_mod('pt_onimage_spacetop', 10).'px;
                    right: '.get_theme_mod('pt_onimage_spaceright', 10).'px;
                }';
            break;
            // (center)
            case 'on-image':
                $return .= '{
                    top: 50%;
                    left: 50%;
                    -webkit-transform: translate(-50%,-50%);
                    -moz-transform: translate(-50%,-50%);
                    -ms-transform: translate(-50%,-50%);
                    -o-transform: translate(-50%,-50%);
                    transform: translate(-50%,-50%);
                }';
            break;
            case 'on-image-bottom-left':
                $return .= '{
                    bottom: '.get_theme_mod('pt_onimage_spacebottom', 10).'px;
                    left: '.get_theme_mod('pt_onimage_spaceleft', 10).'px;
                }';
            break;
            case 'on-image-bottom-right':
                $return .= '{
                    bottom: '.get_theme_mod('pt_onimage_spacebottom', 10).'px;
                    right: '.get_theme_mod('pt_onimage_spaceright', 10).'px;
                }';
            break;
            case 'below-image':
                $return .= '{}';
            break;
            case 'above-image':
                $return .= '{}';
            break;
        }

        return $return;
    }

    public static function generate_visibility_css($selector, $mod_name){
        $return = $selector;
        $mod = get_theme_mod($mod_name, 'always-show');

        if($mod == 'show-on-mouseover'){
            $return .= '{opacity: 0;}';
            return $return;
        }
        else if($mod == 'hide'){
            $return .= '{display:none!important;}';
            return $return;
        }

    }

    public static function generate_is_fixed_css($selector, $mod_name){
        $return = $selector;
        $mod = get_theme_mod($mod_name, '1');

        if($mod == '1'){
            $return .= '{position: fixed;}';
        }
        else{
            $return .= '{position: absolute;}';
        }
        return $return;

    }

    public static function generate_position_css($selector, $mod_name, $default){
        $return = $selector;
        $mod = get_theme_mod($mod_name, $default);
        if ( ! empty( $mod ) ) {
            switch($mod){
                case 'top-left':
                    $return .= '{bottom: auto; right: auto;}';
                break;
                case 'top-center':
                    $return .=
                    '{bottom: auto; right: auto; left: 50%;
                    -webkit-transform: translateX(-50%);
                    -moz-transform: translateX(-50%);
                    -ms-transform: translateX(-50%);
                    -o-transform: translateX(-50%);
                    transform: translateX(-50%);}';
                break;
                case 'top-right':
                    $return .= '{bottom: auto; left: auto;}';
                break;
                case 'center-left':
                    $return .=
                    '{bottom: auto; right: auto; top:50%;
                    -webkit-transform: translate(0, -50%);
                    -moz-transform: translate(0, -50%);
                    -ms-transform: translate(0, -50%);
                    -o-transform: translate(0, -50%);
                    transform: translate(0, -50%);}';
                break;
                case 'center':
                    $return .=
                    '{bottom: auto; right: auto; left: 50%; top:50%;
                    -webkit-transform: translate(-50%, -50%);
                    -moz-transform: translate(-50%, -50%);
                    -ms-transform: translate(-50%, -50%);
                    -o-transform: translate(-50%, -50%);
                    transform: translate(-50%, -50%);}';
                break;
                case 'center-right':
                    $return .=
                    '{bottom: auto; left: auto; top:50%;
                    -webkit-transform: translate(auto, -50%);
                    -moz-transform: translate(auto, -50%);
                    -ms-transform: translate(auto, -50%);
                    -o-transform: translate(auto, -50%);
                    transform: translate(auto, -50%);}';
                break;
                case 'bottom-left':
                    $return .= '{top: auto; right: auto;}';
                break;
                case 'bottom-center':
                    $return .=
                    '{top: auto; right: auto; left: 50%;
                    -webkit-transform: translateX(-50%);
                    -moz-transform: translateX(-50%);
                    -ms-transform: translateX(-50%);
                    -o-transform: translateX(-50%);
                    transform: translateX(-50%);}';
                break;
                case 'bottom-right':
                    $return .= '{top: auto; left: auto;}';
                break;
            }
            return $return;
        }
    }

    // http://codex.wordpress.org/Theme_Customization_API#Sample_Theme_Customization_Class
    public static function generate_css( $selector, $style, $mod_name, $default, $prefix='', $postfix='' ) {
        $return = '';
        $mod = get_theme_mod($mod_name, $default);
        if ( isset( $mod ) ) {
            $return = sprintf('%s { %s:%s; }',
            $selector,
            $style,
            $prefix.$mod.$postfix
            );
        }
        return $return;
    }

    public static function get_mobile_menu_txt_color(){
        $txtColor = get_theme_mod('nav_color', false);
        if($txtColor == false){

            $formatsJsonString = get_option( 'formatsmanager_json', json_encode(array(FormatsManager::$defaultFormat)) );
            $formatsJsonArr = json_decode($formatsJsonString, true);

            for($i = 0; $i<count($formatsJsonArr); $i++) {
                if($formatsJsonArr[$i]["formatname"] == "Default"){
                    $txtColor = $formatsJsonArr[$i]["color"];
                }
            }
        }
        return $txtColor;
    }

    public static function get_mobile_menu_light_color(){
        $bgColor = CSS_Output::get_mobile_basecolor();
        $lighterBgColor = CSS_Output::tintColor($bgColor, 7);
        return $lighterBgColor;
    }

    public static function get_mobile_menu_dark_color(){
        $bgColor = CSS_Output::get_mobile_basecolor();
        $darker = CSS_Output::tintColor($bgColor, -7);
        return $darker;
    }

    public static function get_mobile_basecolor(){
        $navBarHidden = get_theme_mod('navbar_hide', 0);
        $bgColor = '';
        if(!$navBarHidden){
            $bgColor = get_theme_mod('navbar_color', '#ffffff');
            $navbar_opacity = get_theme_mod('navbar_opacity', '90');
            $offset = 100 - (int)$navbar_opacity;
            $bgColor = CSS_Output::tintColor($bgColor, $offset);
        }
        else{
            $bgColor = get_theme_mod('bg_color', '#ffffff');
        }
        return $bgColor;
    }

    // http://www.kirupa.com/forum/showthread.php?366845-Make-hex-colours-lighter-with-PHP-(using-existing-code)
    public static function tintColor($color, $per){
        $color = substr( $color, 1 ); // Removes first character of hex string (#)
        if(strlen($color) == 3){
            $color = $color[0] . $color[0] . $color[1] . $color[1] . $color[2] . $color[2];
        }
        $rgb = ''; // Empty variable
        $per = $per/100*255; // Creates a percentage to work with. Change the middle figure to control color temperature

        if  ($per < 0 ){
            // DARKER
            $per =  abs($per); // Turns Neg Number to Pos Number
            for ($x=0;$x<3;$x++){
                $c = hexdec(substr($color,(2*$x),2)) - $per;
                $c = ($c < 0) ? 0 : dechex($c);
                $rgb .= (strlen($c) < 2) ? '0'.$c : $c;
            }
        }
        else{
            // LIGHTER
            for ($x=0;$x<3;$x++){
                $c = hexdec(substr($color,(2*$x),2)) + $per;
                $c = ($c > 255) ? 'ff' : dechex($c);
                $rgb .= (strlen($c) < 2) ? '0'.$c : $c;
            }
        }
        return '#'.$rgb;
    }

    public static function hex2rgb( $color ) {
            if ( $color[0] == '#' ) {
                    $color = substr( $color, 1 );
            }
            if ( strlen( $color ) == 6 ) {
                    list( $r, $g, $b ) = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
            } elseif ( strlen( $color ) == 3 ) {
                    list( $r, $g, $b ) = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
            } else {
                    return false;
            }
            $r = hexdec( $r );
            $g = hexdec( $g );
            $b = hexdec( $b );
            return array( 'red' => $r, 'green' => $g, 'blue' => $b );
    }

    public static function echo_lay_customize_css(){
        echo CSS_Output::lay_customize_css();
    }

}
new CSS_Output();