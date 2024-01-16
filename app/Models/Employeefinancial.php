<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employeefinancial extends Model
{
    use HasFactory,SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['empno', 'type', 'amnt', 'status', 'userEntry'];
}
