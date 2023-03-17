<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffRequest;
use App\Http\Requests\TeamRequest;
use App\Http\Traits\FileSaveTrait;
use App\Models\Team;
use App\Repositories\TeamRepository;

class TeamController extends Controller
{
    use FileSaveTrait;

    public function __construct(
        protected TeamRepository $teamsRepository
    ) {
        $this->teamsRepository = $teamsRepository;
    }

    public function index()
    {
        $data['teams'] = $this->teamsRepository->getAll();
        $data['divisions'] = $this->teamsRepository->getDivisions();;
        return view('teams.index', $data);
    }

    public function details(Team $team)
    {
        $data['team'] = $team->load('division:id,name')
            ->load('players.attributes.country:id,name');
        return view('teams.detail', $data);
    }

    public function create()
    {
        $data['divisions'] = $this->teamsRepository->getDivisions();;
        return view('teams.create', $data);
    }

    public function store(TeamRequest $request)
    {
        $this->teamsRepository->create($request);
        return redirect()->route('team.index')
            ->with('success', 'Team created successfully.');
    }

    public function edit(Team $team)
    {
        $data['team'] = $team;
        $data['divisions'] = $this->teamsRepository->getDivisions();;
        return view('teams.edit', $data);
    }

    public function update(TeamRequest $request, Team $team)
    {
        $this->teamsRepository->update($request, $team);
        return redirect()->route('team.details', ['team' => $team->id])
            ->with('success', 'Team updated successfully');
    }

    public function delete(Team $team)
    {
        try {
            $this->teamsRepository->delete($team->id);
            return redirect()->route('team.index')->with('success', 'Team deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('team.details', ['team' => $team->id])
                ->with('error', 'Team could not be deleted ' . $e->getMessage());
        }
    }

    public function createStaff(Team $team)
    {
        $data['team'] = $team;
        return view('teams.staff', $data);
    }

    public function storeStaff(StaffRequest $request)
    {
        $this->teamsRepository->createStaff($request);
        return redirect()->route('team.details', ['team' => $request->team_id])
            ->with('success', 'Staff member created successfully');
    }
}
