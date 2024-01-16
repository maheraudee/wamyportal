<?php

namespace App\Models\Saving;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Boxbalance extends Model
{
    use HasFactory,SoftDeletes;

    public $timestamps = true;
    protected $dates = ['deleted_at'];

    protected $fillable = ['empno', 'datePremium', 'premium', 'balance', 'userEntry', 'status', 'deleted_at', 'created_at', 'updated_at'];

    public function employee()
    {
        return $this->belongsTo(Employee::class,'empno');
    }


}
