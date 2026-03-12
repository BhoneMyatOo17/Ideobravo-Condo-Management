<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Condominium;
use App\Models\Staff;
use App\Models\Resident;
use App\Models\Bill;
use App\Models\Parcel;
use App\Models\Announcement;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create 8 condominiums
        $condos = Condominium::factory(8)->create();
        $condos->first()->update(['code' => 'YUBNQ1']);

        // Get the Ideo Sukhumvit 93 condo (index 3)
        $testCondo = $condos->get(3);

        foreach ($condos as $condo) {

            $firstStaffUser = null;

            // Create 2 staff per condo
            for ($i = 0; $i < 2; $i++) {
                $user = User::factory()->create([
                    'user_type' => 'staff',
                    'condo_id'  => $condo->id,
                ]);

                $staff = Staff::factory()->create([
                    'user_id'          => $user->id,
                    'condominium_id'   => $condo->id,
                ]);

                $user->update([
                    'userable_type' => Staff::class,
                    'userable_id'   => $staff->id,
                ]);

                if ($i === 0) {
                    $firstStaffUser = $user;
                }
            }

            // Create 10 residents per condo
            for ($i = 0; $i < 10; $i++) {
                $user = User::factory()->create([
                    'user_type' => 'resident',
                    'condo_id'  => $condo->id,
                ]);

                $resident = Resident::factory()->create([
                    'user_id'          => $user->id,
                    'condominium_id'   => $condo->id,
                ]);

                $user->update([
                    'userable_type' => Resident::class,
                    'userable_id'   => $resident->id,
                ]);

                // Create 3 bills per resident
                Bill::factory(3)->create([
                    'condominium_id' => $condo->id,
                    'resident_id'    => $resident->id,
                    'generated_by'   => $firstStaffUser->id,
                    'unit_number'    => $resident->unit_number,
                ]);

                // Create 2 parcels per resident
                Parcel::factory(2)->create([
                    'condominium_id' => $condo->id,
                    'resident_id'    => $resident->id,
                    'received_by'    => $firstStaffUser->id,
                    'unit_number'    => $resident->unit_number,
                    'recipient_name' => $user->name,
                ]);
            }

            // Create 5 announcements per condo
            Announcement::factory(5)->create([
                'condominium_id' => $condo->id,
                'created_by'     => $firstStaffUser->id,
            ]);
        }

        // -----------------------------------------------
        // Create hardcoded test staff under Ideo Sukhumvit 93
        // -----------------------------------------------
        $testStaffUser = User::factory()->create([
            'name'      => 'Test Staff',
            'email'     => 'staff@ideo.co.th',
            'password'  => Hash::make('staffideo'),
            'user_type' => 'staff',
            'condo_id'  => $testCondo->id,
        ]);

        $testStaff = Staff::factory()->create([
            'user_id'        => $testStaffUser->id,
            'condominium_id' => $testCondo->id,
        ]);

        $testStaffUser->update([
            'userable_type' => Staff::class,
            'userable_id'   => $testStaff->id,
        ]);

        // -----------------------------------------------
        // Create hardcoded test resident under Ideo Sukhumvit 93
        // -----------------------------------------------
        $testResidentUser = User::factory()->create([
            'name'      => 'Test Resident',
            'email'     => 'resident@gmail.com',
            'password'  => Hash::make('testresident'),
            'user_type' => 'resident',
            'condo_id'  => $testCondo->id,
        ]);

        $testResident = Resident::factory()->create([
            'user_id'        => $testResidentUser->id,
            'condominium_id' => $testCondo->id,
        ]);

        $testResidentUser->update([
            'userable_type' => Resident::class,
            'userable_id'   => $testResident->id,
        ]);

        // 3 paid bills
        Bill::factory(3)->create([
            'condominium_id'    => $testCondo->id,
            'resident_id'       => $testResident->id,
            'generated_by'      => $testStaffUser->id,
            'unit_number'       => $testResident->unit_number,
            'status'            => 'paid',
            'paid_date'         => now()->subDays(10),
            'payment_method'    => 'Bank Transfer',
            'payment_reference' => 'REF-TESTPAID001',
        ]);

        // 2 unpaid bills due late May 2026
        $billTypes = ['electricity', 'water'];
        foreach ($billTypes as $index => $type) {
            Bill::create([
                'condominium_id'       => $testCondo->id,
                'resident_id'          => $testResident->id,
                'generated_by'         => $testStaffUser->id,
                'unit_number'          => $testResident->unit_number,
                'bill_number'          => 'BILL-' . date('Y') . '-TEST0' . ($index + 1),
                'bill_type'            => $type,
                'amount'               => $type === 'electricity' ? 1800.00 : 350.00,
                'issue_date'           => now(),
                'due_date'             => now()->setDay(28)->setMonth(5)->setYear(2026),
                'status'               => 'pending',
                'paid_date'            => null,
                'payment_method'       => null,
                'payment_reference'    => null,
                'payment_proof'        => null,
                'payment_notes'        => null,
                'payment_submitted_at' => null,
                'notes'                => null,
            ]);
        }

        // 2 parcels for test resident
        Parcel::factory(2)->create([
            'condominium_id' => $testCondo->id,
            'resident_id'    => $testResident->id,
            'received_by'    => $testStaffUser->id,
            'unit_number'    => $testResident->unit_number,
            'recipient_name' => $testResidentUser->name,
        ]);

        // -----------------------------------------------
        // Create admin
        // -----------------------------------------------
        User::factory()->create([
            'name'          => 'Admin User',
            'email'         => 'admin@ideo.co.th',
            'password'      => Hash::make('bhonemyatoo'),
            'user_type'     => 'admin',
            'userable_type' => null,
            'userable_id'   => null,
        ]);

        $this->command->info('✅ Seeding completed successfully!');
        $this->command->info('📊 Created:');
        $this->command->info('   - 8 Condominiums');
        $this->command->info('   - 16 Staff (2 per condo) + 1 test staff');
        $this->command->info('   - 80 Residents (10 per condo) + 1 test resident');
        $this->command->info('   - 1 Admin');
        $this->command->info('');
        $this->command->info('🔑 Default password: bhonemyatoo');
        $this->command->info('');
        $this->command->info('🧪 Test Accounts (Ideo Sukhumvit 93):');
        $this->command->info('   📧 resident@gmail.com / testresident — 5 bills (3 paid, 2 pending), 2 parcels');
        $this->command->info('   📧 staff@ideo.co.th / staffideo');
        $this->command->info('   📧 admin@ideo.co.th / bhonemyatoo');
    }
}
