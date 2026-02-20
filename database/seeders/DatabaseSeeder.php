<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         // Create 3 condominiums
        $condos = Condominium::factory(3)->create();

        foreach ($condos as $condo) {
            
            $firstStaffUser = null;
            
            // Create 2 staff users per condo
            for ($i = 0; $i < 2; $i++) {
                $user = User::factory()->create([
                    'user_type' => 'staff',
                ]);
                
                $staff = Staff::factory()->create([
                    'user_id' => $user->id,
                    'condominium_id' => $condo->id,
                ]);
                
                $user->update([
                    'userable_type' => Staff::class,
                    'userable_id' => $staff->id,
                ]);
                
                if ($i === 0) {
                    $firstStaffUser = $user;
                }
            }

            // Create 10 resident users per condo
            for ($i = 0; $i < 10; $i++) {
                $user = User::factory()->create([
                    'user_type' => 'resident',
                ]);
                
                $resident = Resident::factory()->create([
                    'user_id' => $user->id,
                    'condominium_id' => $condo->id,
                ]);
                
                $user->update([
                    'userable_type' => Resident::class,
                    'userable_id' => $resident->id,
                ]);
                
                // Create 3 bills per resident
                Bill::factory(3)->create([
                    'condominium_id' => $condo->id,
                    'resident_id' => $resident->id,
                    'generated_by' => $firstStaffUser->id,
                    'unit_number' => $resident->unit_number,
                ]);
                
                // Create 2 parcels per resident
                Parcel::factory(2)->create([
                    'condominium_id' => $condo->id,
                    'resident_id' => $resident->id,
                    'received_by' => $firstStaffUser->id,
                    'unit_number' => $resident->unit_number,
                    'recipient_name' => $user->name,
                ]);
            }

            // Create 5 announcements per condo
            Announcement::factory(5)->create([
                'condominium_id' => $condo->id,
                'created_by' => $firstStaffUser->id,
            ]);
        }

        // Create 1 admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@ideo.co.th',
            'user_type' => 'admin',
            'userable_type' => null,
            'userable_id' => null,
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
