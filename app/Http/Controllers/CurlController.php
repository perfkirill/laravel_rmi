<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurlController extends Controller
{
    //


    public function index(){


        $apiURL = 'https://jsonplaceholder.typicode.com/posts';

        $response = Http::get($apiURL);
        echo "<pre>";
        print_r( $response->json());

    }
}
