<?php

function is_mobile_menu_hidden(){
    return get_theme_mod('mobile_hide_menu') == 1 ? false : true;
}

$txtColor = Customizer::$defaults['mobile_menu_txt_color'];
$lighterBgColor = Customizer::$defaults['mobile_menu_light_color'];
$darker = Customizer::$defaults['mobile_menu_dark_color'];

$section = 'mobile_menu';

$wp_customize->add_section( $section,
   array(
      'title' => 'Mobile Menu',
      'priority' => 0,
      'capability' => 'edit_theme_options',
      'panel' => 'mobile_panel',
   )
);

$wp_customize->add_setting( 'mobile_hide_menu',
   array(
      'default' => false,
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
   )
);
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'mobile_hide_menu',
        array(
            'label'          => 'hide',
            'section'        => $section,
            'settings'       => 'mobile_hide_menu',
            'type'           => 'checkbox',
            'priority'       => 5,
        )
    )
);

$wp_customize->add_setting( 'mobile_menu_isfixed',
   array(
      'default' => true,
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
   )
);
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'mobile_menu_isfixed',
        array(
            'label'          => 'is fixed',
            'section'        => $section,
            'settings'       => 'mobile_menu_isfixed',
            'type'           => 'checkbox',
            'priority'       => 7,
            'active_callback' => 'is_mobile_menu_hidden',
        )
    )
);

// this setting now doesn't show the desktop menu "primary menu" but it shows the "mobile-nav" in a desktop menu style
$wp_customize->add_setting( 'use_desktop_menu_as_mobile_menu',
   array(
      'default' => false,
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
   )
);
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'use_desktop_menu_as_mobile_menu',
        array(
            'label'          => 'Use desktop menu style',
            'section'        => $section,
            'settings'       => 'use_desktop_menu_as_mobile_menu',
            'type'           => 'checkbox',
            'priority'       => 10,
            'active_callback' => 'is_mobile_menu_hidden',
        )
    )
);

$wp_customize->add_setting( 'mobile_menu_arrangement',
    array(
    'default' => 'horizontal',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    )
);
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'mobile_menu_arrangement',
        array(
            'label'          => 'Menu Points Arrangement',
            'section'        => $section,
            'settings'       => 'mobile_menu_arrangement',
            'type'           => 'select',
            'priority'       => 10,
            'choices'        => array('horizontal' => 'horizontal', 'vertical' => 'vertical'),
            'active_callback' => 'is_mobile_menu_hidden'
        )
    )
);

$wp_customize->add_setting( 'mobile_menu_textformat',
    array(
    'default' => 'Default',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'transport' => 'refresh',
    )
);
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'mobile_menu_textformat',
        array(
            'label'          => 'Text Format',
            'section'        => $section,
            'settings'       => 'mobile_menu_textformat',
            'type'           => 'select',
            'priority'       => 11,
            'choices'        => Customizer::$textformatsSelect,
            'active_callback' => 'is_mobile_menu_hidden'
        )
    )
);

$wp_customize->add_setting( 'mobile_menu_position',
   array(
      'default' => 'right',
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
   )
);
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'mobile_menu_position',
        array(
            'label'          => 'Position',
            'section'        => $section,
            'settings'       => 'mobile_menu_position',
            'type'           => 'select',
            'priority'       => 20,
            'choices'        => array('left' => 'left', 'center' => 'center', 'right' => 'right')
        )
    )
);

// space top
$wp_customize->add_setting( 'mobile_menu_spacetop_mu',
   array(
      'default' => 'px',
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
   )
);
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'mobile_menu_spacetop_mu',
        array(
            'label'          => 'Space Top in',
            'section'        => $section,
            'settings'       => 'mobile_menu_spacetop_mu',
            'type'           => 'select',
            'priority'       => 21,
            'choices'        => array('px' => 'px', 'vw' => '%')
        )
    )
);
$wp_customize->add_setting( 'mobile_menu_spacetop',
   array(
      'default' => '12',
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
   )
);
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'mobile_menu_spacetop',
        array(
            'label'          => 'Space Top',
            'section'        => $section,
            'settings'       => 'mobile_menu_spacetop',
            'type'           => 'number',
            'input_attrs'    => array('step' => '0.1'),
            'priority'       => 22
        )
    )
);

// space left
$wp_customize->add_setting( 'mobile_menu_spaceleft_mu',
   array(
      'default' => '%',
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
   )
);
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'mobile_menu_spaceleft_mu',
        array(
            'label'          => 'Space Left in',
            'section'        => $section,
            'settings'       => 'mobile_menu_spaceleft_mu',
            'type'           => 'select',
            'priority'       => 23,
            'choices'        => array('%' => '%', 'px' => 'px')
        )
    )
);
$wp_customize->add_setting( 'mobile_menu_spaceleft',
   array(
      'default' => '5',
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
   )
);
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'mobile_menu_spaceleft',
        array(
            'label'          => 'Space Left',
            'section'        => $section,
            'settings'       => 'mobile_menu_spaceleft',
            'type'           => 'number',
            'input_attrs'    => array('step' => '0.1'),
            'priority'       => 24
        )
    )
);

