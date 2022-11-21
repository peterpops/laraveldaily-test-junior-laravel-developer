<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Companies;
use App\Models\Employees;
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
        // create admin
        $this->call([
            AdminSeeder::class,
        ]);

        // seed employees
        Employees::factory(1000)->create();

        // seed companies
        Companies::factory(1000)->create();
    }
}
