<?php

$section = 'mobile_spaces';
$descr = "";
if(get_option('misc_options_extra_gridder_for_phone', '') == "on"){
  $descr = 'These settings are only for automatically generated phone versions of your layouts. To change these spaces for your custom phone layouts go to "Lay Options" &rarr; "Gridder Defaults" &rarr; "Phone Gridder Defaults".';
}

$wp_customize->add_section( $section,
   array(
      'title' => 'Mobile Spaces',
      'priority' => 20,
      'capability' => 'edit_theme_options',
      'panel' => 'mobile_panel',
      'description'    => $descr
   )
);

$wp_customize->add_setting( 'mobile_space_between_elements',
   array(
      'default' => 5,
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
   )
);
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'mobile_space_between_elements',
        array(
            'label'          => 'Space between Elements (%)',
            'section'        => $section,
            'settings'       => 'mobile_space_between_elements',
            'type'           => 'number',
            'priority'       => 20
        )
    )
);

$wp_customize->add_setting( 'mobile_space_leftright',
   array(
      'default' => 5,
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
   )
);
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'mobile_space_leftright',
        array(
            'label'          => 'Space left and right of Content (%)',
            'section'        => $section,
            'settings'       => 'mobile_space_leftright',
            'type'           => 'number',
            'priority'       => 30
        )
    )
);

$wp_customize->add_setting( 'mobile_space_top',
   array(
      'default' => 5,
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
   )
);
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'mobile_space_top',
        array(
            'label'          => 'Space above Content (%)',
            'section'        => $section,
            'settings'       => 'mobile_space_top',
            'type'           => 'number',
            'priority'       => 40
        )
    )
);

$wp_customize->add_setting( 'mobile_space_bottom',
   array(
      'default' => 5,
      'type' => 'theme_mod',
      'capability' => 'edit_theme_options',
      'transport' => 'refresh',
   )
);
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'mobile_space_bottom',
        array(
            'label'          => 'Space below Content (%)',
            'section'        => $section,
            'settings'       => 'mobile_space_bottom',
            'type'           => 'number',
            'priority'       => 50
        )
    )
);
