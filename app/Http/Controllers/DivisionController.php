<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Support\Facades\DB;

class DivisionController extends Controller
{
    public function index()
    {
        $data['divisions'] = DB::table('divisions')->selectRaw('id, name')->get();
        return view('divisions.index', $data);
    }

    public function teams(Division $division){
        // $data['teams'] = Team::where('division_id', $division->id)orderBy('name')->get();
        $data['teams'] = DB::select("SELECT * FROM teams WHERE division_id = ? ORDER BY name ASC", [$division->id]);
        $data['division'] = $division;
        return view('divisions.teams', $data);
    }
}
