<?php

function menu($key)
{
  $projects = app()->make('App\Repositories\ProjectsRepository');

  $menu = [];

  $menu['projects'] = [
    '/projects' => 'List',
    '/projects/new' => 'Add New'
  ];

  $menu['passwords'] = [
    '/passwords' => 'List',
    '/passwords/new' => 'Add New'
  ];

  foreach ($projects->all() as $project) {
    $menu['projects']['/projects/' . $project->id . '/passwords'] = $project->name;
  }

  return isset($menu[$key]) ? $menu[$key] : [];
}
