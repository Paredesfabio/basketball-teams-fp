<?php

namespace App\Repositories;

use App\Interfaces\BasketballCrudInterface;
use App\Models\Player;
use App\Models\Attribute;
use App\Http\Traits\FileSaveTrait;
use Illuminate\Support\Facades\DB;

class PlayersRepository implements BasketballCrudInterface
{

    use FileSaveTrait;

    private $fillableFields = ['first_name', 'last_name','role','team_id'];
    private $defaultImage = 'img/player_default.png';

    public function __construct(
        protected Player $player,
        protected Attribute $attribute
    )
    {
        $this->player = $player;
        $this->attribute = $attribute;
    }

    public function getCountries() {
        return DB::select("SELECT id, name FROM countries ORDER BY name ASC");
    }

    public function getAll()
    {
        return $this->player
                ->orderBy('first_name')
                ->with('attributes.country:id,name')
                ->with('team:id,name')
                ->paginate(10);
    }

    public function create($data)
    {
        $playersFields = $this->fillableFields;
        $player = $this->player->create($data->only($playersFields));

        $createAttributes = $data->except($playersFields);
        $createAttributes['image'] = $this->defaultImage;
        if ($data->image) {
            $createAttributes['image'] = $this->saveImage('players', $data->image);
        }
        $createAttributes['player_id'] = $player->id;
        $this->attribute->create($createAttributes);
        return $player;
    }

    public function update($data, $player)
    {
        $playersFields = $this->fillableFields;
        DB::statement('UPDATE players SET first_name = ?, last_name = ?, role = ?, team_id = ?
                        WHERE id = ?',
                    [
                        $data->first_name,
                        $data->last_name,
                        $data->role,
                        $data->team_id,
                        $player->id
                    ]);

        $updateAttributes = $data->except($playersFields);
        $updateAttributes['image'] = $this->defaultImage;
        if ($data->image) {
            $this->deleteFile($player->image);
            $updateAttributes['image'] = $this->saveImage('players', $data->image);
        }
        $player->attributes->update($updateAttributes);
        return $player;
    }

    public function delete($id)
    {
        return DB::statement('DELETE FROM players where id = ?',[$id]);
    }

}
