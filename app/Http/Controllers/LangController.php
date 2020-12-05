<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LangController extends Controller
{
    public function langSwitch(Request $request)
    {       
        $locale = $request->change;
        Session::put('locale', $locale);
        return redirect()->back();
    }
}
