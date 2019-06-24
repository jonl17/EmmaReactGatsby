<?php

/*

TODO: Remove thumbnail json from carousel if post is trashed

*/

// this class updates project thumbnails and thumbnails inside carousels and stack elements when a project is saved
// and it updates thumbnails in stack elements

class LayUpdateThumbnails{

	public static function init() {
		add_filter( 'post_updated', 'LayUpdateThumbnails::update_thumbnail_everywhere', 10, 3 );
		add_filter( 'wp_trash_post', 'LayUpdateThumbnails::remove_thumbnail_from_everywhere', 10, 1 );
	}

	public static function remove_thumbnail_from_everywhere($post_id) {
		// remove for categories
		$categoryIds = get_terms(array('taxonomy' => 'category', 'hide_empty' => false, 'fields' => 'ids'));

		foreach($categoryIds as $categoryId) {
			LayUpdateThumbnails::remove_thumbnail_from_category_json($categoryId."_category_gridder_json", $post_id);
			LayUpdateThumbnails::remove_thumbnail_from_category_json($categoryId."_phone_category_gridder_json", $post_id);
		}

		// remove for posts and pages
		$query = new WP_Query(
			array(
				'post_type' => array('post', 'page'),
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'fields' => 'ids',
			) 
		);
		
		if ( $query->have_posts() ) {
			foreach ($query->posts as $key => $id) {
				LayUpdateThumbnails::remove_thumbnail_from_post_json($id, $post_id, '_gridder_json');
				LayUpdateThumbnails::remove_thumbnail_from_post_json($id, $post_id, '_phone_gridder_json');
			}
		}
	}

	private static function remove_thumbnail_from_post_json($id, $post_id, $metaname) {
		$needsUpdate = false;

		$jsonString = get_post_meta( $id, $metaname, true );
		if ($jsonString != "") {
			$jsonObject = json_decode($jsonString, true);
			$needsUpdate = false;

			LayUpdateThumbnails::remove_thumbnail_from_json_recursive($jsonObject['cont'], $needsUpdate, $post_id);

			if ($needsUpdate) {
				LayUpdateThumbnails::update_push($jsonObject);
				// save json back to db
				// http://stackoverflow.com/a/22208945/3159159
				$jsonString = json_encode($jsonObject);
				if ($jsonString != false && $jsonString != "") {
					$jsonString = wp_slash( $jsonString );
					update_post_meta( $id, $metaname, $jsonString );
				}
			}
		}
	}

	private static function remove_thumbnail_from_category_json($option_name, $post_id) {
		$jsonString = get_option( $option_name, false );

		if ($jsonString) {
			$jsonObject = json_decode($jsonString, true);
			$needsUpdate = false;

			LayUpdateThumbnails::remove_thumbnail_from_json_recursive($jsonObject['cont'], $needsUpdate, $post_id);

			if ($needsUpdate) {
				LayUpdateThumbnails::update_push($jsonObject);

				$jsonString = json_encode($jsonObject);
				if ($jsonString != false && $jsonString != "") {
					update_option( $option_name, $jsonString );
				}
			}
		}
	}

	private static function remove_thumbnail_from_json_recursive(&$array, &$needsUpdate, $post_id) {
		if (is_array($array)) {
			for ($i = 0; $i < count($array); $i++) {
				if (array_key_exists('postid', $array[$i])) {
					if ($array[$i]['postid'] == $post_id) {
						// delete column
						unset($array[$i]);
						// http://stackoverflow.com/questions/369602/delete-an-element-from-an-array/369761#369761
						$array = array_values($array);
						$needsUpdate = true;
					}
				}
				else if ($array[$i]['type'] == 'carousel') {
					LayUpdateThumbnails::remove_thumbnail_from_json_recursive($array[$i]['carousel'], $needsUpdate, $post_id);
				}
				else if ($array[$i]['type'] == 'elementgrid' && isset($array[$i]['config'])) {
					LayUpdateThumbnails::remove_thumbnail_from_json_recursive($array[$i]['config']['elements'], $needsUpdate, $post_id);
				}
				else if ($array[$i]['type'] == 'stack') {
					LayUpdateThumbnails::remove_thumbnail_from_json_recursive($array[$i]['cont'], $needsUpdate, $post_id);
				}
			}
		}
	}

