<?php

$fontsdir = 'fonts';
define("CAPTCHA_FONTFILE",	"fonts/Comic_Sans_MS.ttf");

define("CAPTCHA_ALPHABET",	"0123456789abcdefghijklmnopqrstuvwxyz");
//define("CAPTCHA_CHARS",		"23456789abcdeghkmnpqsuvxyz");
define("CAPTCHA_CHARS",		"0123456789");
define("CAPTCHA_LENGTH",	5);

# CAPTCHA image size (you do not need to change it, whis parameters is optimal)
define("CAPTCHA_WIDTH",		100);
define("CAPTCHA_HEIGHT",	50);

define("CAPTCHA_FONT_SIZE", 32);
define("CAPTCHA_CHAR_ANGEL_MIN", 0);
define("CAPTCHA_CHAR_ANGEL_MAX", 0);
define("CAPTCHA_CHAR_SHADOW",5);
define("CAPTCHA_CHAR_ALIGN", 40);
define("CAPTCHA_START",		5);
define("CAPTCHA_INTERVAL",	16);

define("CAPTCHA_JPG_QUALITY",	90);


class W3CAPTCHA{

	function W3CAPTCHA(){
	
		$image = imagecreatetruecolor(CAPTCHA_WIDTH, CAPTCHA_HEIGHT);
		//imagealphablending($image, true);
		
		$back_color	= imagecolorallocate($image, 255, 255, 255);	/* rbg - background color */
		$font_color	= imagecolorallocate($image, 32, 64, 96);			/* rbg- shadow color */

		imagefill($image, 0, 0, $back_color);

		$str	=	"";

		$chars 	=	CAPTCHA_CHARS;
		$start	=	CAPTCHA_START;
		$num_chars	=	strlen($chars);
		
		for ($i = 0; $i < CAPTCHA_LENGTH; $i++)
		{
			$char = $chars[rand(0, $num_chars-1)];
			$font_size		=	CAPTCHA_FONT_SIZE;
			$char_align		=	CAPTCHA_CHAR_ALIGN;
			$char_shadow	=	CAPTCHA_CHAR_SHADOW;
			
			$char_angle		=	rand(CAPTCHA_CHAR_ANGEL_MIN, CAPTCHA_CHAR_ANGEL_MAX);
			$shadow_angle	=	$char_angle + $char_shadow*(rand(0, 1)*2-1);
			
			$font_file		=	CAPTCHA_FONTFILE;
			
			imagettftext($image, $font_size, $char_angle,   $start, $char_align, $font_color, $font_file, $char);
			imagettftext($image, $font_size, $shadow_angle, $start, $char_align, $back_color, $font_file, $char);
			
			$start	+=	CAPTCHA_INTERVAL;
			$str	.=	$char;
		}

		$this->keystring = $str;
		
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
		header('Cache-Control: no-store, no-cache, must-revalidate'); 
		header('Cache-Control: post-check=0, pre-check=0', FALSE); 
		header('Pragma: no-cache');
		
		if (function_exists("imagepng"))
		{
			header("Content-type: image/png");
			imagepng($image);
		}
		elseif (function_exists("imagegif"))
		{
			header("Content-type: image/gif");
			imagegif($image);
		}
		elseif (function_exists("imagejpeg"))
		{
			header("Content-type: image/jpeg");
			imagejpeg($image, null, CAPTCHA_JPG_QUALITY);
		}
		imagedestroy($image);
	}

	// returns keystring
	function getKeyString(){
		return $this->keystring;
	}
}
