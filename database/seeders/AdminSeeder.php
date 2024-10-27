<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = config('api.admin.name');
        $email = config('api.admin.email');
        $password = config('api.admin.password');

        if (empty($name) || empty($email) || empty($password)) {
            $this->command->error('Please set ADMIN_NAME, ADMIN_EMAIL AND ADMIN_PASSWORD in .env file');
            return;
        }

        $role = Role::where('name', 'admin')->first();
        if (!$role) {
            $this->command->error('Please run RoleSeeder first');
            return;
        }

        $admin = User::updateOrCreate([
            'email' => $email,
        ], [
            'name' => $name,
            'password' => bcrypt($password),
        ]);
        $admin->roles()->attach($role);
    }
}
