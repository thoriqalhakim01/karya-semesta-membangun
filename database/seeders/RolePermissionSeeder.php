<?php
namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();

            Role::create(['name' => 'admin', 'guard_name' => 'web']);
            Role::create(['name' => 'user', 'guard_name' => 'web']);

            $admin = User::create([
                'name'              => 'Admin',
                'email'             => 'admin@karsemam.id',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
                'phone'             => '081234567890',
            ]);

            $admin->detail()->create([
                'birth_date' => '2000-01-01',
                'gender'     => 'male',
            ]);

            $admin->assignRole('admin');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }
    }
}
