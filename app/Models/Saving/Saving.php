<?php

namespace App\Models\Saving;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Saving extends Model
{

    protected $table = 'savings';
    public $timestamps = true;

    use HasFactory,SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['empno', 'participationType', 'datePremium', 'premium', 'contribute', 'signature', 'agree', 'userEntry'];

    public function employee()
    {
        return $this->belongsTo(Employee::class,'empno','empno');
    }
    public function balance()
    {
        return $this->belongsTo(Boxbalance::class,'empno','empno');
    }
}
