<?php
namespace App\Helpers;

use getID3;

class AudioHelper
{
    public static function getAudioDuration($filePath)
    {
        $getId3 = new getID3;
        $fileInfo = $getId3->analyze($filePath);

        return isset($fileInfo['playtime_seconds']) ? $fileInfo['playtime_seconds'] : null;

    }
}