<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<?php
	$title = get_bloginfo('name');
	if(!is_front_page()){ 
		$title .= ' &mdash; '.trim(wp_title('',false));
	}
?>

<title><?php echo $title; ?></title>

<?php wp_head(); 

Frontend::get_meta();
Frontend::get_custom_head_content_and_css();
Frontend::get_max_width_option_css();

$theme = wp_get_theme();
echo '<!-- Thank you for using Lay Theme '.$theme->get( 'Version' ).' by Armin Unruh -->';

?>
</head>

<body <?php Frontend::get_body_data() ?>>
<?php


Frontend::get_header();
Frontend::get_project_arrows();