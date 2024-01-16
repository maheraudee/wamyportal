<?php

namespace App\Models\Saving;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Boxbalancestran extends Model
{
    use HasFactory;

    public $timestamps = true;


    protected $fillable = ['balanceid', 'empno', 'premium', 'balance', 'typetran', 'userEntry', 'created_at', 'updated_at'];

    public function balance()
    {
        return $this->belongsTo(Boxbalance::class,'balanceid');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class,'empno');
    }
}
