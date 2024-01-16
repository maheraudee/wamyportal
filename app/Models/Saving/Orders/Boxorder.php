<?php

namespace App\Models\Saving\Orders;

use App\Models\Employee;
use App\Models\Employeefinancial;
use App\Models\Saving\Installmentperiod;
use App\Models\Saving\Saving;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Boxorder extends Model
{
    use HasFactory,SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['empno', 'orderTyp', 'installmentPeriod', 'rate', 'hr', 'box', 'purchasingValue', 'orderdesc', 'sponsor', 'aprovalsponsor', 'aprovalspodate','aprovalacc',
        'aprovalaccdate', 'empacc', 'aprovalmgr', 'aprovalmgrdate', 'empmgr', 'statusid', 'userEntry', 'deleted_at', 'created_at', 'updated_at'];


    public function emporder()
    {
        return $this->belongsTo(Employee::class,'empno');
    }

    public function empaccfun()
    {
        return $this->belongsTo(Employee::class,'empacc');
    }

    public function empmgrfun()
    {
        return $this->belongsTo(Employee::class,'empmgr');
    }


    public function sponsororder()
    {
        return $this->belongsTo(Employee::class,'sponsor');
    }

    /* public function financials()
    {
        return $this->belongsTo(Employeefinancial::class,'empno');
    } */
    /* public function financials()
    {
        return $this->belongsTo(Employeefinancial::class)->using(Employee::class);
    } */

    public function ordertyp()
    {
        return $this->belongsTo(Boxorderstypes::class,'orderTyp');
    }
    public function orderstatus()
    {
        return $this->belongsTo(Boxordersts::class,'statusid');
    }

    /* public function saveing()
    {
        return $this->belongsTo(Saving::class,'empno');
    } */
    public function saveing()
    {
        return $this->belongsTo(Employee::class,'empno');
    }

    /* public function analyse()
    {
        return $this->belongsTo();
    } */

    public function analyse()
    {
        return $this->hasMany(Boxordersanalyse::class,'boxorders_id');
    }
    public function invoices()
    {
        return $this->hasMany(Boxinvoice::class,'boxorders_id');
    }

    public function period()
    {
        return $this->belongsTo(Installmentperiod::class,'installmentPeriod');
    }
}
