<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class IntaniProvider extends ServiceProvider
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

     public function decimalFormat($data) {
        $show = number_format((float)$data,0,',','.');
        return $show;
    }

    public function getRomawi($bln)
    {
        switch ($bln) {
            case  1:
                return 'I';
                break;
            case  2:
                return 'II';
                break;
            case  3:
                return 'II';
                break;
            case  4:
                return 'IV';
                break;
            case  5:
                return 'V';
                break;
            case  6:
                return 'VI';
                break;
            case  7:
                return 'VII';
                break;
            case  8:
                return 'VIII';
                break;
            case  9:
                return 'IX';
                break;
            case  10:
                return 'X';
                break;
            case  11:
                return 'XI';
                break;
            case  12:
                return 'XII';
                break;
        }
    }

}
