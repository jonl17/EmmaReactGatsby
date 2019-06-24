<footer>
        <p id="copyright">&copy; 2019 Emma Heiðarsdóttir</p>
	<?php wp_footer(); ?>        
</footer>
   <?php wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer ); ?>
	<script src="<?php echo get_stylesheet_directory_uri(). '/js/script.js' ?>"></script>
</body>
</html>