	// push needs to be different for texts in 100vh rows cause they are pos absolute
	private static function update_push($rowix, &$jsonObj) {
		$right = 0;

		for ($i = 0, $rowix = 0; $i < count($jsonObj['cont']); $i++) {
			if ($jsonObj['cont'][$i]['row'] != $rowix) {
				$right = 0;
			}

			$is100vh = LayUpdateThumbnails::row_is_100vh($rowix, $jsonObj);
			$type = $jsonObj['cont'][$i]['type'];

			$left = $jsonObj['cont'][$i]['col'];

			if ($is100vh && $type == 'text') {
				$push = $left;
			} else {
				$push = $left - $right;
				$right = $jsonObj['cont'][$i]['col'] + $jsonObj['cont'][$i]['colspan'];
			}

			$jsonObj['cont'][$i]['push'] = $push;
		}
	}

	private static function row_is_100vh($rowix, $jsonObj) {
		if (array_key_exists($rowix, $jsonObj['rowAttrs'])) {
			if (!is_null($jsonObj['rowAttrs'][$rowix])) {
				if (array_key_exists('row100vh', $jsonObj['rowAttrs'][$rowix]) && $jsonObj['rowAttrs'][$rowix]['row100vh'] == true) {
					return true;
				}
			}
		}
		return false;
	}

	// update a posts json in its category json and page and post json
	// http://wordpress.stackexchange.com/questions/134664/what-is-correct-way-to-hook-when-update-post
	public static function update_thumbnail_everywhere($post_id, $post_after, $post_before) {
		$poststatus = get_post_status($post_id);

		if (has_post_thumbnail($post_id) && $poststatus == 'publish') {
			// check for posttype. cause post_updated also gets triggered when nav_menu_item updates / a navigation menu is saved
			if (get_post_type( $post_id ) == 'post') {

				$featuredImgId = get_post_thumbnail_id($post_id);
				$featuredImgObj = wp_get_attachment_image_src($featuredImgId, 'full');
				$sizesArr = array();

				$permalink = LTUtility::getRelativURL(get_permalink($post_id));
				$title = $_POST['post_title'];
				$title = stripslashes($title);
				$featuredImgUrl = LTUtility::getRelativURL($featuredImgObj[0]);
				$ar = $featuredImgObj[2] / $featuredImgObj[1];

				for ($i = 0; $i < count(Setup::$sizes); $i++) {
					$attachment = wp_get_attachment_image_src($featuredImgId, Setup::$sizes[$i]);
					$sizesArr[Setup::$sizes[$i]] = LTUtility::getRelativURL($attachment[0]);
				}
				$full = wp_get_attachment_image_src($featuredImgId, 'full');
				$sizesArr['full'] = LTUtility::getRelativURL($full[0]);

				$projectDescr = "";
				if ( isset( $_POST['lay_project_description'] ) ) {
					$projectDescr = $_POST['lay_project_description'];
					$projectDescr = wpautop($projectDescr);
					$projectDescr = stripslashes($projectDescr);
				}

				// mouseover thumbnail image
				$mouseOverThumbSizesArr = array();
				$mouseOverThumbWidth = "";
				$mouseOverThumbHeight = "";
				if (ImageMouseoverThumbnails::$active == true) {
					$mouseover_thumbnail_id = "";
					if ( isset( $_POST['_lay_thumbnail_mouseover_image'] ) ) {
						$mouseover_thumbnail_id = $_POST['_lay_thumbnail_mouseover_image'];
					}

					if ($mouseover_thumbnail_id && get_post( $mouseover_thumbnail_id )) {
						for ($i = 0; $i < count(Setup::$sizes); $i++) {
							$attachment = wp_get_attachment_image_src($mouseover_thumbnail_id, Setup::$sizes[$i]);
							$mouseOverThumbSizesArr[Setup::$sizes[$i]] = LTUtility::getRelativURL($attachment[0]);
						}
						$full = wp_get_attachment_image_src($mouseover_thumbnail_id, 'full');
						$mouseOverThumbSizesArr['full'] = LTUtility::getRelativURL($full[0]);
						$mouseOverThumbWidth = $full[1];
						$mouseOverThumbHeight = $full[2];
					}
				}
				// video thumbnail
				$video_url = "";
				$video_meta = array('width'=>'', 'height'=>'');
				if (VideoThumbnails::$active == true) {
					if ( isset( $_POST['_lay_thumbnail_video'] ) && '-1' != $_POST['_lay_thumbnail_video']) {
						$video_id = $_POST['_lay_thumbnail_video'];
						$video_url = LTUtility::getRelativURL(wp_get_attachment_url($video_id));
						$video_meta = wp_get_attachment_metadata($video_id);
					}
				}

				// #attributes to update
				// update category json
				$allCategoryIds = get_terms(array('taxonomy' => 'category', 'hide_empty' => false, 'fields' => 'ids'));

				foreach($allCategoryIds as $categoryId) {
					LayUpdateThumbnails::update_thumbnail_in_category_json( $categoryId."_category_gridder_json", $post_id, $permalink, $title,
						$featuredImgId, $featuredImgUrl, $ar, $sizesArr, $projectDescr, $mouseOverThumbSizesArr, $mouseOverThumbWidth, $mouseOverThumbHeight, $video_url, $video_meta  );
					LayUpdateThumbnails::update_thumbnail_in_category_json( $categoryId."_phone_category_gridder_json", $post_id, $permalink, $title,
						$featuredImgId, $featuredImgUrl, $ar, $sizesArr, $projectDescr, $mouseOverThumbSizesArr, $mouseOverThumbWidth, $mouseOverThumbHeight, $video_url, $video_meta  );
				}

				// update post's and page's json
				$query = new WP_Query( 
					array(
						'post_type' => array('post', 'page'),
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'fields' => 'ids',
					)
				);

				if ( $query->have_posts() ) {
					foreach ($query->posts as $key => $id) {
						LayUpdateThumbnails::update_thumbnail_in_post_json( '_gridder_json', $post_id, $permalink, $title, $featuredImgId, $featuredImgUrl, $ar,
							$sizesArr, $projectDescr, $id, $mouseOverThumbSizesArr, $mouseOverThumbWidth, $mouseOverThumbHeight, $video_url, $video_meta );
						LayUpdateThumbnails::update_thumbnail_in_post_json( '_phone_gridder_json', $post_id, $permalink, $title, $featuredImgId, $featuredImgUrl,
							$ar, $sizesArr, $projectDescr, $id, $mouseOverThumbSizesArr, $mouseOverThumbWidth, $mouseOverThumbHeight, $video_url, $video_meta );
					}
				}
			}
		}
	}

