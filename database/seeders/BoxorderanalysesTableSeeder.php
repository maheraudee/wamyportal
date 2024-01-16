<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoxorderanalysesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('boxordersanalyses')->delete();
        $orders = DB::select('SELECT id, boxorders_id, salaryEmp,purchasingValue, endServiceEmp, balanceboxEmp, premiumBox, debtFurnitureEmp, debtCarEmp, anothSponosrEmp,
        sprId, salarySpr, endServiceSpr, balanceboxSpr,debtFurnitureSpr ,debtCarSpr, anothSponosrSpr, evaluation, reson, userEntry, status, dateLastInstallment, lastPurchasingValue, salesPrice,
        monthlyInstallment, dateFirstInstallment, lastUser, created_at, updated_at FROM oldportal.boxordersanalyses');
        foreach ($orders as $key => $order) {

            $empno = DB::select('SELECT empid FROM oldportal.boxorders where id = ?',[$order->id]);
            $period = DB::select('SELECT installmentPeriod FROM oldportal.boxorders where id = ?',[$order->id]);
            $dateFirst = DB::select('SELECT dateFirstInstallment FROM oldportal.boxordersanalyses  where boxorders_id = ?',[$order->id]);
            $dateLastInstallment = date('Y-m-d', strtotime($dateFirst[0]->dateFirstInstallment."+".$period[0]->installmentPeriod." year"));
            $sprId = $order->sprId ? $order->sprId : null;
            $userid = DB::select('SELECT id from users where empno = ?',[$empno[0]->empid]);

            $lastUserid = DB::select('SELECT id from users where empno = ?',[$order->lastUser]);
            $lastUser =  $lastUserid ? $lastUserid[0]->id : null;

            foreach ($userid as $key => $value) {
                $userEntry = $value->id ?  $value->id : $empno[0]->empid;

                DB::insert('INSERT INTO boxordersanalyses(id,empno, boxorders_id,empsalary, purchasingValue,empendService,empbalancebox,  empremiumBox,empdebtFurniture,empdebtCar,empanothSponosr,
                sprno, sprsalary,sprendService, sprbalancebox,sprdebtFurniture, sprdebtCar,spranothSponosr,evaluation, reson, userEntry,status,dateLastInstallment,
                lastPurchasingValue, salesPrice,monthlyInstallment, dateFirstInstallment,  lastUser, created_at, updated_at)
                values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[$order->id,$empno[0]->empid, $order->boxorders_id, $order->salaryEmp,$order->purchasingValue, $order->endServiceEmp,
                $order->balanceboxEmp,0, $order->debtFurnitureEmp, $order->debtCarEmp, $order->anothSponosrEmp,$sprId, $order->salarySpr, $order->endServiceSpr, $order->balanceboxSpr,$order->debtFurnitureSpr ,
                    $order->debtCarSpr,$order->anothSponosrSpr, $order->evaluation, $order->reson, $userEntry, $order->status,$dateLastInstallment, $order->lastPurchasingValue, $order->salesPrice,
                    $order->monthlyInstallment, $order->dateFirstInstallment, $lastUser, $order->created_at, $order->updated_at]);
            }




            $guarantees = DB::select('SELECT empendService,empbalancebox,empdebtFurniture,empdebtCar,empanothSponosr,sprendService,sprbalancebox,
                sprdebtFurniture,sprdebtCar,spranothSponosr FROM boxordersanalyses where id = ?',[$order->id]);

            foreach ($guarantees as $key => $guarantee) {
                $emptotalGuarantees = $guarantee->empendService + $guarantee->empbalancebox;
                $totalCommitmentEmp = $guarantee->empdebtFurniture + $guarantee->empdebtCar + $guarantee->empanothSponosr ;
                $guaranteesAvailableEmp = $emptotalGuarantees - $totalCommitmentEmp;

                $totalGuaranteesSpr = $guarantee->sprendService + $guarantee->sprbalancebox;
                $totalCommitmentSpr = $guarantee->sprdebtFurniture + $guarantee->sprdebtCar + $guarantee->spranothSponosr ;
                $guaranteesAvailableSpr = $totalGuaranteesSpr - $totalCommitmentSpr;

                $totalGuaranteesAll = $emptotalGuarantees + $totalGuaranteesSpr;
                $totalCommitmentAll =  $totalCommitmentEmp  + $totalCommitmentSpr;
                $guaranteesAvailableAl = $totalGuaranteesAll - $totalCommitmentAll;

                DB::update('update boxordersanalyses set emptotalGuarantees = ?,totalCommitmentEmp = ?,guaranteesAvailableEmp = ?,totalGuaranteesSpr = ?,totalCommitmentSpr = ?,guaranteesAvailableSpr = ?,
                totalGuaranteesAll = ?,totalCommitmentAll = ?,guaranteesAvailableAll = ? where id = ?',[$emptotalGuarantees,$totalCommitmentEmp,$guaranteesAvailableEmp,$totalGuaranteesSpr,
                    $totalCommitmentSpr,$guaranteesAvailableSpr,$totalGuaranteesAll,$totalCommitmentAll,$guaranteesAvailableAl,$order->id]);
            }



        }
        /* emptotalGuarantees,totalCommitmentEmp, guaranteesAvailableEmp,sprpremiumBox,  totalGuaranteesSpr,,totalCommitmentSpr, guaranteesAvailableSpr, totalGuaranteesAll, totalCommitmentAll, guaranteesAvailableAll, purchasingValueGurnt, */
    }
}
