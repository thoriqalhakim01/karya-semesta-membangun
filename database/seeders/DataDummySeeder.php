<?php
namespace Database\Seeders;

use App\Models\Investment;
use App\Models\Program;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserDetail;
use App\Models\UserFamily;
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

            // Create 100 users
            $users = User::factory(100)->create();

            // Create 10 programs and 7 investments
            $programs    = Program::factory(10)->create();
            $investments = Investment::factory(7)->create();

            // Create user related data (UserDetail, UserFamily, UserAddress)
            foreach ($users as $user) {
                UserDetail::factory()->create([
                    'user_id' => $user->id,
                ]);

                UserFamily::create([
                    'user_id' => $user->id,
                ]);

                UserAddress::create([
                    'user_id' => $user->id,
                ]);

                $user->assignRole('user');

                // Assign random programs to users (1-3 programs per user)
                $randomPrograms = $programs->random(fake()->numberBetween(1, 3));
                foreach ($randomPrograms as $program) {
                    UserProgram::create([
                        'user_id'    => $user->id,
                        'program_id' => $program->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                // Assign random investments to users (1-3 investments per user)
                $randomInvestments = $investments->random(fake()->numberBetween(1, 3));
                foreach ($randomInvestments as $investment) {
                    UserInvestment::create([
                        'user_id'       => $user->id,
                        'investment_id' => $investment->id,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ]);
                }
            }

            // Create exactly 1000 transactions
            for ($i = 0; $i < 1000; $i++) {
                $randomUser = $users->random();

                // Randomly choose between program or investment transaction
                $isProgram = fake()->boolean();

                if ($isProgram) {
                    $randomProgram = $programs->random();
                    Transaction::create([
                        'user_id'              => $randomUser->id,
                        'transactionable_id'   => $randomProgram->id,
                        'transactionable_type' => Program::class,
                        'transaction_date'     => fake()->dateTimeBetween('2024-01-01', '2025-06-01'),
                        'transaction_type'     => fake()->randomElement(['loyalty', 'personal']),
                        'amount'               => fake()->numberBetween(10000, 99999),
                        'payment_method'       => fake()->randomElement(['bank_transfer', 'credit_card', 'e-wallet']),
                    ]);
                } else {
                    $randomInvestment = $investments->random();
                    Transaction::create([
                        'user_id'              => $randomUser->id,
                        'transactionable_id'   => $randomInvestment->id,
                        'transactionable_type' => Investment::class,
                        'transaction_date'     => fake()->dateTimeBetween('2024-01-01', '2025-06-01'),
                        'amount'               => fake()->numberBetween(10000, 99999),
                        'payment_method'       => fake()->randomElement(['bank_transfer', 'credit_card', 'e-wallet']),
                    ]);
                }
            }

            DB::commit();

            $this->command->info('Successfully created:');
            $this->command->info('- 100 users');
            $this->command->info('- 10 programs');
            $this->command->info('- 7 investments');
            $this->command->info('- 1000 transactions');

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
