<?php

namespace Database\Seeders;

use App\Models\OrganizationUser;
use Illuminate\Database\Seeder;

class OrganizationUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrganizationUser::factory()
                        ->count(5)
                        ->create();
    }
}