	private static function update_thumbnail_in_post_json($metaname, $post_id, $permalink, $title, $featuredImgId, $featuredImgUrl, $ar, $sizesArr,
			$projectDescr, $id, $mouseOverThumbSizesArr, $mouseOverThumbWidth, $mouseOverThumbHeight, $video_url, $video_meta) {

		$jsonString = get_post_meta( $id, $metaname, true );

		if ($jsonString != "") {
			$jsonObject = json_decode($jsonString, true);
			$needsUpdate = false;

			LayUpdateThumbnails::update_thumbnail_in_json_recursive($jsonObject['cont'], $needsUpdate, $post_id, $permalink, $title, $featuredImgId, $featuredImgUrl, $ar, $sizesArr,
				$projectDescr, $mouseOverThumbSizesArr, $mouseOverThumbWidth, $mouseOverThumbHeight, $video_url, $video_meta);

			if ($needsUpdate) {
				// save json back to db
				// http://stackoverflow.com/a/22208945/3159159
				$jsonString = json_encode($jsonObject);
				if ($jsonString != false && $jsonString != '') {
					$jsonString = wp_slash( $jsonString );
					update_post_meta( $id, $metaname, $jsonString );
				}
			}
		}
	}

	private static function update_thumbnail_in_category_json($option_name, $post_id, $permalink, $title, $featuredImgId, $featuredImgUrl, $ar, $sizesArr,
			$projectDescr, $mouseOverThumbSizesArr, $mouseOverThumbWidth, $mouseOverThumbHeight, $video_url, $video_meta) {
		$jsonString = get_option( $option_name, false );

		if ($jsonString) {
			$jsonObject = json_decode($jsonString, true);
			$needsUpdate = false;

			LayUpdateThumbnails::update_thumbnail_in_json_recursive($jsonObject['cont'], $needsUpdate, $post_id, $permalink, $title, $featuredImgId, $featuredImgUrl, $ar, $sizesArr,
				$projectDescr, $mouseOverThumbSizesArr, $mouseOverThumbWidth, $mouseOverThumbHeight, $video_url, $video_meta);

			if ($needsUpdate) {
					// save json back to db
				$jsonString = json_encode($jsonObject);
				if ($jsonString != false && $jsonString != "") {
					update_option( $option_name, $jsonString );
				}
			}
		}
	}

