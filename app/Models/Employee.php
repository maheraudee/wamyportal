<?php

namespace App\Models;

use App\Models\Saving\Orders\Boxorder;
use App\Models\Saving\Orders\Withdraw;
use App\Models\Saving\Saving;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'employees';
    public $timestamps = true;

    protected $primaryKey = 'empno';
    protected $dates = ['deleted_at'];

    protected $fillable = ['empno', 'name', 'email', 'salary', 'department', 'section', 'startdate', 'qualification', 'job', 'mobile', 'cardid', 'nationality', 'status', 'deleted_at', 'created_at', 'updated_at'];

    public function boxorderemps()
    {
        return $this->hasMany(Boxorder::class,'empno');
    }
    public function boxordersponsors()
    {
        return $this->hasMany(Boxorder::class,'empno');
    }

    public function financials()
    {
        return $this->hasMany(Employeefinancial::class,'empno');
    }
    public function Savings()
    {
        return $this->hasMany(Saving::class,'empno');
    }

    public function user()
    {
        return $this->hasMany(User::class,'empno');
    }
    public function withdraws()
    {
        return $this->hasMany(Withdraw::class,'empno');
    }
    /* public function user()
    {
        return $this->belongsTo(User::class,);
    } */

}
