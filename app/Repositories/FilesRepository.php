<?php

namespace App\Repositories;

use App\File;

class FilesRepository
{
    public function create($data = [])
    {
        return File::create($data);
    }

    public function update($id, $data = [])
    {
        return File::update($id, $data);
    }

    public function all()
    {
        return File::all();
    }
}