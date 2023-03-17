<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Player;
use App\Http\Requests\PlayerRequest;
use App\Repositories\PlayersRepository;

class PlayerController extends Controller
{

    public function __construct(
        protected PlayersRepository $playersRepository
    ) {
        $this->playersRepository = $playersRepository;
    }

    public function index()
    {
        $data['players'] = $this->playersRepository->getAll();
        return view('players.index', $data);
    }

    public function details(Player $player)
    {
        $data['player'] = $player->load('attributes')->load('team');
        return view('players.detail', $data);
    }

    public function create(Team $team)
    {
        $data['team'] = $team;
        $data['countries'] = $this->playersRepository->getCountries();
        return view('players.create', $data);
    }

    public function store(PlayerRequest $request)
    {
        $player = $this->playersRepository->create($request);
        return redirect()->route('team.details', ['team' => $player->team_id])
            ->with('success', 'Player created successfully.');
    }

    public function edit(Player $player)
    {
        $data['player'] = $player->load('attributes')->load('team');
        $data['countries'] = $this->playersRepository->getCountries();
        return view('players.edit', $data);
    }

    public function update(PlayerRequest $request, Player $player)
    {
        $this->playersRepository->update($request, $player);
        return redirect()->route('player.details', ['player' => $player->id])
            ->with('success', 'Player updated successfully.');
    }

    public function delete(Player $player)
    {
        try {
            $this->playersRepository->delete($player->id);
            return redirect()->route('player.index')
                ->with('success', 'Player deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('player.details', ['player' => $player->id])
                ->with('error', 'Player could not be deleted');
        }
    }
}
