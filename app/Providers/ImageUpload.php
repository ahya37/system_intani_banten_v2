<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Intervention\Image\Facades\Image;

class ImageUpload extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    public function __construct(){

    }

    public function upload($photo)
    {
        // resize the image to a width of 300 and constrain aspect ratio (auto height)
        $file = $photo;
        $img = Image::make($file);
        $img->resize(200, 200);
        return $img;
    }
}
