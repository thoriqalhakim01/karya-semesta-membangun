<?php
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();

            $this->call(RolePermissionSeeder::class);
            $this->call(DataDummySeeder::class);

            DB::commit();
        } catch (\Throwable $th) {
            throw $th;

            DB::rollBack();
        }
    }
}
