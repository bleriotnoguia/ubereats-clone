<?php

namespace App\Helpers;

use Spatie\MediaLibrary\Models\Media;
// use App\Restaurant;
use Spatie\MediaLibrary\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
    /**
     * Get the path for the given media, relative to the root storage path.
     *
     * @param \Spatie\MediaLibrary\Media $media
     *
     * @return string
     */
    public function getPath(Media $media) : string
    {
        $model = class_basename($media->model_type);
        $directoryName = str_plural(strtolower($model));
        // return $model . '/' . $media->getTypeFromMime() . '/' . date("Y-m-d") . '/' . md5($media->name);
        return $directoryName.'/'.$media->model_id.'/'.$media->id.'/';
    }

    /*
     * Get the path for conversions of the given media, relative to the root storage path.
     */
    public function getPathForConversions(Media $media) : string
    {
        return $this->getPath($media).'c/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media).'/cri/';
    }
}
