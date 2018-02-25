<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Password;
use App\Project;

class File extends Model
{
    const TYPE_PASSWORD = 'password';
    const TYPE_PROJECT = 'project';

    protected $fillable = ['type', 'entity_id', 'path', 'original_name'];

    private $ext_icons = ['app', 'c', 'css', 'doc', 'docx', 'exe', 'file', 'gif', 'html', 'iso', 'java', 'jpeg', 'jpg', 'key', 'mp3', 'mp4', 'pdf', 'php', 'png', 'ppt', 'rar', 'sql', 'txt', 'xls', 'xlsx', 'xml', 'zip'];

    public function entity()
    {
        return $this->type == static::TYPE_PASSWORD ? Password::find($this->entity_id) : Project::find($this->entity_id);
    }

    public function scopePasswords($query)
    {
        return $query->where('type', static::TYPE_PASSWORD);
    }

    public function scopeProjects($query)
    {
        return $query->where('type', static::TYPE_PROJECT);
    }

    public function link()
    {
        return $this->path;
    }

    public function extension()
    {
        $parts = explode('.', $this->original_name);

        return end($parts);
    }

    public function icon()
    {
        $ext = $this->extension();

        return in_array($ext, $this->ext_icons) ? $ext : 'file';
    }
}
