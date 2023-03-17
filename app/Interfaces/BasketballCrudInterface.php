<?php

namespace App\Interfaces;

interface BasketballCrudInterface
{
    public function getAll();

    public function create(array $data);

    public function update(array $data, $model);

    public function delete($id);
}
