<?php
class AddProjectModal{

	public function __construct(){

	}

	public static function get_add_thumbnail_modal(){
	    $screen = get_current_screen();
	    $query;
	    $postIDs = array();
	    if($screen->id == 'edit-category'){
	        $query = new WP_Query( array( 'posts_per_page' => '-1' ) );
	    }
	    else{
	        global $post;
	        $currentId = $post->ID;
	        $query = new WP_Query( array( 'posts_per_page' => '-1', 'post__not_in' => array( $currentId ) ) );
	    }

	    if ( $query->have_posts() ) {
	        foreach ($query->posts as $post){
	            if($post->post_status == "publish"){
	                $postIDs []= $post->ID;
	            }
	        }
	    }

	    $postIDsRows = array_chunk($postIDs, 6);
	    $result =
	    '<div id="add-project-modal" class="lay-input-modal">
	        <div class="panel panel-default">
	            <div class="panel-heading">
	                <h3 class="panel-title js-text-modal-title">Add Project Thumbnails</h3>
	                <button type="button" class="close close-modal-btn"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	            </div>
	            <div class="panel-body">
	                <div class="container-fluid">';

	                foreach ($postIDsRows as $key => $row){
	                    foreach ($row as $key => $postId){
	                        $fiID = get_post_thumbnail_id( $postId );
	                        $fullsize = wp_get_attachment_image_src( $fiID, 'full' );

	                        if($fullsize){

	                            $_265 = "";
	                            $sizesStr = "";
	                            for ($i=0; $i < count(Setup::$sizes); $i++) {
	                                $attachment = wp_get_attachment_image_src($fiID, Setup::$sizes[$i]);
	                                if(Setup::$sizes[$i] == "_265"){
	                                    $_265 = $attachment;
	                                }
	                                $size = Setup::$sizes[$i];
	                                $sizesStr .= 'data-'.substr($size, 1).'="'.$attachment[0].'" ';
	                            }
	                            $sizesStr .= 'data-full="'.$fullsize[0].'" ';

	                            $ar = $fullsize[2] / $fullsize[1];
	                            $format = $fullsize[1] > $fullsize[2] ? 'landscape' : 'portrait';
	                            $link = get_permalink($postId);
	                            $title = get_the_title($postId);

	                            $projectDescr = get_post_meta( $postId, 'lay_project_description', true );
	                            $projectDescr = htmlentities($projectDescr);

	                            $cats = get_the_category($postId);

	                            // mouseover thumbnail
	                            $mo_thumb_sizes_str = "";
	                            $mo_thumb_sizes_markup = "";
	                            $mo_thumb_id = get_post_meta( $postId, '_lay_thumbnail_mouseover_image', true );
	                            if( $mo_thumb_id && get_post( $mo_thumb_id ) ){
	                                for ($i=0; $i < count(Setup::$sizes); $i++) {
	                                    $attachment = wp_get_attachment_image_src($mo_thumb_id, Setup::$sizes[$i]);
	                                    $size = Setup::$sizes[$i];
	                                    $mo_thumb_sizes_str .= 'data-'.substr($size, 1).'="'.$attachment[0].'" ';
	                                }
	                                $attachment = wp_get_attachment_image_src($mo_thumb_id, 'full');
	                                $mo_thumb_sizes_str .= 'data-full="'.$attachment[0].'" ';
	                                $mo_thumb_sizes_markup = '<input type="hidden" class="mo_thumbnail_sizes" data-w="'.$attachment[1].'" data-h="'.$attachment[2].'" '.$mo_thumb_sizes_str.'/>';
	                            }
	                            // #mouseover thumbnail

	                            // video thumbnail
	                            $video_id = get_post_meta( $postId, '_lay_thumbnail_video', true );
	                            $videoMarkup = "";
	                            if( $video_id && get_post( $video_id ) ){
	                            	$videoUrl = wp_get_attachment_url($video_id);
	                            	$video_meta = wp_get_attachment_metadata($video_id);
	                            	$videoMarkup = '<input type="hidden" class="thumbnail_video_url" data-w="'.$video_meta['width'].'" data-h="'.$video_meta['height'].'" data-url="'.$videoUrl.'"/>';
	                            }
	                            // #video thumbnail

	                            $result .= 
	                            '<div class="col-sm-2 col-md-2">
	                                <div class="thumbnail" data-descr="'.$projectDescr.'" data-title="'.$title.'" data-postid="'.$postId.'" data-link="'.$link.'" data-attid="'.$fiID.'" data-ar="'.$ar.'" '.$sizesStr.'>
	                                    '.$mo_thumb_sizes_markup.'
	                                    '.$videoMarkup.'
	                                    <div class="center '.$format.'"><img src="'.$_265[0].'"></div>
	                                </div>
	                                <div class="caption">
	                                    Title: '.get_the_title($postId).'<br>
	                                    Category: '.$cats[0]->name.'
	                                </div>
	                            </div>';
	                        }
	                    }
	                }

	    $result .=
	                '</div>
	            </div>
	            <div class="panel-footer clearfix">
	                <button type="button" disabled="disabled" class="btn btn-default btn-lg add-project-btn">Ok</button>
	            </div>
	        </div>
	        <div class="background"></div>
	    </div>';

	    return $result;
	}

}

new AddProjectModal();