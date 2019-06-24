<?php
get_header();
?>
<div id="laytheme"></div>
<?php
Frontend::get_noscript_content();
LayShortcodes::get_shortcode_contents();
get_footer(); 
?>