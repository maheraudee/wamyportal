<?php

namespace Database\Seeders;

use App\Models\Saving\Orders\Boxorder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoxorderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('boxorders')->delete();
        $orders = DB::select('SELECT id, empid,reqType, installmentPeriod, rate, purchasingValue,
            CASE
                WHEN reqType = 1 && qtyFurniture > 0 THEN CONCAT(descFurniture,"-",qtyFurniture)
                WHEN reqType = 1 && qtyDevice > 0 THEN CONCAT(descDevice,"-",qtyDevice)
                WHEN reqType = 2 THEN CONCAT(descCar,"-",qtyCar)
            END AS orderdesc,fstatus, deleted_at, created_at, updated_at FROM oldportal.boxorders');
        /* $orders = DB::select('SELECT id, empid,reqType, installmentPeriod, rate, purchasingValue, CONCAT(descDevice,"-",qtyDevice,"-",descFurniture,"-",qtyFurniture,"-",descCar,"-",qtyCar) As orderdesc,
        fstatus, deleted_at, created_at, updated_at FROM oldportal.boxorders'); */
        foreach ($orders as $key => $order) {

            $userid = DB::select('SELECT id from users where empno = ?',[$order->empid]);
            $orderdesc = $order->orderdesc ? $order->orderdesc : 'لايوجد';
            $fstatus = $order->fstatus == 0 ? 1 : $order->fstatus;
            foreach ($userid as  $value) {
                $boxorders = new Boxorder();
                $boxorders->id = $order->id;
                $boxorders->empno = $order->empid;
                $boxorders->orderTyp = $order->reqType;
                $boxorders->installmentPeriod = $order->installmentPeriod;
                $boxorders->rate = $order->rate;
                $boxorders->hr = 0;
                $boxorders->box = 0;
                $boxorders->purchasingValue = $order->purchasingValue;
                $boxorders->orderdesc = $orderdesc;
                $boxorders->statusid = $order->fstatus;
                $boxorders->userEntry = $value->id; /* $userid[0]->id; */
                $boxorders->deleted_at = $order->deleted_at;
                $boxorders->created_at = $order->created_at;
                $boxorders->updated_at = $order->updated_at;
                $boxorders->save();
            }


            /* DB::insert('INSERT INTO boxorders(
                id, empno, orderTyp, installmentPeriod, rate,hr,box, purchasingValue, orderdesc,statusid, userEntry,deleted_at, created_at, updated_at)
            values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?, ?)',[$order->id, $order->empid,$order->reqType, $order->installmentPeriod, $order->rate,0,0, $order->purchasingValue,
            $orderdesc,$fstatus,

            $userid[0]->id,
            $order->deleted_at, $order->created_at, $order->updated_at]); */


            $hrbox = DB::select('SELECT deductionsHr, deductionsBox FROM oldportal.boxordersanalyses where id = ?',[$order->id]);
            DB::update('update boxorders set hr = ?,box = ? where id = ? and empno = ?',[$hrbox[0]->deductionsHr,$hrbox[0]->deductionsBox,$order->id, $order->empid]);

            $sponsors = DB::select('SELECT empid,approvalSponsor,created_at FROM oldportal.boxordersponsors where boxorders_id = ?',[$order->id]);
            if ($sponsors) {
                $approvalSponsor = $sponsors[0]->approvalSponsor == 0 ? null : $sponsors[0]->approvalSponsor;
                DB::update('update boxorders set sponsor = ?,aprovalsponsor = ?, aprovalspodate = ? where id = ? and empno = ?',[$sponsors[0]->empid,$approvalSponsor,$sponsors[0]->created_at,$order->id, $order->empid]);
            }


            $st = DB::select('SELECT id, empid,reqType,status, fstatus FROM oldportal.boxorders where empid = ?',[$order->empid]);
            if ($st[0]->status == 'جديد' && $st[0]->fstatus == 1) {
                DB::update('update boxorders set statusid = ? where id = ?',[1,$order->id]);
            }

            elseif($st[0]->status == 'تم إعداد العقد' && $st[0]->fstatus == 3) {
                DB::update('update boxorders set statusid = ? where id = ?',[9,$order->id]);
            }
            elseif ($st[0]->status == 'تم رفض الطلب' && $st[0]->fstatus == 2) {
                DB::update('update boxorders set statusid = ? where id = ?',[10,$order->id]);
            }
            elseif($st[0]->status == 'رفض الكافل' && $st[0]->fstatus == 2) {
                DB::update('update boxorders set statusid = ? where id = ?',[3,$order->id]);
            }


            elseif ($st[0]->status == 'تم إعتماد الطلب' && $st[0]->fstatus == 1 ) {
                DB::update('update boxorders set statusid = ? where id = ?',[4,$order->id]);
            }

            elseif ($st[0]->status == 'تم إعتماد الطلب' && $st[0]->fstatus == 3 ) {
                DB::update('update boxorders set statusid = ? where id = ?',[10,$order->id]);
            }
            elseif ($st[0]->status == 'تم إعتماد الطلب' && $st[0]->fstatus == 2 ) {
                DB::update('update boxorders set statusid = ? where id = ?',[10,$order->id]);
            }






            /*
                1- جديد
                2- موافقة الكافل
                3- رفض الكافل
                4- معتمد مالياً
                5- رفض الطلب مالياً
                6- الموظف
                7- المحاسب
                8- الرئيس
                9- طباعة العقد
                10- رفض الطلب
                11- ملغي
                12- مسدد
             */

            /*
                0 => جديد   =>  Update
                1 => تم إعتماد الطلب   => No Entry
                2 => تم رفض الطلب   => New
                3 => طباعة العقد - إغلاق الطلب   => New
            */


        }

    }
}
