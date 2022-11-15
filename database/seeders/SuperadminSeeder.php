<?php

namespace Database\Seeders;

use App\Models\User;
use App\Traits\UploadFile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SuperadminSeeder extends Seeder
{
    use UploadFile;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = $this->GetApiImage('people', 2);

        $data = [
            'name'                  => 'super_admin',
            'email'                 => 'super_admin@ivas.com',
            'password'              => 123,
            'email_verified_at'     => now(),
            'remember_token'        => Str::random(10),
            'image'                 => $this->uploadApiImage($images[0]['src']['medium'], 'users')
        ];

        $user = User::firstOrCreate(['email' => $data['email']], $data);

        $user->assignRole('Super Admin');

        $new_data = [
            'name'                  => 'emad',
            'email'                 => 'emad@ivas.com.eg',
            'password'              => 123,
            'email_verified_at'     => now(),
            'remember_token'        => Str::random(10),
            'image'                 => $this->uploadApiImage($images[1]['src']['medium'], 'users')
        ];

        $new_user = User::firstOrCreate(['email' => $new_data['email']], $new_data);
        $new_user->assignRole('Super Admin');
    }
}
