<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Employer;
use App\Models\Job;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        for ($i = 0; $i <= 100; $i++) {
            $role = Role::factory(1)->create();
           
            if ($role) {
                
                $user = User::factory(1)->create();

                if ($user) {
                    $employer = Employer::factory(1)->create();

                    if ($employer) {
                        Job::factory(1)->create();
                    }
                }
            }
        }
    }
}
