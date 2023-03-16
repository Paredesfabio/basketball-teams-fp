<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffRequest;
use App\Http\Requests\TeamRequest;
use App\Http\Traits\FileSaveTrait;
use App\Models\Division;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    use FileSaveTrait;

    protected $allDivisions;

    public function __construct(protected Division $division)
    {
        $this->allDivisions = DB::select("SELECT id, name FROM divisions ORDER BY name ASC");
    }

    public function index()
    {
        $data['teams'] = Team::orderBy('name')->with('division:id,name')->get();
        $data['divisions'] = $this->allDivisions;
        return view('teams.index', $data);
    }

    public function details(Team $team)
    {
        $data['team'] = $team->load('division')->load('players.attributes.country');
        return view('teams.detail', $data);
    }

    public function create()
    {
        $data['divisions'] = $this->allDivisions;
        return view('teams.create', $data);
    }

    public function store(TeamRequest $request)
    {
        $createTeam = $request->all();
        $createTeam['icon'] = 'img/team_default.png';
        if ($request->icon) {
            $createTeam['icon'] = $this->saveImage('teams', $request->icon);
        }
        DB::statement('INSERT INTO teams (name, about, color, icon, division_id) VALUES (?, ?, ?, ?, ?)',
                    [
                        $createTeam['name'],
                        $createTeam['about'],
                        $createTeam['color'],
                        $createTeam['icon'],
                        $createTeam['division_id'],
                    ]);
        return redirect()->route('team.index')
            ->with('success', 'Team created successfully.');
    }

    public function edit(Team $team)
    {
        $data['team'] = $team;
        $data['divisions'] = $this->allDivisions;
        return view('teams.edit', $data);
    }

    public function update(TeamRequest $request, Team $team)
    {
        $updateTeam = $request->all();
        $createTeam['icon'] = 'img/team_default.png';
        if ($request->icon) {
            $this->deleteFile($team->icon);
            $updateTeam['icon'] = $this->saveImage('teams', $request->icon);
        }
        DB::statement('UPDATE teams SET name = ?, division_id = ?, about = ?, icon = ?, color = ?
                    WHERE id = ?',
                    [
                        $updateTeam['name'],
                        $updateTeam['division_id'],
                        $updateTeam['about'],
                        $updateTeam['icon'],
                        $updateTeam['color'],
                        $team->id
                    ]);
        return redirect()->route('team.details', ['team' => $team->id])
            ->with('success', 'Team updated successfully');
    }

    public function delete(Team $team)
    {
        try {
            DB::statement('DELETE FROM teams where id = ?',[$team->id]);
            return redirect()->route('team.index')->with('success', 'Team deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('team.details', ['team' => $team->id])
                    ->with('error', 'Team could not be deleted '. $e->getMessage());
        }
    }

    public function createStaff(Team $team)
    {
        $data['team'] = $team;
        return view('teams.staff', $data);
    }

    public function storeStaff(StaffRequest $request)
    {
        DB::statement('INSERT INTO players (first_name, last_name, role, team_id) VALUES (?, ?, ?, ?)',
                    [
                        $request->first_name,
                        $request->last_name,
                        $request->role,
                        $request->team_id,
                    ]);
        return redirect()->route('team.details', ['team' => $request->team_id])
                ->with('success', 'Staff member created successfully');
    }
}
