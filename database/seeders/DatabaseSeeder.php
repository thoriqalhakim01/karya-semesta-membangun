<?php
namespace Database\Seeders;

use App\Models\Investment;
use App\Models\Program;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
