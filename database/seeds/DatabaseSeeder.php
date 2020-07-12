<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);

        $user = App\User::find(1);
        dd($user->hasRole('web-developer')); // вернёт true
        dd($user->hasRole('project-manager'));// вернёт false
        dd($user->givePermissionsTo('manage-users'));
        dd($user->hasPermission('manage-users'));// вернёт true
    }
}
