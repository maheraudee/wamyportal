<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\BoxorderstsSeeder as SeedersBoxorderstsSeeder;
use Database\Seeders\Orders\BoxorderstsSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(EmployeesTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);

        $this->call(usersTableSeeder::class);
        $this->call(TyphardwaresTableSeeder::class);
        $this->call(ManufacturersTableSeeder::class);
        $this->call(StoresTableSeeder::class);
        $this->call(InvtytypesTableSeeder::class);
        $this->call(HardwaresTableSeeder::class);
        $this->call(InventoriesTableSeeder::class);
        $this->call(InvtytracksTableSeeder::class);
        $this->call(EmployeefinancialTableSeeder::class);
        $this->call(ApprovalTableSeeder::class);
        $this->call(SavingsTableSeeder::class);
        $this->call(InstallmentperiodSeeder::class);

        $this->call(BoxorderstsTableSeeder::class);
        $this->call(BoxorderstypesTableSeeder::class);
        $this->call(BoxorderguaranteeTableSeeder::class);
        $this->call(WithdrawtypeTableSeeder::class);
        $this->call(BoxorderTableSeeder::class);
        $this->call(BoxorderanalysesTableSeeder::class);
        $this->call(BoxbalancesTableSeeder::class);


    }
}
