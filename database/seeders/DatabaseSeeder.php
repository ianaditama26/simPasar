<?php

namespace Database\Seeders;

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
        $this->call([
            MasterDataSeeder::class,
            MasterPasarSeed::class,
            MasterLapakSeed::class,
            PedagangSeeder::class,
            RoleSeed::class,
            UserSeed::class,
        ]);
    }
}
