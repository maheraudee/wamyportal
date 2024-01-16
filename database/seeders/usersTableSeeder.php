<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        User::create(['empno'=>11829,'usertypeid'=>1,'name' => 'مهند محمد علي', 'email' => 'moali@wamy.org',
        'mobile' => '0534870595','password' => Hash::make('Is130961')])->assignRole('SuperAdmin');

        User::create(['empno'=>11029,'usertypeid'=>4,'name' => 'Anwar mozumder', 'email' => 'mozumder@wamy.org',
        'password' => Hash::make('wamy@12345')])->assignRole('ItStaff');

        User::create(['empno'=>11723,'usertypeid'=>4,'name' => 'أيمن سمير سلمان منصور', 'email' => 'amansor@wamy.org',
        'password' => Hash::make('wamy@12345')])->assignRole('ItStaff');

        User::create(['empno'=>12019,'usertypeid'=>4,'name' => 'محمد علي عبده رديني', 'email' => 'mrodiny@wamy.org',
        'mobile' => '0502326439','password' => Hash::make('wamy@12345')])->assignRole('ItStaff');

        User::create(['empno'=>11513,'usertypeid'=>4,'name' => 'ماهر عبد العزيز العودة', 'email' => 'r_maher@wamy.org',
        'mobile' => '0541199868','password' => Hash::make('wamy@12345')])->assignRole('ItStaff');

        User::create(['empno'=>11816,'usertypeid'=>4,'name' => 'أكثم أبوعصبة', 'email' => 'akthama@wamy.org',
        'avatar' => '1604385287-16043852142031548458671.jpg','mobile' => '0508593533','password' => Hash::make('wamy@12345')])->assignRole('ItStaff');

        User::create(['empno'=>11166,'usertypeid'=>4,'name' => 'حسن حكمي', 'email' => 'hkudaish@wamy.org','avatar' => '1603714914-me2.jpg',
        'mobile' => '0506431480','password' => Hash::make('wamy@12345')])->assignRole('ItStaff');

        User::create(['empno'=>11402,'usertypeid'=>7,'name' => 'عبدالله أحمد علي الحريري', 'email' => 'ahariri@wamy.org',
        'mobile' => '0506443854','password' => Hash::make('wamy@12345')])->assignRole('BoxAccount');

        User::create(['empno'=>11999,'usertypeid'=>8,'name' => 'عبدالعزيز بن محمد بن عبدالله الجبرين', 'email' => 'ajebreen@wamy.org',
        'mobile' => '0506261682','password' => Hash::make('wamy@12345')])->assignRole('BoxManger');

        User::create(['empno'=>11547,'usertypeid'=>5,'name' => 'أحمد محمد علي إسماعيل', 'email' => 'aismaeel@wamy.org',
        'mobile' => '0500781025','password' => Hash::make('wamy@12345')])->assignRole('BoxStaff');




        $userids = DB::select('SELECT * from oldportal.users where empid NOT IN (?,?,?,?,?,?,?,?,?,?,?,?,?)',[11829,11029,11723,12019,11513,11816,11166,11402,11999,22222,44444,1111,11547]);
        foreach ($userids as $userid) {
            /* DB::insert('INSERT INTO users(empno, name, email, mobile, email_verified_at,password, avatar, remember_token, created_at, updated_at)
            values (?, ?, ?, ?, ?, ?, ?, ?, ?,?)',[
                $userid->empid, $userid->name, $userid->email, $userid->mobile, $userid->email_verified_at, $userid->password, $userid->avatar, $userid->remember_token, $userid->created_at, $userid->updated_at
            ]); */
            User::create(['empno'=>$userid->empid,'usertypeid'=>3,'name' => $userid->name, 'email' => $userid->email,'mobile' => $userid->mobile,
            'password' => Hash::make( $userid->password),'email_verified_at' => $userid->email_verified_at,'avatar' =>$userid->avatar, 'remember_token' =>$userid->remember_token,
            'created_at' =>$userid->created_at, 'updated_at' =>$userid->updated_at])->assignRole('User');

        }
        /* DB::insert("INSERT INTO users (StockId, StockNameAr, StockNameEn, StockTyp, status, userEntry)
            (empno, name, email, mobile,email_verified_at, password, avatar, remember_token, created_at, updated_at)
        VALUES
            (6, , '', '@wamy.org', '', '2020-10-26 04:06:08', Hash::make('wamy@12345'), '', 'JMhTdYBEYWn0DPNev3odHKUFuF7DWdBqUWDsRIPFaYQ7eR8Dtqvy5chiqGV6', '2020-06-20 19:26:02', '2021-03-25 09:00:53'),
            (7, , '', '@wamy.org', '', '2020-10-26 04:29:48', Hash::make('wamy@12345'), '', 'ukgYIMJGLMCnK2Q5rRYTaJv1mw9ATFUASR65MNSOZYxWIxF4UHeGtam8ZwRc', '2020-06-23 06:11:28', '2021-07-11 07:43:31')"); */



    }
}
