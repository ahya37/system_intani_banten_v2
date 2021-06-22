<?php

namespace App\Providers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\ServiceProvider;

class ImageUploadProcess extends ServiceProvider
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

    public function __construct()
    {
        
    }

    public function uploadImgae($request)
    {
        $photo = $request->file('photo');
            $filephoto ='member-'.$request->name . '.' . $photo->getClientOriginalExtension();

            $img = Image::make($photo);
            $img->resize(200, 200);
            $img->save('storage/photo/member/'. $filephoto); // save ke direktori photo petani/farmer

            $photo_idcard = $request->file('photo_idcard');
            $filephoto_idcard ='ktp-'. $request->name . '.' . $photo_idcard->getClientOriginalExtension();
            $photo_idcard->storeAs('public/photo/member/idcard', $filephoto_idcard); // save ke direktori photo ktp/idcard

            $filephoto_family_card = '';
            if ($request->hasFile('photo_family_card')) {
                $photo_family_card = $request->file('photo_family_card');
                $filephoto_family_card ='kk-'. $request->name . '.' . $photo_family_card->getClientOriginalExtension();
                $photo_family_card->storeAs('public/photo/member/familycard', $filephoto_family_card); // save ke direktori kartu keluarga/family_card
            }

        $dataImage = ['filephoto' => $filephoto, 'filephoto_idcard' => $filephoto_idcard];
        return $dataImage;
    }
}
