<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MinusGenerator extends Controller
{
    //
    public function index()
    {
        $result_string  = array();
        return view("minus_generator",['minus_keys'=>$result_string]);
    }


    public function generate(Request $request){

        $text_minus = $request['minus_text'];

        $text_minus = str_replace(array("\r\n", "\r", "\n"), ' ',  strip_tags($text_minus));
        $text_minus_pices = explode(" ", $text_minus);
        $text_minus_pices_uniq = array_unique($text_minus_pices);


        $text_plus = $request['plus_text'];
        $text_plus = str_replace(array("\r\n", "\r", "\n"), ' ',  strip_tags($text_plus));
        $text_plus_pices = explode(" ", $text_plus);
        $text_plus_pices_uniq = array_unique($text_plus_pices);

        $result = array_diff($text_minus_pices_uniq, $text_plus_pices_uniq);

        sort($result, SORT_STRING);

        $result_string = implode("\n", $result);


        return view('minus_generator',['minus_keys'=>$result_string]);

    }
}
