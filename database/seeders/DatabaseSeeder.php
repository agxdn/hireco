<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (app()->environment() === 'developing') {
            $this->command->info('Running dummy seeder...');
            $this->call(DummySeeder::class);
            return;
        }
    }
}
