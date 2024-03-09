<?php
function getPicUrl($fileName, $folder)
{
    $picPath = "storage/$folder/$fileName";
    return asset($picPath);
}

function convertTimeFormat($inputTime, $option)
{

    if ($option === 'd') {
        // Convert input time to Unix timestamp
        $timestamp = strtotime($inputTime);

        // Check if the conversion was successful
        if ($timestamp === false) {
            return "Invalid input time format";
        }

        // Format the timestamp to the desired output format
        $outputFormat = date("l, F j Y", $timestamp);

    } else {
        $timestamp = strtotime($inputTime);
        $outputFormat = date("Y-m-d\TH:i", $timestamp);
    }
    return $outputFormat;
}
