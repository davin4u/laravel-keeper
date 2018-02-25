<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Password;
use App\File;
use App\Repositories\FilesRepository;

class Project extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['user_id', 'name', 'url', 'short_description', 'full_description'];

    public function removable()
    {
        return $this->user_id == auth()->user()->id;
    }

    public function atachFiles($files = [])
    {
        if (!empty($files)) {
            $repository = new FilesRepository();

            foreach ($files as $file) {
                $fileName = md5($file->getFileName() . time()) . '.' . $file->guessClientExtension();

                $path = $file->storeAs('files/projects/' . $this->id, $fileName, 'public');

                $repository->create([
                    'type' => File::TYPE_PROJECT,
                    'entity_id' => $this->id,
                    'path' => $path,
                    'original_name' => str_replace(' ', '-', $file->getClientOriginalName())
                ]);
            }
        }
    }

    public function files()
    {
        return File::projects()->where('entity_id', $this->id)->get();
    }
}
