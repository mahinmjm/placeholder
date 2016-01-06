<?php


	function hex2rgb( $colour ) {
	    if ( $colour[0] == '#' ) {
	            $colour = substr( $colour, 1 );
	    }
	    if ( strlen( $colour ) == 6 ) {
	            list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
	    } elseif ( strlen( $colour ) == 3 ) {
	            list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
	    } else {
	            return false;
	    }
	    $r = hexdec( $r );
	    $g = hexdec( $g );
	    $b = hexdec( $b );
	    return array( 'red' => $r, 'green' => $g, 'blue' => $b );
	}


	$uri = $_SERVER['QUERY_STRING'];

	$info = explode('/' , $uri);



	$bg_color = hex2rgb($info[2]);
	$bg_red = $bg_color['red'];
	$bg_green = $bg_color['green'];
	$bg_blue = $bg_color['blue'];

	$text_color = hex2rgb($info[3]);
	$text_red = $text_color['red'];
	$text_green = $text_color['green'];
	$text_blue = $text_color['blue'];

	$text = $info[0] . " X " . $info[1] . "px";



	$width = intval($info[0]);
	$height = intval($info[1]);

	$font = 30;
	$font_width = ImageFontWidth($font);
	$font_height = ImageFontHeight($font);
	$text_width = $font_width * strlen($text);
	$position_center = ceil(($width - $text_width) / 2);
	$text_height = $font_height;
	$position_middle = ceil(($height - $text_height) / 2);


	$IMG = imagecreate( $width, $height );
	$background = imagecolorallocate($IMG, $bg_red, $bg_green, $bg_blue);
	$textColor = imagecolorallocate($IMG, $text_red, $text_green, $text_blue);
	ImageString($IMG, $font, $position_center, $position_middle, $text, $textColor);
	imagesetthickness ( $IMG, 5 );

	header( "Content-type: image/png" );
	imagepng($IMG);

	imagecolordeallocate( $IMG, $text_color );
	imagecolordeallocate( $IMG, $background );
	imagedestroy($IMG);



?>
