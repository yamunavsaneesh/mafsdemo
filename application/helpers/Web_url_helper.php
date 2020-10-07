<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**

 * Site URL

 * Used when creating internal anchors, translates a uri into the current language

 */

function site_url($uri = '')

{

	$CI =& get_instance();

	return $CI->config->site_url($uri);

}

function sanitizeStringForUrl($string){

	$string = url_title($string,'-',true); 

    $string = html_entity_decode($string);

    $string = str_replace(array('�','�','�','�','&'),array('ae','ue','oe','ss','',),$string);

    $string = preg_replace('#[\s]{2,}#',' ',$string);	

    $string = str_replace(array(' '),array('-'),$string);

    return $string;

}
function getYouTubeVideoId($pageVideUrl) {
    $link = $pageVideUrl;
    $video_id = explode("?v=", $link);
    if (!isset($video_id[1])) {
        $video_id = explode("youtu.be/", $link);
    }
    $youtubeID = $video_id[1];
    if (empty($video_id[1])) $video_id = explode("/v/", $link);
    $video_id = explode("&", $video_id[1]);
    $youtubeVideoID = $video_id[0];
    if ($youtubeVideoID) {
        return $youtubeVideoID;
    } else {
        return false;
    }
}
//* End of file Alpha_url_helper.php */

/* Location: ./application/helpers/Alpha_url_helper.php */