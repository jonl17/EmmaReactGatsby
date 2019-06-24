<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(). '/style.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo bloginfo( 'stylesheet_directory' ); ?>/font-face/fonts.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo bloginfo( 'stylesheet_directory' ); ?>/css/scaling.css" />
  <?php wp_head(); ?>
  <title>Emma Heiðarsdóttir</title>
</head>
<body>      
<header>
        <p id="name"><a href="works">Emma Heiðarsdóttir</a></p>
        <br>
    <nav>
        <?php wp_nav_menu(); ?>
    </nav>
</header>
    