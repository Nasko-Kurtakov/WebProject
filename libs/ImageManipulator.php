<?php
/**
 * Created by PhpStorm.
 * User: Atanas Kurtakov
 * Date: 28.6.2018 г.
 * Time: 18:04
 */

namespace libs;


class ImageManipulator
{

    private static function imageCreateFromAny($filepath) {
        $type = exif_imagetype($filepath); // [] if you don't have exif you could use getImageSize()
        $allowedTypes = array(
            1,  // [] gif
            2,  // [] jpg
            3  // [] png
        );
        if (!in_array($type, $allowedTypes)) {
            return false;
        }
        switch ($type) {
            case 1 :
                $im = imageCreateFromGif($filepath);
                break;
            case 2 :
                $im = imageCreateFromJpeg($filepath);
                break;
            case 3 :
                $im = imageCreateFromPng($filepath);
                break;
        }
        return $im;
    }

    public static function drawVisibleAreas(string $imgPath,array $areas){
        $im = ImageManipulator::imageCreateFromAny($imgPath);
        foreach ($areas as $visibleArea){
            $highlight = imagecolorallocatealpha($im, 253, 255, 50,30);
            imagefilledrectangle($im, $visibleArea["left"], $visibleArea["top"],$visibleArea["left"]+$visibleArea["width"], $visibleArea["top"]+$visibleArea["height"], $highlight);
            imagejpeg($im,$imgPath);
        }
        imagedestroy($im);
    }

    public static function drawHiddenAreas(string $imgPath,array $areas){
        $im = ImageManipulator::imageCreateFromAny($imgPath);
        if(!$im) return false;
        foreach ($areas as $hiddenArea){
            $black = imagecolorallocate($im, 0, 0, 0);
            imagefilledrectangle($im, $hiddenArea["left"], $hiddenArea["top"], $hiddenArea["left"]+$hiddenArea["width"], $hiddenArea["top"]+$hiddenArea["height"], $black);
            imagejpeg($im,$imgPath);
        }
        imagedestroy($im);
    }
}