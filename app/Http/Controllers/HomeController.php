<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $data['divisions'] = DB::select("SELECT * FROM divisions ORDER BY name ASC");
        return view('home',$data);
    }
}
