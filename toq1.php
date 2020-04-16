<?php



if(isset($_GET['text'])){
$a = $_GET['text'];
$id = $_GET['id'];
header('content-type: image/jpg');
$img = imagecreatefromjpeg('rasm/1.jpg');
$font = "font.ttf"; 
$white = imagecolorallocate($img, 255, 255, 255);

$txt = $a;
$x = 370;
$y = 990;

imagettftext($img, 70, 0, $x,$y, $white, $font, $txt);

imagejpeg($img,"data/goto.jpg");

header ('location: data/goto.jpg');
}



?>