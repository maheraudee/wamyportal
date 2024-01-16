<?php

namespace Database\Seeders;

use App\Models\Inventory\Typhardware;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TyphardwaresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('typhardwares')->delete();
        $type = ['Desktop PC','Monitor','Printer','Phone','Mouse','Keyboard','Scanner','Fax','Paper Cutter','Speaker','Desktop MAC','MultiFunction','Stabilizer',
        'H.D.D Ext.','Duplicator','Laptop','Barcode Reader','Switch','PhotoCopier','CD-Rom Ext.','Headphone','Flash Memory','Doc Feeder','Mobile Credit Card','Core Switch',
        'Router','Wireless Controller','External Drive','KVM Apdapter','AV Splitter','Access Point','Server','Motitor System','KVM Switch','Projector','Presenter',];
        $counter = 36;
        for ($i=0; $i < $counter ; $i++) {
            Typhardware::create(['name' => $type[$i], 'status' => 1,'userEntry' => 1]);
        }

    }
}
