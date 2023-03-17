<?php

namespace App\Repositories;

use App\Interfaces\BasketballCrudInterface;
use App\Models\Team;
use App\Models\Attribute;
use App\Http\Traits\FileSaveTrait;
use Illuminate\Support\Facades\DB;

class TeamRepository implements BasketballCrudInterface
{

    use FileSaveTrait;

    private $defaultImage = 'img/team_default.png';

    public function __construct(
        protected Team $team
    ) {
        $this->team = $team;
    }

    public function getDivisions()
    {
        return DB::select("SELECT id, name FROM divisions ORDER BY name ASC");
    }

    public function getAll()
    {
        return $this->team->orderBy('name')->with('division:id,name')->get();
    }

    public function create($data)
    {
        $createTeam = $data->all();
        $createTeam['icon'] = $this->defaultImage;
        if ($data->icon) {
            $createTeam['icon'] = $this->saveImage('teams', $data->icon);
        }
        $team = DB::statement(
            'INSERT INTO teams (name, about, color, icon, division_id) VALUES (?, ?, ?, ?, ?)',
            [
                $createTeam['name'],
                $createTeam['about'],
                $createTeam['color'],
                $createTeam['icon'],
                $createTeam['division_id'],
            ]
        );
        return $team;
    }

    public function createStaff($data)
    {
        return DB::statement(
            'INSERT INTO players (first_name, last_name, role, team_id) VALUES (?, ?, ?, ?)',
            [
                $data->first_name,
                $data->last_name,
                $data->role,
                $data->team_id,
            ]
        );
    }

    public function update($data, $team)
    {
        $updateTeam = $data->all();
        $createTeam['icon'] = $this->defaultImage;
        if ($data->icon) {
            $this->deleteFile($team->icon);
            $updateTeam['icon'] = $this->saveImage('teams', $data->icon);
        }
        DB::statement(
            'UPDATE teams SET name = ?, division_id = ?, about = ?, icon = ?, color = ?
                    WHERE id = ?',
            [
                $updateTeam['name'],
                $updateTeam['division_id'],
                $updateTeam['about'],
                $updateTeam['icon'],
                $updateTeam['color'],
                $team->id
            ]
        );
        return $team;
    }

    public function delete($id)
    {
        return DB::statement('DELETE FROM teams where id = ?', [$id]);
    }
}
