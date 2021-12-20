<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** * MY_Controller Class * * 
@purpose Defined common methods which is accessible in any controller,model,view * 
@author Kalyan Ashis Panja * 
@email kalyan2k@gmail.com */
/** 
  * Debug Variables * 
  * @access public 
  * @param any type, integer 
  * @return array
*/
if ( ! function_exists('pr'))
{
function pr($arr,$e=1){
    if(is_array($arr)) {
            echo "<pre>";
            print_r($arr);
            echo "</pre>";
    }
    else{
            echo "<br>Not an array...<br>";
            echo "<pre>";
            var_dump($arr);
            echo "</pre>";
    }
    if($e==1)
            exit();
    else
            echo "<br>";
	}
}
/** 
  * Subtruct string * 
  * @access public 
  * @param string, integer 
  * @return string
*/
if ( ! function_exists('sub_word'))
{
    function sub_word($str='', $limit=0) {
		    if($str === '') 
				return NULL;
            $text = explode(' ', $str, $limit);
            if (count($text)>=$limit)
            {
                    array_pop($text);
                    $text = implode(" ",$text).'...';
            }
            else
            {
                    $text = implode(" ",$text);
            }
            $text = preg_replace('`\[[^\]]*\]`','',$text);
            return strip_tags($text);
    }
}
/** 
  * Generate Random String * 
  * @access public 
  * @param NULL 
  * @return string
*/
if ( ! function_exists('randomString'))
{
    function randomString()
    {
        $random_string = '';
        $characters='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters_length = strlen($characters);
        for($i=0;$i<5;$i++)
        {
                $random_string .= $characters[mt_rand(0, $characters_length - 1)];
        }
        $final_string=rand(10000, 99999).'_'.$random_string;
        return $final_string;
    }
}
/** 
  * Get Image Source * 
  * @access public 
  * @param STRING 
  * @return STRING
*/
if ( ! function_exists('get_image_source'))
{
    function get_image_source($path=''){
		if($path === '') 
			return false;
		$image_absolute_path = FILE_UPLOAD_ABS_PATH.$path ;
		$image_url           = base_url()."uploads/".$path ;
		if(!file_exists($image_absolute_path)){
			$image_url = base_url()."uploads/noImage.jpg"; 
		}
		return $image_url ;
    }
}
if ( ! function_exists('get_image_source_blog'))
{
    function get_image_source_blog($path=''){
		if($path === '') 
			return false;
		$image_absolute_path = FILE_UPLOAD_ABS_PATH.$path ;
		$image_url           = base_url()."uploads/".$path ;
		if(!file_exists($image_absolute_path) || ($image_absolute_path == './uploads/blog/')){
			$image_url = base_url()."uploads/blog/newtolos.jpg"; 
		}
		return $image_url ;
    }
}
if ( ! function_exists('formatSizeUnits')){
	function formatSizeUnits($bytes)
		{
			if ($bytes >= 1073741824)
			{
				$bytes = number_format($bytes / 1073741824, 2) . ' GB';
			}
			elseif ($bytes >= 1048576)
			{
				$bytes = number_format($bytes / 1048576, 2) . ' MB';
			}
			elseif ($bytes >= 1024)
			{
				$bytes = number_format($bytes / 1024, 2) . ' KB';
			}
			elseif ($bytes > 1)
			{
				$bytes = $bytes . ' bytes';
			}
			elseif ($bytes == 1)
			{
				$bytes = $bytes . ' byte';
			}
			else
			{
				$bytes = '0 bytes';
			}
	
			return $bytes;
	}
}
// not recomended
if ( ! function_exists('getDataByWhere')){
    function getDataByWhere($parrWhere = array(),$table=''){
		if($table == '') return false;
 		$ci=& get_instance();
        $ci->load->database();
        $ci=& get_instance();
        $ci->load->database();
        $ci->db->select("*");
        $ci->db->from($table);
        if(sizeof($parrWhere)) {
            $ci->db->where($parrWhere);
        }
        $sResult = $ci->db->get();
	//echo $this->db->last_query() ;
        if ($sResult->num_rows() > 0) {
            $arrRows = $sResult->result_array();
            return $arrRows;
        }
        return NULL;
    }
}
// not recomended 



if( ! function_exists('custom_encrypt_url')){
    function custom_encrypt_url($url=''){
		if($url === '') 
			return false;
		return urlencode(base64_encode($url));
    }
}

if( ! function_exists('custom_decrypti_url')){
    function custom_decrypti_url($url=''){
		if($url === '') 
			return false;
		return urldecode(base64_decode($url));
    }
}

if( ! function_exists('is_mobile')){
    function is_mobile(){
		$status = 0;
		$useragent=$_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
       $status = 1;
    }
}

if ( ! function_exists('youtubeEmbedFromUrl')){

function youtubeEmbedFromUrl($youtube_url, $width, $height){
    $vid_id = extractUTubeVidId($youtube_url);
    return generateYoutubeEmbedCode($vid_id, $width, $height);
}
}

if ( ! function_exists('vimeoEmbedFromUrl')){

function vimeoEmbedFromUrl($vimeo_url, $width, $height=0){
    
     $html = '<div class="video"><div class="video_iframe"><iframe src="https://player.vimeo.com/video/'.@$vimeo_url.'" width="100%"  frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div></div>';
    
    return $html;
}
}
 
