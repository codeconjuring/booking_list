<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::whereEmail('admin@app.com')->first();

        if ($admin) {
            $admin->update([
                'name'      => 'admin',
                'email'     => 'admin@app.com',
                'password'  => Hash::make('password'),
                'user_type' => 'admin',
            ]);
        } else {
            User::create([
                'name'      => 'admin',
                'email'     => 'admin@app.com',
                'password'  => Hash::make('password'),
                'user_type' => 'admin',
            ]);
        }

    }
}
