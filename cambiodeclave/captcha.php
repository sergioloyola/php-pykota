<?php
session_start( );
$captchaTextSize = 8;
$key = randomText($captchaTextSize);
$_SESSION['key'] = md5( $key );

$captchaImage = imagecreatefrompng( "images/captcha.png" );
$textColor = imagecolorallocate( $captchaImage, 31, 118, 92 );
$lineColor = imagecolorallocate( $captchaImage, 15, 103, 103 );
$imageInfo = getimagesize( "images/captcha.png" );
$linesToDraw = 10;
for( $i = 0; $i < $linesToDraw; $i++ )  {
    $xStart = mt_rand( 0, $imageInfo[ 0 ] );
    $xEnd = mt_rand( 0, $imageInfo[ 0 ] );
    imageline( $captchaImage, $xStart, 0, $xEnd, $imageInfo[1], $lineColor );

}
imagettftext( $captchaImage, 20, 0, 35, 35, $textColor, "fonts/VeraBd.ttf", $key );

header ( "Content-type: image/png" );
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Fri, 20 Jan 2018 05:00:00 GMT");
header("Pragma: no-cache");

imagepng( $captchaImage );

function randomText($length) {
$pattern = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
for($i=0;$i<$length;$i++) { $key .= $pattern{rand(0,61)}; } return $key; }
randomText(8);


?>