function extractUTubeVidId($url){
    /*
    * type1: http://www.youtube.com/watch?v=H1ImndT0fC8
    * type2: http://www.youtube.com/watch?v=4nrxbHyJp9k&feature=related
    * type3: http://youtu.be/H1ImndT0fC8
    */
    $vid_id = "";
    $flag = false;
    if(isset($url) && !empty($url)){
        /*case1 and 2*/
        $parts = explode("?", $url);
        if(isset($parts) && !empty($parts) && is_array($parts) && count($parts)>1){
            $params = explode("&", $parts[1]);
            if(isset($params) && !empty($params) && is_array($params)){
                foreach($params as $param){
                    $kv = explode("=", $param);
                    if(isset($kv) && !empty($kv) && is_array($kv) && count($kv)>1){
                        if($kv[0]=='v'){
                            $vid_id = $kv[1];
                            $flag = true;
                            break;
                        }
                    }
                }
            }
        }
        
        /*case 3*/
        if(!$flag){
            $needle = "youtu.be/";
            $pos = null;
            $pos = strpos($url, $needle);
            if ($pos !== false) {
                $start = $pos + strlen($needle);
                $vid_id = substr($url, $start, 11);
                $flag = true;
            }
        }
    }
    return $vid_id;
}
 
 function generateYoutubeEmbedCode($vid_id, $width, $height){
    $w = $width;
    $h = $height;
    // $html = '<iframe width="'.$w.'" height="'.$h.'" src="http://www.youtube.com/embed/'.$vid_id.'?rel=0" frameborder="0" allowfullscreen></iframe>';
	$html = '<div class="video"><div class="video_iframe"><iframe width="100%" height="'.$h.'" src="https://www.youtube.com/embed/'.$vid_id.'?rel=0" frameborder="0" allowfullscreen></iframe></div></div>';
    return $html;
}


if( ! function_exists('custom_encrypt_url')){
    function custom_encrypt_url($url=''){
		if($url === '') 
			return false;
		return urlencode(base64_encode($url));
    }
}

if( ! function_exists('objectToArray')) {
    function objectToArray($object)
    {
        if (!is_object($object) && !is_array($object))
            return $object;

        return array_map('objectToArray', (array)$object);
    }
}

if ( ! function_exists('get_widget_by_position')){
    function get_widget_by_position($parrWhere = array()){
        $ci=& get_instance();
        $ci->load->database();
        $ci=& get_instance();
        $ci->load->database();
        $ci->db->select("*");
        $ci->db->from("tbl_cms_widget");
        if(sizeof($parrWhere)) {
            $ci->db->where($parrWhere);
        }
        $ci->db->order_by("tbl_cms_widget.id", "desc");
        $sResult = $ci->db->get();
        //echo $this->db->last_query() ;
        if ($sResult->num_rows() > 0) {
            $arrRows = $sResult->result_array();
            return $arrRows;
        }
        return NULL;
    }
}


if( ! function_exists('calendar_to_mysql')){
    function calendar_to_mysql($date = ''){
        if($date == '') return false;
        $date = str_replace('/','-',$date);
        return date("Y-m-d",strtotime($date));
    }
}

if( ! function_exists('mysql_to_calendar')){
    function mysql_to_calendar($date = ''){
        if($date == '') return false;
        return date("d/m/Y",strtotime($date));
    }
}

if( ! function_exists('display_date_format')){
    function display_date_format($date = ''){
        if($date == '') return false;
        return date("d M, Y",strtotime($date));
    }
}


// Encryption method

function encrypt($plainText, $key) {

    $secretKey = hextobin(md5($key));
    $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
    $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
    $blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
    $plainPad = pkcs5_pad($plainText, $blockSize);
    if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) {
        $encryptedText = mcrypt_generic($openMode, $plainPad);
        mcrypt_generic_deinit($openMode);
    }
    return bin2hex($encryptedText);
}

// Decryption method

function decrypt($encryptedText, $key) {

    $secretKey = hextobin(md5($key));
    $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d,0x0e, 0x0f);
    $encryptedText = hextobin($encryptedText);
    $encryptedText = rtrim($encryptedText, "\000");
    $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
    mcrypt_generic_init($openMode, $secretKey, $initVector);
    $decryptedText = mdecrypt_generic($openMode, $encryptedText);
    $decryptedText = rtrim($decryptedText, "\0");
    mcrypt_generic_deinit($openMode);
    return $decryptedText;
}

// Remove repeated content from request strign
function pkcs5_pad($plainText, $blockSize) {
    $pad = $blockSize - (strlen($plainText) % $blockSize);
    return $plainText . str_repeat(chr($pad), $pad);
}


//********** Hexadecimal to Binary function for php 4.0 version ********
function hextobin($hexString) {
    $length = strlen($hexString);
    $binString = "";
    $count = 0;
    while ($count < $length) {
        $subString = substr($hexString, $count, 2);
        $packedString = pack("H*", $subString);
        if ($count == 0) {
            $binString = $packedString;
        } else {
            $binString.=$packedString;
        }
        $count+=2;
    }
    return $binString;
}



