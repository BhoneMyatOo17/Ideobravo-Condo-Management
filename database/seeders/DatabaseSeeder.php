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
        // Create 3 condominiums
        $condos = Condominium::factory(8)->create();

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

        // Create 1 admin user
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
        $this->command->info('   - 3 Condominiums');
        $this->command->info('   - 6 Staff (2 per condo)');
        $this->command->info('   - 30 Residents (10 per condo)');
        $this->command->info('   - 90 Bills (3 per resident)');
        $this->command->info('   - 60 Parcels (2 per resident)');
        $this->command->info('   - 15 Announcements (5 per condo)');
        $this->command->info('   - 1 Admin');
        $this->command->info('');
        $this->command->info('🔑 All passwords: bhonemyatoo');
        $this->command->info('📧 Admin email: admin@ideo.co.th');
    }
}
