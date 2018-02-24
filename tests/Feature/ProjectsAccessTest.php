<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsAccessTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauth_user_cant_see_dashboard()
    {
        $this->get(route('dashboard'))
            ->assertStatus(302);
    }

    /** @test */
    public function unauth_user_cant_see_projects()
    {
        $this->get(route('projects_index'))
            ->assertStatus(302);
    }

    /** @test */
    public function unauth_user_cant_see_add_project_page()
    {
        $this->get(route('projects_create'))
            ->assertStatus(302);
    }

    /** @test */
    public function unauth_user_cant_see_project_edit_page()
    {
        $project = factory('App\Project')->create();

        $this->get(route('projects_edit', ['id' => $project->id]))
            ->assertStatus(302);
    }

    /** @test */
    public function unauth_user_cant_delete_project()
    {
        $project = factory('App\Project')->create();

        $this->get(route('projects_delete', ['id' => $project->id]));

        $project = \App\Project::find($project->id);

        $this->assertNotNull($project);
    }

    /** @test */
    public function unauth_user_cant_see_project_passwords_list()
    {
        $project = factory('App\Project')->create();

        $this->get(route('project_passwords_list', ['id' => $project->id]))
            ->assertStatus(302);
    }

    /** @test */
    public function unauth_user_cant_create_project()
    {
        $this->post(route('projects_store'), [
            'name' => 'Test Project',
            'url' => 'http://test.dev/'
        ]);

        $project = \App\Project::where('name', 'Test Project')->first();

        $this->assertNull($project);
    }

    /** @test */
    public function unauth_user_cant_update_project()
    {
        $project = factory('App\Project')->create();

        $this->post(route('projects_update', ['id' => $project->id]), [
            'name' => 'Test Project',
            'url' => 'http://test.dev/'
        ]);

        $updatedProject = \App\Project::find($project->id);

        $this->assertEquals($project->name, $updatedProject->name);
    }
}
