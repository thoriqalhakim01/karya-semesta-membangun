<?php
namespace Database\Seeders;

use App\Models\Investment;
use App\Models\Program;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserInvestment;
use App\Models\UserProgram;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();

            $users = User::factory(10)->create();

            Program::factory(5)->create();
            Investment::factory(5)->create();

            foreach ($users as $user) {
                UserDetail::factory()->create([
                    'user_id' => $user->id,
                ]);

                $user->assignRole('user');

                $randomPrograms = Program::inRandomOrder()->take(fake()->numberBetween(1, 3))->get();

                foreach ($randomPrograms as $program) {
                    UserProgram::create([
                        'user_id'    => $user->id,
                        'program_id' => $program->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    Transaction::create([
                        'user_id'              => $user->id,
                        'transactionable_id'   => $program->id,
                        'transactionable_type' => Program::class,
                        'transaction_date'     => fake()->dateTimeBetween('2024-01-01', '2025-12-31'),
                        'transaction_type'     => fake()->randomElement(['loyalty', 'personal']),
                        'amount'               => fake()->numberBetween(10000, 99999),
                        'payment_method'       => fake()->randomElement(['bank_transfer', 'credit_card', 'e-wallet']),
                    ]);
                }

                $randomInvestments = Investment::inRandomOrder()
                    ->take(fake()->numberBetween(1, 3))
                    ->get();

                foreach ($randomInvestments as $investment) {
                    UserInvestment::create([
                        'user_id'       => $user->id,
                        'investment_id' => $investment->id,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ]);

                    Transaction::create([
                        'user_id'              => $user->id,
                        'transactionable_id'   => $investment->id,
                        'transactionable_type' => Investment::class,
                        'transaction_date'     => fake()->dateTimeBetween('2024-01-01', '2025-12-31'),
                        'amount'               => fake()->numberBetween(10000, 99999),
                        'payment_method'       => fake()->randomElement(['bank_transfer', 'credit_card', 'e-wallet']),
                    ]);
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            throw $th;

            DB::rollBack();
        }
    }
}
