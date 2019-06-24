<?php
class LTUtility{

	public static function is_frontpage(){
		if( is_home() || is_front_page() ){
			return true;
		  }
		  return false;
	}

	public static function getRelativURL($url) {
		$siteUrl = get_site_url();

		if ($url && substr($url, 0, strlen($siteUrl)) === $siteUrl) {
			return substr($url, strlen($siteUrl));
		}
		return $url;
	}

	public static function has_www(){
		if(strpos(get_site_url(), "://www.") !== false){
			return 1;
		}
		return 0;
	}

	// make sure url is https or http in case user switched from http to https or the other way around
	public static function filterURL($url){
		$is_ssl = is_ssl();
		$has_www = self::has_www();

		if($url != ""){
			$substr = substr($url, 0,5);
			if($substr == "http:" && $is_ssl == true){
				$part = substr($url, 5);
				$url = "https:".$part;
			}
			else if($substr == "https" && ($is_ssl == false || $is_ssl == "")){
				$part = substr($url, 5);
				$url = "http".$part;
			}
				
			// add www in case we're on a www domain, but the url does not contain www
			if($has_www == 1){
				if($is_ssl == true){
					// https://www.
					if(substr($url,0,12) != 'https://www.'){
						// $part is everything after https://
						$part = substr($url,8);
						$url = "https://www.".$part;
					}
				}else{
					// http://www.
					if(substr($url,0,11) != 'http://www.'){
						// $part is everything after http://
						$part = substr($url,7);
						$url = "http://www.".$part;
					}			
				}
			}else{
				// no www, see if url needs removal of www
				if($is_ssl == true){
					if(substr($url,0,12) == 'https://www.'){
						// $part is everything after https://www.
						$part = substr($url,12);
						$url = "https://".$part;
					}
				}else{
					// http://www.
					if(substr($url,0,11) == 'http://www.'){
						// $part is everything after http://www.
						$part = substr($url,11);
						$url = "http://".$part;
					}
				}
			}
        }
		return $url;
	}

}
new LTUtility();