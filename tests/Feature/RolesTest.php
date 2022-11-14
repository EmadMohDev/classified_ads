<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RolesTest extends TestCase
{
    public $auth, $route, $model;

    protected function setUp() :void
    {
        parent::setUp();

        $this->auth  = User::first();
        $this->model = Role::class;
        $this->route = 'roles';
    }

    public function test_index_page()
    {
        $this->actingAs($this->auth)
                ->get(URL_PREFIX."/$this->route")
                ->assertStatus(200)
                ->assertSeeText($this->model::count());
    }

    public function test_load_table()
    {
        $this->actingAs($this->auth)
                ->get(URL_PREFIX."/$this->route", array('HTTP_X-Requested-With' => 'XMLHttpRequest')) // This array is mean the request act as ajax
                ->assertStatus(200)
                ->assertViewIs('backend.includes.tables.table');
    }

    public function test_create_page()
    {
        $this->actingAs($this->auth)
                ->get(URL_PREFIX."/$this->route/create")
                ->assertStatus(200)
                ->assertViewIs('backend.includes.pages.form-page');
    }

    public function test_store_row()
    {
        $data = ['name' => 'test_role'];

        $this->actingAs($this->auth)
                ->post(URL_PREFIX."/$this->route", $data, array('HTTP_X-Requested-With' => 'XMLHttpRequest'))
                ->assertSessionHasNoErrors()
                ->assertStatus(200);
    }

    public function test_edit_page()
    {
        $row = $this->model::where('name', 'test_role')->first();

        $this->actingAs($this->auth)
                ->get(URL_PREFIX."/$this->route/$row->id/edit")
                ->assertViewIs('backend.includes.forms.form-update')
                ->assertStatus(200);
    }

    public function test_update_row()
    {
        $row = $this->model::where('name', 'test_role')->first();
        $data = ['name' => 'new_test_role'];

        $this->actingAs($this->auth)
                ->put(URL_PREFIX."/$this->route/$row->id", $data, array('HTTP_X-Requested-With' => 'XMLHttpRequest'))
                ->assertSessionHasNoErrors()
                ->assertStatus(200);
    }

    public function test_delete_row()
    {
        $row = $this->model::where('name', 'new_test_role')->first();

        $this->actingAs($this->auth)
                ->delete(URL_PREFIX."/$this->route/$row->id", [], array('HTTP_X-Requested-With' => 'XMLHttpRequest'))
                ->assertSessionHasNoErrors()
                ->assertStatus(200);
    }
}
