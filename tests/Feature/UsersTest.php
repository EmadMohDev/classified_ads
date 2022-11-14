<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    public $auth, $route, $model;

    protected function setUp() :void
    {
        parent::setUp();

        $this->auth  = User::first();
        $this->model = User::class;
        $this->route = 'users';
    }

    public function test_index_page()
    {
        $this->actingAs($this->auth)
                ->get(URL_PREFIX."/$this->route")
                ->assertStatus(200)
                ->assertSeeText(User::count());
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
        $data = [
            'name' => 'test',
            'password' => '123',
            'email' => 'test@ivas.com',
            'department_id' => Department::first()->id,
            'behalf_id' => $this->auth->id,
        ];

        $this->actingAs($this->auth)
                ->post(URL_PREFIX."/$this->route", $data, array('HTTP_X-Requested-With' => 'XMLHttpRequest'))
                ->assertSessionHasNoErrors()
                ->assertStatus(200);
    }

    public function test_show_page()
    {
        $row = $this->model::where('name', 'test')->first();

        $this->actingAs($this->auth)
                ->get(URL_PREFIX."/$this->route/$row->id")
                ->assertSessionHasNoErrors()
                ->assertStatus(200)
                ->assertSeeText($row->name)
                ->assertViewIs('backend.includes.pages.show-page');
    }

    public function test_edit_page()
    {
        $row = User::where('name', 'test')->first();

        $this->actingAs($this->auth)
                ->get(URL_PREFIX."/$this->route/$row->id/edit")
                ->assertViewIs('backend.includes.pages.form-page')
                ->assertStatus(200);
    }

    public function test_update_row()
    {
        $row = User::where('name', 'test')->first();
        $data = [
            "id"        => $row->id,
            "name"      => 'new_test',
            "email"     => $row->email,
            "image"     => null,
            "behalf_id" => $row->behalf_id,
            "department_id" => $row->department_id,
            "annual_credit" => $row->annual_credit,
            "finger_print_id" => $row->finger_print_id,
            "salary_per_monthly" => 1,
            "insurance_deduction" => $row->insurance_deduction
        ];

        $this->actingAs($this->auth)
                ->put(URL_PREFIX."/$this->route/$row->id", $data, array('HTTP_X-Requested-With' => 'XMLHttpRequest'))
                ->assertSessionHasNoErrors()
                ->assertStatus(200);
    }

    public function test_delete_row()
    {
        $row = User::where('name', 'new_test')->first();

        $this->actingAs($this->auth)
                ->delete(URL_PREFIX."/$this->route/$row->id", [], array('HTTP_X-Requested-With' => 'XMLHttpRequest'))
                ->assertSessionHasNoErrors()
                ->assertStatus(200);
    }
}
