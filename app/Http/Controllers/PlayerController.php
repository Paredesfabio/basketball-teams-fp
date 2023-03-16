<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Player;
use App\Models\Country;
use App\Models\Attribute;
use App\Http\Requests\PlayerRequest;
use Illuminate\Http\Request;
use App\Http\Traits\FileSaveTrait;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{

    use FileSaveTrait;

    protected $countries;

    public function __construct(protected Country $country)
    {
        $this->countries = DB::select("SELECT * FROM countries ORDER BY name ASC");
    }

    public function index()
    {
        $data['players'] = Player::orderBy('first_name')->with('team')->with('attributes.country')->paginate(10);
        // $data['players'] = DB::table('players')
        //         ->join('teams', 'teams.id', 'players.team_id')
        //         ->join('attributes', 'attributes.player_id', 'players.id')
        //         ->join('countries', 'countries.id', 'attributes.country_id')
        //         ->orderBy('players.first_name')
        //         ->select('players.*', 'attributes.*',
        //                 'teams.id', 'teams.name',
        //                 'countries.id', 'countries.name')->get();
        return view('players.index', $data);
    }

    public function details(Player $player){
        $data['player'] = $player->load('attributes')->load('team');
        return view('players.detail', $data);
    }

    public function create(Team $team)
    {
        $data['team'] = $team;
        $data['countries'] = $this->countries;
        return view('players.create', $data);
    }

    public function store(PlayerRequest $request)
    {
        $playersFields = ['first_name', 'last_name','role','team_id'];
        $player = Player::create($request->only($playersFields));

        $createAttributes = $request->except($playersFields);
        $createAttributes['image'] = 'img/player_default.png';
        if ($request->image) {
            $createAttributes['image'] = $this->saveImage('players', $request->image);
        }
        $createAttributes['player_id'] = $player->id;
        Attribute::create($createAttributes);

        return redirect()->route('team.details', ['team' => $player->team_id])
            ->with('success', 'Player created successfully.');
    }

    public function edit(Player $player)
    {
        $data['player'] = $player->load('attributes')->load('team');
        $data['countries'] = $this->countries;
        return view('players.edit', $data);
    }

    public function update(PlayerRequest $request, Player $player)
    {
        $playersFields = ['first_name', 'last_name','role','team_id'];
        DB::statement('UPDATE players SET first_name = ?, last_name = ?, role = ?, team_id = ?
                        WHERE id = ?',
                    [
                        $request->first_name,
                        $request->last_name,
                        $request->role,
                        $request->team_id,
                        $player->id
                    ]);

        $updateAttributes = $request->except($playersFields);
        $updateAttributes['image'] = 'img/player_default.png';
        if ($request->image) {
            $this->deleteFile($player->image);
            $updateAttributes['image'] = $this->saveImage('players', $request->image);
        }
        $player->attributes->update($updateAttributes);

        return redirect()->route('player.details', ['player' => $player->id])
            ->with('success', 'Player updated successfully.');
    }

    public function delete(Player $player)
    {
        try {
            $player->delete();
            DB::statement('DELETE FROM players where id = ?',[$player->id]);
            return redirect()->route('player.index')
                ->with('success', 'Player deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('player.details', ['player' => $player->id])
                ->with('error', 'Player could not be deleted');
        }
    }

}
