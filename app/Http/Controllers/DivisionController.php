<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Support\Facades\DB;

class DivisionController extends Controller
{
    public function index()
    {
        $data['divisions'] = DB::select('SELECT id, name FROM divisions');
        return view('divisions.index', $data);
    }

    public function teams(Division $division)
    {
        $data['teams'] = DB::select("SELECT * FROM teams WHERE division_id = ? ORDER BY name ASC", [$division->id]);
        $data['division'] = $division;
        return view('divisions.teams', $data);
    }
}
