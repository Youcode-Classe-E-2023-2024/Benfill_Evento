<?php
function getPicUrl($fileName, $folder)
{
    $picPath = "storage/$folder/$fileName";
    return asset($picPath);
}
