<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Traits\UploadFile;
use Exception;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use UploadFile;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $truncate_tables = ['menus', 'content_types', 'roles', 'permissions', 'routes', 'users', 'settings', 'notifications',  'posts'];

        foreach ($truncate_tables as $table) truncateTables($table);

        $this->call(MenuSeeder::class);

        $this->call(RoleSeeder::class);
        $this->call(RouteSeeder::class);

        $this->call(SuperadminSeeder::class);
        $this->call(ContentTypeSeeder::class);
        $this->call(SettingSeeder::class);

    }
}
