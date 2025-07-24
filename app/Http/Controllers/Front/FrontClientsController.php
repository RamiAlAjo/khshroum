<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Client;

class FrontClientsController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('front.client', compact('clients'));
    }
}
