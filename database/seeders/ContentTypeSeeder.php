<?php

namespace Database\Seeders;

use App\Models\ContentType;
use Illuminate\Database\Seeder;

class ContentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        truncateTables('content_types');

        $types = [
            ['visible_to_content' => true,  'name' => 'Advanced Text'],
            ['visible_to_content' => true,  'name' => 'Normal Text'],
            ['visible_to_content' => true,  'name' => 'Image'],
            ['visible_to_content' => true,  'name' => 'Audio'],
            ['visible_to_content' => true,  'name' => 'Video'],
            ['visible_to_content' => true,  'name' => 'External Link'],
            ['visible_to_content' => false, 'name' => 'Selector'],
            ['visible_to_content' => false, 'name' => 'Time'],
            ['visible_to_content' => false, 'name' => 'Weekend Days'],
            ['visible_to_content' => false, 'name' => 'File'],
            ['visible_to_content' => false, 'name' => 'Languages'],
        ];

        foreach ($types as $type) ContentType::firstOrCreate(['name' => $type['name']], $type);
    }
}
