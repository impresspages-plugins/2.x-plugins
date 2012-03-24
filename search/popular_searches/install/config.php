<?php
//language description
$languageCode = "en"; //RFC 4646 code
$languageShort = "EN"; //Short description
$languageLong = "English"; //Long title
$languageUrl = "en";


$moduleGroupTitle["search"] = "Search";
$moduleTitle["search"]["popular_searches"] = "Popular searches";
  
  $parameterGroupTitle["search"]["popular_searches"]["cache"] = "Cache";
  $parameterGroupAdmin["search"]["popular_searches"]["cache"] = "1";

    $parameterTitle["search"]["popular_searches"]["cache"]["popular_searches"] = "Popular searches cache";
    $parameterValue["search"]["popular_searches"]["cache"]["popular_searches"] = "";
    $parameterAdmin["search"]["popular_searches"]["cache"]["popular_searches"] = "1";
    $parameterType["search"]["popular_searches"]["cache"]["popular_searches"] = "lang_textarea";
  
  $parameterGroupTitle["search"]["popular_searches"]["options"] = "Options";
  $parameterGroupAdmin["search"]["popular_searches"]["options"] = "0";

    $parameterTitle["search"]["popular_searches"]["options"]["popular_searches_count"] = "Popular searches count";
    $parameterValue["search"]["popular_searches"]["options"]["popular_searches_count"] = "15";
    $parameterAdmin["search"]["popular_searches"]["options"]["popular_searches_count"] = "0";
    $parameterType["search"]["popular_searches"]["options"]["popular_searches_count"] = "integer";

    $parameterTitle["search"]["popular_searches"]["options"]["how_old"] = "How old searches should be analyzed (in days)";
    $parameterValue["search"]["popular_searches"]["options"]["how_old"] = "180";
    $parameterAdmin["search"]["popular_searches"]["options"]["how_old"] = "0";
    $parameterType["search"]["popular_searches"]["options"]["how_old"] = "integer";
  
  $parameterGroupTitle["search"]["popular_searches"]["translations"] = "Translations";
  $parameterGroupAdmin["search"]["popular_searches"]["translations"] = "0";

    $parameterTitle["search"]["popular_searches"]["translations"]["popular_searches"] = "Popular searches";
    $parameterValue["search"]["popular_searches"]["translations"]["popular_searches"] = "Frequent search terms";
    $parameterAdmin["search"]["popular_searches"]["translations"]["popular_searches"] = "0";
    $parameterType["search"]["popular_searches"]["translations"]["popular_searches"] = "lang";