// spaceright
$wp_customize->add_setting( 'mobile_menu_spaceright_mu',
   array(
      'default' => '%',
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
   )
);
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'mobile_menu_spaceright_mu',
        array(
            'label'          => 'Space Right in',
            'section'        => $section,
            'settings'       => 'mobile_menu_spaceright_mu',
            'type'           => 'select',
            'priority'       => 25,
            'choices'        => array('%' => '%', 'px' => 'px')
        )
    )
);
$wp_customize->add_setting( 'mobile_menu_spaceright',
   array(
      'default' => '5',
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
   )
);
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'mobile_menu_spaceright',
        array(
            'label'          => 'Space Right',
            'section'        => $section,
            'settings'       => 'mobile_menu_spaceright',
            'type'           => 'number',
            'input_attrs'    => array('step' => '0.1'),
            'priority'       => 26
        )
    )
);

$wp_customize->add_setting( 'mobile_menu_spacebetween',
   array(
      'default' => '5',
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
   )
);
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'mobile_menu_spacebetween',
        array(
            'label'          => 'Space Between (px)',
            'section'        => $section,
            'settings'       => 'mobile_menu_spacebetween',
            'type'           => 'number',
            'priority'       => 35
        )
    )
);

//
$wp_customize->add_setting( 'mobile_menu_fontsize',
   array(
      'default' => Customizer::$defaults['mobile_menu_fontsize'],
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
   )
);
// http://codex.wordpress.org/Class_Reference/WP_Customize_Control
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'mobile_menu_fontsize',
        array(
            'label'          => 'Font Size Menu Points',
            'section'        => $section,
            'settings'       => 'mobile_menu_fontsize',
            'type'           => 'number',
            'input_attrs'    => array('step' => '1'),
            'priority'       => 15,
            'active_callback' => 'is_mobile_menu_hidden',
        )
    )
);

$wp_customize->add_setting( 'mobile_menu_burger_icon_color',
   array(
      'default' => $txtColor,
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
   )
);
$wp_customize->add_control( new WP_Customize_Color_Control(
   $wp_customize,
   'mobile_menu_burger_icon_color',
   array(
      'label' => 'Burger Icon Color',
      'section' => $section,
      'settings' => 'mobile_menu_burger_icon_color',
      'priority'   => 50,
      'active_callback' => 'is_mobile_menu_hidden',
   )
) );

$wp_customize->add_setting( 'mobile_menu_background_opacity',
   array(
      'default' => '100',
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
   )
);
$wp_customize->add_control( new WP_Customize_Control(
   $wp_customize,
   'mobile_menu_background_opacity',
   array(
      'label' => 'Menu Points Background Opacity (%)',
      'section' => $section,
      'settings' => 'mobile_menu_background_opacity',
      'type' => 'number',
      'input_attrs' => array('min' => '0', 'max' => '100'),
      'priority' => 55,
      'active_callback' => 'is_mobile_menu_hidden',
   )
) );

$wp_customize->add_setting( 'mobile_menu_background_color',
   array(
      'default' => $lighterBgColor,
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
   )
);
$wp_customize->add_control( new WP_Customize_Color_Control(
   $wp_customize,
   'mobile_menu_background_color',
   array(
      'label' => 'Menu Points Background Color',
      'section' => $section,
      'settings' => 'mobile_menu_background_color',
      'priority'   => 60,
      'active_callback' => 'is_mobile_menu_hidden',
   )
) );

$wp_customize->add_setting( 'mobile_menu_text_color',
   array(
      'default' => $txtColor,
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
   )
);
$wp_customize->add_control( new WP_Customize_Color_Control(
   $wp_customize,
   'mobile_menu_text_color',
   array(
      'label' => 'Menu Points Text Color',
      'section' => $section,
      'settings' => 'mobile_menu_text_color',
      'priority'   => 65,
      'active_callback' => 'is_mobile_menu_hidden',
   )
) );

$wp_customize->add_setting( 'mobile_menu_points_underline_color',
   array(
      'default' => $darker,
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
   )
);
$wp_customize->add_control( new WP_Customize_Color_Control(
   $wp_customize,
   'mobile_menu_points_underline_color',
   array(
      'label' => 'Menu Points Lines Color',
      'section' => $section,
      'settings' => 'mobile_menu_points_underline_color',
      'priority'   => 70,
      'active_callback' => 'is_mobile_menu_hidden',
   )
) );

$wp_customize->add_setting( 'mobile_menu_current_menu_item_background_color',
   array(
      'default' => $darker,
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
   )
);
$wp_customize->add_control( new WP_Customize_Color_Control(
   $wp_customize,
   'mobile_menu_current_menu_item_background_color',
   array(
      'label' => 'Active Menu Point Background Color',
      'section' => $section,
      'settings' => 'mobile_menu_current_menu_item_background_color',
      'priority'   => 80,
      'active_callback' => 'is_mobile_menu_hidden',
   )
) );
