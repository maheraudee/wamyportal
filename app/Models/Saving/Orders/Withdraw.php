<?php

namespace App\Models\Saving\Orders;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdraw extends Model
{
    use HasFactory,SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['empno', 'witype', 'amnt', 'hr', 'box', 'outsite', 'agree', 'status', 'userEntry', 'acctext', 'aprovalacct', 'aprovalaccdate', 'empacc', 'aprovalmgr', 'aprovalmgrdate', 'empmgr', 'deleted_at', 'created_at', 'updated_at'];

    public function wtype()
    {
        return $this->belongsTo(Withdrawtype::class,'witype');
    }
    public function emp()
    {
        return $this->belongsTo(Employee::class,'empno');
    }


}
