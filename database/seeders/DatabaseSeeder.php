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
        DB::beginTransaction();

        try {
            Role::create(['name' => 'admin']);
            Role::create(['name' => 'user']);

            $admin = User::create([
                'name'     => 'Admin',
                'email'    => 'admin@example.com',
                'password' => Hash::make('password'),
                'phone'    => '081234567890',
            ]);

            $user = User::create([
                'name'     => 'User',
                'email'    => 'user@example.com',
                'password' => Hash::make('password'),
                'phone'    => '081234567890',
            ]);

            $user->detail()->create([
                'birth_date' => '1990-01-01',
                'gender'     => 'male',
            ]);

            $admin->assignRole('admin');
            $user->assignRole('user');

            Investment::factory()->count(10)->create();
            Program::factory()->count(10)->create();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw $th;
        }
    }
}
