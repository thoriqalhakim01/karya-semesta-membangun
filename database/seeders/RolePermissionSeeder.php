<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();

            Role::create(['name' => 'admin']);
            Role::create(['name' => 'user']);

            $admin = User::create([
                'name'              => 'Admin',
                'email'             => 'admin@test.com',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
                'phone'             => '081234567890',
            ]);

            $admin->detail()->create([
                'birth_date' => '1990-01-01',
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
