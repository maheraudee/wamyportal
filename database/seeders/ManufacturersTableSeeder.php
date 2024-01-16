<?php

namespace Database\Seeders;

use App\Models\Inventory\Manufacturer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManufacturersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('manufacturers')->delete();
        $manufacturers = ['DELL','ACER','MICROSOFT','HP','NORTEL','PANASONIC','KOBRA','ASSEMPLIED','ZAI','GENIUS','LG','MAC','COMPAQ','BENQ','CANON','MC','VIEW SONIC',
        'UNKNOWN','PANDA','EPSON','SONY','LOGITECH','SAMSUNG','ZC','UNITEC','STAR','MATICA','FUJISU','CROSS CUT','GCOM','UCOM','GENX','MY BOOK STORE','WD',
        'SMART DRIVE ALTRA','SEAGATE','VIN','PROMISE','GIGABYTE','TOSHIBA','ZEBRA','HONYWELL','ALMAKTABA','LOGITECH','DX58S0-I7','NEC','MONSTER','DAHLE','KINGSTONE','AVAYA',
        'CTX','KONICA','IDEAL','SHARP','ELVA','EBA','AURORA','MyCase','Mov','Hypercom','ATLAS','Quietific','Diplo','lenovo','MSI','Philips','Comix','Intel NUC','ASUS','Apple',
        'DATACARD','D-Link','AOC'];
        $counter = 73;
        for ($i=0; $i < $counter ; $i++) {
            Manufacturer::create(['name' => $manufacturers[$i], 'status' => 1,'userEntry' => 1]);
        }
    }
}
