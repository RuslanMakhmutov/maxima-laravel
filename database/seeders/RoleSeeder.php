<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'user',
            'admin',
        ];
        foreach ($roles as $role) {
            Role::updateOrCreate([
                'name' => $role
            ]);
        }

        // существующим пользователям без роли добавляем роль user
        $users_ids_without_roles = User::query()
            ->select('id')
            ->whereDoesntHave('roles')
            ->pluck('id');

        if ($users_ids_without_roles->isNotEmpty()) {
            $role = Role::where('name', 'user')->first();

            $role_user_insert = [];
            foreach ($users_ids_without_roles as $user_id) {
                $role_user_insert[] = [
                    'role_id' => $role->id,
                    'user_id' => $user_id
                ];
            }

            RoleUser::insert($role_user_insert);
        }
    }
}
