<?php

namespace App\Http\Controllers\API;

use App\TypeOfAgricultur;
use App\Http\Controllers\Controller;

class TypeOfAgriculturController extends Controller
{
    public function typeofagricultur()
    {
        return TypeOfAgricultur::select('id','name_type')->get();
    }
}
