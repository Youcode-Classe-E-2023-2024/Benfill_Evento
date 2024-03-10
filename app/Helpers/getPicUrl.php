<?php
function getPicUrl($fileName, $folder)
{
    $picPath = "storage/$folder/$fileName";
    return asset($picPath);
}

function convertTimeFormat($inputTime, $option)
{
    if ($option === 'd') {
        $timestamp = strtotime($inputTime);
        if ($timestamp === false) {
            return "Invalid input time format";
        }
        $outputFormat = date("l, F j Y", $timestamp);
    } else if ($option === 't') {
        $timestamp = strtotime($inputTime);
        $outputFormat = date("Y-m-d\TH:i", $timestamp);
    }
    return $outputFormat;
}
