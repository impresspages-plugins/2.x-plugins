<?php
//language description
$languageCode = "en"; //RFC 4646 code
$languageShort = "EN"; //Short description
$languageLong = "English"; //Long title
$languageUrl = "en";


$moduleGroupTitle["images"] = "Images";
$moduleTitle["images"]["simple_slideshow"] = "Simple slideshow";
  
  $parameterGroupTitle["images"]["simple_slideshow"]["options"] = "Options";
  $parameterGroupAdmin["images"]["simple_slideshow"]["options"] = "1";

    $parameterTitle["images"]["simple_slideshow"]["options"]["crop_type"] = "Crop type (crop, fit, width, height) ";
    $parameterValue["images"]["simple_slideshow"]["options"]["crop_type"] = "crop";
    $parameterAdmin["images"]["simple_slideshow"]["options"]["crop_type"] = "0";
    $parameterType["images"]["simple_slideshow"]["options"]["crop_type"] = "string";

    $parameterTitle["images"]["simple_slideshow"]["options"]["image_width"] = "Image width";
    $parameterValue["images"]["simple_slideshow"]["options"]["image_width"] = "940";
    $parameterAdmin["images"]["simple_slideshow"]["options"]["image_width"] = "0";
    $parameterType["images"]["simple_slideshow"]["options"]["image_width"] = "integer";

    $parameterTitle["images"]["simple_slideshow"]["options"]["image_height"] = "Image height";
    $parameterValue["images"]["simple_slideshow"]["options"]["image_height"] = "320";
    $parameterAdmin["images"]["simple_slideshow"]["options"]["image_height"] = "0";
    $parameterType["images"]["simple_slideshow"]["options"]["image_height"] = "integer";

    $parameterTitle["images"]["simple_slideshow"]["options"]["quality"] = "Quality (0 - 100)";
    $parameterValue["images"]["simple_slideshow"]["options"]["quality"] = "90";
    $parameterAdmin["images"]["simple_slideshow"]["options"]["quality"] = "0";
    $parameterType["images"]["simple_slideshow"]["options"]["quality"] = "integer";