	private static function update_thumbnail_in_json_recursive(&$array, &$needsUpdate, $post_id, $permalink, $title, $featuredImgId, $featuredImgUrl, $ar, $sizesArr,
			$projectDescr, $mouseOverThumbSizesArr, $mouseOverThumbWidth, $mouseOverThumbHeight, $video_url, $video_meta) {
		if (is_array($array)) {
			for ($i = 0; $i < count($array); $i++) {
				// element with type of thumbnail has 'postid' attribute .. but it's actual element type could be still 'img' instead of 'postThumbnail'
				if (array_key_exists( 'postid', $array[$i] )) {
					// does element have postid of current post being saved?
					if ($array[$i]['postid'] == $post_id) {
						$needsUpdate = true;
						$array[$i]['link'] = $permalink;
						$array[$i]['title'] = $title;
						if (isset($array[$i]['caption'])) {
							$array[$i]['caption'] = $title;
						}
						$array[$i]['attid'] = $featuredImgId;
						$array[$i]['cont'] = $featuredImgUrl;
						$array[$i]['ar'] = $ar;
						$array[$i]['sizes'] = $sizesArr;
						$array[$i]['descr'] = $projectDescr;
						if (ImageMouseoverThumbnails::$active == true) {
							$array[$i]['mo_sizes'] = $mouseOverThumbSizesArr;
							$array[$i]['mo_w'] = $mouseOverThumbWidth;
							$array[$i]['mo_h'] = $mouseOverThumbHeight;
						}
						if (VideoThumbnails::$active == true) {
							$array[$i]['video_url'] = $video_url;
							$array[$i]['video_w'] = $video_meta['width'];
							$array[$i]['video_h'] = $video_meta['height'];
						}
					}
				}
				// update project thumbnails in carousels
				else if ($array[$i]['type'] == 'carousel') {
					LayUpdateThumbnails::update_thumbnail_in_json_recursive($array[$i]['carousel'], $needsUpdate, $post_id, $permalink, $title, $featuredImgId, $featuredImgUrl, $ar, $sizesArr,
						$projectDescr, $mouseOverThumbSizesArr, $mouseOverThumbWidth, $mouseOverThumbHeight, $video_url, $video_meta);
				}
				// update project thumbnails in elementgrid
				else if ($array[$i]['type'] == 'elementgrid' && isset($array[$i]['config'])) {
					LayUpdateThumbnails::update_thumbnail_in_json_recursive($array[$i]['config']['elements'], $needsUpdate, $post_id, $permalink, $title, $featuredImgId, $featuredImgUrl, $ar, $sizesArr,
						$projectDescr, $mouseOverThumbSizesArr, $mouseOverThumbWidth, $mouseOverThumbHeight, $video_url, $video_meta);
				}
				// update project thumbnails in type stack
				else if ($array[$i]['type'] == 'stack' ) {
					LayUpdateThumbnails::update_thumbnail_in_json_recursive($array[$i]['cont'], $needsUpdate, $post_id, $permalink, $title, $featuredImgId, $featuredImgUrl, $ar, $sizesArr,
						$projectDescr, $mouseOverThumbSizesArr, $mouseOverThumbWidth, $mouseOverThumbHeight, $video_url, $video_meta);
				}
			}
		}
	}
}

LayUpdateThumbnails::init();