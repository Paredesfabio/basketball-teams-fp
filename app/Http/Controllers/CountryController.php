<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    public function index()
    {
        $data['countries'] = DB::table('countries')
                            ->selectRaw('name, code')
                            ->orderByRaw('name')
                            ->paginate(15);
        return view('countries.index', $data);
    }
}
