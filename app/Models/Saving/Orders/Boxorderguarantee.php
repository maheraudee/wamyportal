<?php

namespace App\Models\Saving\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Boxorderguarantee extends Model
{
    use HasFactory,SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name','status','userEntry'];

}
