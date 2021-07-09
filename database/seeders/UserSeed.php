<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin1 = User::create([
            'name' => 'Adminitator oro oro dowo',
            'email' => 'adminPasar1@gmail.test',
            'password' => bcrypt(12345),
            'role' => 'admin',
            'pasar_id' => 1
        ]);

        $roleAdmin1->assignRole('admin');

        $roleAdmin2 = User::create([
            'name' => 'Adminitator Pasar sawo jajar',
            'email' => 'adminPasar2@gmail.test',
            'password' => bcrypt(12345),
            'role' => 'admin',
            'pasar_id' => 2
        ]);

        $roleAdmin2->assignRole('admin');

        $roleSuperAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'super_admin@gmail.test',
            'password' => bcrypt(12345),
            'role' => 'superAdmin',
        ]);

        $roleSuperAdmin->assignRole('superAdmin');
    }
}
