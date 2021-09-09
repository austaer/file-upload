<?php

namespace Libraries\MediaConvert;

use FFMpeg\FFMpeg;

class Convertor 
{
    /**
     * @var FFMpeg\FFMpeg $ffmpeg
     * @var FFMpeg\Media\Video $media
     */
    private $ffmpeg;
    private $media;

    public function __construct()
    {
        $this->ffmpeg = FFMpeg::create();
    }

    public function open($source)
    {
        $this->media = $this->ffmpeg->open($source);
        return $this;
    }

    public function makeThumbnail(string $path, int $second)
    {
        $frame = $this->media->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds($second));
        $frame->save($path);
        return $this;
    }

    public function close()
    {
        $this->media = null;
    }
}