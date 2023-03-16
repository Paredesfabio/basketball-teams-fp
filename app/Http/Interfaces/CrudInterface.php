<?php

namespace App\Interfaces;

interface CrudInterface
{
    public function all();

    public function getById($id);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

}
