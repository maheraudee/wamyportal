<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmins = ['mm-inventory','sm-custody','sm-basicData','acn-addStore','acn-editStore','acn-deltStore','acn-actvStore','acn-addDevice','acn-editDevice','acn-deltDevice','acn-actvDevice',
                        'acn-addCompany','acn-editCompany','acn-deltCompany','acn-actvCompany','acn-addCustody','acn-printCustody','sm-myCustody','mm-box','sm-slate','sm-subscriptions','sm-newRegistration',
                        'sm-updRegistration','sm-membData','acn-deltsubscription','sm-shholderData','acn-updShholder','sm-contracts','sm-myContract','sm-contract','sm-orders','sm-orderServices','sm-withdraws',
                        'sm-sponsers','sm-myorders','sm-mangtBox','sm-analysMenu','sm-analysorder','sm-analyswithdraws','sm-mangtAppBox','sm-signContract','sm-blances','sm-opblances','acn-showopblances','acn-editopblances',
                        'acn-premium','acn-allPremium','mm-setting','sm-tranData','sm-permissions','mm-setting','sm-tranData','sm-permissions','acn-analyService','acn-accntService','acn-mangService','acn-printcontract'];


        $boxaccounts = ['mm-box','sm-slate','sm-subscriptions','sm-newRegistration','sm-updRegistration','sm-membData','sm-shholderData','acn-deltsubscription','acn-updShholder','sm-contracts','sm-myContract',
                        'sm-contract','sm-orders','sm-orderServices','sm-withdraws','sm-sponsers','sm-myorders','sm-mangtBox','sm-analysMenu','sm-analysorder','sm-analyswithdraws','sm-blances','sm-opblances',
                        'acn-editopblances','acn-premium','acn-allPremium','acn-analyService','acn-accntService','acn-printcontract'];

        $boxmembers = ['mm-box','sm-slate','sm-subscriptions','sm-newRegistration','sm-updRegistration','sm-membData','sm-contracts','sm-myContract','sm-orders','sm-orderServices','sm-withdraws','sm-sponsers','sm-myorders'];

        $boxStaffs = ['mm-box','sm-slate','sm-subscriptions','sm-newRegistration','sm-updRegistration','sm-membData','sm-contracts','sm-myContract','sm-contract','sm-orders','sm-orderServices','sm-withdraws',
                        'sm-sponsers','sm-myorders','sm-mangtBox','sm-mangtAppBox','sm-blances','sm-opblances','acn-showopblances','acn-comitService','acn-printcontract'];

        $boxmangers = ['mm-box','sm-slate','sm-subscriptions','sm-newRegistration','sm-updRegistration','sm-membData','sm-contracts','sm-myContract','sm-contract','sm-orders','sm-orderServices','sm-withdraws',
                        'sm-sponsers','sm-myorders','sm-mangtBox','sm-mangtAppBox','sm-blances','sm-opblances','acn-showopblances','acn-comitService','acn-mangService','acn-printcontract'];

        $SuperAdmin = Role::create(['name' => 'SuperAdmin']);/* 1 */
        Role::create(['name' => 'Admin']); /* 2 */
        Role::create(['name' => 'User']); /* 3 */
        Role::create(['name' => 'ItStaff']); /* 4 */
        $BoxStaff   = Role::create(['name' => 'BoxStaff']); /* 5 */
        $BoxMember  = Role::create(['name' => 'BoxMember']); /* 6 */
        $BoxAccount = Role::create(['name' => 'BoxAccount']); /* 7 */
        $BoxManger  = Role::create(['name' => 'BoxManger']); /* 8 */


        $SuperAdmin->givePermissionTo($superadmins);
        $BoxAccount->givePermissionTo($boxaccounts);
        $BoxMember->givePermissionTo($boxmembers);
        $BoxStaff->givePermissionTo($boxStaffs);
        $BoxManger->givePermissionTo($boxmangers);

    }
}
