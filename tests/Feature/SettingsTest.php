<?php

namespace Tests\Feature;

use App\Models\ContentType;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SettingsTest extends TestCase
{
    public $auth, $route, $model;

    protected function setUp() :void
    {
        parent::setUp();

        $this->auth  = User::first();
        $this->model = Setting::class;
        $this->route = 'settings';
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
            'key'              => 'Test Key',
            'value'            => '<p>Test Key Value</p>',
            'content_type_id'  => ContentType::where('name', 'Advanced Text')->first()->id,
            'system'           => 1
        ];

        $this->actingAs($this->auth)
                ->post(URL_PREFIX."/$this->route", $data, array('HTTP_X-Requested-With' => 'XMLHttpRequest'))
                ->assertSessionHasNoErrors()
                ->assertStatus(200);
    }

    public function test_edit_page()
    {
        $row = $this->model::where('value', 'LIKE', '%Test Key Value%')->first();

        $this->actingAs($this->auth)
                ->get(URL_PREFIX."/$this->route/$row->id/edit")
                ->assertViewIs('backend.includes.pages.form-page')
                ->assertStatus(200);
    }

    public function test_update_row()
    {
        $row = $this->model::where('value', 'LIKE', '%Test Key Value%')->first();
        $data = [
            'key'              => 'Edit Test Key',
            'value'            => '<p>Edit Test Key Value</p>',
            'content_type_id'  => ContentType::where('name', 'Advanced Text')->first()->id,
            'system'           => 1
        ];

        $this->actingAs($this->auth)
                ->put(URL_PREFIX."/$this->route/$row->id", $data, array('HTTP_X-Requested-With' => 'XMLHttpRequest'))
                ->assertSessionHasNoErrors()
                ->assertStatus(200);
    }

    public function test_delete_row()
    {
        $row = $this->model::where('key', 'LIKE', '%Edit Test Key%')->first();
        $this->actingAs($this->auth)
                ->delete(URL_PREFIX."/$this->route/$row->id", [], array('HTTP_X-Requested-With' => 'XMLHttpRequest'))
                ->assertSessionHasNoErrors()
                ->assertStatus(200);
    }
}
