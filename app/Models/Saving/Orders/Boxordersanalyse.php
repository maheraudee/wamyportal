<?php

namespace App\Models\Saving\Orders;;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Boxordersanalyse extends Model
{
    use HasFactory,SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['boxorders_id', 'empno', 'purchasingValue', 'empsalary', 'empremiumBox', 'empendService', 'empbalancebox', 'emptotalGuarantees', 'empdebtFurniture', 'empdebtCar', 'empanothSponosr',
        'totalCommitmentEmp', 'guaranteesAvailableEmp', 'sprno', 'sprsalary', 'sprpremiumBox', 'sprendService', 'sprbalancebox', 'totalGuaranteesSpr', 'sprdebtFurniture', 'sprdebtCar', 'spranothSponosr',
        'totalCommitmentSpr', 'guaranteesAvailableSpr', 'totalGuaranteesAll', 'totalCommitmentAll', 'guaranteesAvailableAll', 'purchasingValueGurnt', 'evaluation', 'reson', 'userEntry', 'status',
        'lastPurchasingValue', 'salesPrice', 'monthlyInstallment', 'dateFirstInstallment', 'dateLastInstallment', 'lastUser'];

    public function emp()
    {
        return $this->belongsTo(Employee::class,'empno');
    }

    public function spr()
    {
        return $this->belongsTo(Employee::class,'sprno');
    }

    public function usercontract()
    {
        return $this->belongsTo(User::class,'lastUser');
    }

    public function order()
    {
        return $this->belongsTo(Boxorder::class,'boxorders_id');
    }




}
